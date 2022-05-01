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
              <li class="menu-header">Dashboard</li>
              <li class="nav-item">
                <a href="admin_dashboard.php" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
              </li>
              <li class=""><a class="nav-link" href="brg_stok.php"><i class="fas fa-shopping-bag"></i><span>Stock Barang</span></a></li>
              <li class="active"><a class="nav-link" href="brg_masuk.php"><i class="fas fa-arrow-alt-circle-down"></i> <span>Barang Masuk</span></a></li>
              <li class=""><a class="nav-link" href="brg_keluar.php"> <i class="fas fa-upload"></i><span>Barang Keluar</span></a></li>
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
            <h1>Barang Masuk</h1>
          </div>
          <div class="section-body">
              <?=@$alert; ?>
                <div class="form-inline mb-4">
                    <!-- tombol tambah data baru -->
                    <button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#formBarangMasuk">
                    <i class="fas fa-cart-plus"></i> Tambah Data Baru
                    </button>
                    <a href="../../functions/laporan_brg_masuk.php" target="_blank" class="btn btn-info mr-3"><i class="fas fa-print"></i> Cetak Laporan</a>
                    <input class="form-control mr-3" value="<?="Total Makanan : " . " " . $totalBrg ." " . "Pcs"; ?>" type="text" readonly>
                    <input type="seach" placeholder="Cari..." class="form-control">
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
                    <th scope="col">ADMIN</th>
                    <th scope="col">AKSI</th>
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
                    <td>
                       <div class="form-inline row">
                            <a href="../../functions/edit_brg_masuk.php?id_masuk=<?=$data['id_masuk']; ?>" class="mr-2 text-info"><i class="fas fa-edit"></i></a> 
                            <a href="../../functions/delete_brg_masuk.php?id_masuk=<?=$data['id_masuk']; ?>" class="text-primary" onclick = "return confirm ('Apakah anda yakin untuk menghapus data ini ?');"><i class="fas fa-trash"></i>
                            </a>
                       </div>
                    </td>
                    </tr>
                    <?php $no++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
          </div>
        </section>
          <!-- Form Barang Masuk -->
          <div class="modal fade" id="formBarangMasuk" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Data Masuk</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="../../functions/add_brg_masuk.php" method="post">
                      <input type="text" name="kode_transaksi" class="form-control mb-3" type="text" readonly value="<?= $kodeTransaksi; ?>">
                      <input type="text" name="nama_makanan" placeholder="Nama Makanan" class="form-control mb-3" required>
                      <select name="varian_rasa" id="varian_rasa" class="form-control mb-3" required>
                          <option value="" disabled selected hidden>Pilih varian rasa</option>
                          <option value="Ayam">Ayam</option>
                          <option value="Beef">Beef</option>
                          <option value="Cumi">Cumi</option>
                          <option value="Udang">Udang</option>
                      </select>
                      <input type="number" name="harga_satuan" placeholder="Harga Satuan" class="form-control mb-3" min="1000" required>
                      <input type="number" name="jumlah" placeholder="Jumlah" class="form-control mb-3" min="1" required>
                      <input type="date" name="tgl_masuk" class="form-control mb-3" required>
                      <input type="text" name="penerima" value="<?=$_SESSION['fname']; ?>" class="form-control mb-3" required readonly>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
     <?php include "../master/footer.php"; ?>
</body>
</html>