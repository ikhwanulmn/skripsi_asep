<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/logo_gissekolah.png') ?>">
  <link rel="icon" type="image/png" href="<?= base_url('assets/logo_gissekolah.png') ?>">
  <title>
    GIS Sekolah
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="<?= base_url('material_dashboard/assets/css/nucleo-icons.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('material_dashboard/assets/css/nucleo-svg.css') ?>" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url('material_dashboard/assets/css/material-dashboard.css?v=3.0.0') ?>" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css" />
  <?= $this->renderSection('head') ?>
</head>

<body class="g-sidenav-show">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-1 fixed-start bg-gradient-dark " id="sidenav-main">
    <style>
      .sidenav-header {
        background-color: #1A407A;
      }

      #sidenav-collapse-main {
        background-color: #50AAB7;
      }

      .img-fluid {
        background-color: #50AAB7;
      }

      .nav-item {
        background-color: #7AB7C0;
      }

      .nav-item:hover {
        background-color: #ECF02E;
      }

      .selected {
        background-color: #F8C40E;
      }
    </style>
    <!-- Style Header navbar -->
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="<?= base_url('home') ?>">
        <h4 class="ms-4 font-weight-bold text-white">WebGIS SMP</h4>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-0">
    <div class="collapse navbar-collapse w-auto max-height-vh-100 h-100" id="sidenav-collapse-main">
      <a href="<?= base_url('home') ?>">
        <img src="<?= base_url('assets/logo_gissekolah.png') ?>" class="img-fluid mx-3 mt-2" alt="Responsive image">
      </a>
      <ul class="navbar-nav mt-2">
        <li class="nav-item <?php
                            $uri = new \CodeIgniter\HTTP\URI();
                            $uri = service('uri');
                            if ($uri == base_url('home')) echo 'selected'; ?>">
          <a class="nav-link text-white" href="<?= base_url('home') ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">home</i>
            </div>
            <span class="nav-link-text ms-1">Home</span>
          </a>
        </li>
        <li class="nav-item <?php
                            $uri = new \CodeIgniter\HTTP\URI();
                            $uri = service('uri');
                            if ($uri == base_url('sekolah')) echo 'selected'; ?>">
          <a class="nav-link text-white" href="<?= base_url('sekolah') ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">search</i>
            </div>
            <span class="nav-link-text ms-1">Data Sekolah</span>
          </a>
        </li>
        <li class="nav-item <?php
                            $uri = new \CodeIgniter\HTTP\URI();
                            $uri = service('uri');
                            if ($uri == base_url('maps')) echo 'selected'; ?>">
          <a class="nav-link text-white" href="<?= base_url('maps') ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-folder-open opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Visualisasi Data</span>
          </a>
        </li>
        <li class="nav-item <?php
                            $uri = new \CodeIgniter\HTTP\URI();
                            $uri = service('uri');
                            if ($uri == base_url('maps/prediction_page')) echo 'selected'; ?>">
          <a class="nav-link text-white" href="<?php echo base_url('maps/prediction_page'); ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-globe opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Hasil Prediksi</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg shadow-none" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-0 px-0">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <?php
            $session = session();
            if ($session->get('isLoggedIn') == TRUE) {
              echo ('<p class="font-weight-normal my-auto mb-4 lead">Hello, ' . $session->get('name') . '</p> <a class="nav-link text-white" href="' . base_url("signin/logout") . '"> <button class="btn btn-primary" type="button">Logout</button></a>');
            } else {
              echo ('<a class="nav-link text-white" href="' . base_url("signin") . '"> <button class="btn btn-primary" type="button">Login</button></a>');
            }
            ?>
          </div>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-2">
      <div class="row min-vh-80 h-100">
        <div class="col-12">
          <?= $this->renderSection('content') ?>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="copyright text-center text-sm text-muted text-lg-center">
                SIG SMP KOTA BANDUNG
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="<?php base_url('material_dashboard/assets/js/core/popper.min.js') ?>"></script>
  <script src="<?php base_url('material_dashboard/assets/js/core/bootstrap.min.js') ?>"></script>
  <script src="<?php base_url('material_dashboard/assets/js/plugins/perfect-scrollbar.min.js') ?>"></script>
  <script src="<?php base_url('material_dashboard/assets/js/plugins/smooth-scrollbar.min.js') ?>"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?= base_url('material_dashboard/assets/js/material-dashboard.min.js?v=3.0.0') ?>"></script>
  <?= $this->renderSection('script') ?>
</body>

</html>