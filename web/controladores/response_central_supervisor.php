<?php
    session_start();

    $nombre_usuario=$_SESSION['user'];
    $id_usuario=$_SESSION['id'];
    $campana_id=$_SESSION['campana_id'];

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }
    
    $hoy = date("Y-m-d H:i:s");

    $mysqli = new mysqli("localhost","root","","db");

    $base_id=$_POST['base_id'];
    $observation_supervisor=$_POST['observation_supervisor'];

    // Perform query
    if (!$mysqli -> query("UPDATE `central_risk` SET `observation` = '$observation_supervisor', `response_supervisory` = 1,`response_user_id` = $id_usuario WHERE `central_risk`.`id` = $base_id")) {
        echo("Error description: " . $mysqli -> error);
    }
    $mysqli -> close();

    header('Location: ../supervisor/central.php?s=1');
    exit;
?>
