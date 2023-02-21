<?php $role_id = $this->session->userdata('role_id');  ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">

        <!-- registration status -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-black text-uppercase mb-1">Persyaratan masuk <?= $ormawa['name_ormawa'] ?>:
                            </div>
                            <div class="text-xs font-weight-bold text-black text-uppercase mb-1"><?= $ormawa['requirement_ormawa'] ?>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><? ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <?php echo form_open_multipart('student/registration_student_to_ormawa'); ?>
            <div class="form-group row">
                <label for="ormawa" class="col-sm-2 col-form-label">Ormawa</label>
                <div class="col-sm-10">
                    <input type="hidden" class="form-control" id="id_ormawa" name="id_ormawa" value="<?= $ormawa['id_ormawa'] ?>" readonly>
                    <input type="text" class="form-control" id="ormawa" name="ormawa" value="<?= $ormawa['name_ormawa'] ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="id" class="col-sm-2 col-form-label">NRP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="id" name="id" value="<?= $user['id'] ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nama lengkap</label>
                <div class="col-sm-10">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $user['id'] ?>">
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="date_of_birth" class="col-sm-2 col-form-label">Tanggal lahir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?= $user['date_of_birth'] ?>">
                    <?= form_error('date_of_birth', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="phone_number" class="col-sm-2 col-form-label">Nomor telepon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= $user['phone_number'] ?>">
                    <?= form_error('phone_number', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="gender" class="col-sm-2 col-form-label">Jenis kelamin</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="gender" name="gender" value="<?= $gender['name_gender'] ?>" readonly>
                    <?= form_error('gender', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="religion" class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="religion" name="religion" value="<?= $religion['name_religion'] ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address" value="<?= $user['address'] ?>">
                    <?= form_error('address', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="prodi" name="prodi" value="<?= $student['name_prodi'] ?>">
                    <?= form_error('prodi', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group pt-3">
                <button type="button" class="btn btn-primary mb-2" id="btnAdd">Dokumen CV</button>
                <span class="ml-3 text-danger" id="error-doc"></span>
            </div>
            <div class="form-group">
                <div class="">
                    <a href="#" id="kirim" class="btn btn-primary">Kirim</a>
                </div>
            </div>

            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

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
                    <input type="hidden" name="type_document" value="1">
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
    document.getElementById("kirim").addEventListener("click", function(event) {
        event.preventDefault();
        <?php if ($document) {
            echo 'var doc = 1;';
        } else {
            echo 'var doc = 0;';
        } ?>

        if (doc == 0) {
            $('#error-doc').html('Curriculum Vitae harus diisi terlebih dahulu')
        } else {
            $('#error-doc').html('')
        }
        if (doc != 0) {
            window.location.href = '<?= base_url() ?>student/registration_student_to_ormawa/<?= $id ?>';
        }
    });

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
                location.reload(true);
                // showAllDocument();
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
                    location.reload(true);
                    // showAllDocument();
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
            url: '<?php echo base_url() ?>Document/showDocumentByStudent/<?= $user['id'] ?>',
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