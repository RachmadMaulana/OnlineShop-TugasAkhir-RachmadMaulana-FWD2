<div class="container ">
    <?php $this->load->view('layouts/_alert'); ?>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahHero">
        Tambah Hero
    </button>
    <table class="table my-3">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Label</th>
                <th scope="col">Description</th>
                <th scope="col">Foto</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hero as $key =>  $h) : ?>
                <tr>
                    <th scope="row"><?= ++$key; ?></th>
                    <td><?= $h['label']; ?></td>
                    <td><?= $h['description']; ?></td>
                    <td><img src="<?= base_url('./assets/img/hero/') ?><?= $h['file_foto']; ?>" alt="" width="100"></td>
                    <td><?= $h['status']; ?></td>
                    <td>
                        <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $h['id']; ?>">
                            <i class="fas fa-edit text-info"></i>
                        </button>
                        <a href="<?= base_url(); ?>staff/herounit/delete/<?= $h['id']; ?>" class="btn btn-sm" onclick="return confirm('Apakah anda yakin?')">
                            <i class="fas fa-trash text-danger"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <!-- Modal Tambah Hero -->
    <div class="modal fade" id="tambahHero" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Hero</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('staff/herounit/create', ['method' => 'POST']) ?>
                    <div class="form-group">
                        <label for="label" class="form-label">Label</label>
                        <input type="text" name="label" class="form-control" id="label" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" id="description" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" accept="image/png, image/jpg, image/jpeg, image/PNG" name="gambar" class="form-control" id="gambar" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Hero</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
    <!-- End Modal Tambah Hero -->

    <!-- Modal Edit Hero -->
    <?php foreach ($hero as $h) : ?>
        <div class="modal fade" id="editModal<?= $h['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Hero</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= form_open_multipart('staff/herounit/edit', ['method' => 'POST']) ?>
                        <input type="hidden" name="id" value="<?= $h['id']; ?>">
                        <div class="form-group">
                            <label for="label" class="form-label">Label</label>
                            <input type="text" value="<?= $h['label']; ?> " name="label" class="form-control" id="label" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" value="<?= $h['description']; ?>" name="description" class="form-control" id="description" required>
                        </div>
                        <div class="form-group">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" accept="image/png, image/jpg, image/jpeg, image/PNG" name="gambar" class="form-control" id="gambar">
                            <img src="<?= base_url('./assets/img/hero/') ?><?= $h['file_foto']; ?>" alt="" width="100">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit Hero</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- End Modal Edit Hero -->
</div>