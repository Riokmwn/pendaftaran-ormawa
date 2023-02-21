<?php $role_id = $this->session->userdata('role_id');  ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?php echo form_open_multipart('user/edit'); ?>
            <?php if ($role_id == 4) { ?>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">NRP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id" name="id" readonly value="<?= $user['id'] ?>">
                    </div>
                </div>
            <?php } ?>
            <?php if ($role_id == 2 || $role_id == 5) { ?>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id" name="id" readonly value="<?= $user['id'] ?>">
                    </div>
                </div>
            <?php } ?>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nama lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="date_of_birth" class="col-sm-2 col-form-label">Tanggal lahir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?= $user['date_of_birth'] ?>">
                    <?= form_error('date_of_birth', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address" value="<?= $user['address'] ?>">
                    <?= form_error('address', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="phone_number" class="col-sm-2 col-form-label">Nomor Telepon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= $user['phone_number'] ?>">
                    <?= form_error('phone_number', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="gender" class="col-sm-2 col-form-label">Jenis kelamin</label>
                <div class="col-sm-10">
                    <!-- <input type="text" class="form-control" id="gender" name="gender" value="<?= $gender['name_gender'] ?>"> -->
                    <select class="form-control" id="gender" name="gender_id">
                        <?php foreach ($gender as $data) { ?>
                            <option <?php if ($data->id_gender == $user['gender_id']) {
                                        echo 'selected';
                                    } ?> value="<?= $data->id_gender ?>"><?= $data->name_gender ?></option>
                        <?php } ?>
                    </select>
                    <?= form_error('gender', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="religion" class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-10">
                    <!-- <input type="text" class="form-control" id="religion" name="religion" value="<?= $religion['name_religion'] ?>"> -->
                    <select class="form-control" id="religion" name="religion_id">
                        <?php foreach ($religion as $data) { ?>
                            <option <?php if ($data->id_religion == $user['religion_id']) {
                                        echo 'selected';
                                    } ?> value="<?= $data->id_religion ?>"><?= $data->name_religion ?></option>
                        <?php } ?>
                    </select>
                    <?= form_error('religion', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">Gambar</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-thumbnail">
                        </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Pilih berkas</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
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