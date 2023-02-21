                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
                    </div>

                    <a href="<?= base_url('ormawa/add_requirement') ?>" class="btn btn-primary mb-2" id="btnAdd">Tambah persyaratan masuk ormawa</a>
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Submission -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Pengajuan Anggota</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><? ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url('ormawa/submission_member_ormawa') ?>" type="button" class="btn btn-info ml-2 mr-2 mt-2">Detail</a>
                            </div>
                        </div>


                        <!-- Proses -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Proses Penerimaan Anggota</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><? ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url('ormawa/accept_candidate') ?>" type="button" class="btn btn-info ml-2 mr-2 mt-2">Detail</a>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->