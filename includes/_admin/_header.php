<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>

    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <link rel="stylesheet" href="./dist/css/fonts.googleapis.css">
    <script src="./dist/js/jquery.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="./plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="./plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="./plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="./plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="./plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="./dist/css/sweetalert2.min.css">
    <script src="./dist/js/sweetalert2.min.js"></script>


    <link rel="stylesheet" href="./dist/css/flatpickr.min.css">
    <script src="./dist/js/flatpickr.js"></script>
    <script src="./js/xlsx.full.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="?page=logout" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> Logout
                        </a>
                    </div>
                </li>


            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link">
                <img src="./dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Jayahanda Institute</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <!-- <div class="image">
                        <img src="./dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div> -->
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $_SESSION['UserName'] ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <?php if (isset($_SESSION['UserLevel'])) { ?>


                            <!-- Manage the Admin session -->

                            <?php if ($_SESSION['UserLevel'] === "Admin") { ?>
                                <li class="nav-item">
                                    <a href="?page=dashboard" class="nav-link">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=student" class="nav-link">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>Students</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=teachers" class="nav-link">
                                        <i class="nav-icon fas fa-th"></i>
                                        <p>Teachers</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=teacherdetails" class="nav-link">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>Teacher details</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=classesshedule" class="nav-link">
                                        <i class="nav-icon far fa-calendar-alt"></i>
                                        <p>classes shedule</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=classdetails" class="nav-link">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>Classes details</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=usermanagement" class="nav-link">
                                        <i class="nav-icon fas fa-th"></i>
                                        <p>User Management</p>
                                    </a>
                                </li>

                            <?php } ?>



                            <!-- Manage the Teacher session -->

                            <?php if ($_SESSION['UserLevel'] === "Teacher") { ?>

                                <li class="nav-item">
                                    <a href="?page=dashboard" class="nav-link">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=student" class="nav-link">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>Students</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=teachers" class="nav-link">
                                        <i class="nav-icon fas fa-th"></i>
                                        <p>Teachers</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=teacherdetails" class="nav-link">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>Teacher details</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=classdetails" class="nav-link">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>Classes details</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=classesshedule" class="nav-link">
                                        <i class="nav-icon far fa-calendar-alt"></i>
                                        <p>classes shedule</p>
                                    </a>
                                </li>


                            <?php } ?>


                            <!-- Manage the student session -->

                            <?php if ($_SESSION['UserLevel'] === "Student") { ?>

                                <li class="nav-item">
                                    <a href="?page=dashboard" class="nav-link">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=teacherdetails" class="nav-link">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>Teacher details</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?page=classdetails" class="nav-link">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>Classes details</p>
                                    </a>
                                </li>



                            <?php } ?>






                        <?php } ?>
                    </ul>
                </nav>

            </div>

        </aside>