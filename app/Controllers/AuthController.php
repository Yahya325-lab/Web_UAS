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

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logout berhasil');
    }
}
