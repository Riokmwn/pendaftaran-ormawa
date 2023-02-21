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
                                    <th>NRP</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Posisi</th>
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
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">NIP : </label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" name="nip">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Nama : </label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" name="name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Email : </label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" name="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Tanggal lahir : </label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" name="date_of_birth">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Alamat : </label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" name="address">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Jenis kelamin : </label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" name="gender">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Agama : </label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" name="religion">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Posisi : </label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" name="position">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Nomor telepon : </label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" name="nomor_telepon">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        showAllPKA();

        //edit
        $('#show_data').on('click', '.item-edit', function() {
            var id = $(this).attr('data');
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Detail');
            $('#myForm').attr('action', '<?php echo base_url() ?>user/updateUser');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>Pka_user_management/detailPka',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('input[name=name]').val(data.name);
                    $('input[name=nip]').val(data.id);
                    $('input[name=email]').val(data.email);
                    $('input[name=date_of_birth]').val(data.date_of_birth);
                    $('input[name=gender]').val(data.name_gender);
                    $('input[name=religion]').val(data.name_religion);
                    $('input[name=position]').val(data.name_pka_position);
                    $('input[name=address]').val(data.address);
                    $('input[name=nomor_telepon]').val(data.phone_number);
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
                    url: '<?php echo base_url() ?>Pka_user_management/deletePka',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        alert('Success!')
                        showAllLecturer();
                    },
                    error: function() {
                        alert('error');
                    }
                })
            } else {
                alert('Canceled');
            }
        });

        //function
        function showAllPKA() {
            var baseUrl = (window.location).href; // You can also use document.URL
            var id_position = baseUrl.substring(baseUrl.lastIndexOf('/') + 1);
            $.ajax({
                url: '<?php echo base_url() ?>Pka_user_management/showPkaByPosition/' + id_position,
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {

                        html += '<tr>' +
                            '<td class="">' + data[i].id + '</td>' +
                            '<td class="">' + data[i].name + '</td>' +
                            '<td class="">' + data[i].email + '</td>' +
                            '<td class="">' + data[i].name_pka_position + '</td>' +
                            '<td class="text-center">' +
                            '<button class="btn btn-warning item-edit mr-2" data="' + data[i].id + '"><i class="fa fa-eye" aria-hidden="true"></i> </button>' +
                            '<button class="btn btn-danger item-delete" data="' + data[i].id + '"><i class="fa fa-trash" aria-hidden="true"></i> </button>' +
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

    window.onload = function() {
        showAllPKA();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable();
    }
</script>