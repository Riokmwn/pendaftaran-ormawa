<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Notifikasi</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Notifikasi -->
        <?php foreach ($notifikasi as $data) { ?>
            <div class="col-xl-12 col-md-12 mb-12 pb-3">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    <?= $data->text_notification ?></div>
                                <div><?= $data->date_notification ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->