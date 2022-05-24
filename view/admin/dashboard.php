<?php
  session_start();
  include "../../conn/koneksi.php";
  
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "../master/header.php"; ?>
  <title>Dashboard - Dimsum Pawonkulo</title>
  <script src="../../assets/js/Chart.js"></script>
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
            <div class="d-sm-none d-lg-inline-block">Hi, <?= $_SESSION['fname'];?></div></a>
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
              <li class="nav-item active">
                <a href="dashboard.php" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
              </li>
              <li class=""><a class="nav-link" href="menu.php"><i class="fas fa-clipboard-list"></i><span>Menu</span></a></li>
              <li class=""><a class="nav-link" href="stock.php"><i class="fas fa-layer-group"></i><span>Stock</span></a></li>
              <li class=""><a class="nav-link" href="penjualan.php"><i class="fas fa-shopping-bag"></i><span>Penjualan</span></a></li>
              <li class=""><a class="nav-link" href="laporan.php"><i class="fas fa-file-excel"></i> <span>Laporan</span></a></li>
              <li class=""><a class="nav-link" href="setting.php"><i class="fas fa-cog"></i> <span>Pengaturan</span></a></li>
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
            <h1>Dashboard</h1>
          </div>
          <div class="section-body">
            <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-left" data-aos-duration="3000">
              <strong><?= "Hi,". " " .$_SESSION['fname'] . "."; ?></strong> Selamat datang kembali.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="card bg-success shadow-lg rounded">
                  <div class="card-header">Stock</div>
                  <div class="card-body">
                    <div class="row justify-content-center">
                    <img src="../../assets/img/calendar.svg" class="mr-3" height="50"><h1>18%</h1>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="card bg-danger shadow-lg rounded">
                  <div class="card-header">Stock</div>
                  <div class="card-body">
                      <div class="row justify-content-center">
                       <img src="../../assets/img/calendar.svg" class="mr-3" height="50"><h1>18%</h1>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="card bg-warning shadow-lg rounded">
                  <div class="card-header">Stock</div>
                  <div class="card-body">
                    <div class="row justify-content-center">
                      <img src="../../assets/img/calendar.svg" class="mr-3" height="50"><h1>18%</h1>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                  <h5>Grafik Data Penjualan</h5>
                  <!-- Grafik -->
                    <div style="width: 500px;height: 200px">
                          <canvas id="myChart"></canvas>
                    </div>
                      <script>
                          var ctx = document.getElementById("myChart").getContext('2d');
                          var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                              labels: ["Ayam", "Beef", "Cumi", "Udang"],
                              datasets: [{
                                label: '',
                                data: [
                                <?php 
                                $stockAyam = $conn->query("SELECT SUM(jumlah) AS totalAyam FROM penjualan WHERE id_menu = 'DPK001'");
                                $fethData = $stockAyam->fetch_array();
                                $jmlAyam = $fethData['totalAyam'];
                                echo $jmlAyam;
                                ?>, 
                                <?php 
                                $stockBeef = $conn->query("SELECT SUM(jumlah) AS totalBeef FROM penjualan WHERE id_menu = 'DPK002'");
                                $fethData2 = $stockBeef->fetch_array();
                                $jmlBeef = $fethData2['totalBeef'];
                                echo $jmlBeef;
                                ?>, 
                                <?php 
                                $stockCumi = $conn->query("SELECT SUM(jumlah) AS totalCumi FROM penjualan WHERE id_menu = 'DPK003'");
                                $fethData3 = $stockCumi->fetch_array();
                                $jmlCumi = $fethData3['totalCumi'];
                                echo $jmlCumi;
                                ?>, 
                                <?php 
                                $stockUdang = $conn->query("SELECT SUM(jumlah) AS totalUdang FROM penjualan WHERE id_menu = 'DPK004'");
                                $fethData4 = $stockUdang->fetch_array();
                                $jmlUdang = $fethData4['totalUdang'];
                                echo $jmlUdang;
                                ?>
                                ],
                                backgroundColor: [
                                  'rgba(255, 99, 132, 0.2)',
                                  'rgba(54, 162, 235, 0.2)',
                                  'rgba(255, 206, 86, 0.2)',
                                  'rgba(75, 192, 192, 0.2)',
                                  'rgba(153, 102, 255, 0.2)',
                                  'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                  'rgba(255, 99, 132, 1)',
                                  'rgba(54, 162, 235, 1)',
                                  'rgba(255, 206, 86, 1)',
                                  'rgba(75, 192, 192, 1)',
                                  'rgba(153, 102, 255, 1)',
                                  'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                              }]
                            },
                            options: {
                              scales: {
                                yAxes: [{
                                  ticks: {
                                    beginAtZero:true
                                  }
                                }]
                              }
                            }
                          });
                      </script>
                    <!-- End of Grafik -->
              </div>
              <!-- Profile -->
              <div class="col-lg-6" data-aos="fade-left" data-aos-duration="3000">
                  <div class="card shadow-md rounded">
                    <div class="card-header"><strong>My Profile - </strong>You're login as @<?=$_SESSION['username'] . " " . "[" . $_SESSION['id_user'] . "]"; ?></div>
                    <div class="card-body text-center">
                        <img alt="image" src="../../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1" height=75>
                        <div class="row d-flex justify-content-center mt-5">
                          <div class="title text-left">
                            <h5>ID</h5>
                            <h5>USERNAME</h5>
                            <h5>FULLNAME</h5>
                            <h5>LEVEL</h5>
                          </div>
                          <div class="titik text-center ml-5">
                            <h5>:</h5>
                            <h5>:</h5>
                            <h5>:</h5>
                            <h5>:</h5>
                          </div>
                          <div class="identitas text-left ml-3">
                            <h5><strong><?=$_SESSION['id_user']; ?></strong></h5>
                            <h5><strong><?=$_SESSION['username']; ?></strong></h5>
                            <h5><strong><?=$_SESSION['fname']; ?></strong></h5>
                            <h5><strong><?=$_SESSION['level']; ?></strong></h5>
                          </div>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </section>
      </div>
     <?php include "../master/footer.php" ?>
</body>
</html>
