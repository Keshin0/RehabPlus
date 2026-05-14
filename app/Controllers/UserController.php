<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data  = $model->paginate(10);
        return view('users/index', ['users' => $data, 'pager' => $model->pager]);
    }

    public function create()
    {
        return view('users/form', ['user' => null, 'errors' => []]);
    }

    public function store()
    {
        $model = new UserModel();
        $data  = [
            'name'     => esc($this->request->getPost('name')),
            'email'    => esc($this->request->getPost('email')),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'),
        ];

        if (! $model->insert($data)) {
            return redirect()->back()->with('errors', $model->errors())->withInput();
        }

        return redirect()->to(site_url('users'))->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = (new UserModel())->find($id);
        if (! $user) return redirect()->to(site_url('users'));
        return view('users/form', ['user' => $user, 'errors' => []]);
    }

    public function update($id)
    {
        $model = new UserModel();
        $data  = [
            'name'  => esc($this->request->getPost('name')),
            'email' => esc($this->request->getPost('email')),
            'role'  => $this->request->getPost('role'),
        ];

        $password = $this->request->getPost('password');
        if (! empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $model->update($id, $data);
        return redirect()->to(site_url('users'))->with('success', 'User updated successfully.');
    }

    public function delete($id)
    {
        (new UserModel())->delete($id);
        return redirect()->to(site_url('users'))->with('success', 'User deleted.');
    }
}
