<?php

      include "../conn/koneksi.php";

      $kode             = $_POST['kode'];
      $nama_makanan     = $_POST['nama_makanan'];
      $varian_rasa      = $_POST['varian_rasa'];

        $sql = "INSERT INTO tb_makanan(kode, nama_makanan, varian_rasa) VALUES
              ('$kode', '$nama_makanan', '$varian_rasa')";
        $query = mysqli_query($conn, $sql);
        if($query){
                header("location:../view/superadmin/menu.php?pesan=sukses");
        }else{
                header("location:../view/superadmin/menu.php?pesan=gagal");
        }


?>