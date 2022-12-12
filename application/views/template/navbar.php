<div class="container-fluid">
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="<?= base_url('./assets/img/N.png'); ?>" class="rounded-circle" height="50" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= base_url('home/daftarProduk'); ?>">Produk</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item mx-3">
            <a href="<?= base_url('login'); ?>" class="btn btn-primary">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>