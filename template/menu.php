<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

<div class="slimscroll-menu">

    <!-- User box -->
    <div class="user-box text-center">
        <img src="<?php echo BASE_URL ?>assets/images/users/avatar.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-lg">
        <div class="dropdown">
            <p class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"><?php echo strlen($_SESSION['nama']) > 22 ? substr($_SESSION['nama'], 0, 22) . '...' : $_SESSION['nama']; ?></p>
        </div>
        <p class="text-muted"><?php echo $_SESSION['nama_peran'] ?></p>
    </div>

    <!--- Sidemenu -->
    <div id="sidebar-menu">

        <ul class="metismenu" id="side-menu">

            <li>
                <a href="<?php echo BASE_URL ?>">
                    <i class="mdi mdi-view-dashboard"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <?php if($_SESSION['nama_peran'] == "Administrator") { ?>

            <li class="menu-title">Master Data</li>

            <li>
                <a href="<?php echo BASE_URL ?>data-mahasiswa">
                    <i class="mdi mdi-account-group"></i>
                    <span> Mahasiswa </span>
                </a>
            </li>
            <li>
                <a href="<?php echo BASE_URL ?>data-dosen">
                    <i class="mdi mdi-account-multiple"></i>
                    <span> Dosen </span>
                </a>
            </li>
            <li>
                <a href="<?php echo BASE_URL ?>data-mata-kuliah">
                    <i class="mdi mdi-calendar-text-outline"></i>
                    <span> Mata Kuliah </span>
                </a>
            </li>

            <?php } elseif($_SESSION['nama_peran'] == "Dosen") { ?>

            <li class="menu-title">Penilaian</li>

            <li>
                <a href="<?php echo BASE_URL ?>data-mata-kuliah">
                    <i class="mdi mdi-calendar-text-outline"></i>
                    <span> Mata Kuliah </span>
                </a>
            </li>

            <?php } elseif($_SESSION['nama_peran'] == "Mahasiswa") { ?>

            <li class="menu-title">Penilaian</li>

            <li>
                <a href="<?php echo BASE_URL ?>data-nilai">
                    <i class="mdi mdi-calendar-text-outline"></i>
                    <span> Nilai </span>
                </a>
            </li>

            <?php } ?>
        </ul>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->