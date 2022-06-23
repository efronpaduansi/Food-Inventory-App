<?php
  //Membuat id user otomatis
  include "../conn/koneksi.php";

  $query = "SELECT max(id) as idUser FROM user";
  $hasil = mysqli_query($conn, $query);
  $data = mysqli_fetch_array($hasil);

  $maxkode = $data['idUser'];

  $noUrut = (int) substr($maxkode, 9, 3);

  $noUrut++;
  $char = 'USR' . date('dmy');
  $idNewUser = $char . sprintf("%03s", $noUrut);

?>
