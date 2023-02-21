<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="application_name">Judul aplikasi</label>
                    <textarea class="form-control" id="application_name" name="application_name" rows="3"><?= $main_config['application_name_main_config'] ?></textarea>
                </div>
                <div class="row">
                    <div class="col-sm-6 pt-3">
                        <label>Gambar utama</label>
                        <img src="<?= base_url('assets/img/header/') . $main_config['header_main_config'] ?>" class="img-thumbnail">
                    </div>
                    <div class="col-sm-9 pt-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="header" name="header">
                            <label class="custom-file-label" for="header">Pilih berkas</label>
                        </div>
                    </div>
                </div>
                <div class="form-group pt-3">
                    <label for="title">Judul 1</label>
                    <textarea class="form-control" id="title" name="title" rows="3"><?= $main_config['title_main_config'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="title_2">Judul 2</label>
                    <textarea class="form-control" id="title_2" name="title_2" rows="3"><?= $main_config['title_2_main_config'] ?></textarea>
                </div>


                <!-- Campus -->
                <div class="row">
                    <div class="col-sm-6 pt-3">
                        <label>Logo kampus</label>
                        <img src="<?= base_url('assets/img/logo_campus/') . $main_config['logo_campus_main_config'] ?>" class="img-thumbnail">
                    </div>
                    <div class="col-sm-9 pt-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="logo_campus" name="logo_campus">
                            <label class="custom-file-label" for="logo_campus">Pilih berkas</label>
                        </div>
                    </div>
                </div>
                <div class="form-group pt-3">
                    <label for="campus_name">Nama kampus</label>
                    <textarea class="form-control" id="campus_name" name="campus_name" rows="3"><?= $main_config['campus_name_main_config'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi kampus</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?= $main_config['description_main_config'] ?></textarea>
                </div>

                <!-- Application -->
                <div class="row">
                    <div class="col-sm-6 pt-3">
                        <label>Logo aplikasi</label>
                        <img src="<?= base_url('assets/img/logo_application/') . $main_config['logo_application_main_config'] ?>" class="img-thumbnail">
                    </div>
                    <div class="col-sm-9 pt-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="logo_application" name="logo_application">
                            <label class="custom-file-label" for="logo_application">Pilih berkas</label>
                        </div>
                    </div>
                </div>
                <div class="form-group pt-3">
                    <label for="description_2">Deskripsi Aplikasi</label>
                    <textarea class="form-control" id="description_2" name="description_2" rows="3"><?= $main_config['description_2_main_config'] ?></textarea>
                </div>

                <!-- Contact -->
                <label for="">Kontak</label>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea class="form-control" id="address" name="address" rows="3"><?= $information_config['address_information_config'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <textarea class="form-control" id="email" name="email" rows="3"><?= $information_config['email_information_config'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="phone">Telepon</label>
                    <textarea class="form-control" id="phone" name="phone" rows="3"><?= $information_config['phone_information_config'] ?></textarea>
                </div>

                <div class="form-group pt-3">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->