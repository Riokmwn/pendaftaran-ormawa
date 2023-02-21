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
                    <select name="menu_id" id="menu_id" class="form-control">
                        <option value="">Pilih menu</option>
                        <?php foreach ($menu as $m) : ?>
                            <option <?php if ($m['id'] == $submenu->menu_id) echo 'selected'  ?> value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $submenu->id ?>">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Judul Submenu" value="<?php echo $submenu->title ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="url" name="url" placeholder="Url" value="<?php echo $submenu->url ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon" value="<?php echo $submenu->icon ?>">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                    <label class="form-check-label" for="is_active">
                        Aktif?
                    </label>
                </div>
                <input type="submit" class="btn btn-primary" value="Save">

            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->