<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="container-fluid">
            <?php if ($user['role_id'] == 3) { ?>
                <a href="<?= base_url('ormawa/add_member_period_ormawa/' . $id) ?>" type="button" class="btn btn-primary mb-2" id="btnUpload">Tambah Anggota</a>
            <?php } ?>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap" id="example" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">NRP</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Agama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Prodi</th>
                                    <th scope="col">Aksi</th>
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


<script>
    //delete
    $('#show_data').on('click', '.item-delete', function() {
        var id = $(this).attr('data');
        let confirmation = confirm('Non aktif anggota?');
        if (confirmation) {
            $.ajax({
                type: 'get',
                async: false,
                url: '<?php echo base_url() ?>Ormawa/nonActiveMemberByOrmawa',
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

    //function
    function showAllOrmawa() {
        $.ajax({
            url: '<?php echo base_url() ?>Ormawa/showMemberByPeriod/<?= $id ?>',
            async: false,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td class="">' + (i + 1) + '</td>' +
                        '<td class="">' + data[i].id + '</td>' +
                        '<td class="">' + data[i].name + '</td>' +
                        '<td class="">' + data[i].name_gender + '</td>' +
                        '<td class="">' + data[i].address + '</td>' +
                        '<td class="">' + data[i].name_religion + '</td>' +
                        '<td class="">' + data[i].email + '</td>' +
                        '<td class="">' + data[i].name_prodi + '</td>' +
                        '<td class="text-center">' +
                        '<button class="btn btn-danger item-delete" data="' + data[i].id + '"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
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
        $('#example').DataTable({
            responsive: true
        });
    });

    window.onload = function() {
        showAllOrmawa();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable();
    }
</script>