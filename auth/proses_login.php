<?php

    session_start();
    if(isset($_POST['login'])){
        include "../conn/koneksi.php";
    
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $login = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
    
        $cek = mysqli_num_rows($login);
    
        if($cek > 0){
          $data = mysqli_fetch_assoc($login);
    
          if($data['level'] == "Admin"){
              $_SESSION['id_user'] = $data['id_user'];
              $_SESSION['username'] = $username;
              $_SESSION['fname'] = $data['fname'];
              $_SESSION['level'] = "Admin";
              header("location:../view/admin/dashboard.php?login=success");
    
          }else if($data['level']== "Superadmin"){
            
              $_SESSION['id_user'] = $data['id_user'];
              $_SESSION['username'] = $username;
              $_SESSION['fname'] = $data['fname'];
              $_SESSION['level'] = "Superadmin";
              header("location:../view/superadmin/dashboard.php?login=success");
    
          }else{
            header("location:../index.php?pesan=gagallogin");
          }
        }else{
            header("location:../index.php?pesan=gagallogin");
             
        }
      }
      



?>