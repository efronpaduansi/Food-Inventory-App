<?php

        include "../conn/koneksi.php";

        $kode = $_GET['kode'];

        $query = $conn->query("DELETE FROM tb_makanan WHERE kode = '$kode'");

        if($query){
                header("location:../view/superadmin/menu.php?hapus=sukses");
        }else{
                header("location:../view/superadmin/menu.php?hapus=gagal");
        }


?>