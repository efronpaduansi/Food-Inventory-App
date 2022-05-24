<?php
  session_start();
  include "../../conn/koneksi.php";
  include "../../functions/penjualan_kode.php";

  
  //cek proses transaksi
  if( isset( $_GET['transaksi'])){
    if( $_GET['transaksi'] == "sukses"){
      $alert = "
      <div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>Transaksi berhasil</strong>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
          </button>
      </div>
      ";
    }
  }

  if( isset( $_GET['stock'])){
    if($_GET['stock']== "kurang"){
      $alert = "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'>
          <strong>Transaksi gagal ! Stock tidak cukup.</strong>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
          </button>
      </div>
      ";
    }
  }
 
  //Menampilkan data kedalam tabel
  $getData = $conn->query("SELECT menu.makanan, menu.varian_rasa, menu.harga, penjualan.id, penjualan.tgl, penjualan.jumlah, penjualan.administrator FROM (menu INNER JOIN penjualan ON menu.id = penjualan.id_menu) ORDER BY penjualan.id DESC");
  $dtPenjualan = array();
  while($data = $getData->fetch_array()){
    $dtPenjualan[] = $data;
  }



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "../master/header.php"; ?>
  <title>Penjualan | Dimsum Pawonkulo</title>
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
              <li class="nav-item">
                <a href="dashboard.php" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
              </li>
              <li class=""><a class="nav-link" href="menu.php"><i class="fas fa-clipboard-list"></i><span>Menu</span></a></li>
              <li class=""><a class="nav-link" href="stock.php"><i class="fas fa-layer-group"></i><span>Stock</span></a></li>
              <li class="active"><a class="nav-link" href="penjualan.php"><i class="fas fa-shopping-bag"></i><span>Penjualan</span></a></li>
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
            <h1>Data Penjualan</h1>
          </div>

          <div class="section-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                          <?=@$alert; ?>
                            <!-- Tombol data penjualan -->
                            <div class="form-inline mb-5">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#penjualanModal">
                                    Tambah Data Penjualan
                                </button>
                            </div>
                            <!-- Tabel data penjualan -->
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">NO</th>
                                        <th scope="col">KODE TRX</th>
                                        <th scope="col">TGL TRX</th>
                                        <th scope="col">NAMA MAKANAN</th>
                                        <th scope="col">VARIAN RASA</th>
                                        <th scope="col">HRG JUAL / <sub>Pcs</sub></th>
                                        <th scope="col">JML (Pcs)</th>
                                        <th scope="col">ADMIN</th>
                                        <th scope="col">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                      $no = 1;
                                      foreach($dtPenjualan as $data) :
                                  ?>
                                    <tr>
                                    <th scope="row"><?=$no;  ?></th>
                                    <td><?=$data['id']; ?></td>
                                    <td><?=$data['tgl']; ?></td>
                                    <td><?=$data['nama_makanan']; ?></td>
                                    <td><?=$data['varian_rasa']; ?></td>
                                    <td><?=$data['harga']; ?></td>
                                    <td><?=$data['jumlah']; ?></td>
                                    <td><?=$data['administrator']; ?></td>
                                    <td>
                                        <div class="form-inline">
                                          <a href="" data-toggle="tooltip" data-placement="right" title="Lihat detail"><i class="fas fa-eye"></i></a>
                                          <a href="" data-toggle="tooltip" data-placement="right" title="Cetak struk"><i class="fas fa-print"></i></a>
                                        </div>
                                    </td>
                                    </tr>
                                    <?php
                                        $no++;
                                      endforeach
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
          </div>
        </section>
        <!-- Penjualan Modal -->
            <div class="modal fade" id="penjualanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penjualan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="../../functions/penjualan_proses.php" method="post">
                            <input type="text" name="id" value="<?=$kodeTrx; ?>" class="form-control mb-3" readonly>
                            <select name="nama_makanan" class="form-control mb-3" required>
                                <option value="" disabled selected hidden>--Select Makanan--</option>
                                <option value="Dimsum">Dimsum</option>
                            </select>
                                  <select name="varian_rasa" class="form-control mb-3" required>
                                      <option value="" disabled selected hidden>--Select Varian Rasa--</option>
                                          <?php
                                              $sql = $conn->query("SELECT varian_rasa FROM menu");
                                              while( $data_varian = $sql->fetch_array()) {
                                          ?>
                                      <option value="<?=$data_varian['varian_rasa']; ?>"><?=$data_varian['varian_rasa']; ?></option>
                                      <?php } ?>
                                  </select>
                            <div class="row mb-5">
                                <div class="col">
                                    <input type="number" name="jumlah" min="1" class="form-control" placeholder="Jumlah" required>
                                </div>
                                <div class="col">
                                    <input type="text" name="administrator" class="form-control" value="<?=$_SESSION['fname']; ?>" placeholder="<?=$_SESSION['fname']; ?>" readonly >
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
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
