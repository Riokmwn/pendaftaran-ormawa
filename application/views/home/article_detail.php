    <!-- Detail Start -->
    <div class="container py">
        <div class="row pt-5">
            <div class="col-lg-8">
                <div class="d-flex flex-column text-left mb-4">
                    <h6 class="text-primary font-weight-normal text-uppercase mb-3">Artikel</h6>
                    <h1 class="mb-4 section-title"><?= $article['title_article'] ?></h1>
                    <div class="d-index-flex mb-2">
                        <span class="mr-3"><i class="fa fa-user text-primary"></i><?= $article['name_ormawa'] ?></span>
                        <span class="mr-3"><i class="fas fa-clock text-primary"></i><?= $article['date_article'] ?></span>
                    </div>
                </div>

                <div class="mb-5">
                    <img class="img-fluid w-100 mb-4" src="<?= base_url('assets/img/article/' . $article['image_article']) ?>" alt="Image">
                    <p><?= $article['content_article'] ?></p>
                </div>
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">
                <div class="d-flex flex-column text-center bg-light mb-5 py-5 px-4">
                    <img src="<?= base_url('assets/img/logo_ormawa/') . $article['logo_ormawa'] ?>" class="img-fluid mx-auto mb-3" style="width: 100px;">
                    <h3 class="text-primary mb-3"><?= $article['name_ormawa'] ?></h3>
                    <p class="text-black m-0 text-justify"><?= $article['description_ormawa'] ?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Detail End -->

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