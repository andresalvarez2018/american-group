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
    $status_central=$_POST['status_central'];

    // Perform query
    if (!$mysqli -> query("UPDATE `central_risk` SET `status_id` = '$status_central',`observation` = '$observation_supervisor', `response_supervisory` = 1,`response_user_id` = $id_usuario WHERE `central_risk`.`id` = $base_id")) {
        echo("Error description: " . $mysqli -> error);
    }

    if ($central_risk = $mysqli -> query("SELECT * FROM `central_risk` WHERE `id` = $base_id")) {
        while ($central_risk_result = $central_risk->fetch_array()) {
            $action=$central_risk_result['action'];
        }
    }
    
    switch ($action) {
        case 'Prestamo':

            if ($status_central == "17") {
                // Perform query
                if (!$mysqli -> query("UPDATE `central_risk` SET `viability` = '1' WHERE `central_risk`.`id` = $base_id")) {
                    echo("Error description: " . $mysqli -> error);
                }
                // Perform query
                if (!$mysqli -> query("INSERT INTO `viability` (`id`, `created_at`, `central_id`, `status_id`, `user_id`, `currrent`) VALUES (NULL, current_timestamp(), '$base_id', '30', '$id_usuario', '1')")) {
                    echo("Error description: " . $mysqli -> error);
                }
            }
            
        break;
        
    }
    
    $mysqli -> close();
    
    header('Location: ../supervisor/central.php?s=1');
    exit;
?>
