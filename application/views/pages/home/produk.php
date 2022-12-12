<div class="container my-3">
    <div class="row">
        <form class="d-flex col-lg-6 col-md-6" action="<?= base_url('home/daftarProduk'); ?>" method="post" role="search">
            <input class="form-control me-2" type="search" name="keyword" placeholder="Search" aria-label="Search">
            <button class="btn btn btn-outline-success mx-3" type="submit">Search</button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Filter
            </button>
        </form>
        <div class="row row-cols-1 row-cols-md-4 row-cols-lg-5 row-cols-sm-1 g-4">
            <?php if (empty($daftar_produk)) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Data produk tidak ditemukan</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
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



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Filter</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?= form_open('home/filter', ['method' => 'GET']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Harga</label>
                        <select class="form-select" name="harga" aria-label="Default select example">
                            <option value="default">Default</option>
                            <option value="termurah">Termurah</option>
                            <option value="termahal">Termahal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select class="form-select" name="kategori" aria-label="Default select example">
                            <option value="default">Default</option>
                            <?php foreach ($kategori as $kt) :  ?>
                                <option value="<?= $kt['nama']; ?>"><?= $kt['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>

</div>