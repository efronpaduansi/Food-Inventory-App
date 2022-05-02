<?php

    include "../conn/koneksi.php";

        $id = $_POST['id'];
       $nama_makanan = $_POST['nama_makanan'];
       $varian_rasa = $_POST['varian_rasa'];
       $hrg_satuan = $_POST['hrg_satuan'];
       $jumlah  = $_POST['jumlah'];
       $tgl_order = $_POST['tgl_order'];
       $admin = $_POST['admin'];

       //ambil kode makanan pada tb_makanan sesuai dengan varian rasa yg dipilih
       $getKode = $conn->query("SELECT kode AS kode_makanan FROM tb_makanan WHERE varian_rasa = '$varian_rasa'");
       $fetch_kode = mysqli_fetch_array($getKode);
       $kode_makanan = $fetch_kode['kode_makanan'];
       echo $kode_makanan;

       $query = $conn->query("INSERT INTO stock(nama_makanan, varian_rasa, kode_makanan, hrg_satuan, jumlah, tgl_order, admin) VALUES ('$nama_makanan', '$varian_rasa', '$kode_makanan', '$hrg_satuan', '$jumlah', '$tgl_order', '$admin')");
       if($query){
           header("location:../view/superadmin/stock.php?pesan=sukses");
       }else{
        header("location:../view/superadmin/stock.php?pesan=gagal");
       }

    


?>