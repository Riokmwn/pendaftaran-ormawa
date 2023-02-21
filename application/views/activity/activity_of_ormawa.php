<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Jadwal mulai</th>
                                    <th>Jadwal selesai</th>
                                    <th>Kategori</th>
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
                <form id="myForm" action="#" method="post" class="needs-validation" novalidate="" onsubmit={this.saveAndContinue}>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Judul : </label>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" name="Id">
                            <input type="text" class="form-control" name="title">
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
                        <label for="staticEmail" class="col-sm-4 col-form-label">Jadwal mulai : </label>
                        <div class="col-sm-12">
                            <input type="datetime-local" class="form-control" name="start_date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Jadwal selesai : </label>
                        <div class="col-sm-12">
                            <input type="datetime-local" class="form-control" name="end_date">
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="staticEmail" class="col-sm col-form-label">Laporan Pertanggung Jawaban : </label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control choose" name="document">
                        </div>
                    </div> -->
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
            </div>
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
            <div class="modal-footer">
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
                                <input type="hidden" name="category_id" value="L">
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
        showAllActivity();

        //detail
        $('#show_data').on('click', '.item-detail', function() {
            $('#modalDetail').modal('show');
            $('#modalDetail').find('.modal-title').text('Detail');
            var id = $(this).attr('data');
            $.ajax({
                type: 'get',
                url: '<?php echo base_url() ?>Activity/editActivity',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    $('#for-content').html(data.content_activity);
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
            $('#myModal').find('.modal-title').text('Tambah aktivitas baru');
            $('#myForm').attr('action', '<?php echo base_url() ?>Activity/addActivity');
        });

        $('#btnSave').click(function() {
            var url = $('#myForm').attr('action');
            var data = $('#myForm').serialize();

            $.ajax({
                type: 'post',
                url: url,
                data: data,
                async: false,
                dataType: 'json',
                success: function(response) {
                    $('#myModal').modal('hide');
                    $('#myForm')[0].reset();
                    if (response.type == 'add') {
                        var type = 'added';
                    } else if (response.type == 'edit') {
                        var type = 'edited';
                    }
                    showAllActivity();
                    alert('Success!');
                },
                error: function() {
                    alert('Error!');
                }
            });
        });

        //edit
        $('#show_data').on('click', '.item-edit', function() {
            var id = $(this).attr('data');
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Ubah aktivitas');
            $('#myForm').attr('action', '<?php echo base_url() ?>Activity/updateActivity');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>Activity/editActivity',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('input[name=Id]').val(data.id_activity);
                    $('input[name=title]').val(data.title_activity);
                    $('textarea').html(data.content_activity);
                    $('.note-editable ').html('<p>' + data.content_activity + '</p>');
                    $('input[name=start_date]').val(data.start_date_activity.replace(/ /g, 'T'));
                    $('input[name=end_date]').val(data.end_date_activity.replace(/ /g, 'T'));
                    $('input[name=document]').html(data.document_activity);
                    $('select[name=category]').val(data.category_id);
                },
                error: function() {
                    alert('Error!');
                }
            });

        });

        //terima
        $('#show_data').on('click', '.item-terima', function() {
            var id = $(this).attr('data');
            let confirmation = confirm('Terima LPJ?');
            if (confirmation) {
                $.ajax({
                    type: 'get',
                    async: false,
                    url: '<?php echo base_url() ?>Activity/terimaActivity',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        alert('Success!')
                        showAllActivity();
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

        //delete
        $('#show_data').on('click', '.item-delete', function() {
            var id = $(this).attr('data');
            let confirmation = confirm('Hapus data?');
            if (confirmation) {
                $.ajax({
                    type: 'get',
                    async: false,
                    url: '<?php echo base_url() ?>Activity/deleteActivity',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        alert('Success!')
                        showAllActivity();
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

    //function
    function showAllActivity() {
        $.ajax({
            url: '<?php echo base_url() ?>Activity/showActivityByOrmawa/<?= $id_ormawa ?>',
            async: false,
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    if (data[i].status_documet_activity == 1) {
                        color = "info";
                        text = "Pengajuan";
                    } else if (data[i].status_documet_activity == 2) {
                        color = "success";
                        text = "Diterima";
                    } else if (data[i].status_documet_activity == 3) {
                        color = "danger";
                        text = "Ditolak";
                    }
                    html += '<tr>' +
                        '<td class="">' + (i + 1) + '</td>' +
                        '<td class="">' + data[i].title_activity + '</td>' +
                        '<td class="">' + data[i].start_date_activity + '</td>' +
                        '<td class="">' + data[i].end_date_activity + '</td>' +
                        '<td class="">' + data[i].name_category_activity + '</td>' +
                        '<td class=""><a href="<?= base_url('assets/document/lpj/') ?>' + data[i].name_document + '" type="button" class="btn btn-success">Download</a></td>' +
                        '<td class="text-center"><span class="badge badge-' + color + '">' + text + '</span></td>' +
                        '<td class="text-center">' +
                        '<button class="btn btn-success item-detail mr-2" data="' + data[i].id_activity + '"><i class="fa fa-eye" aria-hidden="true"></i></button>' +
                        <?php if ($user['role_id'] == 3) { ?> '<button class="btn btn-warning item-edit mr-2" data="' + data[i].id_activity + '"><i class="fa fa-edit" aria-hidden="true"></i></button>' +
                            '<button class="btn btn-danger item-delete" data="' + data[i].id_activity + '"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
                        <?php } ?>
                    <?php if ($user['role_id'] != 3) { ?> '<button class="btn btn-info item-terima mt-2" data="' + data[i].id_activity + '">Terima</button>' +
                            '<button class="btn btn-danger item-tolak mt-1" data="' + data[i].id_activity + '">Tolak</button>' +
                        <?php } ?> '</td>' +
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
        showAllActivity();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable();
    }
</script>