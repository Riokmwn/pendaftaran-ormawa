<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-primary mb-2" id="btnAdd">Tambah baru</button>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Gambar</th>
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

<!-- modal -->
<div id="myModal" class="modal fade " role="dialog">
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

<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });

    $(function() {
        showAllContentHomepage();

        //add New
        $('#btnAdd').click(function() {
            $("#myForm").trigger('reset');
            $('#myModal').modal('show');
            $('.note-editable').html("");
            $('#myModal').find('.modal-title').text('Tambah gambar baru');
            $('#myForm').attr('action', '<?php echo base_url() ?>Ormawa/addContentHomepage');
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
                    showAllContentHomepage();
                    alert('Success!');
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
                    url: '<?php echo base_url() ?>Ormawa/deleteContentHomepage',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        alert('Success!')
                        showAllContentHomepage();
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

    //function
    function showAllContentHomepage() {
        $.ajax({
            url: '<?php echo base_url() ?>Ormawa/showAllContentHomepageByOrmawa',
            async: false,
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td class="">' + (i + 1) + '</td>' +
                        '<td class=""><img src="<?= base_url('assets/img/content/') ?>' + data[i].image_content_homepage + '" class="img-thumbnail"></td>' +
                        '<td>' +
                        '<button class="btn btn-danger item-delete" data="' + data[i].id_content_homepage + '"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
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
        showAllContentHomepage();
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