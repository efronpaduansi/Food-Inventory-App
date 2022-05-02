<?php
  //Membuat id transaksi barang masuk otomatis
  include 'koneksi.php';

  $query = "SELECT max(kode_transaksi) as kodeTransaksi FROM brg_masuk";
  $hasil = mysqli_query($conn, $query);
  $data = mysqli_fetch_array($hasil);

  $maxkode = $data['kodeTransaksi'];

  $noUrut = (int) substr($maxkode, 2, 3);

  $noUrut++;
  $char = 'ID';
  $kodeTransaksi = $char . sprintf("%03s", $noUrut);




?>
