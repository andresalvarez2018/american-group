<?php
session_start();

$pass_1=$_POST['pass_1'];
$pass_2=$_POST['pass_2'];
$hoy = date("Y-m-d H:i:s");
$id=$_SESSION["id"];

if ($pass_1 !== $pass_2) {
    header('Location: ../login/update_password.php?e=1');
    exit;
}
$pass_1 = md5($pass_1); 
$mysqli = new mysqli("localhost","root","","db");


// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
if (!$mysqli -> query("UPDATE user SET pasword='$pass_1', update_at='$hoy', update_password='0' WHERE id=$id")){
    echo("Error description: " . $mysqli -> error);
};
header('Location: ./logout.php');
exit;   

$mysqli -> close();
?>