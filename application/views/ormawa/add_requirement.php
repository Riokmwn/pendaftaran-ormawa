<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
            <?php echo form_open_multipart('ormawa/add_requirement'); ?>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Persyaratan : </label>
                <div class="col-sm-12">
                    <div class="form-group">
                        <textarea id="summernote" class="editor" name="requirement">
                            <?= $ormawa['requirement_ormawa'] ?>
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="form-group pt-3">
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>