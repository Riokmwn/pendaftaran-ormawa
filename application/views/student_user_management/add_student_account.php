<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-black text-uppercase mb-1">
                                Tata Cara Mengisi Template Tambah Akun Mahasiswa:
                            </div>
                            <p>1. Id digunakan untuk menambahkan nrp mahasiswa</p>
                            <p>2. email digunakan untuk menambahkan email mahasiswa</p>
                            <p>3. name digunakan untuk menambahkan nama mahasiswa</p>
                            <p>4. prodi_id digunakan untuk menambahkan program studi mahasiswa</p>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><? ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
            <div class="form-group">
                <a href="<?= base_url('assets/excel/student/template_mahasiswa.xlsx') ?>">Download Template Excel</a>
            </div>
            <form method="post" action="<?= base_url("Student_user_management/uploadStudentAccount"); ?>" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-5 pt-2">
                        <p class="text-gray-800">Kirim Excel</p>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file">
                            <label class="custom-file-label" for="header">Pilih berkas</label>
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>