    <!-- Carousel -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="<?= base_url() ?>assets/img/header/<?= $ormawa['image_ormawa'] ?>" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 800px;">
                            <h4 style="font-size:3vw;" class="text-primary text-uppercase font-weight-normal mb-md-3"><?= $ormawa['name_type_ormawa'] ?></h4>
                            <h3 style="font-size:3vw;" class="display-3 text-white mb-md-4"><?= $ormawa['name_ormawa'] ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel -->


    <!-- About -->
    <div class="container-fluid bg-light pt-5" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 py-5 px-3">
                        <i class="display-1 font-weight-normal text-secondary mb-3"></i>
                        <img src="<?= base_url('assets/img/logo_ormawa/') . $ormawa['logo_ormawa'] ?>" alt="" style="width: 300px;">
                    </div>
                </div>
                <div class="col-lg-7 m-0 my-lg-5 pt-5 pb-5 pb-lg-2 pl-lg-5 col-md-7 my-md-7 pb-md-2 pl-md-7 col-sm-7 my-sm-7 pb-sm-2 pl-sm-7">
                    <h6 class="text-primary font-weight-normal text-uppercase mb-3">Tentang Kami</h6>
                    <h1 class="mb-4 section-title"><?= $ormawa['name_ormawa'] ?></h1>
                    <p class="text-justify"><?= $ormawa['description_ormawa'] ?></p>
                    <br>
                    <h6 class="text-primary font-weight-normal text-uppercase mb-3">Visi Misi</h6>
                    <p class="text-justify"><?= $ormawa['visi_mission_ormawa'] ?></p>
                    <br>
                    <h6 class="text-primary font-weight-normal text-uppercase mb-3">Kontak</h6>
                    <p><i class="fab fa-whatsapp mr-2"></i><?= $ormawa['phone_number'] ?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- About -->

    <!-- organization structure -->
    <div class="container-fluid pt-5" id="about">
        <div class="container">
            <div class="container">
                <div class="col-lg col-md col-sm">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 w-auto py-5 px-3">
                        <img class="img-fluid w-100 h-100" src="<?= base_url('assets/img/structure/') . $ormawa['organization_structure_ormawa'] ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- organization structure -->

    <!-- Gallery -->
    <div class="container-fluid bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md col-sm-12 p-0 py-sm-5">
                    <div class="owl-carousel team-carousel position-relative p-0 py-sm-5">
                        <?php foreach ($content as $data) { ?>
                            <div class="team d-flex flex-column text-center mx-3">
                                <div class="position-relative">
                                    <img class="img-fluid w-100 h-100" style="height:230px !important; object-fit:contain;" src="<?= base_url('assets/img/content/') . $data->image_content_homepage ?>" alt="">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery -->

    <!-- Article -->
    <div class="container-fluid">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col text-center mb-4">
                    <h1 class="text-primary font-weight-normal text-uppercase mb-4">Artikel</h1>
                </div>
            </div>
            <div class="container pb-3">
                <div class="row pb-3">
                    <?php foreach ($article as $data) { ?>
                        <div class="col-lg-4 col-md-4">
                            <div class="card border-0 mb-2">
                                <img class="card-img-top" style="height: 250px; object-fit: fill;" src="<?= base_url("assets/img/article/") . $data->image_article ?>" alt="">
                                <div class="card-body bg-white p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <a class="btn btn-primary" href="<?= base_url('home/article_detail/') . $data->id_article ?>"><i class="fa fa-link"></i></a>
                                        <h5 class="m-0 ml-3 text-truncate"><?= $data->title_article ?></h5>
                                    </div>
                                    <!-- <p><?= substr($data->content_article, 0, 240) . "..." ?></p> -->
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Article -->


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