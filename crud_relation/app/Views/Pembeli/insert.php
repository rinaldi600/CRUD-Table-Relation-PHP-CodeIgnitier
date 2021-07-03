<?= $this->extend('/Layout/Template') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <?php if (session()->getFlashdata('message')) { ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php } ?>
    <form action="/Pembeli/insertData" method="post">
        <div class="mb-3">
            <label for="id_pembeli" class="form-label">ID Pembeli</label>
            <input type="text" class="form-control <?= session()->getFlashdata('idPembeliMessage') ? ' is-invalid' : '' ?>" value="<?= old('id_pembeli') ?>" id="id_pembeli" name="id_pembeli">
            <div class="form-text">We'll never share your ID Pembeli with anyone else.</div>
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('idPembeliMessage') ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="nama_pembeli" class="form-label">Nama Pembeli</label>
            <input type="text" class="form-control <?= session()->getFlashdata('namaPembeliMessage') ? ' is-invalid' : '' ?>" value="<?= old('nama_pembeli') ?>" id="nama_pembeli" name="nama_pembeli">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('namaPembeliMessage') ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control <?= session()->getFlashdata('emailMessage') ? ' is-invalid' : '' ?>" value="<?= old('email') ?>" id="email" name="email">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('emailMessage') ?>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat" id="floatingTextarea2" style="height: 100px"><?= old('alamat') ? old('alamat') : '' ?></textarea>
                <label for="floatingTextarea2">Alamat</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?= $this->endSection() ?>
