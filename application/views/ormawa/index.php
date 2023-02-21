                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Period -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Periode dan anggota ormawa</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><? ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url('ormawa/period_ormawa') ?>" type="button" class="btn btn-info ml-2 mr-2 mt-2">Detail</a>
                            </div>
                        </div>

                        <!-- Homepage -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Halaman utama ormawa</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><? ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-home fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url('ormawa/homepage_ormawa') ?>" type="button" class="btn btn-primary ml-2 mr-2 mt-2">Detail</a>
                            </div>
                        </div>

                        <!-- Membership -->
                        <!-- <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Anggota</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><? ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url('ormawa/member_ormawa') ?>" type="button" class="btn btn-success ml-2 mr-2 mt-2">Detail</a>
                            </div>
                        </div> -->

                        <!-- Article -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Artikel
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url('article/') ?>" type="button" class="btn btn-info ml-2 mr-2 mt-2">Detail</a>
                            </div>
                        </div>

                        <!-- Activity -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Aktivitas
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><? ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url('activity/') ?>" type="button" class="btn btn-info ml-2 mr-2 mt-2">Detail</a>
                            </div>
                        </div>

                        <!-- candidate member -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Calon anggota</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><? ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url('ormawa/proses_and_accept_candidate') ?>" type="button" class="btn btn-success ml-2 mr-2 mt-2">Detail</a>
                            </div>
                        </div>

                        <!-- Document -->
                        <!-- <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Dokumen</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><? ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url('document/') ?>" type="button" class="btn btn-primary ml-2 mr-2 mt-2">Detail</a>
                            </div>
                        </div> -->

                        <!-- Re-registration ormawa -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Daftar ulang ormawa</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><? ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url('document/re_registration_ormawa') ?>" type="button" class="btn btn-primary ml-2 mr-2 mt-2">Detail</a>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->