<?php namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        helper(['form']);
        echo view('auth/login');
    }

    public function loginProcess()
    {
        helper(['form']);
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if(!$this->validate($rules)) {
            return redirect()->to('/login')->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();
        $user = $model->where('username', $this->request->getVar('username'))->first();

        if(!$user) {
            return redirect()->to('/login')->with('error', 'Username tidak ditemukan');
        }

        if (!password_verify($this->request->getVar('password'), $user['password'])) {
            return redirect()->to('/login')->with('error', 'Password salah');
        }

        // Simpan session
        session()->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role'],
            'isLoggedIn' => true,
        ]);

        if($user['role'] === 'admin') {
            return redirect()->to('/admin');
        } else {
            return redirect()->to('/user');
        }
    }
    public function register()
    {
        return view('auth/signup');
    }

    public function registerProcess()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'username' => 'required|is_unique[users.username]',
            'password' => 'required|min_length[4]',
            'confirm_password' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new \App\Models\UserModel();
        $userModel->insert([
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/login')->with('success', 'Akun berhasil dibuat, silakan login.');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logout berhasil');
    }
}
