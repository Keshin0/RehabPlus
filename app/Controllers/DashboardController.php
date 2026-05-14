<?php

namespace App\Controllers;

use App\Models\ExerciseRecordModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $cache = \Config\Services::cache();

        $patientStats = $cache->get('patient_stats');
        if ($patientStats === null) {
            $patientStats = (new ExerciseRecordModel())->getPatientStats();
            $cache->save('patient_stats', $patientStats, 300); // cache 5 mins
        }

        $recentRecords = (new ExerciseRecordModel())->getRecentRecords(10);
        $totalPatients = count($patientStats);
        $avgCompliance = $totalPatients
            ? round(array_sum(array_column($patientStats, 'compliance_rate')) / $totalPatients, 1) : 0;
        $avgPain = $totalPatients
            ? round(array_sum(array_column($patientStats, 'avg_pain')) / $totalPatients, 1) : 0;

        return view('dashboard/index', compact('patientStats', 'recentRecords', 'totalPatients', 'avgCompliance', 'avgPain'));
    }
}
