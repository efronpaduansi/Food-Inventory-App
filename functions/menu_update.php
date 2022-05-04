<?php
    include "../conn/koneksi.php";

    $kode = $_POST['kode'];
    $nama_makanan = $_POST['nama_makanan'];
    $varian_rasa = $_POST['varian_rasa'];
    $harga = $_POST['harga'];

    $query = $conn->query("UPDATE menu SET
                nama_makanan = '$nama_makanan',
                varian_rasa  = '$varian_rasa',
                harga       = '$harga'
                WHERE kode = '$kode'");
    if($query){
        header("location:../view/superadmin/menu.php?update=sukses");
    }else{
        header("location:../view/superadmin/menu.php?update=gagal");
    }

?>