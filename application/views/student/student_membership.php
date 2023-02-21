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
                                    <th>Ormawa</th>
                                    <th>Status Keanggotaan</th>
                                    <th>Periode</th>
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
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Prodi</th>
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
        showOrmawa();

        //detail
        $('#show_data').on('click', '.item-detail', function() {
            $('#modalDetail').modal('show');
            $('#modalDetail').find('.modal-title').text('Detail');
            var id = $(this).attr('data');
            $.ajax({
                type: 'get',
                url: '<?php echo base_url() ?>Student/showStudentByPeriod/' + id,
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    var html = '';
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td class="">' + (i + 1) + '</td>' +
                            '<td class="">' + data[i].id + '</td>' +
                            '<td class="">' + data[i].name + '</td>' +
                            '<td class="">' + data[i].name_gender + '</td>' +
                            '<td class="">' + data[i].name_prodi + '</td>' +
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

    });

    //function
    function showOrmawa() {
        $.ajax({
            url: '<?php echo base_url() ?>Student/showOrmawaByMember',
            async: false,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    if (data[i].is_active_member_ormawa == 1) {
                        color = "success";
                        text = "Aktif";
                    } else {
                        color = "danger";
                        text = "Tidak aktif"
                    }
                    html += '<tr>' +
                        '<td class="">' + (i + 1) + '</td>' +
                        '<td class="">' + data[i].name_ormawa + '</td>' +
                        '<td class=""><span class="badge badge-' + color + '">' + text + '</span></td>' +
                        '<td class="">' + data[i].name_period + '</td>' +
                        '<td class="text-center">' +
                        '<button class="btn btn-success item-detail mr-2" data="' + data[i].period_id + '"><i class="fa fa-eye" aria-hidden="true"></i></button>' +
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
        showOrmawa();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable();
    }
</script>