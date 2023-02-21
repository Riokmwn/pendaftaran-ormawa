<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- Brand Buttons -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Anggota Periode</h6>
        </div>
        <div class="card-body">
            <form id="demoform" action="<?= base_url() ?>ormawa/add_to_member_ormawa" method="post">
                <input type="hidden" name="id_ormawa" value="<?= $id_ormawa['ormawa_id'] ?>">
                <input type="hidden" name="id_period" value="<?= $id ?>">
                <select multiple="multiple" size="10" name="member[]" title="member[]">
                    <?php
                    foreach ($member as $data) {
                    ?>
                        <option value="<?= $data->user_id ?>"><?= $data->user_id ?> - <?= $data->name ?></option>
                    <?php } ?>
                </select>
                <br>
                <button type="submit" class="btn btn-primary btn-block">Submit data</button>
            </form>
            <script>
                var demo1 = $('select[name="member[]"]').bootstrapDualListbox();
                $("#demoform").submit(function() {
                    var list_mhs = ($('[name="member[]"]').val());
                    console.log(list_mhs);
                });
            </script>
        </div>

    </div>
</div>
<!-- /.container-fluid -->