<?php

    // Membuat kode transaksi otomatis
    include "../conn/koneksi.php";

    $query = "SELECT max(id) as kodeTrx FROM penjualan";
    $hasil = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($hasil);
  
    $maxkode = $data['kodeTrx'];
  
    $noUrut = (int) substr($maxkode, 7, 3);
  
    $noUrut++;
    $char = date('dmy');
    $kodeTrx = $char . sprintf("%03s", $noUrut);
  
?>