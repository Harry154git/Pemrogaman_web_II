<?php

namespace App\Models;
use CodeIgniter\Model;

class DataModel extends Model {
    public function getberandadata() {
        return [
            'nama' => 'Harry Pratama Yunus',
            'nim' => '2310817210010'
        ];
    }

    public function getprofildata() {
        return [
            'nama' => 'Harry Pratama Yunus',
            'gambar' => 'fotoprofil.jpeg',
            'nim' => '2310817210010',
            'asalprodi' => 'Teknologi Informasi',
            'hobi' => 'coding, gamer, gym',
            'skill' => 'jago main magic chess, jago main gitar, jago coding di C++, java, python'
        ];
    }
}