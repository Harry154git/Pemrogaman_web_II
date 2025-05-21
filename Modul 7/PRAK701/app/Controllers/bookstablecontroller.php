<?php

namespace App\Controllers;

use App\Models\Buku;
use CodeIgniter\Controller;

class Bookstablecontroller extends BaseController
{
    protected $bukuModel;

    public function __construct()
    {
        $this->bukuModel = new Buku();
        helper(['form', 'url']);
    }

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Login terlebih dahulu!');
        }

        $data = [
            'buku' => $this->bukuModel->findAll(),
            'validation' => session('validation') ? session('validation') : \Config\Services::validation(),
            'editMode' => false,
            'editData' => null,
        ];

        return view('bookstablepage/bookstablepage', $data);
    }

    public function save()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Login terlebih dahulu!');
        }

        $id = $this->request->getPost('id'); 

        $rules = [
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required|regex_match[/^[A-Za-z0-9\s\.\,\-]+$/]',
                'errors' => [
                    'required' => 'Judul wajib diisi.',
                    'regex_match' => 'Judul hanya boleh berisi huruf, angka, spasi, titik, koma, atau strip.'
                ]
            ],
            'penulis' => [
                'label' => 'Penulis',
                'rules' => 'required|regex_match[/^[A-Za-z\s\.\,\-]+$/]',
                'errors' => [
                    'required' => 'Penulis wajib diisi.',
                    'regex_match' => 'Penulis hanya boleh berisi huruf, spasi, titik, koma, atau strip.'
                ]
            ],
            'penerbit' => [
                'label' => 'Penerbit',
                'rules' => 'required|regex_match[/^[A-Za-z\s\.\,\-]+$/]',
                'errors' => [
                    'required' => 'Penerbit wajib diisi.',
                    'regex_match' => 'Penerbit hanya boleh berisi huruf, spasi, titik, koma, atau strip.'
                ]
            ],
            'tahun_terbit' => [
                'label' => 'Tahun Terbit',
                'rules' => 'required|integer|greater_than_equal_to[1901]|less_than_equal_to[2025]',
                'errors' => [
                    'required' => 'Tahun terbit wajib diisi.',
                    'integer' => 'Tahun terbit harus berupa angka.',
                    'greater_than_equal_to' => 'Tahun terbit tidak boleh kurang dari 1901.',
                    'less_than_equal_to' => 'Tahun terbit tidak boleh lebih dari 2025.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'judul' => $this->request->getPost('judul'),
            'penulis' => $this->request->getPost('penulis'),
            'penerbit' => $this->request->getPost('penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
        ];

        if ($id) {
            $this->bukuModel->update($id, $data);
            $message = 'Buku berhasil diperbarui.';
        } else {
            $message = 'Buku berhasil ditambahkan.';
        }

        return redirect()->to('/books')->with('success', $message);
    }

    public function edit($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Login terlebih dahulu!');
        }

        $book = $this->bukuModel->find($id);

        if (!$book) {
            return redirect()->to('/books')->with('error', 'Buku tidak ditemukan.');
        }

        $data = [
            'buku' => $this->bukuModel->findAll(),
            'validation' => session('validation') ? session('validation') : \Config\Services::validation(),
            'editMode' => true,
            'editData' => $book,
        ];

        return view('bookstablepage/bookstablepage', $data);
    }

    public function delete($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Login terlebih dahulu!');
        }

        if (!$this->bukuModel->find($id)) {
            return redirect()->to('/books')->with('error', 'Buku tidak ditemukan.');
        }

        $this->bukuModel->delete($id);
        return redirect()->to('/books')->with('success', 'Buku berhasil dihapus.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}