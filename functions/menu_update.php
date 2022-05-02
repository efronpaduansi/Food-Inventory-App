<?php
    include "../conn/koneksi.php";

    $kode = $_POST['kode'];
    $nama_makanan = $_POST['nama_makanan'];
    $varian_rasa = $_POST['varian_rasa'];

    $query = $conn->query("UPDATE tb_makanan SET
                nama_makanan = '$nama_makanan',
                varian_rasa  = '$varian_rasa'
                WHERE kode = '$kode'");
    if($query){
        header("location:../view/superadmin/menu.php?update=sukses");
    }else{
        header("location:../view/superadmin/menu.php?update=gagal");
    }

?>