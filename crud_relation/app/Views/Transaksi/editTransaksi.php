<?= $this->extend('Layout/Template') ?>
<?= $this->section('content') ?>
<div class="container mt-3">
    <?php if (session()->getFlashdata('message')) { ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php } ?>
    <form action="/Transaksi/editData" method="post">
            <input value="<?= $resultQuery[0]["id_transaksi"] ?>" type="hidden" class="form-control" name="idTransaksi">
        <div class="mb-3">
            <label for="IDPembeli">ID Pembeli</label>
            <select class="form-select" id="IDPembeli" name="idPembeli">
                <?php foreach ($IDPembeli->getResultArray() as $row) { ?>
                    <option <?= $resultQuery[0]["id_pembeli"] == $row["id_pembeli"] ? 'selected' : '' ?> value="<?= $row["id_pembeli"] ?>"><?= $row["id_pembeli"] ?> : <?= $row["nama_pembeli"] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="IDBarang">ID Barang</label>
            <select class="form-select" id="IDBarang" name="idBarang">
                <?php foreach ($IDBarang->getResultArray() as $roww) { ?>
                    <option <?= $resultQuery[0]["id_barang"] == $roww["id_barang"] ? 'selected' : '' ?> value="<?= $roww["id_barang"] ?>"><?= $roww["id_barang"] ?> : <?= $roww["nama_barang"] ?></option>
                <?php } ?>
            </select>
        </div>
        <input type="hidden" value="<?= $resultQuery[0]["jumlah"] ?>" name="jumlahLama">
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="text" value="<?= old('jumlah') ? old('jumlah') : $resultQuery[0]["jumlah"] ?>" class="form-control <?= session()->getFlashdata('messageError') ? 'is-invalid' : '' ?>" id="jumlah" name="jumlah">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('messageError') ?>
            </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?= $this->endSection() ?>
