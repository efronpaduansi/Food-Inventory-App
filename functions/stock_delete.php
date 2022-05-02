<?php

    include "koneksi.php";

    $id_masuk = $_GET['id_masuk'];
    $sql = "DELETE FROM brg_masuk WHERE id_masuk = '$id_masuk' ";
    $hapus = mysqli_query($conn, $sql);
    if($hapus){
        header("location:../view/admin/brg_masuk.php?hapus=sukses");
    }else{
        header("location:../view/admin/brg_masuk.php?hapus=gagal");
    }

?>
