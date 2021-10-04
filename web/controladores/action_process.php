<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }
    $hoy = date("Y-m-d H:i:s");

      $mysqli = new mysqli("localhost","root","","db");

    //$mysqli = new mysqli("localhost","root","","db");


    // Check connection
    if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
    }

    $observation = $_POST['observation'];
    $status = $_POST['status'];
    if (isset($_POST['callback'])) {
        $callback = $_POST['callback'];
    }else {
        $callback = '0000-00-00 00:00:00';
    }
    $id_reg = $_POST['id_reg'];

    if (!$mysqli -> query("UPDATE `base_occidente` SET `processed` = '1',observation = '$observation',status_id = '$status',callback = '$callback',processed_at='$hoy ' WHERE `base_occidente`.`id` = $id_reg;")) {
        echo("Error description: " . $mysqli -> error);
    }
    
    $mysqli -> close();

    switch ($status) {
        case '4':
            header('Location: ../central_risk/index.php?id='.$id_reg);
            exit;
        break;
        
        default:
            header('Location: ../asesor/gestionar.php?s=1');
            exit;
        break;
    }

    

?>