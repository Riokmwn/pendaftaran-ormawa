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
                                    <th>Kode</th>
                                    <th>Nama</th>
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
                        <label for="staticEmail" class="col-sm-4 col-form-label">Kode : </label>
                        <div class="col-sm-8">
                            <input type="hidden" class="form-control" name="firstId">
                            <input type="text" class="form-control" name="Id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Nama : </label>
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

<div id="modalDetail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Judul modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table display" id="example" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NRP</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis kelamin</th>
                        </tr>
                    </thead>
                    <tbody id="show_content">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        showAllProdi();

        //detail
        $('#show_data').on('click', '.item-detail', function() {
            $('#modalDetail').modal('show');
            $('#modalDetail').find('.modal-title').text('Detail');
            var id = $(this).attr('data');
            $.ajax({
                type: 'get',
                url: '<?php echo base_url() ?>Prodi_management/showStudentByProdi/' + id,
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var html = '';
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td class="">' + (i + 1) + '</td>' +
                            '<td class="">' + data[i].id + '</td>' +
                            '<td class="">' + data[i].name + '</td>' +
                            '<td class="">' + data[i].name_gender + '</td>' +
                            '</tr>';
                    }
                    $('#show_content').html(html);
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
            $('#myModal').find('.modal-title').text('Tambah prodi baru');
            $('#myForm').attr('action', '<?php echo base_url() ?>Prodi_management/addProdi');
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
                        showAllProdi();
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
            $('#myModal').find('.modal-title').text('Ubah prodi');
            $('#myForm').attr('action', '<?php echo base_url() ?>Prodi_management/updateProdi');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>Prodi_management/editProdi',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('input[name=firstId]').val(data.id_prodi);
                    $('input[name=Id]').val(data.id_prodi);
                    $('input[name=name]').val(data.name_prodi);
                },
                error: function() {
                    swal('Failed', 'Error occured. Please try again!', 'error');
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
                    url: '<?php echo base_url() ?>Prodi_management/deleteProdi',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        alert('Success!')
                        showAllProdi();
                    },
                    error: function() {
                        alert: ('error');
                    }
                })
            } else {
                alert('Canceled');
            }
        });


        //function
        function showAllProdi() {
            $.ajax({
                url: '<?php echo base_url() ?>Prodi_management/showAllProdi',
                async: false,
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {

                        html += '<tr>' +
                            '<td class="">' + (i + 1) + '</td>' +
                            '<td class="">' + data[i].id_prodi + '</td>' +
                            '<td class="">' + data[i].name_prodi + '</td>' +
                            '<td class="text-center">' +
                            '<button class="btn btn-success item-detail mr-2" data="' + data[i].id_prodi + '"><i class="fa fa-eye" aria-hidden="true"></i></button>' +
                            '<button class="btn btn-warning item-edit mr-2" data="' + data[i].id_prodi + '"><i class="fa fa-edit" aria-hidden="true"></i></button>' +
                            '<button class="btn btn-danger item-delete" data="' + data[i].id_prodi + '"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
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
    });

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
        showAllProdi();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable();
    }
</script>