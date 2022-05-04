<?php

    include "../conn/koneksi.php";

    $id         = $_POST['id'];
    $nama_makanan = $_POST['nama_makanan'];
    $varian_rasa  = $_POST['varian_rasa'];
    $jumlah        = $_POST['jumlah'];
    $tgl            = date('Ymd');
    $administrator  = $_POST['administrator'];


    //Select kode_menu dari tabel stock berdasarkan varian_rasa
    $getKode = $conn->query("SELECT kode AS kodeMenu FROM menu WHERE varian_rasa = '$varian_rasa'");
    $resultKode = $getKode->fetch_array();
    $kode_menu = $resultKode['kodeMenu'];

    //ambil harga jual dari tabel menu
    $getHarga = $conn->query("SELECT harga AS hrg FROM menu WHERE varian_rasa = '$varian_rasa'");
    $resultHarga = $getHarga->fetch_array();
    $hrgJual = $resultHarga['hrg'];

     //mengambil jumlah stock makanan pada tabel stock
     $getStock = $conn->query("SELECT SUM(jumlah) AS jmlStock FROM stock WHERE kode_menu = '$kode_menu'");
     $resultStock = $getStock->fetch_array();
     $jumlahStock = $resultStock['jmlStock'];
     //hitung sisa stock makanan pada tabel stock
      $sisa = $jumlahStock - $jumlah;
      

    //cek apakah jumlah input lebih dari jumlah stock
   if( $kode_menu == "DPK001"){
       $getJmlAyam = $conn->query("SELECT SUM(jumlah) AS rasaAyam FROM stock WHERE kode_menu = 'DPK001'");
       $fetchAyam = $getJmlAyam->fetch_array();
       $stockAyam = $fetchAyam['rasaAyam'];
       if($jumlah > $stockAyam){
            header("location:../view/admin/penjualan.php?stock=kurang");
       }else{
           //masukan data ke tabel penjualan
           $insertData = $conn->query("INSERT INTO penjualan(id, kode_menu, hrg_jual, jumlah, tgl, administrator) VALUES
            ('$id', '$kode_menu', '$hrgJual', '$jumlah', '$tgl', '$administrator')");
            if($insertData){
                // update tabel stock
                $update = $conn->query("UPDATE stock SET jumlah = '$sisa' WHERE kode_menu = '$kode_menu'");
               header("location:../view/admin/penjualan.php?transaksi=sukses");
            }else{
                header("location:../view/admin/penjualan.php?transaksi=gagal");
            }
       }
   }else if($kode_menu == 'DPK002'){
       $getJmlBeef = $conn->query("SELECT SUM(jumlah) AS rasaBeef FROM stock WHERE kode_menu = 'DPK002'");
       $fetchBeef = $getJmlBeef->fetch_array();
       $stockBeef = $fetchBeef['rasaBeef'];
       if( $jumlah > $stockBeef){
        header("location:../view/admin/penjualan.php?stock=kurang");
       }else{
            //masukan data ke tabel penjualan
            $insertData = $conn->query("INSERT INTO penjualan(id, kode_menu, hrg_jual, jumlah, tgl, administrator) VALUES
            ('$id', '$kode_menu', '$hrgJual', '$jumlah', '$tgl', '$administrator')");
            if($insertData){
                // update tabel stock
                $update = $conn->query("UPDATE stock SET jumlah = '$sisa' WHERE kode_menu = '$kode_menu'");
                header("location:../view/admin/penjualan.php?transaksi=sukses");
            }else{
                header("location:../view/admin/penjualan.php?transaksi=gagal");
            }
       }
   }else if($kode_menu == 'DPK003'){
    $getJmlCumi = $conn->query("SELECT SUM(jumlah) AS rasaCumi FROM stock WHERE kode_menu = 'DPK003'");
    $fetchCumi = $getJmlCumi->fetch_array();
    $stockCumi= $fetchCumi['rasaCumi'];
        if( $jumlah > $stockCumi){
            header("location:../view/admin/penjualan.php?stock=kurang");
        }else{
            //masukan data ke tabel penjualan
            $insertData = $conn->query("INSERT INTO penjualan(id, kode_menu, hrg_jual, jumlah, tgl, administrator) VALUES
            ('$id', '$kode_menu', '$hrgJual', '$jumlah', '$tgl', '$administrator')");
            if($insertData){
                // update tabel stock
                $update = $conn->query("UPDATE stock SET jumlah = '$sisa' WHERE kode_menu = '$kode_menu'");
                header("location:../view/admin/penjualan.php?transaksi=sukses");
            }else{
                header("location:../view/admin/penjualan.php?transaksi=gagal");
            }
        }
   }else if( $kode_menu == 'DPK004'){
        $getJmlUdang = $conn->query("SELECT SUM(jumlah) AS rasaUdang FROM stock WHERE kode_menu = 'DPK004'");
        $fetchUdang = $getJmlUdang->fetch_array();
        $stockUdang = $fetchUdang['rasaUdang'];
        if( $jumlah > $stockUdang){
            header("location:../view/admin/penjualan.php?stock=kurang");
        }else{
             //masukan data ke tabel penjualan
           $insertData = $conn->query("INSERT INTO penjualan(id, kode_menu, hrg_jual, jumlah, tgl, administrator) VALUES
           ('$id', '$kode_menu', '$hrgJual', '$jumlah', '$tgl', '$administrator')");
           if($insertData){
               // update tabel stock
               $update = $conn->query("UPDATE stock SET jumlah = '$sisa' WHERE kode_menu = '$kode_menu'");
                header("location:../view/admin/penjualan.php?transaksi=sukses");
           }else{
            header("location:../view/admin/penjualan.php?transaksi=gagal");
           }
        }
   }else{
       die();
   }
    
    // //ambil jumlah stock rasa ayam
    // $getDataAyam = $conn->query("SELECT SUM(jumlah) AS jmlRasaAyam FROM stock WHERE kode_menu = 'DPK001'");
    // $resultDataAyam = $getDataAyam->fetch_array();
    // $jmlData = $resultDataAyam['jmlRasaAyam'];
    // echo $jmlData;

    // //ambil jumlah stock rasa beef
    // $getDataBeef = $conn->query("SELECT SUM(jumlah) AS jmlRasaBeef FROM stock WHERE kode_menu = 'DPK002'");
    // $resultDataBeef = $getDataBeef->fetch_array();
    // $jmlData = $resultDataBeef['jmlRasaBeef'];
    // echo $jmlData;

    // //ambil jumlah stock rasa cumi
    // $getDataCumi = $conn->query("SELECT SUM(jumlah) AS jmlRasaCumi FROM stock WHERE kode_menu = 'DPK003'");
    // $resultDataCumi = $getDataCumi->fetch_array();
    // $jmlData = $resultDataCumi['jmlRasaCumi'];
    // echo $jmlData;

    // //ambil jumlah stock rasa udang
    // $getDataUdang = $conn->query("SELECT SUM(jumlah) AS jmlRasaUdang FROM stock WHERE kode_menu = 'DPK004'");
    // $resultDataUdang = $getDataUdang->fetch_array();
    // $jmlData = $resultDataUdang['jmlRasaUdang'];
    // echo $jmlData;


?>