<?php

namespace App\Controllers;

use CodeIgniter\Database\Query;

class Transaksi extends BaseController
{
    public function index()
    {
        $transaksiModel = new \App\Models\TransaksiModel();
        if ($this->request->getGet('keyword')) {
            $keyowrdData = $this->request->getGet('keyword');
            $transaksiModel->like('id_transaksi', $keyowrdData)->orLike('id_pembeli',$keyowrdData)->orLike('id_barang',$keyowrdData);
        }

        $numberPage = (int) $this->request->getGet('page_transaksi');
        $page = 5;
        if ($numberPage > 1) {
            $numberListData = ($numberPage * $page) - ($page - 1);
        } elseif (!$numberPage || $numberPage = 1) {
            $numberListData = 1;
        }
        $data = [
            'users' => $transaksiModel->paginate($page,'transaksi'),
            'pager' => $transaksiModel->pager,
            'number' => session()->set('value',$numberListData),
            'resultData' => $transaksiModel->countAll()
        ];
       return view("Transaksi/index",$data);
    }

    public function detailPayment($id) {
        $db = \Config\Database::connect();
        $query = $db->query("select nama_pembeli, nama_barang, harga, jumlah, total from pembeli, barang, transaksi where transaksi.id_pembeli = pembeli.id_pembeli and transaksi.id_barang = barang.id_barang and id_transaksi = '$id'");
        $data = [
            'data' => $query->getResultArray()
        ];
        return view("Transaksi/DetailTransaksi",$data);
    }

    public function tambahData() {
        $db = \Config\Database::connect();
        $builder = $db->table("pembeli");
        $builder->select("id_pembeli,nama_pembeli");
        $query = $builder->get();
//        =======================================
        $db1 = \Config\Database::connect();
        $builder1 = $db1->table("barang");
        $builder1->select("id_barang,nama_barang");
        $query1 = $builder1->get();
        $data = [
            'id_pembeli' => $query->getResultArray(),
            'id_barang' => $query1->getResultArray(),
        ];
        return view("Transaksi/TambahData", $data);
    }

