<?php
session_start();

$user=$_POST['user'];
$pass=$_POST['password'];
$pass = md5($pass);

$mysqli = new mysqli("db","db_american_group","4m3r1c4n2021","db");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
// Perform query
if ($result = $mysqli -> query("SELECT * FROM `user` WHERE `username` LIKE '$user' AND `pasword` LIKE '$pass' AND `is_active` = 1 ")) {
    if ($reg = $result->fetch_array()) {
        $_SESSION["id"]=$reg['id'];
        $_SESSION["user"]=$reg['complete_name'];
        $_SESSION["role_id"]=$reg['role_id'];
        $_SESSION["campana_id"]=$reg['campana_id'];
        $_SESSION["url_image"]=$reg['url_image'];
        $_SESSION["update_password"]=$reg['update_password'];
        header('Location: ./router.php');
        exit;
    }else {
      header('Location: ../login/index.php?e=1');
      exit;
    }
   
    // Free result set
    $result -> free_result();
}

$mysqli -> close();
?>