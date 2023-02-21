<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message') ?>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $menu->id ?>">
                    <input type="text" class="form-control" id="menu" name="menu" placeholder="Nama controller" value="<?php echo $menu->menu ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="menu_name" name="menu_name" placeholder="Nama menu" value="<?php echo $menu->menu_name ?>">
                </div>
                <input type="submit" class="btn btn-primary">

            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->