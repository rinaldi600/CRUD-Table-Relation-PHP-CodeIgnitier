<?= $this->extend('Layout/Template') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <form action="" method="get">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Masukkan Keyword" name="keyword">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Button</button>
        </div>
    </form>
    <?php if (session()->getFlashdata('message')) { ?>
        <?php foreach (session()->getFlashdata('message') as $row) { ?>
            <div class="alert alert-danger" role="alert">
               <?= $row ?>
            </div>
        <?php } ?>
    <?php } ?>
    <?php ?>
    <a href="/Barang/Tambah" class="btn btn-primary mb-3">Tambah Data</a>
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
    <?php if (session()->getFlashdata('updateMessage')) { ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('updateMessage') ?>
        </div>
    <?php } ?>
    <h2><?= $countData ?> Data Barang</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">ID Barang</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Harga</th>
            <th scope="col">Stok</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $row) { ?>
            <tr>
                <th scope="row"><?= $number++ ?></th>
                <td><?= $row["id_barang"] ?></td>
                <td><?= $row["nama_barang"] ?></td>
                <td><?= $row["harga"] ?></td>
                <td><?= $row["stok"] ?></td>
                <?php $idbarang = $row["id_barang"] ?>
                <?php $config = new \Config\Encryption() ?>
                <?php $encrypter = \Config\Services::encrypter($config); ?>
                <?php $idKey = $encrypter->encrypt($idbarang) ?>
                <td class="d-flex d-grid gap-3">
                    <a href="/Barang/Edit/<?= bin2hex($idKey) ?>" class="btn btn-warning">Edit</a>
                    <form action="/Barang/Hapus" method="post">
                        <input type="hidden" value="<?= bin2hex($idKey) ?>" name="key">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus')">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?= $pager->links('barang','modern_pagination') ?>
</div>
<?= $this->endSection() ?>
