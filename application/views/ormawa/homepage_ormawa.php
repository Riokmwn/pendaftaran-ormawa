<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <h3 class="h3 text-gray-800">Halaman Utama</h3>
            <?= $this->session->flashdata('message'); ?>
            <?php echo form_open_multipart('ormawa/homepage_ormawa'); ?>
            <div class="form-group pt-3">
                <label for="name">Nama Himpunan</label>
                <textarea class="form-control" id="name" name="name" rows="3"><?= $ormawa['name_ormawa'] ?></textarea>
            </div>
            <label>Gambar utama </label>
            <div class="row">
                <div class="col-sm-6">
                    <img src="<?= base_url('assets/img/header/') . $ormawa['image_ormawa'] ?>" class="img-thumbnail">
                </div>
                <div class="col-sm-9 pt-2">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Pilih berkas</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 pt-3">
                    <label>Struktur organisasi</label>
                    <img src="<?= base_url('assets/img/structure/') . $ormawa['organization_structure_ormawa'] ?>" class="img-thumbnail">
                </div>
                <div class="col-sm-9 pt-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image_structure" name="image_structure">
                        <label class="custom-file-label" for="image_structure">Pilih berkas</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 pt-3">
                    <label>Logo Organisasi</label>
                    <img src="<?= base_url('assets/img/logo_ormawa/') . $ormawa['logo_ormawa'] ?>" class="img-thumbnail">
                </div>
                <div class="col-sm-9 pt-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="logo" name="image_logo">
                        <label class="custom-file-label" for="logo">Pilih berkas</label>
                    </div>
                </div>
            </div>
            <div class="form-group pt-3">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= $ormawa['description_ormawa'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="visi_mission">Visi Misi</label>
                <textarea class="form-control" id="visi_mission" name="visi_mission" rows="3"><?= $ormawa['visi_mission_ormawa'] ?></textarea>
            </div>
            <div class="form-group pt-3">
                <a href="<?= base_url('ormawa/content_homepage') ?>" type="submit" class="btn btn-primary">Tambah konten</a>
            </div>
            <div class="form-group pt-3">
                <button type="button" class="btn btn-primary mb-2" id="btnAdd">Tambah AD/ART</button>
            </div>
            <div class="form-group pt-3">
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
            </form>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- modal -->
<div id="myModal" class="modal fade " role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Judul modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="myForm" action="#" method="post" class="needs-validation" novalidate="" onsubmit={this.saveAndContinue}>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Upload file : </label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control choose" name="document">
                        </div>
                    </div>
                    <input type="hidden" name="type_document" value="4">
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Dokumen</th>
                                <?php if ($user['role_id'] == 2 || $user['role_id'] == 3) { ?>
                                    <th>Tanggal</th>
                                <?php } ?>
                                <th>Tipe</th>
                                <?php if ($user['role_id'] == 2) { ?>
                                    <th>Ormawa</th>
                                <?php } ?>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });

    $('#btnAdd').click(function() {
        showAllDocument();
        $("#myForm").trigger('reset');
        $('#myModal').modal('show');
        $('#myModal').find('.modal-title').text('Tambah Dokumen');
        $('#myForm').attr('action', '<?php echo base_url() ?>Document/addDocument');
    });

    $('#btnSave').click(function() {
        var url = $('#myForm').attr('action');
        var data = $('#myForm').serialize();

        var formData = new FormData($('#myForm')[0]);
        $.ajax({
            type: 'post',
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                $('#myModal').modal('hide');
                $('#myForm')[0].reset();
                if (response.type == 'add') {
                    var type = 'added';
                } else if (response.type == 'edit') {
                    var type = 'edited';
                }
                showAllDocument();
                alert('Success!');
            },
            error: function() {
                alert('Error!');
            }
        });
    });


    //delete
    $('#show_data').on('click', '.item-delete', function() {
        var id = $(this).attr('data');
        let confirmation = confirm('Hapus data?');
        if (confirmation) {
            $.ajax({
                type: 'get',
                async: false,
                url: '<?php echo base_url() ?>Document/deleteDocument',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    alert('Success!')
                    showAllDocument();
                },
                error: function() {
                    alert('error');
                }
            })
        } else {
            alert('Canceled');
        }
    });

    function showAllDocument() {

        $.ajax({
            url: '<?php echo base_url() ?>Document/showDocumentByOrmawa/<?= $myOrmawa['user_id'] ?>',
            async: false,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td class="">' + (i + 1) + '</td>' +
                        '<td class=""><a href="<?= base_url('assets/document/') ?>' + data[i].name_document + '" type="button" class="btn btn-success">Download</a></td>' +
                        <?php if ($user['role_id'] != 4) { ?> '<td class="">' + data[i].date_document + '</td>' +
                        <?php } ?> '<td class="">' + data[i].name_type_document + '</td>' +
                        <?php if ($user['role_id'] == 2) { ?> '<td class="">' + data[i].name_ormawa + '</td>' +
                        <?php } ?> '<td class="text-center">' +
                        '<button class="btn btn-danger item-delete" data="' + data[i].id_document + '"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
                        '</td>' +
                        '</tr>';
                }
                // MyTable.fnDestroy();
                $('#show_data').html(html);
                refresh();

            },
            error: function() {
                alert('Error loading data');
            }
        });
    }

    function refresh() {
        MyTable = $('#myTable').dataTable();
    }

    const readURL = (input) => {
        if (input.files && input.files[0]) {
            const reader = new FileReader()
            reader.onload = (e) => {
                $('#image').attr('src', e.target.result)
            }
            reader.readAsDataURL(input.files[0])
        }
    }
    $('.choose').on('change', function() {
        readURL(this)
        let i
        if ($(this).val().lastIndexOf('\\')) {
            i = $(this).val().lastIndexOf('\\') + 1
        } else {
            i = $(this).val().lastIndexOf('/') + 1
        }
        const fileName = $(this).val().slice(i)
    })
</script>