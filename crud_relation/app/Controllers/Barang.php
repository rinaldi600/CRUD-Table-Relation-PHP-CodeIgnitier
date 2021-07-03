<?php

namespace App\Controllers;

use CodeIgniter\Database\Query;

class Barang extends BaseController
{
    public function index()
    {
        $model = new \App\Models\BarangModel();
        if ($this->request->getGet('keyword')) {
            $keyword = $this->request->getGet('keyword');
            $model->like('nama_barang',$keyword)->orLike('id_barang',$keyword);
        }

        $number = 5;
        if ((int) $this->request->getGet('page_barang') > 1) {
            $numberPagination = ($number * (int) $this->request->getGet('page_barang')) - ($number - 1);
        } else {
            $numberPagination = 1;
        }
        $query = $model->select('nama_barang,stok')->where('stok',0)->findAll();
        $message = [];
        foreach ($query as $row) {
            array_push($message,'Stok Barang '.$row["nama_barang"] . ' Yaitu 0, Silahkan Perbarui Stok');
        }
        session()->setFlashdata('message',$message);
        $data = [
            'users' => $model->paginate($number,'barang'),
            'pager' => $model->pager,
            'number' => $numberPagination,
            'countData' => $model->countAll()
        ];
        return view('Barang/index',$data);
    }

    public function edit($id) {
        $db = \Config\Database::connect();
        $encrypter = \Config\Services::encrypter();
        $decrypKey = $encrypter->decrypt(hex2bin($id));
        $pQuery = $db->prepare(function($db)

        {
            $sql = "SELECT * FROM barang WHERE id_barang = ?";

            return (new Query($db))->setQuery($sql);
        });

        $results = $pQuery->execute($decrypKey)->getResultArray();
        $data = [
            'result' => $results[0]
        ];
        return view('Barang/editData',$data);
    }

    public function editData() {
        $validation =  \Config\Services::validation();
        $validation->setRules([
                'nama_barang' => [
                    'label'  => 'Nama Barang',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi'
                    ]
                ],
                'harga' => [
                    'label'  => 'Harga',
                    'rules'  => 'required|integer',
                    'errors' => [
                        'required' => '{field} Wajib Diisi',
                        'integer' => '{field} Harus Berupa Angka'
                    ]
                ],
                'stok' => [
                    'label'  => 'Stok',
                    'rules'  => 'required|integer',
                    'errors' => [
                        'required' => '{field} Wajib Diisi',
                        'integer' => '{field} Harus Berupa Angka'
                    ]
                ]
            ]
        );
        if ($validation->withRequest($this->request)->run()) {
            $db = \Config\Database::connect();
            $idBarang = $this->request->getPost('id_barang');
            $namaBarang = $this->request->getPost('nama_barang');
            $hargaBarang = $this->request->getPost('harga');
            $stokBarang = $this->request->getPost('stok');

            $pQuery = $db->prepare(function($db)
            {
                $sql = "UPDATE barang SET nama_barang = ?, harga = ?, stok = ? WHERE id_barang = ?";

                return (new Query($db))->setQuery($sql);
            });

            $pQuery->execute($namaBarang, $hargaBarang, $stokBarang, $idBarang);

            if ($db->affectedRows()) {
                session()->setFlashdata('updateMessage','Data Berhasil Diubah');
                return redirect()->to('/Barang');
            }

        } else {
            $config = new \Config\Encryption();
            $encrypter = \Config\Services::encrypter($config);
            $id = $encrypter->encrypt($this->request->getPost('id_barang'));
            $idBarang = bin2hex($id);
            $data = [
                'namaMessage' => $validation->getError('nama_barang'),
                'hargaMessage' => $validation->getError('harga'),
                'stokMessage' => $validation->getError('stok'),
            ];
            session()->setFlashdata($data);
            return redirect()->to('/Barang/Edit/' . $idBarang)->withInput();
        }
    }

    public function hapus() {
        $id = $this->request->getPost('key');
        $encrypter = \Config\Services::encrypter();
        $decrypKey = $encrypter->decrypt(hex2bin($id));
        $db = \Config\Database::connect();
        $barangModel = new \App\Models\BarangModel();
        $rows = $db->table('transaksi')->countAll();
        $pQuery = $db->prepare(function($db)
        {
            $sql = "DELETE FROM barang WHERE id_barang = ?";

            return (new Query($db))->setQuery($sql);
        });

        $pQuery->execute($decrypKey);

        if ($db->affectedRows()) {
            if ($db->table('transaksi')->countAll() < $rows) {
                session()->setFlashdata('informationDanger','Data Transaksi Dengan ID Barang ' . $decrypKey . ' Dihapus Karena Barang Sudah Tidak Ada Lagi');
                return redirect()->to("/");
            }
            session()->setFlashdata('messageDelete','Data Berhasil Dihapus');
            return redirect()->to("/Barang");
        }
    }

    public function tambah() {
        return view("Barang/tambah");
    }

    public function insertData() {
        $validation =  \Config\Services::validation();
        $validation->setRules([
                'id_barang' => [
                    'label'  => 'ID Barang',
                    'rules'  => 'required|is_unique[barang.id_barang]|alpha_numeric',
                    'errors' => [
                        'required' => '{field} Wajib Diisi',
                        'is_unique' => '{field} Sudah Ada di Database',
                        'alpha_numeric' => '{field} Harus Mengandung Huruf dan Angka Serta Tidak Boleh Ada Spasi',
                    ]
                ],
                'harga' => [
                    'label'  => 'Harga',
                    'rules'  => 'required|numeric|decimal',
                    'errors' => [
                        'required' => '{field} Wajib Diisi',
                        'numeric' => '{field} Harus Berupa Angka',
                        'decimal' => '{field} Yang Anda Masukkan Angka Desimal',
                    ]
                ],
                'stok' => [
                    'label'  => 'Stok',
                    'rules'  => 'required|numeric|decimal',
                    'errors' => [
                        'required' => '{field} Wajib Diisi',
                        'numeric' => '{field} Harus Berupa Angka',
                        'decimal' => '{field} Yang Anda Masukkan Angka Desimal',
                    ]
                ],
            ]
        );

        if ($validation->withRequest($this->request)->run()) {
            $db = \Config\Database::connect();
            $idBarang = $this->request->getPost('id_barang');
            $namabarang = $this->request->getPost('nama_barang');
            $hargaBarang = $this->request->getPost('harga');
            $stokBarang = $this->request->getPost('stok');
            $pQuery = $db->prepare(function($db)
            {
                $sql = "INSERT INTO barang (id_barang, nama_barang, harga, stok) VALUES (?, ?, ?, ?)";

                return (new Query($db))->setQuery($sql);
            });

            if ((int) $hargaBarang <= 0 || (int) $stokBarang <= 0 ) {
                $data = [
                  'errorUpdate' => 'Coba Cek Form Input Harga / Stok'
                ];
                session()->setFlashdata($data);
                return redirect()->back()->withInput();
            }
            $pQuery->execute($idBarang, $namabarang, $hargaBarang, $stokBarang);

            if ($db->affectedRows()) {
                session()->setFlashdata('messageUpdate','Data Berhasil Diupdate');
                return redirect()->to("/Barang");
            }
        } else {
            $errorMessage = [
                'id_barang' => $validation->getError('id_barang'),
                'harga' => $validation->getError('harga'),
                'stok' => $validation->getError('stok'),
            ];
            session()->setFlashdata($errorMessage);
            return redirect()->back()->withInput();
        }
    }
}
