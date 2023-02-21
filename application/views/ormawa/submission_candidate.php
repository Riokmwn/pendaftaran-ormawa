<?php $role_id = $this->session->userdata('role_id');  ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?php echo form_open_multipart('ormawa/candidate_ormawa_member'); ?>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= $mahasiswa['email'] ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nama lengkap</label>
                <div class="col-sm-10">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $mahasiswa['id'] ?>">
                    <input type="text" class="form-control" id="name" name="name" value="<?= $mahasiswa['name'] ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="date_of_birth" class="col-sm-2 col-form-label">Tanggal lahir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?= $mahasiswa['date_of_birth'] ?>">
                    <?= form_error('date_of_birth', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="phone_number" class="col-sm-2 col-form-label">Nomor telepon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= $mahasiswa['phone_number'] ?>">
                    <?= form_error('phone_number', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="gender" class="col-sm-2 col-form-label">Jenis kelamin</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="gender" name="gender" value="<?= $mahasiswa['name_gender'] ?>" readonly>
                    <?= form_error('gender', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="religion" class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="religion" name="religion" value="<?= $mahasiswa['name_religion'] ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address" value="<?= $mahasiswa['address'] ?>">
                    <?= form_error('address', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="prodi" name="prodi" value="<?= $mahasiswa['name_prodi'] ?>">
                    <?= form_error('prodi', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group pt-4">
                <a href="<?= base_url('document/candidate_document/') . $mahasiswa['id'] ?>" type="button" class="btn btn-info">Dokumen</a>
            </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->