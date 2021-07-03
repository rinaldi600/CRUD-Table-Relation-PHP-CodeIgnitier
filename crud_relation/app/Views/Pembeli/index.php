<?= $this->extend('Layout/Template') ?>
<?= $this->section('content') ?>
<div class="container mt-4">
    <form action="" method="get">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="keyword" placeholder="Masukkan Keyword">
            <button class="btn btn-outline-secondary" type="submit">Button</button>
        </div>
    </form>
    <div class="input-group mb-3">
        <a href="/Pembeli/insert" class="btn btn-primary">Tambah Data</a>
    </div>
    <h2><?= $resultData ?> Data Pembeli</h2>
    <?php if (session()->getFlashdata('message')) {  ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php } ?>
    <?php if (session()->getFlashdata('delete')) {  ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('delete') ?>
        </div>
    <?php } ?>
    <?php if (session()->getFlashdata('deleteError')) {  ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('deleteError') ?>
        </div>
    <?php } ?>
    <?php if (session()->getFlashdata('messageUpdate')) {  ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('messageUpdate') ?>
        </div>
    <?php } ?>
    <?php if (session()->getFlashdata('messageUpdateError')) {  ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('messageUpdateError') ?>
        </div>
    <?php } ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">NO</th>
            <th scope="col">ID Pembeli</th>
            <th scope="col">Nama Pembeli</th>
            <th scope="col">Email</th>
            <th scope="col">Alamat</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $row) { ?>
            <?php
                $encryptString = $row["id_pembeli"];
                $encrypter = \Config\Services::encrypter();
                $cipherText = $encrypter->encrypt($encryptString);
                $key = bin2hex($cipherText);
            ?>
            <tr>
                <th scope="row"><?= $number++ ?></th>
                <td><?= $row["id_pembeli"] ?></td>
                <td><?= $row["nama_pembeli"] ?></td>
                <td><?= $row["email"] ?></td>
                <td><?= $row["alamat"] ?></td>
                <td class="d-flex d-grid gap-2">
                    <form action="/Pembeli/Hapus/<?= $key ?>" method="post">
                        <input type="hidden" name="_method" value="DELETE" />
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus')">Hapus</button>
                    </form>
                    <a href="/Pembeli/Edit/<?= $key ?>" class="btn btn-warning">Edit</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?= $pager->links("pembeli","modern_pagination") ?>
</div>
<?= $this->endSection() ?>
