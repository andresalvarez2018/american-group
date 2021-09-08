<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }
    
    $hoy = date("Y-m-d H:i:s");

    $mysqli = new mysqli("db","db_american_group","4m3r1c4n2021","db");

    $observation_supervisor=$_POST['observation_supervisor'];
    $status_id=$_POST['status_id'];
    $base_id=$_POST['base_id'];
    $id_supervisor=$_POST['id_supervisor'];

    // Perform query
    if (!$mysqli -> query("UPDATE `central_risk` SET `status_id` = '$status_id' WHERE `central_risk`.`id` = $base_id")) {
        echo("Error description: " . $mysqli -> error);
    }
    $mysqli -> close();

    header('Location: ../form/agenda.php?id='.$base_id);
    exit;
?>
