<?php

session_start();

if(!isset($_SESSION['login'])){
    header("location:../../index.php?session=false");
  }



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "../master/header.php"; ?>
  <title>Pengaturan | Dimsum Pawonkulo</title>
</head>
<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="../../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?=$_SESSION['fname']; ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="account_info.php" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="setting.php" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="../../logout.php" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Dimsum Pawon Kulo</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">DPK</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header"><?=$_SESSION['level']; ?></li>
              <li class="nav-item">
                <a href="dashboard.php" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
              </li>
            <li class=""><a class="nav-link" href="penjualan.php"><i class="fas fa-shopping-bag"></i><span>Penjualan</span></a></li>
              <li class=""><a class="nav-link" href="stock.php"><i class="fas fa-layer-group"></i><span>Stock</span></a></li>
              <li class=""><a class="nav-link" href="menu.php"><i class="fas fa-clipboard-list"></i><span>Menu</span></a></li>
              <li class="active"><a class="nav-link" href="setting.php"><i class="fas fa-cog"></i> <span>Pengaturan</span></a></li>
            </ul>
            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="../../logout.php" class="btn btn-danger btn-lg btn-block btn-icon-split">
              <i class="fas fa-sign-out"></i> Keluar
              </a>
            </div>
        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
             <h1>Pengaturan</h1>
          </div>

          <div class="section-body">
            <div class="row">
                <div class="col-lg-8">
                   <div class="card" data-aos="fade-up" data-aos-duration="1000">
                       <div class="card-header bg-dark text-light">
                        <i class="fas fa-user mr-2"></i> <span>Pengaturan Akun</span> 
                       </div>
                       <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><a href="account_info.php"><span>Informasi Akun Anda</span></a></li>
                                <li class="list-group-item"><a href=""><span>Ganti Password</span></a></li>
                            </ul>
                       </div>
                   </div>
                </div>
          </div>
        </section>
      </div>
     <?php include "../master/footer.php" ?>
</body>
</html>
