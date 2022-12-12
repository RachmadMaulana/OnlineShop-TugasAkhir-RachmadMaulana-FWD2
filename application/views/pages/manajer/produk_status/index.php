<div class="container">
    <?php $this->load->view('layouts/_alert'); ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Harga</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produk_status as $key => $ps) : ?>
                <tr>
                    <th scope="row"><?= ++$key; ?></th>
                    <td><?= $ps['nama']; ?></td>
                    <td><?= number_format($ps['harga'], 0, ',', '.'); ?></td>
                    <td><?= $ps['status']; ?></td>
                    <td>
                        <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $ps['id']; ?>">
                            <i class="fas fa-edit text-info"></i>
                        </button>
                        <a href="<?= base_url(); ?>manajer/produk_status/delete/<?= $ps['id']; ?>" class="btn btn-sm" onclick="return confirm('Apakah anda yakin?')">
                            <i class="fas fa-trash text-danger"></i>
                        </a>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal edit data -->
    <?php foreach ($produk_status as $key => $ps) : ?>
        <div class="modal fade" id="editModal<?= $ps['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Status</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= form_open_multipart('manajer/produk_status/edit', ['method' => 'POST']) ?>
                        <input type="hidden" name="id" value="<?= $ps['id']; ?>">
                        <div class="form-group">
                            <img src="<?= base_url('./assets/img/upload/') ?><?= $ps['gambar']; ?>" width="200" alt="">
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="Default select example">
                                <?php foreach ($status as $st) :  ?>
                                    <?php if ($st['id'] == $ps['status_id']) : ?>
                                        <option value="<?= $st['id']; ?>" selected><?= $st['nama']; ?></option>
                                    <?php else :  ?>
                                        <option value="<?= $st['id']; ?>"><?= $st['nama']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- End modal edit data -->
</div>