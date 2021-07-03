<?= $this->extend('Layout/Template') ?>

<?= $this->section('content') ?>
    <div class="container mt-4">
        <form action="/Pembeli/editData" method="post">
            <input type="hidden" name="id_pembeli" value="<?= $dataPembeli["id_pembeli"] ?>">
            <div class="mb-3">
                <label for="namaPembeli" class="form-label">Nama Pembeli</label>
                <input type="text" class="form-control <?= session()->getFlashdata('nama_pembeli') ?  'is-invalid' : ''  ?>" name="nama_pembeli" id="namaPembeli" value="<?= old('nama_pembeli') ? old('nama_pembeli') : $dataPembeli["nama_pembeli"] ?>">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= session()->getFlashdata('nama_pembeli') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control <?= session()->getFlashdata('email') ?  'is-invalid' : ''  ?>" id="email" name="email" value="<?= old('email') ? old('email') : $dataPembeli["email"] ?>">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= session()->getFlashdata('email') ?>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Masukkan Alamat Disini" name="alamat" id="floatingTextarea2" style="height: 100px"><?= $dataPembeli["alamat"] ?></textarea>
                    <label for="floatingTextarea2">Alamat</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
<?= $this->endSection() ?>