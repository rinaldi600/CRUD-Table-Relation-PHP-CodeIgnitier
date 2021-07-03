<?= $this->extend('Layout/Template') ?>
<?= $this->section('content') ?>
<div class="container">
    <?php if (session()->getFlashdata('stok')) { ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('stok') ?>
        </div>
    <?php } ?>
    <form action="/Transaksi/insertData" method="post">
        <div class="mb-3">
            <label for="IDTransaksi" class="form-label is-invalid">ID Transaski</label>
            <input type="text" class="form-control" id="IDTransaksi" name="id_transaksi" value="<?= old('id_transaksi') ?>">
            <?php if (session()->getFlashdata('IDTransaksi')) { ?>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= session()->getFlashdata('IDTransaksi') ?>
                </div>
            <?php } ?>
            <div id="idTransaksiHelp" class="form-text">We'll never share your ID Transaksi with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="IDPembeli">ID Pembeli</label>
            <select required class="form-select" name="id_pembeli" aria-label="Default select example" id="IDPembeli">
                <?php foreach ($id_pembeli as $row) {?>
                    <option <?= old('id_pembeli') == $row["id_pembeli"] ? 'selected="selected"' : '' ?> value="<?= $row["id_pembeli"] ?>"><?= $row["id_pembeli"] ?> : <?= $row["nama_pembeli"] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="IDBarang">ID Barang</label>
            <select required class="form-select" name="id_barang" aria-label="Default select example" id="IDBarang">
                <?php foreach ($id_barang as $roww) {?>
                    <option <?= old('id_barang') == $roww["id_barang"] ? 'selected="selected"' : '' ?> value="<?= $roww["id_barang"] ?>"><?= $roww["id_barang"] ?> : <?= $roww["nama_barang"] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="Jumlah" class="form-label is-invalid">Jumlah</label>
            <input <?= old('jumlah') ? 'value="' . old('jumlah') . '"' : '' ?> type="text" class="form-control" id="Jumlah" name="jumlah">
            <?php if (session()->getFlashdata('jumlah')) { ?>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= session()->getFlashdata('jumlah') ?>
                </div>
            <?php } ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?= $this->endSection() ?>
