<?php

    include "../conn/koneksi.php";

    //cari data berdasarkan tanggal
    if(isset($_POST['cari']))
    {
        $keyword = $_POST['keyword'];
        $selectData = $_POST['select_data'];

       if($selectData == 'Orders'){
            $getDataOrders = $conn->query("SELECT SUM(jumlah) AS jmlOrders FROM orders WHERE tgl_order LIKE '%$keyword%'");
            $resultDataOrders = $getDataOrders->fetch_array();
            $jmlDataOrders = $resultDataOrders['jmlOrders'];
       }else if($selectData == 'Penjualan'){
            $getDataPenjualan = $conn->query("SELECT SUM(jumlah) AS jmlPenjualan FROM penjualan WHERE tgl LIKE '%$keyword%'");
            $resultDataPenjualan = $getDataPenjualan->fetch_array();
            $jmlDataPenjualan = $resultDataPenjualan['jmlPenjualan'];
       }
        
    }
?>