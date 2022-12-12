<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <?php $this->load->view('layouts/_alert'); ?>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">
      Tambah Produk
    </button>

    <table class="table my-3">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">Kategori</th>
          <th scope="col">Status</th>
          <th scope="col">Detail</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($produk as $key => $pd) : ?>
          <tr>
            <th scope="row"><?= $key += 1; ?></th>
            <td><?= $pd['nama']; ?></td>
            <td><?= $pd['kategori']; ?></td>
            <td><?= $pd['status']; ?></td>
            <td><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal<?= $pd['id']; ?>">Detail</button></td>
            <td>
              <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $pd['id']; ?>">
                <i class="fas fa-edit text-info"></i>
              </button>
              <a href="<?= base_url(); ?>staff/produk/delete/<?= $pd['id']; ?>" class="btn btn-sm" onclick="return confirm('Apakah anda yakin?')">
                <i class="fas fa-trash text-danger"></i>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="judulModalInsert" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="judulModalInsert">Tambah Produk</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?= form_open_multipart('staff/produk/create', ['method' => 'POST']) ?>
            <div class="form-group">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" name="nama" class="form-control" id="nama" required>
            </div>
            <div class="form-group">
              <label for="harga" class="form-label">Harga</label>
              <input type="number" min="1" name="harga" class="form-control" id="harga" required>
            </div>
            <div class="form-group">
              <label for="gambar" class="form-label">Gambar</label>
              <input type="file" min="1" name="gambar" class="form-control" accept="image/png, image/jpg, image/jpeg, image/PNG" id="gambar" id="gambar" required>
            </div>
            <div class="form-group">
              <label for="kategori" class="form-label">Kategori</label>
              <select class="form-select" name="kategori" aria-label="Default select example">
                <option selected>Pilih Kategori</option>
                <?php foreach ($kategori as $kt) :  ?>
                  <option value="<?= $kt['id']; ?>"><?= $kt['nama']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="kondisi" class="form-label">Kondisi</label>
              <input type="text" min="1" name="kondisi" class="form-control" id="kondisi" required>
            </div>
            <div class="form-group">
              <label for="berat_satuan" class="form-label">Berat Satuan</label>
              <input type="text" min="1" name="berat_satuan" class="form-control" required id="berat_satuan">
            </div>
            <div class="form-group">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5" required></textarea>
            </div>
            <div class="form-group">
              <label for="tanggal" class="form-label">Created at</label>
              <input type="date" min="1" name="tanggal" class="form-control" id="tanggal" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Tambah Produk</button>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal Tambah Data -->

    <!-- Modal Edit Data -->
    <?php foreach ($products as $key => $pd) : ?>
      <div class="modal fade" id="editModal<?= $pd['id']; ?>" tabindex="-1" aria-labelledby="judulModalInsert" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="judulModalInsert">Edit Produk</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <?= form_open_multipart('staff/produk/edit', ['method' => 'POST']) ?>
              <input type="hidden" name="id" value="<?= $pd['id']; ?>">
              <div class="form-group">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" value="<?= $pd['nama']; ?>" class="form-control" id="nama" required>
              </div>
              <div class="form-group">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" min="1" value="<?= $pd['harga']; ?>" name="harga" class="form-control" id="harga" required>
              </div>
              <div class="form-group">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" min="1" name="gambar" class="form-control" accept="image/png, image/jpg, image/jpeg, image/PNG" id="gambar"><br>
                <img src="<?= base_url('./assets/img/upload/') ?><?= $pd['gambar']; ?>" width="200" alt="">
              </div>
              <div class="form-group">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" name="kategori" aria-label="Default select example">
                  <option selected>Pilih Kategori</option>
                  <?php foreach ($kategori as $kt) :  ?>
                    <?php if ($kt['id'] == $pd['kategori_id']) : ?>
                      <option value="<?= $kt['id']; ?>" selected><?= $kt['nama']; ?></option>
                    <?php else :  ?>
                      <option value="<?= $kt['id']; ?>"><?= $kt['nama']; ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="kondisi" class="form-label">Kondisi</label>
                <input type="text" min="1" value="<?= $pd['kondisi']; ?>" name="kondisi" class="form-control" id="kondisi" required>
              </div>
              <div class="form-group">
                <label for="berat_satuan" class="form-label">Berat Satuan</label>
                <input type="text" min="1" value="<?= $pd['Berat_satuan']; ?>" name="berat_satuan" class="form-control" required id="berat_satuan">
              </div>
              <div class="form-group">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5" required>
                  <?= $pd['deskripsi']; ?>
                </textarea>
              </div>
              <div class="form-group">
                <label for="tanggal" class="form-label">Created at</label>
                <input type="date" min="1" value="<?= $pd['created_at']; ?>" name="tanggal" class="form-control" id="tanggal" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Edit Produk</button>
              <?= form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <!-- End Modal Edit Data -->

    <!-- Modal Detail Data -->
    <?php foreach ($products as $key => $pd) : ?>
      <div class="modal fade" id="detailModal<?= $pd['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Detail</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="card">
                <img src="<?= base_url('./assets/img/upload/') ?><?= $pd['gambar']; ?>" class="card-img-top" height="350" alt="...">
                <div class="card-body">
                  <h3 class="card-title"><?= $pd['nama']; ?></h3>
                  <p class="card-text"><?= $pd['deskripsi']; ?></p>
                </div>
                <div class="card-footer">
                  <h5 class="fw-bold"><?= 'Rp' . number_format($pd['harga'], 0, ',', '.'); ?></h5>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <!-- End Modal Detail Data -->

  </div>





</body>

</html>