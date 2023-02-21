<!-- Projects Start -->
<div class="container-fluid " id="ormawa">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col text-center mb-4">
                <h6 class="text-primary font-weight-normal text-uppercase mb-3">Ormawa</h6>
                <h1 class="mb-4">Organisasi Mahasiswa Institut Teknologi Indonesia</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mb-2">
                <ul class="list-inline mb-4" id="portfolio-flters">
                    <li class="btn btn-outline-primary m-1 active" data-filter="*">All</li>
                    <?php foreach ($category as $data) { ?>
                        <li class="btn btn-outline-primary m-1" data-filter=".<?= $data->id_type_ormawa ?>"><?= $data->name_type_ormawa ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="row mx-1 portfolio-container">
            <?php foreach ($ormawa as $data) { ?>
                <div class="col-lg-4 col-md-6 col-sm-12 p-0 portfolio-item <?= $data->type_ormawa_id ?>">
                    <div class="position-relative overflow-hidden">
                        <div class="portfolio-img d-flex align-items-center justify-content-center px-3 py-3">
                            <img class="img-fluid" style="height: 200px !important; object-fit:cover !important;" src="<?= base_url('assets/img/logo_ormawa/') . $data->logo_ormawa ?>" alt="">
                        </div>
                        <div class="portfolio-text bg-secondary d-flex flex-column align-items-center justify-content-center">
                            <h4 class="text-center text-white mb-4"><?= $data->name_ormawa ?></h4>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn btn-outline-primary m-1" href="<?= base_url('home/ormawa_profile/') . $data->id_ormawa ?>">
                                    <i class="fa fa-link"></i>
                                </a>
                                <a class="btn btn-outline-primary m-1" href="<?= base_url('assets/img/logo_ormawa/') . $data->logo_ormawa ?>" data-lightbox="portfolio">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Projects End -->

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