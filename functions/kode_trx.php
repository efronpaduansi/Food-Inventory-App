<?php

    // Membuat kode transaksi otomatis
    include "../conn/koneksi.php";

    $query = "SELECT max(kode_trx) as kode FROM penjualan";
    $hasil = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($hasil);
  
    $maxkode = $data['kode'];
  
    $noUrut = (int) substr($maxkode, 9, 3);
  
    $noUrut++;
    $char = 'trx' . date('dmy');
    $kodeTrx = $char . sprintf("%03s", $noUrut);
  
?>