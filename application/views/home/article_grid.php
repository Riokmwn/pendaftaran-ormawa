    <!-- Blog Start -->
    <div class="container-fluid bg-light">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col text-center mb-4">
                    <h6 class="text-primary font-weight-normal text-uppercase mb-3">Artikel</h6>
                    <h1 class="mb-4">Artikel Organisasi Mahasiswa Institut Teknologi Indonesia</h1>
                </div>
            </div>
            <div class="row pb-3">
                <?php foreach ($article as $data) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 mb-2" style="height: 500px !important;">
                            <img class="card-img-top" style="height: 300px !important; object-fit:cover !important;" src="<?= base_url("assets/img/article/") . $data->image_article ?>" alt="">
                            <div class="card-body bg-white p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <a class="btn btn-primary" href="<?= base_url('home/article_detail/') . $data->id_article ?>"><i class="fa fa-link"></i></a>
                                    <h5 class="m-0 ml-3 text-truncate"><?= $data->title_article ?></h5>
                                </div>
                                <p>Dibuat Oleh <?= $data->name_ormawa ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Blog End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-6 col-md-6 mb-5 ml-5">
                <h4 class="text-primary mb-4">Kontak</h4>
                <p><i class="fas fa-university mr-2"></i><?= $config['name_information_config'] ?></p>
                <p><i class="fa fa-map-marker-alt mr-2"></i><?= $config['address_information_config'] ?></p>
                <p><i class="fa fa-phone-alt mr-2"></i><?= $config['phone_information_config'] ?></p>
                <p><i class="fa fa-envelope mr-2"></i><?= $config['email_information_config'] ?></p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 ml-5">
                <h4 class="text-primary mb-4">Quick Links</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white mb-2" href="<?= base_url('home/index') ?>"><i class="fa fa-angle-right mr-2"></i>Utama</a>
                    <a class="text-white mb-2" href="<?= base_url('home/ormawa') ?>"><i class="fa fa-angle-right mr-2"></i>Ormawa</a>
                    <a class="text-white mb-2" href="<?= base_url('home/article_grid') ?>"><i class="fa fa-angle-right mr-2"></i>Artikel</a>
                    <a class="text-white" href="<?= base_url('auth') ?>"><i class="fa fa-angle-right mr-2"></i>Masuk</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->