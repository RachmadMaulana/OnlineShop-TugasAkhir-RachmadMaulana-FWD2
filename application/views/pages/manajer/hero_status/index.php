<div class="container">
    <?php $this->load->view('layouts/_alert'); ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Label</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hero_status as $key => $hs) : ?>
                <tr>
                    <th scope="row"><?= ++$key; ?></th>
                    <td><?= $hs['label']; ?></td>
                    <td><?= $hs['description']; ?></td>
                    <td><?= $hs['status']; ?></td>
                    <td>
                        <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $hs['id']; ?>">
                            <i class="fas fa-edit text-info"></i>
                        </button>
                        <a href="<?= base_url(); ?>manajer/herounit_status/delete/<?= $hs['id']; ?>" class="btn btn-sm" onclick="return confirm('Apakah anda yakin?')">
                            <i class="fas fa-trash text-danger"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal edit data -->
    <?php foreach ($hero_status as $key => $hs) : ?>
        <div class="modal fade" id="editModal<?= $hs['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Status</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= form_open_multipart('manajer/herounit_status/edit', ['method' => 'POST']) ?>
                        <input type="hidden" name="id" value="<?= $hs['id']; ?>">
                        <div class="form-group">
                            <img src="<?= base_url('./assets/img/hero/') ?><?= $hs['file_foto']; ?>" width="200" alt="">
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="Default select example">
                                <?php foreach ($status as $st) :  ?>
                                    <?php if ($st['id'] == $hs['status_id']) : ?>
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