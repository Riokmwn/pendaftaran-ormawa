<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap" id="example" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">NRP</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Religion</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Prodi</th>
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
    function showAllOrmawa() {
        $.ajax({
            url: '<?php echo base_url() ?>Ormawa/showMemberOrmawaByOrmawaNoAdmin/<?= $ormawa_id ?>',
            async: false,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    if (data[i].is_active == 1) {
                        color = "success";
                        text = "Active";
                    } else {
                        color = "danger";
                        text = "Not Active";
                    }
                    html += '<tr>' +
                        '<td class="">' + (i + 1) + '</td>' +
                        '<td class="">' + data[i].id + '</td>' +
                        '<td class="">' + data[i].name + '</td>' +
                        '<td class="">' + data[i].name_gender + '</td>' +
                        '<td class="">' + data[i].address + '</td>' +
                        '<td class="">' + data[i].name_religion + '</td>' +
                        '<td class="">' + data[i].email + '</td>' +
                        '<td class="">' + data[i].name_prodi + '</td>' +
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