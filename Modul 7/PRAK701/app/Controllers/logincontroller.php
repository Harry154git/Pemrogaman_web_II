<?php

namespace App\Controllers;

use App\Models\User;

class LoginController extends BaseController
{
    public function index()
    {
        return view('loginpage/loginpage');
    }

    public function login()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username tidak boleh kosong.'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong.'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validationErrors', $validation->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new User();
        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set('isLoggedIn', true);
            session()->set('username', $user['username']);
            return redirect()->to('/books');
        } else {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah');
        }
    }
}