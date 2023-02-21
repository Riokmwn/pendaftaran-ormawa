                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Daftar ormawa</h1>
                    </div>

                    <!-- Content Row HMPS -->
                    <?php if ($hmps != null) { ?>
                        <div class="">
                            <h4 class="h4 mb-10 text-gray-800">Daftar Himpunan Mahasiswa Program Studi</h4>
                        </div>
                        <div class="row">
                            <!-- registration status -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-black text-uppercase mb-1"><?= $hmps['name_ormawa'] ?>
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><? ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-file fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?= base_url('student/student_registration_ormawa/') . $hmps['id_ormawa'] ?>" type="button" class="btn btn-success ml-2 mr-2 mt-2">Detail</a>
                                </div>
                            </div>

                        </div>
                        <!-- /.container-fluid -->
                    <?php } ?>

                    <!-- Content Row UKM -->
                    <div class="">
                        <h4 class="h4 mb-10 text-gray-800">Daftar Unit Kegiatan Mahasiswa</h4>
                    </div>
                    <div class="row">
                        <?php foreach ($ukm as $data) { ?>
                            <!-- registration status -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-black text-uppercase mb-1"><?= $data->name_ormawa ?>
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><? ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-file fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?= base_url('student/student_registration_ormawa/') . $data->id_ormawa ?>" type="button" class="btn btn-success ml-2 mr-2 mt-2">Detail</a>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                    <!-- /.container-fluid -->

                    <!-- Content Row UKK -->
                    <div class="">
                        <h4 class="h4 mb-10 text-gray-800">Daftar Unit Kegiatan Khusus</h4>
                    </div>
                    <div class="row">
                        <?php foreach ($ukk as $data) { ?>
                            <!-- registration status -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-black text-uppercase mb-1"><?= $data->name_ormawa ?>
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><? ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-file fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?= base_url('student/student_registration_ormawa/') . $data->id_ormawa ?>" type="button" class="btn btn-success ml-2 mr-2 mt-2">Detail</a>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->