    public function insertData() {
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'id_transaksi' => [
                'label'  => 'ID Transaksi',
                'rules'  => 'required|min_length[10]|is_unique[transaksi.id_transaksi]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'min_length' => 'Ukuran {field} Minimal 10 Character',
                    'is_unique' => '{field} Tidak Boleh Sama'
                ]
            ],
            'jumlah' => [
                'label'  => 'jumlah',
                'rules'  => 'required|integer',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'integer' => '{field} Harus Angka'
                ]
            ],
        ]);

        if ($validation->withRequest($this->request)->run()) {
            $db = \Config\Database::connect();
            $IDTransaksi = $this->request->getPost('id_transaksi');
            $IDPembeli = $this->request->getPost('id_pembeli');
            $IDBarang = $this->request->getPost('id_barang');
            $jumlah = $this->request->getPost('jumlah');

            $pQuery = $db->prepare(function ($db) {
                $query = "SELECT * FROM barang WHERE id_barang = ?";
                return (new Query($db))->setQuery($query);
            });

            $result = $pQuery->execute($IDBarang)->getResultArray();
            $priceItem = $result[0]["harga"];
            $stok = $result[0]["stok"] - $jumlah;

            if ($stok < 0) {
                return redirect()->back()->with('stok','Anda Menginputkan Jumlah Terlalu Banyak Dari Stok Barang, Coba Cek Stok Barang Terkait')->withInput();
            }

            $total = (string) ((int) $jumlah * (int) $priceItem);

            $pQuery1 = $db->prepare(function ($db) {
                $query = "INSERT INTO transaksi(id_transaksi, id_pembeli, id_barang, jumlah, total) VALUES(?, ?, ?, ?, ?)";
                return (new Query($db))->setQuery($query);
            });
            $pQuery1->execute($IDTransaksi,$IDPembeli,$IDBarang,$jumlah,$total);

            $pQuery2 = $db->prepare(function ($db) {
                $query = "UPDATE barang SET stok = ? WHERE id_barang = ?";
                return (new Query($db))->setQuery($query);
            });
            $pQuery2->execute($stok, $IDBarang);

            session()->setFlashdata('messageInsert','Data Berhasil Ditambahkan');
            return redirect()->to("/");

        } else {
            $messageErrors = [
              'IDTransaksi' => $validation->getError('id_transaksi'),
                'jumlah' => $validation->getError('jumlah')
            ];
            session()->setFlashdata($messageErrors);
            return redirect()->back()->withInput();
        }
    }

    public function editPayment($id) {
        $db = \Config\Database::connect();
        $pQuery =  $db->prepare(function ($db) {

            $sql = "SELECT * FROM transaksi WHERE id_transaksi = ? ";

            return (new Query($db))->setQuery($sql);
        });
        $resultQuery = $pQuery->execute($id)->getResultArray();
        $data = [
            'IDPembeli' => $db->query("SELECT id_pembeli, nama_pembeli FROM pembeli"),
            'IDBarang' => $db->query("SELECT id_barang, nama_barang FROM barang"),
            'resultQuery' => $resultQuery
        ];
        return view("Transaksi/editTransaksi",$data);
    }

    public function editData() {
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'jumlah' => [
                'label'  => 'jumlah',
                'rules'  => 'required|integer',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'integer' => '{field} Harus Angka'
                ]
            ],
        ]);
        if ($validation->withRequest($this->request)->run()) {
            $db = \Config\Database::connect();

            $IDTransaksi = $this->request->getPost('idTransaksi');
            $IDPembeli = $this->request->getPost('idPembeli');
            $IDBarang = $this->request->getPost('idBarang');
            $jumlah = (int) $this->request->getPost('jumlah');
            $jumlahLama = (int) $this->request->getPost('jumlahLama');

            $pQuery = $db->prepare(function($db)
            {
                $sql = "SELECT * FROM barang WHERE id_barang = ?";

                return (new Query($db))->setQuery($sql);
            });

            $results = $pQuery->execute($IDBarang)->getResultArray();

            if ($jumlahLama < $jumlah) {
                $stokBarang = (int)$results[0]["stok"] - ((int)$jumlah - (int)$jumlahLama);
            } else {
                $stokBarang = (int)$results[0]["stok"] + ((int)$jumlahLama - (int)$jumlah);
            }
            if ($stokBarang < 0) {
                return redirect()->back()->withInput()->with('message','Jumlah Melebihi Batas Minimum 0, Coba Cek Stok Barang Sekarang');
            }
            $hargaTotal = (string) ((int)$jumlah * (int)$results[0]["harga"]);

            $pQuery1 = $db->prepare(function($db)
            {
                $sql = "UPDATE transaksi SET id_pembeli = ?, id_barang = ?, jumlah = ?, total = ? WHERE id_transaksi = ?";

                return (new Query($db))->setQuery($sql);
            });

            $pQuery1->execute($IDPembeli,$IDBarang,$jumlah,$hargaTotal,$IDTransaksi);


            $pQuery2 = $db->prepare(function($db)
            {
                $sql = "UPDATE barang SET stok = ? WHERE id_barang = ?";

                return (new Query($db))->setQuery($sql);
            });

            $pQuery2->execute((string)$stokBarang, $IDBarang);
            session()->setFlashdata('messageUpdate','Data Berhasil Diubah');
            return redirect()->to("/");
        } else {
            session()->setFlashdata('messageError',$validation->getError());
            return redirect()->back()->withInput();
        }
    }

    public function hapusPayment($id) {
        $db = \Config\Database::connect();
        $idTransaksi = base64_decode($id);

        $pQuery = $db->prepare(function($db)
        {
            $sql = "SELECT * FROM transaksi WHERE id_transaksi = ?";

            return (new Query($db))->setQuery($sql);
        });

        $results = $pQuery->execute($idTransaksi)->getResultArray();
        $idBarang = $results[0]["id_barang"];
        $jumlahBarang = $results[0]["jumlah"];


        $pQuery2 = $db->prepare(function($db)
        {
            $sql = "SELECT stok FROM barang WHERE id_barang = ?";

            return (new Query($db))->setQuery($sql);
        });

        $results2 = $pQuery2->execute($idBarang)->getResultArray();
        $jumlahStok = $results2[0]["stok"];

        $jumlahSemula = $jumlahBarang + $jumlahStok;


        $pQuery3 = $db->prepare(function($db)
        {
            $sql = "UPDATE barang SET stok = ? WHERE id_barang = ?";

            return (new Query($db))->setQuery($sql);
        });

        $pQuery3->execute($jumlahSemula,$idBarang);

        $pQuery4 = $db->prepare(function($db)
        {
            $sql = "DELETE FROM transaksi WHERE id_transaksi = ?";

            return (new Query($db))->setQuery($sql);
        });

        $pQuery4->execute($idTransaksi);

        if ($db->affectedRows()) {
            session()->setFlashdata('messageDelete','Data Berhasil Dihapus');
            return redirect()->to("/");
        } else {
            return false;
        }
    }

    public function PageNotFoundException() {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
}

