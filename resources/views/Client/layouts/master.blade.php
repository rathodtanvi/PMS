<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="http://localhost:8080/API_PMS/public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost:8080/API_PMS/public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="http://localhost:8080/API_PMS/public/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="http://localhost:8080/API_PMS/public/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="http://localhost:8080/API_PMS/public/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="http://localhost:8080/API_PMS/public/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="http://localhost:8080/API_PMS/public/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="http://localhost:8080/API_PMS/public/assets/css/style.css" rel="stylesheet">
    <link href="http://localhost:8080/API_PMS/public/assets/css/custom.css" rel="stylesheet">

    <!-- yajra links -->

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    

    <!-- =======================================================
    * Template Name: NiceAdmin - v2.2.2
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
    </head>

    <body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block"> PMS </span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        

        <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <img src="http://localhost:8080/API_PMS/public/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                <h6>Kevin Anderson</h6>
                <span>Web Designer</span>
                </li>
                <li>
                <hr class="dropdown-divider">
                </li>

                <li>
                <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                    <i class="bi bi-person"></i>
                    <span>My Profile</span>
                </a>
                </li>
                <li>
                <hr class="dropdown-divider">
                </li>

                <li>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                </a>
                </li>

            </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="http://localhost:8080/API_PMS/public/Dashboard">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed"  href="http://localhost:8080/API_PMS/public/Technology">
            <i class="bi bi-menu-button-wide"></i><span> Technology </span>
            </a>
            
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed"  href="http://localhost:8080/API_PMS/public/Project">
            <i class="bi bi-card-list"></i><span> Project </span>
            </a>
            
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed"  href="http://localhost:8080/API_PMS/public/ProjectAllotment">
            <i class="bi bi-file-earmark"></i><span> Project Allotment </span>
            </a>
            
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed"  href="http://localhost:8080/API_PMS/public/Attendance">
            <i class="bi bi-calendar-check"></i><span> Attendance </span>
            </a>
            
        </li>

        </ul>
    </aside>
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">

                @yield('content')

            </div>
        </section>
    </main>
    <!-- ======= Footer ======= -->
    <footer class="footer">
        <div class="copyright">
        &copy; Copyright <strong><span>PMS</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="http://localhost:8080/API_PMS/public/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="http://localhost:8080/API_PMS/public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="http://localhost:8080/API_PMS/public/assets/vendor/chart.js/chart.min.js"></script>
    <script src="http://localhost:8080/API_PMS/public/assets/vendor/echarts/echarts.min.js"></script>
    <script src="http://localhost:8080/API_PMS/public/assets/vendor/quill/quill.min.js"></script>
    <script src="http://localhost:8080/API_PMS/public/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="http://localhost:8080/API_PMS/public/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="http://localhost:8080/API_PMS/public/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="http://localhost:8080/API_PMS/public/assets/js/main.js"></script>

</body>
</html>