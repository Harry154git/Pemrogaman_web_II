<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            'username'=>'Harry',
            'email'=>'harry@gmail.com',
            'password'=>password_hash('123456', PASSWORD_BCRYPT),
        );

        $this->db->table('user')->insert($data);
    }
}