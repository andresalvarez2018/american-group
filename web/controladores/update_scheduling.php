<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }
    $hoy = date("Y-m-d H:i:s");

      $mysqli = new mysqli("db","db_american_group","4m3r1c4n2021","db");


    $user_id=$_SESSION["id"];

    
    $status=$_POST['status'];
    $observation=$_POST['observation'];
    $base_id=$_POST['base_id'];

    if (!$mysqli -> query("UPDATE scheduling_status_occidente SET current='0' WHERE scheduling_id=$base_id")){
        echo("Error description: " . $mysqli -> error);
    };

    sleep(2);
      // Perform query
    if (!$mysqli -> query("INSERT INTO `scheduling_status_occidente`(`scheduling_id`, `status_id`, `current`, `user_id`, `notes`) VALUES ($base_id,$status,1,'$user_id','$observation')")) {
        echo("Error description: " . $mysqli -> error);
    }

    $mysqli -> close();
    header('Location: ../backoffice/consulta.php?f=1');
    exit;

?>
