<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="container-fluid">
            <?php if ($user['role_id'] == 3) { ?>
                <button type="button" class="btn btn-primary mb-2" id="btnAdd">Tambah baru</button>
            <?php } ?>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Jadwal</th>
                                    <th>Kategori</th>
                                    <?php if ($user['role_id'] == 2) { ?>
                                        <th>Ormawa</th>
                                    <?php } ?>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="show_data">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- modal -->
<div id="myModal" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Judul modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="myForm" action="#" method="post" class="needs-validation" novalidate="" onsubmit={this.saveAndContinue} enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Judul : </label>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" name="Id">
                            <input type="text" class="form-control" name="title">
                            <input type="hidden" class="form-control" name="nama_dokumen">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Konten : </label>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea id="" class="editor summernote" name="content"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Jadwal : </label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" name="date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Proposal : </label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control choose" name="document">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Kategori : </label>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select class="form-control" id="category" name="category">
                                    <?php foreach ($category as $data) { ?>
                                        <option value="<?= $data->id_category_activity ?>"><?= $data->name_category_activity ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- detail -->
<div id="modalDetail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Judul modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="for-content">
            </div>
        </div>
    </div>
</div>

<!-- Feedback -->
<div id="modalFeedback" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-body" id="show_feedback">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- tolak -->
<div id="modalTolak" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Judul modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="formFeedback" action="<?= base_url() ?>Feedback/addFeedback/" method="post" class="needs-validation" novalidate="" onsubmit={this.saveAndContinue}>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Feedback : </label>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" name="category_id" value="P">
                                <input type="hidden" name="post_id" value="">
                                <textarea class="editor summernote" name="feedback"></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });

    $(function() {
        showAllWorkProgram();

        //detail
        $('#show_data').on('click', '.item-detail', function() {
            $('#modalDetail').modal('show');
            $('#modalDetail').find('.modal-title').text('Detail');
            var id = $(this).attr('data');
            $.ajax({
                type: 'get',
                url: '<?php echo base_url() ?>Work_program/editWorkProgram',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    $('#for-content').html(data.content_work_program);
                    refresh();

                },
                error: function() {
                    alert('Error loading data');
                }
            });
        });

        //add New
        $('#btnAdd').click(function() {
            $("#myForm").trigger('reset');
            $('#myModal').modal('show');
            $('.note-editable').html("");
            $('#myModal').find('.modal-title').text('Tambah program kerja baru');
            $('#myForm').attr('action', '<?php echo base_url() ?>Work_program/addWorkProgram');
        });

        // $('#btnSave').click(function() {
        //     var url = $('#myForm').attr('action');
        //     var data = $('#myForm').serialize();

        //     $.ajax({
        //         type: 'post',
        //         url: url,
        //         data: data,
        //         async: false,
        //         dataType: 'json',
        //         success: function(response) {
        //             $('#myModal').modal('hide');
        //             $('#myForm')[0].reset();
        //             if (response.type == 'add') {
        //                 var type = 'added';
        //             } else if (response.type == 'edit') {
        //                 var type = 'edited';
        //             }
        //             showAllWorkProgram();
        //             alert('Success!');
        //         },
        //         error: function() {
        //             alert('Error!');
        //         }
        //     });
        // });

        //feedback
        $('#show_data').on('click', '.item-feedback', function() {
            var id = $(this).attr('data');
            $('#modalFeedback').modal('show');
            $('#modalFeedback').find('.modal-title').text('Detail');
            $.ajax({
                type: 'get',
                url: '<?php echo base_url() ?>feedback/showFeedbackById/P',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<div class="card mb-2 bg-info text-white">' +
                            '<div class="card-body">' + data[i].content_feedback + '</div>' +
                            '</div>';
                    }
                    $('#show_feedback').html(html);
                    refresh();
                },
                error: function() {
                    alert('Error loading dat1a');
                }
            });
        });

        //edit
        $('#show_data').on('click', '.item-edit', function() {
            var id = $(this).attr('data');
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Ubah program kerja');
            $('#myForm').attr('action', '<?php echo base_url() ?>Work_program/updateWorkProgram');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>Work_program/editWorkProgram',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    // console.table(data);
                    $('input[name=Id]').val(data.id_work_program);
                    $('input[name=title]').val(data.title_work_program);
                    $('textarea').html(data.content_work_program);
                    $('.note-editable ').html('<p>' + data.content_work_program + '</p>');
                    $('input[name=date]').val(data.date_work_program);
                    $('select[name=category]').val(data.category_id);
                    $('input[name=nama_dokumen]').val(data.document_work_program);
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
                    url: '<?php echo base_url() ?>Work_program/deleteWorkProgram',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        alert('Success!')
                        showAllWorkProgram();
                    },
                    error: function() {
                        alert('error');
                    }
                })
            } else {
                alert('Canceled');
            }
        });
    });

    //terima
    $('#show_data').on('click', '.item-terima', function() {
        var id = $(this).attr('data');
        let confirmation = confirm('Terima Proposal?');
        if (confirmation) {
            $.ajax({
                type: 'get',
                async: false,
                url: '<?php echo base_url() ?>Work_program/terimaWorkProgram',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    alert('Success!')
                    showAllWorkProgram();
                },
                error: function() {
                    alert('error');
                }
            })
        } else {
            alert('Canceled');
        }
    });

    //tolak
    $('#show_data').on('click', '.item-tolak', function() {
        $('#modalTolak').modal('show');
        $('#modalTolak').find('.modal-title').text('Detail');
        var id = $(this).attr('data');
        $('input[name=post_id]').val(id);

    });

    role = '<?= $user['role_id'] ?>';

    //function
    function showAllWorkProgram() {

        if (role == 3 || role == 5) {
            show_url = 'showWorkProgramByOrmawa/<?= $ormawa_id ?>';
        } else {
            show_url = 'showAllWorkProgram'
        }

        $.ajax({
            url: '<?php echo base_url() ?>Work_program/' + show_url,
            async: false,
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    if (data[i].status_document_work_program == 1) {
                        color = "info";
                        text = "Pengajuan";
                    } else if (data[i].status_document_work_program == 2) {
                        color = "success";
                        text = "Diterima";
                    } else if (data[i].status_document_work_program == 3) {
                        color = "danger";
                        text = "Ditolak";
                    }
                    html += '<tr>' +
                        '<td class="">' + (i + 1) + '</td>' +
                        '<td class="">' + data[i].title_work_program + '</td>' +
                        '<td class="">' + data[i].date_work_program + '</td>' +
                        '<td class="">' + data[i].name_category_activity + '</td>' +
                        <?php if ($user['role_id'] == 2) { ?> '<td class="">' + data[i].name_ormawa + '</td>' +
                        <?php } ?> '<td class="text-center"><a href="<?= base_url('assets/document/proposal/') ?>' + data[i].document_work_program + '" type="button" class="btn btn-success">Download</a></td>' +
                        '<td class="text-center"><span class="badge badge-' + color + '">' + text + '</span></td>' +
                        '<td class="text-center">' +
                        '<button class="btn btn-success item-detail mr-2" data="' + data[i].id_work_program + '"><i class="fa fa-eye" aria-hidden="true"></i></button>' +
                        <?php if ($user['role_id'] == 3) { ?> '<button class="btn btn-warning item-edit mr-2" data="' + data[i].id_work_program + '"><i class="fa fa-edit" aria-hidden="true"></i></button>' +
                            '<button class="btn btn-danger item-delete" data="' + data[i].id_work_program + '"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
                        <?php } ?>
                    <?php if ($user['role_id'] == 1 || $user['role_id'] == 2) { ?>
                            '<button class="btn btn-info item-terima mt-2" data="' + data[i].id_work_program + '">Terima</button>' +
                            '<button class="btn btn-danger item-tolak mt-1" data="' + data[i].id_work_program + '">Tolak</button>' +
                        <?php } ?> '<button class="btn btn-info item-feedback ml-2" data="' + data[i].id_work_program + '"><i class="fas fa-marker mr-1" aria-hidden="true"></i><span class="badge badge-light" id="fb-' + data[i].id_work_program + '"></span></button>' +
                        '</td>' +
                        '</tr>';
                }
                MyTable.fnDestroy();

                $('#show_data').html(html);
                refresh();

            },
            error: function() {
                alert('Error loading data');
            }
        });
    }

    $(document).keypress(
        function(event) {
            if (event.which == '13') {
                event.preventDefault();
            }
        });

    var MyTable = $('#myTable').dataTable({
        "order": [],
    });

    $(document).ready(function() {
        $('#example').DataTable();
    });

    window.onload = function() {
        showAllWorkProgram();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable();
    }
</script>