<?php
    session_start();
    include "../conn/koneksi.php";

    $id     = $_POST['id'];
    $nama_makanan = $_POST['nama_makanan'];
    $varian_rasa = $_POST['varian_rasa'];
    $kode_makanan = $_POST['kode_makanan'];
    $hrg_beli  = $_POST['hrg_beli'];
    $jumlah     = $_POST['jumlah'];
    $tgl_order  = $_POST['tgl_order'];
    $administrator = $_POST['administrator'];

    //select kode from tb_makanan where $varian_rasa
       $getKode = $conn->query("SELECT kode AS kode_makanan FROM tb_makanan WHERE varian_rasa = '$varian_rasa'");
       $fetch_kode = mysqli_fetch_array($getKode);
       $kode_makanan2 = $fetch_kode['kode_makanan'];
       echo $kode_makanan2;

    $query = $conn->query("UPDATE stock SET 
            nama_makanan = '$nama_makanan',
            varian_rasa  = '$varian_rasa',
            kode_makanan = '$kode_makanan2',
            hrg_beli = '$hrg_beli',
            jumlah     = '$jumlah',
            tgl_order  = '$tgl_order',
            administrator = '$administrator' 
            WHERE id = '$id'");
    if($query){
        header("location:../view/superadmin/stock.php?update=sukses");
    }else{
        header("location:../view/superadmin/stock.php?update=gagal");
    }


?>