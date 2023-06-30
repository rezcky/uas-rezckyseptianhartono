<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header neu-brutalism-border">
            <h1><?= $title; ?></h1>
        </div>

        <?= $this->session->flashdata('message') ?>
        <div class="d-flex">
        <?php foreach($kota as $k): ?>
            <div class="card mr-5 "  style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">kota: <?= $k['kota'] ?> </h5>
                <p class="card-text">Harga: <?= $k['harga']?></p>
                <a href="#" class="btn btn-primary">Beli</a>
            </div>
            </div>

            <?php endforeach; ?>        
        </div>            
    </section>
</div>