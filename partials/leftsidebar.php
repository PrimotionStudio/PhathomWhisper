<!-- Start left sidebar-menu -->
<div class="side-menu flex-lg-column me-lg-1 ms-lg-0">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo.svg" alt="" height="30">
            </span>
        </a>

        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo.svg" alt="" height="30">
            </span>
        </a>
    </div>
    <!-- end navbar-brand-box -->

    <!-- Start side-menu nav -->
    <div class="flex-lg-column my-auto">
        <ul class="nav nav-pills side-menu-nav justify-content-center" role="tablist">
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Profile">
                <a class="nav-link" id="pills-user-tab" data-bs-toggle="pill" href="#pills-user" role="tab">
                    <i class="ri-user-2-line"></i>
                </a>
            </li>
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Chats">
                <a class="nav-link active" id="pills-chat-tab" data-bs-toggle="pill" href="#pills-chat" role="tab">
                    <i class="ri-message-3-line"></i>
                </a>
            </li>
            <li class="nav-item d-lg-none">
                <a class="nav-link light-dark-mode" href="#" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" title="Dark / Light Mode">
                    <i class='ri-sun-line theme-mode-icon'></i>
                </a>
            </li>
            <li class="nav-item dropdown profile-user-dropdown d-inline-block d-lg-none">
                <a class="nav-link dropdown-toggle" href="https://theprimotionstudio.wordpress.com/" target="_blank">
                    <img src="assets/images/users/PrimotionStudio.jpg" alt="" class="profile-user rounded-circle">
                </a>
            </li>
            <?php
            if (isset($_SESSION["userid"]) && isset($_SESSION["loginkey"])) {
            ?>
            <li class="nav-item d-lg-none">
                <a class="nav-link" href="func/logout" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" title="Logout">
                    <i class='ri-logout-circle-line'></i>
                </a>
            </li>
            <?php
            }
            ?>
        </ul>
    </div>
    <!-- end side-menu nav -->

    <div class="flex-lg-column d-none d-lg-block">
        <ul class="nav side-menu-nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link light-dark-mode" href="#" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" title="Dark / Light Mode">
                    <i class='ri-sun-line theme-mode-icon'></i>
                </a>
            </li>

            <?php
            if (isset($_SESSION["userid"]) && isset($_SESSION["loginkey"])) {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="func/logout" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" title="Logout">
                    <i class='ri-logout-circle-line'></i>
                </a>
            </li>
            <?php
            }
            ?>

            <li class="nav-item btn-group dropup profile-user-dropdown">
                <a class="nav-link dropdown-toggle" href="https://theprimotionstudio.wordpress.com/" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" title="Primotion Studio" target="_blank">
                    <img src="assets/images/users/PrimotionStudio.jpg" alt="" class="profile-user rounded-circle">
                </a>
            </li>
        </ul>
    </div>
    <!-- Side menu user -->
</div>
<!-- end left sidebar-menu -->