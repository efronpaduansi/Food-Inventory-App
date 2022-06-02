<?php
  session_start();

    include "../../conn/koneksi.php";

    //Menampilkan data kedalam tabel
    $getData = $conn->query("SELECT menu.makanan, menu.varian_rasa, penjualan.hrg_jual, penjualan.jumlah, penjualan.tgl, penjualan.administrator FROM (menu INNER JOIN penjualan ON menu.id = penjualan.id_menu)");
    $array = array();
    while ($data = $getData->fetch_array()) {
       $array[] = $data;
    }

    //menghitung total terjual
    $dataTerjualRasaAyam = $conn->query("SELECT SUM(jumlah) AS jmlTerjualRasaAyam FROM penjualan WHERE id_menu = 'DPK001'");
    $numData1 = $dataTerjualRasaAyam->fetch_array();
    $jmlPenjualanRasaAyam = $numData1['jmlTerjualRasaAyam'];

    $dataTerjualRasaBeef = $conn->query("SELECT SUM(jumlah) AS jmlTerjualRasaBeef FROM penjualan WHERE id_menu= 'DPK002'");
    $numData2 = $dataTerjualRasaBeef->fetch_array();
    $jmlPenjualanRasaBeef = $numData2['jmlTerjualRasaBeef'];

    $dataTerjualRasaCumi = $conn->query("SELECT SUM(jumlah) AS jmlTerjualRasaCumi FROM penjualan WHERE id_menu= 'DPK003'");
    $numData3 = $dataTerjualRasaCumi->fetch_array();
    $jmlPenjualanRasaCumi = $numData3['jmlTerjualRasaCumi'];

    $dataTerjualRasaUdang = $conn->query("SELECT SUM(jumlah) AS jmlTerjualRasaUdang FROM penjualan WHERE id_menu = 'DPK004'");
    $numData4 = $dataTerjualRasaUdang->fetch_array();
    $jmlPenjualanRasaUdang = $numData4['jmlTerjualRasaudang'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include "../master/header.php";
  ?>
  <title>Data Penjualan - Dimsum Pawonkulo</title>
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
              <li class="nav-item">
                <a href="dashboard.php" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
              </li>
              <li class=""><a class="nav-link" href="orders.php"><i class="fas fa-shopping-bag"></i><span>Orders</span></a></li>
              <li class=""><a class="nav-link" href="stock.php"><i class="fas fa-layer-group"></i><span>Stock</span></a></li>
              <li class=""><a class="nav-link" href="menu.php"><i class="fas fa-clipboard-list"></i><span>Menu</span></a></li>
              <li class="active"><a class="nav-link" href="data_penjualan.php"><i class="fas fa-chart-line"></i><span>Penjualan</span></a></li>
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
            <h1>Data Penjualan</h1>
          </div>
          <div class="section-body">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-3">
                          <div class="card bg-success shadow-lg">
                              <div class="card-header">Rasa Ayam</div>
                              <div class="card-body">
                                  <?php
                                    if($jmlPenjualanRasaAyam == 0){

                                      echo "<h1>" . "Belum ada yang terjual" . "</h1>";

                                    }else{

                                      echo "<h1>". $jmlPenjualanRasaAyam ."<sub> Pcs </sub>" ."</h1>";
                                    }

                                   ?>
                                </div>
                          </div>
                      </div>
                      <div class="col-lg-3">
                          <div class="card bg-warning shadow-lg">
                              <div class="card-header">Rasa Beef</div>
                              <div class="card-body">

                                <?php
                                    if($jmlPenjualanRasaBeef == 0){

                                      echo "<h1>" . "Belum ada yang terjual" . "</h1>";

                                    }else{

                                      echo "<h1>". $jmlPenjualanRasaBeef ."<sub> Pcs </sub>"."</h1>";
                                    }

                                   ?>

                              </div>
                          </div>
                      </div>
                      <div class="col-lg-3">
                          <div class="card bg-danger shadow-lg">
                              <div class="card-header">Rasa Cumi</div>
                              <div class="card-body">
                                <?php
                                    if($jmlPenjualanRasaCumi == 0){

                                      echo "<h5>" . "Belum ada yang terjual" . "</h5>";

                                    }else{

                                      echo "<h1>". $jmlPenjualanRasaCumi ."<sub> Pcs </sub>"."</h1>";
                                    }

                                   ?>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-3">
                          <div class="card bg-info shadow-lg">
                              <div class="card-header">Rasa Udang</div>
                              <div class="card-body">
                                <?php
                                    if($jmlPenjualanRasaUdang == 0){

                                      echo "<h5>" . "Belum ada yang terjual" . "</h5>";

                                    }else{

                                      echo "<h1>". $jmlPenjualanRasaUdang ."<sub> Pcs </sub>"."</h1>";
                                    }

                                   ?>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <!-- Tabel Penjualan -->
                      <div class="col-lg-8">
                        <h5>Tabel Penjualan</h5>
                        <table class="table table-striped">
                            <thead class="thead-dark bg-primary">
                                <tr>
                                    <th scope="col" class="text-light">NO</th>
                                    <th scope="col" class="text-light">MAKANAN</th>
                                    <th scope="col" class="text-light">VARIAN RASA</th>
                                    <th scope="col" class="text-light">HRG JUAL</th>
                                    <th scope="col" class="text-light">JML</th>
                                    <th scope="col" class="text-light">TGL</th>
                                    <th scope="col" class="text-light">ADMIN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    foreach($array as $data) :
                                ?>
                                <tr>
                                    <th scope="row"><?=$no; ?></th>
                                    <td><?=$data['makanan']; ?></td>
                                    <td><?=$data['varian_rasa']; ?></td>
                                    <td><?=$data['hrg_jual']; ?></td>
                                    <td><?=$data['jumlah']; ?></td>
                                    <td><?=$data['tgl']; ?></td>
                                    <td><?=$data['administrator']; ?></td>
                                </tr>
                                <?php
                                    $no++;
                                    endforeach
                                ?>
                            </tbody>
                        </table>
                      </div>
                      <!-- Grafik Penjualan -->
                      <div class="col-lg-4">
                          <h5>Grafik Penjualan</h5>
                      </div>
                  </div>
              </div>
          </div>
        </section>
        <!-- Menu Modal -->
          <div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Menu Baru</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <!-- form input -->
                    <form action="../../functions/menu_insert.php" method="post">
                          <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Perhatian!</strong> Fitur ini hanya bisa diakses oleh superadmin.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <input type="text" name="id" class="form-control mb-3" value="<?=$idMenu; ?>" readonly>
                        <input type="text" name="makanan" placeholder="Makanan" class="form-control mb-3" required autocomplete="off">
                        <input type="text" name="varian_rasa" placeholder="Varian Rasa" class="form-control mb-3" required autocomplete="off">
                        <input type="number" name="harga" placeholder="Harga Jual (Rp)" class="form-control mb-5" min="3500" max="999999" required autocomplete="off">
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                          <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
      </div>
     <?php include "../master/footer.php" ?>
</body>
</html>
