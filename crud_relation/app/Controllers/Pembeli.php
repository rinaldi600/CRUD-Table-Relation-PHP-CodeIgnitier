<?php

namespace App\Controllers;

use CodeIgniter\Database\Query;

class Pembeli extends BaseController
{
    public function index()
    {
        $pembeliModel = new \App\Models\PembeliModel();
        $perPage = 5;
        if ((int) $this->request->getGet("page_pembeli") > 1) {
            $number = (int) $this->request->getGet("page_pembeli");
            $numberPagination = ($number * $perPage) - ($perPage - 1);
        } else {
            $numberPagination = 1;
        }
        if ($this->request->getGet("keyword")) {
            $keyword = $this->request->getGet("keyword");
            $pembeliModel->like("email",$keyword)->orLike("nama_pembeli",$keyword)->orLike("alamat",$keyword);
        } else {
            $pembeliModel->findAll();
        }
        $db = \Config\Database::connect();
        $data = [
            'users' => $pembeliModel->paginate($perPage,"pembeli"),
            'pager' => $pembeliModel->pager,
            'number' => $numberPagination,
            'resultData' => $db->table('pembeli')->countAll()
        ];
        return view("Pembeli/index", $data);
    }

    public function Edit($id) {
        $db = \Config\Database::connect();
        $encrypter = \Config\Services::encrypter();
        $idPembeliDecryp = $encrypter->decrypt(hex2bin($id));
        $pQuery = $db->prepare(function($db)
        {
            $sql = "SELECT * FROM pembeli WHERE id_pembeli = ?";

            return (new Query($db))->setQuery($sql);
        });
        $results = $pQuery->execute($idPembeliDecryp)->getResultArray()[0];
        $data = [
          'dataPembeli' => $results
        ];
        return view("Pembeli/editPembeli",$data);
    }

    public function editData() {
        $validation =  \Config\Services::validation();
        $getData = $this->request->getPost();
        $validation->setRules([
                'nama_pembeli' => [
                    'label'  => 'Nama Pembeli',
                    'rules'  => 'required|alpha_space',
                    'errors' => [
                        'required' => '{field} Wajib Diisi',
                        'alpha_space' => '{field} Harus Berupa Karakter Huruf'
                    ]
                ],
                'email' => [
                    'label'  => 'Email',
                    'rules'  => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} Wajib Diisi',
                        'valid_email' => '{field} Harus Berupa Email'
                    ]
                ]
            ]
        );

        if ($validation->withRequest($this->request)->run()) {
            $idPembeli = $this->request->getPost('id_pembeli');
            $namaPembeli = $this->request->getPost('nama_pembeli');
            $emailPembeli = $this->request->getPost('email');
            $alamatPembeli = $this->request->getPost('alamat');
            $db = \Config\Database::connect();
            $pQuery = $db->prepare(function($db)
            {
                $sql = "UPDATE pembeli SET nama_pembeli = ?, email = ?, alamat = ? WHERE id_pembeli = ? ";

                return (new Query($db))->setQuery($sql);
            });
            $pQuery->execute($namaPembeli, $emailPembeli, $alamatPembeli, $idPembeli);

            if ($db->affectedRows()) {
                session()->setFlashdata('messageUpdate', 'Data Berhasil Diupdate');
                return redirect()->to('/Pembeli');
            } else {
                session()->setFlashdata('messageUpdateError', 'Data Gagal Diupdate');
                return redirect()->to('/Pembeli');
            }
        } else {
            $encrypter = \Config\Services::encrypter();
            $idPembeli = $this->request->getPost('id_pembeli');
            $encrypterIDPembeli = $encrypter->encrypt($idPembeli);
            session()->setFlashdata([
                'nama_pembeli' => $validation->getError('nama_pembeli'),
                'email' => $validation->getError('email')
            ]);
            return redirect()->to('/Pembeli/Edit/' . bin2hex($encrypterIDPembeli))->withInput();
        }
    }

    public function Hapus($id) {
        $idPembeli = $id;
        $encrypter = \Config\Services::encrypter();
        $idPembeliSecret = $encrypter->decrypt(hex2bin($idPembeli));
        $db = \Config\Database::connect();
        $pQuery = $db->prepare(function($db)
        {
            $sql = "DELETE FROM pembeli WHERE id_pembeli = ?";

            return (new Query($db))->setQuery($sql);
        });

        $pQuery->execute($idPembeliSecret);

        if ($db->affectedRows()) {
            return redirect()->to('/Pembeli')->with('delete','Data Berhasil Dihapus');
        } else {
            return redirect()->to('/Pembeli')->with('deleteError','Data Gagal Dihapus');
        }
    }

    public function insert() {
        return view("Pembeli/insert");
    }

    public function insertData() {
        $validation =  \Config\Services::validation();
        $validation->setRules([
                'id_pembeli' => [
                    'label'  => 'ID Pembeli',
                    'rules'  => 'required|is_unique[pembeli.id_pembeli]|min_length[8]',
                    'errors' => [
                        'required' => '{field} Wajib Diisi',
                        'is_unique' => '{field} Tidak Boleh Sama',
                        'min_length' => '{field} Minimal 8 Karakter'
                    ]
                ],
                'nama_pembeli' => [
                    'label'  => 'Nama Pembeli',
                    'rules'  => 'required|alpha_space',
                    'errors' => [
                        'required' => '{field} Wajib Diisi',
                        'alpha_space' => '{field} Harus Huruf Alphabet',
                    ]
                ],
                'email' => [
                    'label'  => 'Email',
                    'rules'  => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} Wajib Diisi',
                        'valid_email' => '{field} Harus Berupa Format Email'
                    ]
                ],
            ]
        );
        if ($validation->withRequest($this->request)->run()) {
            $db = \Config\Database::connect();

            $idPembeli = $this->request->getPost('id_pembeli');
            $namaPembeli = $this->request->getPost('nama_pembeli');
            $email = $this->request->getPost('email');
            $alamat = $this->request->getPost('alamat');

            $pQuery = $db->prepare(function($db)
            {
                $sql = "INSERT INTO pembeli (id_pembeli, nama_pembeli, email, alamat) VALUES (?, ?, ?, ?)";

                return (new Query($db))->setQuery($sql);
            });

           $pQuery->execute($idPembeli,$namaPembeli,$email,$alamat);

            if ($db->affectedRows()) {
                session()->setFlashdata('message','Data Berhasil Ditambahkan');
                $pQuery->close();
                return redirect()->to("/Pembeli");
            } else {
                session()->setFlashdata('message','Data Gagal Ditambahkan');
                return redirect()->back();
            }
        } else {
            $errorMessage = [
                'idPembeliMessage' => $validation->getError('id_pembeli'),
                'namaPembeliMessage' => $validation->getError('nama_pembeli'),
                'emailMessage' => $validation->getError('email')
            ];
            session()->setFlashdata($errorMessage);
            return redirect()->back()->withInput();
        }
    }

    public function PageNotFoundException() {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
}
