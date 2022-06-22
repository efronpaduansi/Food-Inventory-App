<?php

    include "../conn/koneksi.php";

    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $fname  = $_POST['fname'];
    $password = $_POST['password'];
    $level   =$_POST['level'];
  

    //enkripsi password

    $query = $conn->query("UPDATE user SET 
            username    = '$username',
            fname       = '$fname',
            password    = '$password',
            level       = '$level'
            WHERE id_user = '$id_user'");
    if($query){
        header("location:../view/superadmin/users.php?edit=sukses");
    }else{
        header("location:../view/superadmin/users.php?edit=gagal");
    }

?>