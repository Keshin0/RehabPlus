<?php

namespace App\Controllers;

use App\Models\PatientModel;
use App\Models\ExerciseRecordModel;

class PatientController extends BaseController
{
    protected PatientModel $patients;
    protected ExerciseRecordModel $records;

    public function __construct()
    {
        $this->patients = new PatientModel();
        $this->records  = new ExerciseRecordModel();
    }

    public function index()
    {
        $data  = $this->patients->orderBy('name')->paginate(10);
        $pager = $this->patients->pager;
        return view('patients/index', compact('data', 'pager'));
    }

    public function show(int $id)
    {
        $patient = $this->patients->findOrFail($id);
        $records = $this->records->where('patient_id', $id)->orderBy('recorded_at', 'DESC')->findAll();

        $compliance = 0;
        $avgPain    = 0;
        if ($records) {
            $prescribed = array_sum(array_column($records, 'sets_prescribed'));
            $completed  = array_sum(array_column($records, 'sets_completed'));
            $compliance = $prescribed ? round($completed / $prescribed * 100, 1) : 0;
            $avgPain    = round(array_sum(array_column($records, 'pain_level')) / count($records), 1);
        }

        $trend = $this->records->db->query("
            SELECT DATE(recorded_at) AS day, ROUND(AVG(pain_level),1) AS avg_pain
            FROM exercise_records WHERE patient_id = ?
            GROUP BY day ORDER BY day ASC LIMIT 14
        ", [$id])->getResultArray();

        return view('patients/show', compact('patient', 'records', 'compliance', 'avgPain', 'trend'));
    }

    public function create()
    {
        return view('patients/form', ['patient' => null, 'errors' => []]);
    }

    public function store()
    {
        $rules = [
            'name'      => 'required|max_length[100]',
            'condition' => 'required|max_length[150]',
            'avatar'    => 'if_exist|is_image[avatar]|max_size[avatar,2048]',
        ];

        if (! $this->validate($rules)) {
            return view('patients/form', ['patient' => null, 'errors' => $this->validator->getErrors()]);
        }

        $data = [
            'name'      => esc($this->request->getPost('name')),
            'condition' => esc($this->request->getPost('condition')),
        ];

        $file = $this->request->getFile('avatar');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/avatars', $newName);

            // Image manipulation — resize to 200x200
            \Config\Services::image()
                ->withFile(WRITEPATH . 'uploads/avatars/' . $newName)
                ->resize(200, 200, true)
                ->save(WRITEPATH . 'uploads/avatars/' . $newName);

            $data['avatar'] = $newName;
        }

        $this->patients->insert($data);
        \Config\Services::cache()->delete('patient_stats');
        return redirect()->to(site_url('patients'))->with('success', 'Patient added.');
    }

    public function edit(int $id)
    {
        return view('patients/form', ['patient' => $this->patients->findOrFail($id), 'errors' => []]);
    }

    public function update(int $id)
    {
        $rules = [
            'name'      => 'required|max_length[100]',
            'condition' => 'required|max_length[150]',
            'avatar'    => 'if_exist|is_image[avatar]|max_size[avatar,2048]',
        ];

        if (! $this->validate($rules)) {
            return view('patients/form', ['patient' => $this->patients->find($id), 'errors' => $this->validator->getErrors()]);
        }

        $data = [
            'name'      => esc($this->request->getPost('name')),
            'condition' => esc($this->request->getPost('condition')),
        ];

        $file = $this->request->getFile('avatar');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/avatars', $newName);

            \Config\Services::image()
                ->withFile(WRITEPATH . 'uploads/avatars/' . $newName)
                ->resize(200, 200, true)
                ->save(WRITEPATH . 'uploads/avatars/' . $newName);

            $data['avatar'] = $newName;
        }

        $this->patients->update($id, $data);
        \Config\Services::cache()->delete('patient_stats');
        return redirect()->to(site_url('patients'))->with('success', 'Patient updated.');
    }

    public function delete(int $id)
    {
        $this->patients->delete($id);
        \Config\Services::cache()->delete('patient_stats');
        return redirect()->to(site_url('patients'))->with('success', 'Patient deleted.');
    }
}
