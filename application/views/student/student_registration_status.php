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
                                    <th>Status</th>
                                    <th>Tanggal Status</th>
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
    //function
    function showAllCandidateStatus() {
        $.ajax({
            url: '<?php echo base_url() ?>Student/showAllCandidateStatus',
            async: false,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    if (data[i].status_registration_student_to_ormawa == 1) {
                        color = "info";
                        text = "Pengajuan";
                    } else if (data[i].status_registration_student_to_ormawa == 2) {
                        color = "success";
                        text = "Proses"
                    } else {
                        color = "danger"
                        text = "Ditolak"
                    }
                    html += '<tr>' +
                        '<td class="">' + (i + 1) + '</td>' +
                        '<td class="">' + data[i].name_ormawa + '</td>' +
                        '<td class=""><span class="badge badge-' + color + '">' + text + '</span></td>' +
                        '<td class="">' + data[i].date_status_registration_student_to_ormawa + '</td>' +
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
        showAllCandidateStatus();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable();
    }
</script>