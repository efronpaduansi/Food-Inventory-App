<?php

    session_start();
    include "../../conn/koneksi.php";

    //tampil data kedalam table
    $data = $conn->query("SELECT tb_makanan.nama_makanan, tb_makanan.varian_rasa, stock.hrg_satuan, stock.jumlah FROM (tb_makanan LEFT JOIN stock ON tb_makanan.kode = stock.kode_makanan)");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "../master/header.php"; ?>
  <title>Stock | Dimsum Pawonkulo</title>
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
              <li class="nav-item">
                <a href="dashboard.php" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
              </li>
              <li class=""><a class="nav-link" href="menu.php"><i class="fas fa-clipboard-list"></i><span>Menu</span></a></li>
              <li class="active"><a class="nav-link" href="stock.php"><i class="fas fa-layer-group"></i><span>Stock</span></a></li>
              <li class=""><a class="nav-link" href="data_penjualan.php"><i class="fas fa-chart-line"></i><span>Data Penjualan</span></a></li>
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
            <h1>Stok Makanan</h1>
          </div>
          <div class="section-body">
              <!-- Table stok makanan -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-inline mb-3">
                          <button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#stokModal">
                              Tambahkan ke Stok
                            </button>
                              <a href="../../functions/laporan_stok_brg.php" target="_blank" class="btn btn-info"><i class="fas fa-print"></i> Cetak Laporan</a>
                          </div>
                        <table class="table table-bordered table-secondary">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col">NO</th>
                                <th scope="col">NAMA MAKANAN</th>
                                <th scope="col">VARIAN RASA</th>
                                <th scope="col">HARGA / Pcs</th>
                                <th scope="col">JUMLAH</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                                  $no = 1;
                                  while( $tampil = $data->fetch_array()) {
                                ?>
                                <tr>
                                  <th scope="row"><?= $no; ?></th>
                                  <td><?=$tampil['nama_makanan']; ?></td>
                                  <td><?=$tampil['varian_rasa']; ?></td>
                                  <td><?=$tampil['hrg_satuan']; ?></td>
                                  <td><?=$tampil['jumlah']; ?></td>
                                </tr>
                                <?php 
                                  $no++; 
                                  }
                                ?>
                            <tbody>
                        </table>
                    </div>
                    
                </div>
           </div>
        </section>
        <!-- Modal -->
          <div class="modal fade" id="stokModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambahkan ke Stok</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
      </div>
      <?php include "../master/footer.php"; ?>
</body>
</html>
