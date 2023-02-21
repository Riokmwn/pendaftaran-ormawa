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
                        <table class="table table-bordered text-center" width="100%" cellspacing="0" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ormawa</th>
                                    <th>Jumlah Program Kerja</th>
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

<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });

    //function
    function showAllArticle() {

        $.ajax({
            url: '<?php echo base_url() ?>Ormawa_management/showAllOrmawa',
            async: false,
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    $.ajax({
                        url: '<?php echo base_url() ?>Work_program/countWorkProgramById/' + data[i].id_ormawa,
                        async: false,
                        dataType: 'json',
                        success: function(work_program_count) {
                            html += '<tr>' +
                                '<td class="">' + (i + 1) + '</td>' +
                                '<td class="">' + data[i].name_ormawa + '</td>' +
                                '<td class="text-center">' + work_program_count + '</td>' +
                                '<td class="text-center">' +
                                '<a href="<?= base_url() ?>work_program/work_program_by_ormawa/' + data[i].id_ormawa + '" class="btn btn-success item-detail mr-2" data="' + data[i].id_article + '"><i class="fa fa-eye" aria-hidden="true"></i></a>' +
                                '</td>' +
                                '</tr>';
                        },
                        error: function() {
                            alert('Error loading data');
                        }
                    });
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
        showAllArticle();
    }

    function refresh() {
        MyTable = $('#myTable').dataTable();
    }


    const readURL = (input) => {
        if (input.files && input.files[0]) {
            const reader = new FileReader()
            reader.onload = (e) => {
                $('#image').attr('src', e.target.result)
            }
            reader.readAsDataURL(input.files[0])
        }
    }
    $('.choose').on('change', function() {
        readURL(this)
        let i
        if ($(this).val().lastIndexOf('\\')) {
            i = $(this).val().lastIndexOf('\\') + 1
        } else {
            i = $(this).val().lastIndexOf('/') + 1
        }
        const fileName = $(this).val().slice(i)
    })
</script>