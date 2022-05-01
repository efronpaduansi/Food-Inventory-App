<?php

//DATABASE CONNECTION
$conn = mysqli_connect("localhost", "admin", "12345", "dev_dimsum_pawonkulo");

if(mysqli_connect_errno()){
    echo "Database connection failed" .die();
}


?>