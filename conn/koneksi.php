<?php

//DATABASE CONNECTION
//if you use windows
// $conn = mysqli_connect("localhost", "root", "", "dimsum_pawonkulo");

//if you use linux, you must to active syntax below
$conn = mysqli_connect("localhost", "admin", "12345", "dimsum_pawonkulo");

if(mysqli_connect_errno()){
    echo "Gagal terhubung ke database" .die();
}


?>