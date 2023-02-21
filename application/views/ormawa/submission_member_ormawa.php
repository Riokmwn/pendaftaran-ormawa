<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="container-fluid">
            <a href="<?= base_url('ormawa/add_proses_member') ?>" type="button" class="btn btn-primary mb-2" id="btnAdd">Proses Anggota</a>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NRP</th>
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

<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });

    //delete
    $('#show_data').on('click', '.item-delete', function() {
        var id = $(this).attr('data');
        let confirmation = confirm('Hapus data?');
        if (confirmation) {
            $.ajax({
                type: 'get',
                async: false,
                url: '<?php echo base_url() ?>Ormawa/deleteCandidate/',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    alert('Success!')
                    showAllStudentRegistrationMemberOrmawa();
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
    function showAllStudentRegistrationMemberOrmawa() {
        $.ajax({
            url: '<?php echo base_url() ?>Ormawa/registration_member_ormawa/<? $id_student_registration ?>',
            async: false,
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td class="">' + (i + 1) + '</td>' +
                        '<td class="">' + data[i].id + '</td>' +
                        '<td class="">' + data[i].name + '</td>' +
                        '<td class="text-center">' +
                        // <?php if ($user['role_id'] == 3) { ?> 
                        '<a href="<?= base_url() ?>ormawa/submission_candidate/' + data[i].id + '" type="button" class="btn btn-success mr-2"><i class="fa fa-eye" aria-hidden="true"></i></a>' +
                        '<button class="btn btn-danger item-delete" data="' + data[i].id + '"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
                        // <?php } ?>

                        // <?php if ($user['role_id'] == 4) { ?>
                        //         '<a href="<?= base_url() ?>student/student_registration_ormawa/' + data[i].id + '" type="button" class="btn btn-success mr-2"><i class="fa fa-eye" aria-hidden="true"></i></a>' +
                        //     <?php } ?> '</td>' +
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
        showAllStudentRegistrationMemberOrmawa();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable();
    }
</script>