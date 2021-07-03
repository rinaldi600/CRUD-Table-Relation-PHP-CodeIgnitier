<?= $this->extend('Layout/Template') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="mt-4">
        <form action="" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Masukkan Keyword" name="keyword">
                <button class="btn btn-outline-secondary" type="submit" name="submit" id="button-addon2">Cari</button>
            </div>
        </form>
        <a href="/Transaksi/tambahData" class="btn btn-primary mb-2">Tambah Data</a>
        <?php if (session()->getFlashdata('messageInsert')) { ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('messageInsert') ?>
            </div>
        <?php } ?>
        <?php if (session()->getFlashdata('messageUpdate')) { ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('messageUpdate') ?>
            </div>
        <?php } ?>
        <?php if (session()->getFlashdata('messageDelete')) { ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('messageDelete') ?>
            </div>
        <?php } ?>
        <?php if (session()->getFlashdata('informationDanger')) { ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('informationDanger') ?>
            </div>
        <?php } ?>
        <h2><?= $resultData ?> Data Transaksi</h2>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">NO</th>
            <th scope="col">ID Transaksi</th>
            <th scope="col">ID Pembeli</th>
            <th scope="col">ID Barang</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Total</th>
            <th scope="col">Detail</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $x) { ?>
            <tr>
                <th scope="row"><?= $_SESSION["value"]++ ?></th>
                <td><?= $x["id_transaksi"] ?></td>
                <td><?= $x["id_pembeli"] ?></td>
                <td><?= $x["id_barang"] ?></td>
                <td><?= $x["jumlah"] ?></td>
                <td><?= $x["total"] ?></td>
                <td class="d-flex d-grid gap-2">
                    <a href="/Transaksi/detailPayment/<?= $x["id_transaksi"] ?>" class="btn btn-primary">Detail</a>
                    <?php $id_transaksi = base64_encode($x["id_transaksi"])?>
                    <form action="/Transaksi/hapusPayment/<?= $id_transaksi ?>" method="post">
                        <input type="hidden" name="_method" value="DELETE" />
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus')">Hapus</button>
                    </form>
                    <a href="/Transaksi/editPayment/<?= $x["id_transaksi"] ?>" class="btn btn-warning">Edit</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?= $pager->links('transaksi','modern_pagination') ?>
</div>
<?= $this->endSection() ?>
