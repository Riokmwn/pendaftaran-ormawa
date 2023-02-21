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
                                    <th>Jadwal</th>
                                    <th>Kategori</th>
                                    <th>Ormawa</th>
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
    <div class="modal-dialog" role="document">
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
                                <textarea id="summernote" class="editor" name="content"></textarea>
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

<script>
    $(document).ready(function() {
        $('#summernote').summernote();
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
                    showAllWorkProgram();
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
                    $('input[name=Id]').val(data.id_work_program);
                    $('input[name=title]').val(data.title_work_program);
                    $('.note-editable').html(data.content_work_program);
                    $('input[name=date]').val(data.date_work_program);
                    $('input[name=category_name]').val(data.name_category_activity);
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

    //function
    function showAllWorkProgram() {

        $.ajax({
            url: '<?php echo base_url() ?>Work_program/showWorkProgramByOrmawa/<?= $ormawa_id ?>',
            async: false,
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    if (data[i].is_active == 1) {
                        color = "success";
                        text = "Active";
                    } else {
                        color = "danger";
                        text = "Not Active"
                    }
                    html += '<tr>' +
                        '<td class="">' + (i + 1) + '</td>' +
                        '<td class="">' + data[i].title_work_program + '</td>' +
                        '<td class="">' + data[i].date_work_program + '</td>' +
                        '<td class="">' + data[i].name_category_activity + '</td>' +
                        '<td class="">' + data[i].name_ormawa + '</td>' +
                        '<td class="text-center">' +
                        '<button class="btn btn-success item-detail mr-2" data="' + data[i].id_work_program + '"><i class="fa fa-eye" aria-hidden="true"></i></button>' +
                        '<button class="btn btn-warning item-edit mr-2" data="' + data[i].id_work_program + '"><i class="fa fa-edit" aria-hidden="true"></i></button>' +
                        '<button class="btn btn-danger item-delete" data="' + data[i].id_work_program + '"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
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

<?php
if ($user['role_id'] == 1 || $user['role_id'] == 2) { ?>
    <script>
        $(document).ready(function() {
            $('.item-edit').remove();
        });
    </script>
<?php }
?>