<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }
    $user_id=$_SESSION["id"];
    $mysqli = new mysqli("localhost","root","","db");

    $id_user=$_GET['id'];


     // Perform query
     if (!$mysqli -> query("UPDATE `user` SET `is_active` = '0' WHERE `user`.`id` = '$id_user'")) {
        echo("Error description: " . $mysqli -> error);
    }

     

    if ($result_cant_reg_proc = $mysqli -> query("SELECT * FROM `user` as u inner join campana as c on u.campana_id=c.id WHERE `u`.`id` = '$id_user'")) {
        while ($reg_cant_reg_proc = $result_cant_reg_proc->fetch_array()) {
           $prefijo=$reg_cant_reg_proc['prefijo'];
        }
    }

    if (!$mysqli -> query("UPDATE `base_$prefijo` SET `assigned` = '0' WHERE `assigned` = 1 AND `processed` = 0 AND `user_assigned` =  $id_user;")) {
        echo("Error description: " . $mysqli -> error);
    }

    $mysqli -> close();
    header('Location: ../admin/usuarios.php?sa=1');
    exit;

?>   