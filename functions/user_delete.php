<?php

    include "../conn/koneksi.php";

    $id_user    = $_GET['id_user'];

    $query = $conn->query("DELETE FROM user WHERE id_user = '$id_user'");

    if($query){
        header("location:../view/superadmin/users.php?hapus=sukses");
    }else{
        header("location:../view/superadmin/users.php?hapus=gagal");
        
    }




?>