<?php

    include "../conn/koneksi.php";
//     //Menghitung pendapatan
//   //Mengambil hrg_beli pada table orders
//   $getDataHrgBeli = $conn->query("SELECT hrg_beli AS hrgBeli FROM orders");
//   $fetchDataHrgBeli = $getDataHrgBeli->fetch_array();
//   $hrgBeli = $fetchDataHrgBeli['hrgBeli'];

//   //Mengambil hrg jual pada table menu
//   $getDataHrgJual = $conn->query("SELECT harga AS hrgJual FROM menu");
//   $fetchDataHrgJual = $getDataHrgJual->fetch_array();
//   $hrgJual = $fetchDataHrgJual['hrgJual'];

//   //Mengambil jumlah makanan terjual dari tabel penjualan
//   $getJmlTerjual = $conn->query("SELECT SUM(jumlah) AS jmlTerjual FROM penjualan");
//   $fetchJmlTerjual = $getJmlTerjual->fetch_array();
//   $jmlTerjual = $fetchJmlTerjual['jmlTerjual'];

//     //Menghitung pendapatan (harga jual - harga beli * jumlah makanan terjual)
//     $pendapatan = ($hrgJual - $hrgBeli) * $jmlTerjual;

    //Menghitung pendapatan per varian_rasa
    //===PROFIT RASA AYAM===
    $tampilHrgJualRasaAyam = $conn->query("SELECT harga AS hrgJualRasaAyam FROM menu WHERE varian_rasa = 'Ayam'");
    $hasilHrgJualRasaAyam = $tampilHrgJualRasaAyam->fetch_array();
    $hargaJualRasaAyam = $hasilHrgJualRasaAyam['hrgJualRasaAyam'];

    $tampilHrgBeliRasaAyam = $conn->query("SELECT hrg_beli AS hrgBeliRasaAyam FROM orders WHERE id_menu = 'DPK001'");
    $hasilHrgBeliRasaAyam = $tampilHrgBeliRasaAyam->fetch_array();
    $hargaBeliRasaAyam = $hasilHrgBeliRasaAyam['hrgBeliRasaAyam'];

    $getTerjualRasaAyam = $conn->query("SELECT SUM(jumlah) AS jmlTerjualRasaAyam FROM penjualan WHERE id_menu = 'DPK001'");
    $resultRasaAyam = $getTerjualRasaAyam->fetch_array();
    $terjual1 = $resultRasaAyam['jmlTerjualRasaAyam'];

    //Hitung profit rasa ayam
    $profitRasaAyam = ($hargaJualRasaAyam - $hargaBeliRasaAyam) * $terjual1;

    //===PROFIT RASA BEEF===
    $tampilHrgJualRasaBeef = $conn->query("SELECT harga AS hrgJualRasaBeef FROM menu WHERE varian_rasa = 'Beef'");
    $hasilHrgJualRasaBeef = $tampilHrgJualRasaBeef->fetch_array();
    $hargaJualRasaBeef = $hasilHrgJualRasaBeef['hrgJualRasaBeef'];

    $tampilHrgBeliRasaBeef = $conn->query("SELECT hrg_beli AS hrgBeliRasaBeef FROM orders WHERE id_menu = 'DPK002'");
    $hasilHrgBeliRasaBeef = $tampilHrgBeliRasaBeef->fetch_array();
    $hargaBeliRasaBeef = $hasilHrgBeliRasaBeef['hrgBeliRasaBeef'];

    $getTerjualRasaBeef = $conn->query("SELECT SUM(jumlah) AS jmlTerjualRasaBeef FROM penjualan WHERE id_menu = 'DPK002'");
    $resultRasaBeef = $getTerjualRasaBeef->fetch_array();
    $terjual2 = $resultRasaBeef['jmlTerjualRasaBeef'];

    //Hitung profit rasa Beef
    $profitRasaBeef = ($hargaJualRasaBeef - $hargaBeliRasaBeef) * $terjual2;

    //===PROFIT RASA CUMI===
    $tampilHrgJualRasaCumi = $conn->query("SELECT harga AS hrgJualRasaCumi FROM menu WHERE varian_rasa = 'Cumi'");
    $hasilHrgJualRasaCumi = $tampilHrgJualRasaCumi->fetch_array();
    $hargaJualRasaCumi = $hasilHrgJualRasaCumi['hrgJualRasaCumi'];

    $tampilHrgBeliRasaCumi = $conn->query("SELECT hrg_beli AS hrgBeliRasaCumi FROM orders WHERE id_menu = 'DPK003'");
    $hasilHrgBeliRasaCumi = $tampilHrgBeliRasaCumi->fetch_array();
    $hargaBeliRasaCumi = $hasilHrgBeliRasaCumi['hrgBeliRasaCumi'];

    $getTerjualRasaCumi = $conn->query("SELECT SUM(jumlah) AS jmlTerjualRasaCumi FROM penjualan WHERE id_menu = 'DPK003'");
    $resultRasaCumi = $getTerjualRasaCumi->fetch_array();
    $terjual3 = $resultRasaCumi['jmlTerjualRasaCumi'];

     //Hitung profit rasa Cumi
     $profitRasaCumi = ($hargaJualRasaCumi - $hargaBeliRasaCumi) * $terjual3;

     //===PRFIT RASA UDANG===
     $tampilHrgJualRasaUdang = $conn->query("SELECT harga AS hrgJualRasaUdang FROM menu WHERE varian_rasa = 'Udang'");
    $hasilHrgJualRasaUdang = $tampilHrgJualRasaUdang->fetch_array();
    $hargaJualRasaUdang = $hasilHrgJualRasaUdang['hrgJualRasaUdang'];

    $tampilHrgBeliRasaUdang = $conn->query("SELECT hrg_beli AS hrgBeliRasaUdang FROM orders WHERE id_menu = 'DPK004'");
    $hasilHrgBeliRasaUdang = $tampilHrgBeliRasaUdang->fetch_array();
    $hargaBeliRasaUdang = $hasilHrgBeliRasaUdang['hrgBeliRasaUdang'];

    $getTerjualRasaUdang = $conn->query("SELECT SUM(jumlah) AS jmlTerjualRasaUdang FROM penjualan WHERE id_menu = 'DPK004'");
    $resultRasaUdang = $getTerjualRasaUdang->fetch_array();
    $terjual4 = $resultRasaUdang['jmlTerjualRasaUdang'];

     //Hitung profit rasa Udang
     $profitRasaUdang = ($hargaJualRasaUdang - $hargaBeliRasaUdang) * $terjual4;

     //===MENGHITUNG TOTAL PENDAPATAN===
     $totalPendapatan = ($profitRasaAyam + $profitRasaBeef + $profitRasaCumi + $profitRasaUdang);

?>