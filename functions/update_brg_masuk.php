<?php
    session_start();
    include "koneksi.php";

    $id_masuk            = $_POST['id_masuk'];
    $nama_makanan   = $_POST['nama_makanan'];
    $varian_rasa    = $_POST['varian_rasa'];
    $harga_satuan   = $_POST['harga_satuan'];
    $jumlah         = $_POST['jumlah'];
    $tgl_masuk       = $_POST['tgl_masuk'];
    $penerima       = $_POST['penerima'];

    $sql = "UPDATE brg_masuk SET
        nama_makanan = '$nama_makanan',
        varian_rasa = '$varian_rasa',
        harga_satuan = '$harga_satuan',
        jumlah      = '$jumlah',
        tgl_masuk   = '$tgl_masuk',
        penerima    = '$penerima'
        WHERE id_masuk = '$id_masuk'
    ";
    $update = mysqli_query($conn, $sql);
    if($update){
        header("location:../view/admin/brg_masuk.php?update=sukses");
    }else{
        header("location:../view/admin/brg_masuk.php?update=gagal");
    }


?>