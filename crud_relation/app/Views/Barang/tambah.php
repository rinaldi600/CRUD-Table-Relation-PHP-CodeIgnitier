<?= $this->extend('Layout/Template') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <?php if (session()->getFlashdata('errorUpdate')) { ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('errorUpdate') ?>
        </div>
    <?php } ?>
    <form action="/Barang/insertData" method="post">
        <div class="mb-3">
            <label for="id_barang" class="form-label">ID Barang</label>
            <input type="text" class="form-control <?= session()->getFlashdata('id_barang') ? 'is-invalid' : '' ?>" id="id_barang" name="id_barang" value="<?= old('id_barang') ?>">
            <div id="emailHelp" class="form-text">We'll never share your ID Barang with anyone else.</div>
            <div id="validationServer03Feedback" class="invalid-feedback">
               <?= session()->getFlashdata('id_barang') ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= old('nama_barang') ?>">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control <?= session()->getFlashdata('harga') ? 'is-invalid' : '' ?>" id="harga" name="harga" value="<?= old('harga') ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('harga') ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="text" class="form-control <?= session()->getFlashdata('stok') ? 'is-invalid' : '' ?>" id="stok" name="stok" value="<?= old('stok') ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('stok') ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?= $this->endSection() ?>
