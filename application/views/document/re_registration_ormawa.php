<!-- Begin Page Content -->
<div class="container-fluid">
    <?php  ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
            <?php echo form_open_multipart('ormawa/homepage_ormawa'); ?>
            <div class="row">
                <div class="col-sm-12 pt-3">
                    <label>STRUKTUR ORGANISASI</label><span class="ml-3 text-danger" id="error-so"></span>
                    <?php if ($ormawa['organization_structure_ormawa']) { ?><img src="<?= base_url('assets/img/structure/') . $ormawa['organization_structure_ormawa'] ?>" class="img-thumbnail">
                        <a href="<?= base_url('assets/img/structure/') . $ormawa['organization_structure_ormawa'] ?>" type="button" class="btn btn-info ml-2 mr-2 mt-2">Detail</a> <?php } ?>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 pt-4">
                    <label class="ml-2">AD/ART</label><span class="ml-3 text-danger" id="error-adart"></span>
                    <br>
                    <?php if (isset($ad_art)) { ?>
                        <a href="<?= base_url('assets/document/') . $ad_art['name_document']  ?>" type="button" class="btn btn-info ml-2 mr-2">Download</a>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group pt-4">
                <label class="ml-2">PROGRAM KERJA</label><span class="ml-3 text-danger" id="error-proker"></span>
                <br>
                <?php if (isset($work_program)) { ?>
                    <?php if ($work_program != array()) { ?>
                        <?php if ($user['role_id'] == 2) { ?>
                            <a href="<?= base_url('work_program/work_program_by_ormawa/') . $ormawa['id_ormawa'] ?>" type="button" class="btn btn-info ml-2 mr-2">Detail</a>
                        <?php } ?>
                        <?php if ($user['role_id'] == 3) { ?>
                            <a href="<?= base_url('work_program/') ?>" type="button" class="btn btn-info ml-2 mr-2 mt-2">Detail</a>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>
            <?php if ($user['role_id'] == 3) { ?>
                <div class="form-group ml-2 pt-3">
                    <a href="#" class="btn btn-success" id="kirim">Kirim</a>
                </div>
            <?php } ?>
            <?php if ($user['role_id'] == 2) { ?>
                <div class="form-group ml-2 pt-3">
                    <a href="<?= base_url() ?>Ormawa_management/acceptRegistrationOrmawa/<?= $id ?>" class="btn btn-success">Terima</a>
                    <a href="<?= base_url() ?>Ormawa_management/declineRegistrationOrmawa/<?= $id ?>" class="btn btn-danger">Tolak</a>
                </div>
                <div class="form-group">
                    <a href="<?= base_url('ormawa_management/ormawa') ?>" type="button" class="btn btn-primary ml-2 mr-2 mt-2">Manajemen Ormawa</a>
                </div>
            <?php } ?>
            </form>

        </div>
    </div>
</div>

<script>
    document.getElementById("kirim").addEventListener("click", function(event) {
        event.preventDefault();
        <?php if ($ormawa['organization_structure_ormawa']) {
            echo 'var so = 1;';
        } else {
            echo 'var so = 0;';
        }
        if ($ad_art) {
            echo 'var adart = 1;';
        } else {
            echo 'var adart = 0;';
        }
        if ($proker) {
            echo 'var proker = 1;';
        } else {
            echo 'var proker = 0;';
        }
        ?>
        console.log(so);
        if (so == 0) {
            $('#error-so').html('Struktur organisasi harus diisi terlebih dahulu')
        } else {
            $('#error-so').html('')
        }

        if (adart == 0) {
            $('#error-adart').html('AD/ART harus diisi terlebih dahulu')
        } else {
            $('#error-adart').html('')
        }

        if (proker == 0) {
            $('#error-proker').html('Program kerja harus diisi terlebih dahulu')
        } else {
            $('#error-proker').html('')
        }

        if (adart != 0 && proker != 0 && so != 0) {
            window.location.href = '<?= base_url() ?>Ormawa/sendRegistrationOrmawa/<?= $id ?>';
        }
    });
</script>
<!-- /.container-fluid -->