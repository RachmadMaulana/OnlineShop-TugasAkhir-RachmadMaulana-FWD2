<div class="container">
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <?php foreach ($hero as $key => $row) :  ?>
        <div class="carousel-item <?= ($key == 0 ? 'active' : ''); ?>">
          <img src="<?= base_url('./assets/img/hero/') ?><?= $row['file_foto'] ?>" class="d-block w-100" width="200" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5><?= $row['label']; ?></h5>
            <p><?= $row['description']; ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>

<h1 class="text-center mt-4 ">Produk Kami</h1>
<div class="container my-3">
  <div class="row">
    <div class="row row-cols-1 row-cols-md-4 row-cols-lg-5 row-cols-sm-1 g-4">
      <?php foreach ($daftar_produk as $dp) : ?>
        <div class="card mx-3">
          <img src="<?= base_url('./assets/img/upload/') ?><?= $dp['gambar']; ?>" width="100" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?= $dp['nama']; ?></h5>
            <p class="card-text"><strong><?= 'Rp' . number_format($dp['harga'], 0, ',', '.'); ?></strong></p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Last updated 3 mins ago</small>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>