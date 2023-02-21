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
                                    <th>Tahun</th>
                                    <th>Ketua Organisasi</th>
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
<?php if ($user['role_id'] == 3) { ?>
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
                            <label for="staticEmail" class="col-sm-4 col-form-label">Tahun : </label>
                            <div class="col-sm-12">
                                <input type="hidden" class="form-control" name="Id">
                                <input type="text" class="form-control" name="name">
                                <input type="hidden" class="form-control" name="ormawa_id" value="<?= $ormawa_id ?>">
                            </div>
                        </div>
                        <select name="head" id="head" class="form-control">
                            <option value="">Ketua Organisasi</option>
                            <?php foreach ($head as $data) { ?>
                                <option value="<?= $data->user_id ?>"><?= $data->id ?> - <?= $data->name; ?></option>
                            <?php } ?>
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


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
        showAllPeriod();

        //detail
        $('#show_data').on('click', '.item-detail', function() {
            $('#modalDetail').modal('show');
            $('#modalDetail').find('.modal-title').text('Detail');
            var id = $(this).attr('data');
            $.ajax({
                type: 'get',
                url: '<?php echo base_url() ?>Ormawa/editPeriod',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    $('#for-content').html(data.content);
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
            $('#myModal').find('.modal-title').text('Tambah ketua organisasi baru');
            $('#myForm').attr('action', '<?php echo base_url() ?>Ormawa/addPeriod');
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
                    showAllPeriod();
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
            $('#myModal').find('.modal-title').text('Ubah ketua organisasi');
            $('#myForm').attr('action', '<?php echo base_url() ?>Ormawa/updatePeriod');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>Ormawa/editPeriod',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('input[name=Id]').val(data.id_period);
                    $('input[name=name]').val(data.name_period);
                    $('select[name=head]').val(data.user_id);
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
                    url: '<?php echo base_url() ?>Ormawa/deletePeriod',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        alert('Success!')
                        showAllPeriod();
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
    function showAllPeriod() {

        $.ajax({
            url: '<?php echo base_url() ?>Ormawa/showAllPeriodByOrmawa/<?= $id ?>',
            async: false,
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td class="">' + (i + 1) + '</td>' +
                        '<td class="">' + data[i].name_period + '</td>' +
                        '<td class="">' + data[i].name + '</td>' +
                        '<td class="text-center">' +
                        '<a href="<?= base_url() ?>ormawa/member_ormawa_period/' + data[i].id_period + '" type="button" class="btn btn-success mr-2"><i class="fa fa-eye" aria-hidden="true"></i></a>' +
                        '<button class="btn btn-warning item-edit mr-2" data="' + data[i].id_period + '"><i class="fa fa-edit" aria-hidden="true"></i></button>' +
                        '<button class="btn btn-danger item-delete" data="' + data[i].id_period + '"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
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
        showAllPeriod();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable();
    }
</script>

<?php
if ($user['role_id'] == 1 || $user['role_id'] == 2 || $user['role_id'] == 5) { ?>
    <script>
        $(document).ready(function() {
            $('.item-edit').remove();
            $('.item-delete').remove();
        });
    </script>
<?php } ?>