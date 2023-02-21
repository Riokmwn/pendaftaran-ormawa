<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Registrasi pembina</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/registration_lecturer'); ?>">
                            <div class="form-group">
                                <input type="number" class="form-control form-control-user" id="nip" name="nip" placeholder="NIP" value="<?= set_value('nip'); ?>">
                                <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama lengkap" value="<?= set_value('name'); ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Alamat email" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi password">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="phone_number" name="phone_number" placeholder="Nomor telepon" value="<?= set_value('phone_number'); ?>">
                                <?= form_error('phone_number', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control form-control-user" id="date_of_birth" name="date_of_birth" value="<?= set_value('date_of_birth'); ?>">
                                <?= form_error('date_of_birth', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-sm" id="gender" name="gender">
                                    <?php foreach ($dataGender as $data) { ?>
                                        <option value="<?= $data->id_gender ?>"><?= $data->name_gender ?></option>
                                    <?php } ?>
                                </select>
                                <?= form_error('gender', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-sm" id="religion" name="religion">
                                    <?php foreach ($dataReligion as $data) { ?>
                                        <option value="<?= $data->id_religion ?>"><?= $data->name_religion ?></option>
                                    <?php } ?>
                                </select>
                                <?= form_error('religion', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="address" name="address" placeholder="Alamat" value="<?= set_value('address'); ?>"></textarea>
                                <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-sm" id="ormawa" name="ormawa">
                                    <?php foreach ($ormawa as $data) { ?>
                                        <option value="<?= $data->id_ormawa ?>"><?= $data->name_ormawa ?></option>
                                    <?php } ?>
                                </select>
                                <?= form_error('ormawa', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Daftarkan akun
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth/forgotpassword'); ?>">Lupa password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Sudah memiliki akun? Masuk!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>