<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="container-fluid">
            <?php if ($user['role_id'] != 5 && $user['role_id'] != 1) { ?>
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
                                    <th>Judul</th>
                                    <th>Tanggal rilis</th>
                                    <?php if ($user['role_id'] == 1) { ?>
                                        <th>Penulis</th>
                                    <?php } ?>
                                    <th>Status</th>
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

<!-- modal -->
<div id="myModal" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
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
                        <label for="staticEmail" class="col-sm-4 col-form-label">Judul : </label>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" name="Id">
                            <input type="text" class="form-control" name="title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Konten : </label>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea id="summernote" class="editor" name="content"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Gambar : </label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control choose" name="image">
                            <img src="" id="image" class="rounded mx-auto d-block w-100 logo mt-2">
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

<!-- detail -->
<div id="modalDetail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card">
                <img class=" card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Feedback -->
<div id="modalFeedback" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-body" id="show_feedback">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });

    $(function() {
        showAllArticle();

        //detail
        $('#show_data').on('click', '.item-detail', function() {
            var id = $(this).attr('data');
            $('#modalDetail').modal('show');
            $('#modalDetail').find('.modal-title').text('Detail');
            $.ajax({
                type: 'get',
                url: '<?php echo base_url() ?>Article/editArticle',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    $(".card-title").html(data.title_article);
                    $(".card-text").html(data.content_article);
                    $('img').attr('src', "<?= base_url() ?>assets/img/article/" + data.image_article);
                    refresh();

                },
                error: function() {
                    alert('Error loading data');
                }
            });
        });


        //feedback
        $('#show_data').on('click', '.item-feedback', function() {
            var id = $(this).attr('data');
            $('#modalFeedback').modal('show');
            $('#modalFeedback').find('.modal-title').text('Detail');
            $.ajax({
                type: 'get',
                url: '<?php echo base_url() ?>Feedback/showFeedbackById/A',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<div class="card mb-2 bg-info text-white">' +
                            '<div class="card-body">' + data[i].content_feedback + '</div>' +
                            '</div>';
                    }
                    $('#show_feedback').html(html);
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
            $('#myModal').find('.modal-title').text('Tambah artikel baru');
            $('#myForm').attr('action', '<?php echo base_url() ?>Article/addArticle');
            $('#image').attr("src", "");
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
                    showAllArticle();
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
            $('#myModal').find('.modal-title').text('Ubah artikel');
            $('#myForm').attr('action', '<?php echo base_url() ?>Article/updateArticle');
            $.ajax({
                type: 'get',
                url: '<?php echo  base_url() ?>Article/editArticle',
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('input[name=Id]').val(data.id_article);
                    $('input[name=title]').val(data.title_article);
                    $('textarea').html(data.content_article);
                    $('.input[name=image]').html(data.image_article);
                    $('.note-editable ').html('<p>' + data.content_article + '</p>');
                    $('#image').attr("src", "<?php echo base_url(); ?>/assets/img/article/" + data.image_article);
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
                    url: '<?php echo base_url() ?>Article/deleteArticle',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        alert('Success!')
                        showAllArticle();
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

    var role = '<?= $user['role_id'] ?>';



    //function
    function showAllArticle() {

        if (role == 1) {
            var show_url = 'showAllArticle';
        } else if (role == 2) {
            var show_url = 'showArticleByPka';
        } else {
            var show_url = 'showArticleByOrmawa/<?= $ormawa_id ?>';
        }

        $.ajax({
            url: '<?php echo base_url() ?>Article/' + show_url,
            async: false,
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    if (data[i].status_article == 1) {
                        color = "info";
                        text = "Pengajuan";
                    } else if (data[i].status_article == 2) {
                        color = "success";
                        text = "Terpublikasi"
                    } else if (data[i].status_article == 3) {
                        color = "danger";
                        text = "Revisi"
                    }
                    html += '<tr>' +
                        '<td class="">' + (i + 1) + '</td>' +
                        '<td class="">' + data[i].title_article + '</td>' +
                        '<td class="">' + data[i].date_article + '</td>' +
                        <?php if ($user['role_id'] == 1) { ?> '<td class="">' + data[i].name_ormawa + '</td>' +
                        <?php } ?> '<td class="text-center"><span class="badge badge-pill badge-' + color + '">' + text + '</span></td>' +
                        '<td class="text-center">' +
                        '<button class="btn btn-success item-detail mr-2" data="' + data[i].id_article + '"><i class="fa fa-eye" aria-hidden="true"></i></button>' +
                        <?php if ($user['role_id'] != 5) { ?>
                        '<button class="btn btn-warning item-edit mr-2" data="' + data[i].id_article + '"><i class="fa fa-edit" aria-hidden="true"></i></button>' +
                        '<button class="btn btn-danger item-delete" data="' + data[i].id_article + '"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
                        <?php } ?>
                        <?php if ($user['role_id'] != 2) { ?>
                        '<button class="btn btn-info item-feedback ml-2" data="' + data[i].id_article + '"><i class="fas fa-marker mr-1" aria-hidden="true"></i><span class="badge badge-light" id="fb-' + data[i].id_article + '"></span></button>' +
                        <?php } ?>
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

<?php if ($user['role_id'] == 1) { ?>
    <script>
        $(document).ready(function() {
            $('.item-edit').remove();
        });
    </script>
<?php } ?>