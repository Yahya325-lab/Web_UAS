<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new \App\Models\UserModel();

        $userModel->save([
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role' => 'admin'
        ]);

        $userModel->save([
            'username' => 'user2',
            'password' => password_hash('user123', PASSWORD_DEFAULT),
            'role' => 'user'
        ]);

        
    }
}
