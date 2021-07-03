<?= $this->extend('Layout/Template') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <form action="/barang/editData" method="post">
        <input type="hidden" name="id_barang" value="<?= $result["id_barang"] ?>">
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control <?= session()->getFlashdata('namaMessage') ? 'is-invalid' : '' ?>" id="nama_barang" name="nama_barang" value="<?= old('nama_barang') ? old('nama_barang') : $result["nama_barang"]; ?>">
            <div id="validationServer05Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('namaMessage') ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control <?= session()->getFlashdata('hargaMessage') ? 'is-invalid' : '' ?>" id="harga" name="harga" value="<?= old('harga') ? old('harga') : $result["harga"]; ?>"">
            <div id="validationServer05Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('hargaMessage') ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="text" class="form-control <?= session()->getFlashdata('stokMessage') ? 'is-invalid' : '' ?>" id="stok" name="stok" value="<?= old('stok') ? old('stok') : $result["stok"]; ?>"">
            <div id="validationServer05Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('stokMessage') ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?= $this->endSection() ?>
