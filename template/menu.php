<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

<div class="slimscroll-menu">

    <!-- User box -->
    <div class="user-box text-center">
        <img src="<?php echo BASE_URL ?>assets/images/users/avatar.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-lg">
        <div class="dropdown">
            <p class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"><?php echo $_SESSION['nama'] ?></p>
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

            <li class="menu-title">Navigation</li>

            <li>
                <a href="typography.html">
                    <i class="mdi mdi-format-font"></i>
                    <span> Typography </span>
                </a>
            </li>
        </ul>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->