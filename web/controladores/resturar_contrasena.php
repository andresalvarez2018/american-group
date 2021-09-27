<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }
    
    $hoy = date("Y-m-d H:i:s");

    $mysqli = new mysqli("localhost","root","","db");

    $id=$_REQUEST['id'];

    $password = md5('123');

    // Perform query
    if (!$mysqli -> query("UPDATE `user` SET `update_password` = '1', pasword='$password' WHERE `user`.`id` =  $id;")) {
        echo("Error description: " . $mysqli -> error);
    }
    $mysqli -> close();

    header('Location: /admin/editar.php?id='.$id.'&s=1');
    exit;
?>
