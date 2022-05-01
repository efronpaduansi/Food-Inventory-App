<?php
  session_start();
    //Include file koneksi
    include "../../functions/koneksi.php";
    include "../../functions/kode_transaksi_brg_masuk.php";

      //Menangkap $_GET simpan
      if(isset($_GET['simpan'])){
          if($_GET['simpan'] =="sukses"){
              $alert =  "
              <div class='alert alert-success alert-dismissible fade show' role='alert'>
              <strong>Data berhasil ditambahkan</strong>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
              ";
          }
      }

      //Menangkap $_GET update
      if(isset($_GET['update'])){
        if($_GET['update'] =="sukses"){
            $alert =  "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Data berhasil diubah</strong>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
            ";
        }
    }
    //Menangkap $_GET delete
    if(isset($_GET['hapus'])){
      if($_GET['hapus'] =="sukses"){
          $alert =  "
          <div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>Data berhasil dihapus</strong>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
          ";
      }
    }

    //Fungsi untuk menampilkan  data kedalam table
    $query = mysqli_query($conn, "SELECT * FROM brg_masuk");
    $result = array();
    while ($data = mysqli_fetch_array($query)) {
      $result[] = $data; //result dijadikan array
      
    }
    //Fungsi untuk menghitung total barang
    $getTotal = mysqli_query($conn, "SELECT SUM(jumlah) AS totalBrg FROM brg_masuk");
    $dataTotal = mysqli_fetch_array($getTotal);
    $totalBrg = $dataTotal['totalBrg'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "../master/header.php" ?>
  <title>Barang Masuk | Dimsum Pawonkulo</title>
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
            <div class="d-sm-none d-lg-inline-block">Hi,  <?=$_SESSION['fname']; ?></div></a>
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
              <li class="menu-header"><?=$_SESSION['level']; ?></li>
              <li class="nav-item">
                <a href="superadmin_dashboard.php" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
              </li>
              <li class=""><a class="nav-link" href="brg_stok.php"><i class="fas fa-shopping-bag"></i><span>Stock Barang</span></a></li>
              <li class="active"><a class="nav-link" href="brg_masuk.php"><i class="fas fa-arrow-alt-circle-down"></i> <span>Barang Masuk</span></a></li>
              <li class=""><a class="nav-link" href="brg_keluar.php"> <i class="fas fa-upload"></i><span>Barang Keluar</span></a></li>
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
            <h1>Barang Masuk</h1>
          </div>
          <div class="section-body">
              <?=@$alert; ?>
                <div class="form-inline mb-4">
                    <a href="../../functions/laporan_brg_masuk.php" target="_blank" class="btn btn-info mr-3"><i class="fas fa-print"></i> Cetak Laporan</a>
                    <input class="form-control mr-3" value="<?="Total Makanan : " . " " . $totalBrg ." " . "Pcs"; ?>" type="text" readonly>
                    <input type="seach" placeholder="Cari..." class="form-control">
                    <select name="varian_rasa" id="varian_rasa" class="form-control ml-3" required>
                          <option value="" disabled selected hidden>Urutkan berdasarkan</option>
                          <option value="Ayam">Varian Rasa (A-Z)</option>
                          <option value="Beef">Tgl Masuk</option>
                          <option value="Cumi">Penerima (A-Z)</option>
                      </select>
                </div>
            <!-- table tampil data -->
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">NO</th>
                    <th scope="col">KODE TRANSAKSI</th>
                    <th scope="col">NAMA MAKANAN</th>
                    <th scope="col">VARIAN RASA</th>
                    <th scope="col">HRG SATUAN (Rp)</th>
                    <th scope="col">JUMLAH (Pcs)</th>
                    <th scope="col">TGL MASUK</th>
                    <th scope="col">PENERIMA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no= 1; ?>
                    <?php foreach ($result as $data) : ?>
                    <tr>
                    <th scope="row"><?= $no;?></th>
                    <td><?=$data['kode_transaksi']; ?></td>
                    <td><?=$data['nama_makanan']; ?></td>
                    <td><?=$data['varian_rasa']; ?></td>
                    <td><?= "Rp."." ".$data['harga_satuan']; ?></td>
                    <td><?=$data['jumlah']; ?></td>
                    <td><?=$data['tgl_masuk']; ?></td>
                    <td><?=$data['penerima']; ?></td>
                    </tr>
                    <?php $no++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
          </div>
        </section>
          <!-- Form Barang Masuk -->
      </div>
     <?php include "../master/footer.php"; ?>
</body>
</html>