<?= $this->extend('Layout/Template') ?>
<?= $this->section('content') ?>
<div class="container">
    <?php foreach ($data as $result) { ?>
        <div class="card mb-3 mt-4 mx-auto" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-6">
                    <img class="img-fluid mx-auto d-block rounded img-thumbnail" src="/img/nathan-dumlao-zi5vRoAP3WY-unsplash.jpg" alt="coverImage">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title"><?= $result["nama_pembeli"] ?></h5>
                        <p class="card-text"><?= $result["nama_barang"] ?></p>
                        <p class="card-text"><?= $result["harga"] ?></p>
                        <p class="card-text"><?= $result["jumlah"] ?></p>
                        <p class="card-text"><?= $result["total"] ?></p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <a href="/" class="btn btn-success">Back</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?= $this->endSection() ?>
