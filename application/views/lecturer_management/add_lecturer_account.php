<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Download Template Excel</button>
                </div>
                <div class="row">
                    <div class="col-sm-5 pt-2">
                        <p class="text-gray-800">Kirim Excel</p>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="header" name="header">
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