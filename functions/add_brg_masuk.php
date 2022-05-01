<?php

    include "koneksi.php";

        $kode_transaksi  = $_POST['kode_transaksi'];
        $nama_makanan   = $_POST['nama_makanan'];
        $varian_rasa    = $_POST['varian_rasa'];
        $harga_satuan   = $_POST['harga_satuan'];
        $jumlah         = $_POST['jumlah'];
        $tgl_masuk      = $_POST['tgl_masuk'];
        $penerima       = $_POST['penerima'];

        $sql = "INSERT INTO brg_masuk(kode_transaksi, nama_makanan, varian_rasa, harga_satuan, jumlah, tgl_masuk, penerima) VALUES ('$kode_transaksi', '$nama_makanan', '$varian_rasa', '$harga_satuan', '$jumlah', '$tgl_masuk', '$penerima')";

        $simpan = mysqli_query($conn, $sql);

        if($simpan){
            header("location:../view/admin/brg_masuk.php?simpan=sukses");
        }else{
            
            header("location:../view/admin/brg_masuk.php?simpan=gagal");
        }



?>