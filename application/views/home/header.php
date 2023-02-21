<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="<?= base_url() ?>assets/home/img/favicon/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Oswald:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="<?= base_url() ?>assets/home/lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url() ?>assets/home/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/home/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url() ?>assets/home/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container position-relative" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-secondary navbar-dark py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="<?= base_url('home/index') ?>" class="navbar-brand">
                    <h1 class="m-0 display-5 text-white"><?= $main_config['application_name_main_config'] ?></h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="<?= base_url('home/index') ?>" class="nav-item nav-link <?php if ($this->uri->segment('2') == "index") {
                                                                                                echo "active";
                                                                                            } ?> ">Utama</a>
                        <a href="<?= base_url('home/ormawa') ?>" class="nav-item nav-link <?php if ($this->uri->segment('2') == "ormawa") {
                                                                                                echo "active";
                                                                                            } ?>">Ormawa</a>
                        <a href="<?= base_url('home/article_grid') ?>" class="nav-item nav-link <?php if ($this->uri->segment('2') == "article_grid") {
                                                                                                    echo "active";
                                                                                                } ?>">Artikel</a>
                        <a href="<?= base_url('auth') ?>" class="nav-item nav-link">Masuk</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->