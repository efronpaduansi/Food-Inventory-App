<?php
  session_start();
  include "../../conn/koneksi.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
    include "../master/header.php";
  ?>
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
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="../../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?= $_SESSION['fname']; ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="account_info.php" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="account_setting.php" class="dropdown-item has-icon">
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
              <li class="menu-header"><?= $_SESSION['level']; ?></li>
              <li class="nav-item active">
                <a href="dashboard.php" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
              </li>
              <li class=""><a class="nav-link" href="orders.php"><i class="fas fa-shopping-bag"></i><span>Orders</span></a></li>
              <li class=""><a class="nav-link" href="stock.php"><i class="fas fa-layer-group"></i><span>Stock</span></a></li>
              <li class=""><a class="nav-link" href="menu.php"><i class="fas fa-clipboard-list"></i><span>Menu</span></a></li>
              <li class=""><a class="nav-link" href="data_penjualan.php"><i class="fas fa-chart-line"></i><span>Penjualan</span></a></li>
              <li class=""><a class="nav-link" href="profit.php"><i class="fas fa-coins"></i><span>Profit</span></a></li>
              <li class=""><a class="nav-link" href="laporan.php"><i class="fas fa-file-excel"></i> <span>Laporan</span></a></li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-sliders-h"></i><span>Preferences</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="account_setting.php"><i class="fas fa-cog"></i>Pengaturan Akun</a></li>
                  <li><a class="nav-link" href="users.php"><i class="fas fa-user"></i>Tambah User</a></li>
                </ul>
              </li>
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
            <div class="welcome" data-aos="fade-left" data-aos-duration="3000"  data-aos-once="true">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Hi, <?=$_SESSION['fname']; ?>!</strong> Welcome back.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-md-3">
                    <div class="card bg-success">
                      <div class="card-header">Stock</div>
                      <div class="card-body">
                        <h1 class="text-light">18</h1>
                      </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning">
                      <div class="card-header">Stock</div>
                      <div class="card-body">
                        <h1 class="text-light">18</h1>
                      </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger">
                      <div class="card-header">Stock</div>
                      <div class="card-body">
                        <h1 class="text-light">18</h1>
                      </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info">
                      <div class="card-header">Stock</div>
                      <div class="card-body">
                        <h1 class="text-light">18</h1>
                      </div>
                    </div>
                </div>
              </div>
                <div class="row" data-aos="fade-up" data-aos-duration="3000">
                        <div class="col-md-6 stock-grafik">
                          <div class="title">Stock Makanan</div>
                            <!-- Grafik -->
                              <div style="width: 500px;height: 500px">
                                <canvas id="myChart"></canvas>
                              </div>
                              <script>
                                  var ctx = document.getElementById("myChart").getContext('2d');
                                  var myChart = new Chart(ctx, {
                                    type: 'doughnut',
                                    data: {
                                      labels: ["Ayam", "Beef", "Cumi", "Udang"],
                                      datasets: [{
                                        label: '',
                                        data: [
                                        <?php 
                                        $stockAyam = $conn->query("SELECT SUM(total) AS totalAyam FROM stock WHERE id_menu = 'DPK001'");
                                        $fethData = $stockAyam->fetch_array();
                                        $jmlAyam = $fethData['totalAyam'];
                                        echo $jmlAyam;
                                        ?>, 
                                        <?php 
                                        $stockBeef = $conn->query("SELECT SUM(total) AS totalBeef FROM stock WHERE id_menu = 'DPK002'");
                                        $fethData2 = $stockBeef->fetch_array();
                                        $jmlBeef = $fethData2['totalBeef'];
                                        echo $jmlBeef;
                                        ?>, 
                                        <?php 
                                        $stockCumi = $conn->query("SELECT SUM(total) AS totalCumi FROM stock WHERE id_menu = 'DPK003'");
                                        $fethData3 = $stockCumi->fetch_array();
                                        $jmlCumi = $fethData3['totalCumi'];
                                        echo $jmlCumi;
                                        ?>, 
                                        <?php 
                                        $stockUdang = $conn->query("SELECT SUM(total) AS totalUdang FROM stock WHERE id_menu = 'DPK004'");
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
      </div>
     <?php include "../master/footer.php" ?>
</body>
</html>
