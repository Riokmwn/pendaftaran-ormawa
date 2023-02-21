<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="container-fluid">
            <button type="button" class="btn btn-primary mb-2" id="btnAdd">Tambah baru</button>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tipe ormawa</th>
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
<div id="myModal" class="modal fade" role="dialog">
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
                        <input type="hidden" class="form-control" name="Id">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Tipe ormawa : </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name">
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

<script>
    $(function() {
        showTypeOrmawa();

        //add New
        $('#btnAdd').click(function() {
            $("#myForm").trigger('reset');
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Tambah tipe ormawa baru');
            $('#myForm').attr('action', '<?php echo base_url() ?>Type_ormawa/addTypeOrmawa');
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
                    if (response.success) {
                        $('#myModal').modal('hide');
                        $('#myForm')[0].reset();
                        if (response.type == 'add') {
                            var type = 'added';
                        } else if (response.type == 'edit') {
                            var type = 'edited';
                        }
                        showTypeOrmawa();
                        alert('Success!');
                    } else {
                        alert('Error!');
                    }
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
            $('#myModal').find('.modal-title').text('Ubah tipe ormawa');
            $('#myForm').attr('action', '<?php echo base_url() ?>Type_ormawa/updateTypeOrmawa');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>Type_ormawa/editTypeOrmawa',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('input[name=name]').val(data.name_type_ormawa);
                    $('input[name=Id]').val(data.id_type_ormawa);
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
                    url: '<?php echo base_url() ?>Type_ormawa/deleteTypeOrmawa',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        alert('Success!')
                        showTypeOrmawa();
                    },
                    error: function() {
                        alert: ('error');
                    }
                })
            } else {
                alert('Canceled');
            }
        });

    });
    //function
    function showTypeOrmawa() {
        $.ajax({
            url: '<?php echo base_url() ?>Type_ormawa/showAllTypeOrmawa',
            async: false,
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {

                    html += '<tr>' +
                        '<td class="">' + (i + 1) + '</td>' +
                        '<td class="">' + data[i].name_type_ormawa + '</td>' +
                        '<td class="text-center">' +
                        '<button class="btn btn-warning item-edit mr-2" data="' + data[i].id_type_ormawa + '"><i class="fa fa-edit" aria-hidden="true"></i></button>' +
                        '<button class="btn btn-danger item-delete" data="' + data[i].id_type_ormawa + '"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
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

    window.onload = function() {
        showTypeOrmawa();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable();
    }
</script>