<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }
    $user_id=$_SESSION["id"];
      $mysqli = new mysqli("db","db_american_group","4m3r1c4n2021","db");


    $id_user=$_GET['id'];


     // Perform query
     if (!$mysqli -> query("UPDATE `user` SET `is_active` = '1' WHERE `user`.`id` = '$id_user'")) {
        echo("Error description: " . $mysqli -> error);
    }

 

    $mysqli -> close();
    header('Location: ../admin/usuarios.php?sa=1');
    exit;

?>   