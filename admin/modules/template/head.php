<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="../assets/css/dashboard.css">
  <title><?= $title?></title>
  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</head>
<body>
  <nav class="navbar navbar-dark sticky-top bg-secondary flex-md-nowrap p-0 shadow ">
    <a class="navbar-brand bg-secondary col-md-3 col-lg-2 mr-0 px-3 font-weight-bold border-0" href="<?= base_url()?>dashboard.php" style="letter-spacing: 5px;">
      <img src="<?= base_url().'../../assets/img/lpse-logo.png'?>" alt="" height="30"> SIKAMU
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav px-3 justify-content-end align-content-between flex-row border-0">
      <li class="nav-item text-nowrap px-2">        
        <a class="nav-link" href="<?= base_url()?>ganti_password.php"><i class="fa fa-lock"></i> Ganti Password</a>
      </li>
      <li class="nav-item text-nowrap px-2">        
        <a class="nav-link" href="<?= base_url()?>keluar.php"><i class="fa fa-sign-out-alt"></i> Keluar</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <?php include 'navbar.php'?>

      

