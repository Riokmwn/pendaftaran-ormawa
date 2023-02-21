<!-- Sidebar -->

<?php $role_id = $this->session->userdata('role_id');  ?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('') ?>">
        <?php $data['main_config'] = $this->db->get('main_config')->row_array(); ?>
        <div class="sidebar-brand-text mx-3"><?= $data['main_config']['application_name_main_config'] ?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <?php switch ($role_id) {
        case '1':
            $dashboard = 'admin';
            break;
        case '2':
            $dashboard = 'pka';
            break;
        case '3':
            $dashboard = 'ormawa';
            break;
        case '4':
            $dashboard = 'student';
            break;
        case '5':
            $dashboard = 'lecturer';
            break;
    } ?>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url($dashboard) ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Heading -->
    <div class="sidebar-heading">
        Profil
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#profil" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Profil</span>
        </a>
        <div id="profil" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url() ?>user">Profil</a>
                <a class="collapse-item" href="<?= base_url() ?>user/edit">Edit profil</a>
                <a class="collapse-item" href="<?= base_url() ?>user/change_password">Ganti password</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">


    <?php $role = 'admin/role';
    $menu = 'menu';
    $submenu = 'menu/submenu';
    $prodi = 'prodi_management/prodi';
    $ormawa = 'ormawa_management/ormawa';
    $position = 'pka_position_management/pka_position';
    $type_document = 'type_document/type_document';
    $category_activity = 'category_activity/category_activity';
    $type_ormawa = 'type_ormawa/type_ormawa';
    $religion = 'religion_management/user_religion';
    $gender = 'user_gender_management/user_gender';
    ?>

    <?php if ($role_id == 1 || $role_id == 2) { ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Admin
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#admin" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Manajemen</span>
            </a>
            <div id="admin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php if ($role_id == 1) { ?>
                        <a class="collapse-item" href="<?= base_url($role) ?>">Hak Akses</a>
                        <a class="collapse-item" href="<?= base_url($menu) ?>">Menu</a>
                        <a class="collapse-item" href="<?= base_url($submenu) ?>">Submenu</a>
                        <a class="collapse-item" href="<?= base_url($position) ?>">Jabatan PKA</a>
                        <a class="collapse-item" href="<?= base_url($type_document) ?>">Tipe Dokumen</a>
                        <a class="collapse-item" href="<?= base_url($category_activity) ?>">Tipe Kegiatan</a>
                        <a class="collapse-item" href="<?= base_url($type_ormawa) ?>">Tipe Ormawa</a>
                        <a class="collapse-item" href="<?= base_url($prodi) ?>">Program studi</a>
                        <a class="collapse-item" href="<?= base_url($religion) ?>">Agama</a>
                        <a class="collapse-item" href="<?= base_url($gender) ?>">Jenis kelamin</a>
                    <?php } ?>
                    <a class="collapse-item" href="<?= base_url($ormawa) ?>">Ormawa</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    <?php } ?>

    <?php if ($role_id != 4) { ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Kegiatan
        </div>

        <?php
        $before_article = 'article/before_article';
        $article = 'article';
        $before_activity = 'activity/before_activity';
        $activity = 'activity';
        $before_work_program = 'work_program/before_work_program';
        $work_program = 'work_program'; ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kegiatan" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Kegiatan</span>
            </a>
            <div id="kegiatan" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php if ($role_id == 1 || $role_id == 2) { ?>
                        <a class="collapse-item" href="<?= base_url($before_article) ?>">Artikel Ormawa</a>
                        <a class="collapse-item" href="<?= base_url($before_activity) ?>">Aktivitas Ormawa</a>
                        <a class="collapse-item" href="<?= base_url($before_work_program) ?>">Program Kerja Ormawa</a>
                    <?php } ?>
                    <?php if ($role_id != 1 && $role_id != 2) { ?>
                        <a class="collapse-item" href="<?= base_url($article) ?>">Artikel</a>
                        <a class="collapse-item" href="<?= base_url($activity) ?>">Aktivitas</a>
                        <a class="collapse-item" href="<?= base_url($work_program) ?>">Program kerja</a>
                    <?php } ?>
                </div>
            </div>
        </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <?php } ?>

    <?php $student = 'student_user_management/user_student';
    $lecturer = 'lecturer_management/user_lecturer';
    $staff_ormawa = 'staff_ormawa/staff_ormawa';
    ?>
    <?php if ($role_id == 1 || $role_id == 2) { ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Akun
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#akun" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Manajemen akun</span>
            </a>
            <div id="akun" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= base_url($lecturer) ?>">Pembina</a>
                    <a class="collapse-item" href="<?= base_url($student) ?>">Mahasiswa</a>
                    <a class="collapse-item" href="<?= base_url($staff_ormawa) ?>">Staff Ormawa</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    <?php } ?>

    <?php
    $halaman = 'admin/mainConfig';
    $tambah_mahasiswa = 'student_user_management/addStudentAccount';
    $tambah_pembina = 'lecturer_management/addLecturerAccount';
    ?>
    <?php if ($role_id == 1 || $role_id == 2) { ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Pengaturan
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pengaturan" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Pengaturan</span>
            </a>
            <div id="pengaturan" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php if ($role_id == 1) { ?>
                        <a class="collapse-item" href="<?= base_url($halaman) ?>">Halaman Utama</a>
                    <?php } ?>
                    <a class="collapse-item" href="<?= base_url($tambah_mahasiswa) ?>">Tambah Akun Mahasiswa</a>
                    <!-- <a class="collapse-item" href="<?= base_url($tambah_pembina) ?>">Tambah Akun Pembina</a> -->
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    <?php } ?>

    <!-- Heading -->
    <div class="sidebar-heading">
        Keluar
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Keluar</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->