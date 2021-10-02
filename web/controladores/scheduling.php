<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }
    $hoy = date("Y-m-d H:i:s");

   $mysqli = new mysqli("db","db_american_group","4m3r1c4n2021","db");

    $user_id=$_SESSION["id"];

    $date=$_POST['date'];
    $process=$_POST['process'];
    $method=$_POST['method'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $place_visit=$_POST['place_visit'];
    $trip=$_POST['trip'];
    $products=$_POST['products'];
    $purchase_portfolio=$_POST['purchase_portfolio'];
    $observation=$_POST['observation'];
    $base_id=$_POST['base_id'];
    $banco=$_POST['banco'];
    $score=$_POST['score'];
    $purchase_value=$_POST['purchase_value'];

    // Perform query
    if (!$mysqli -> query("INSERT INTO `scheduling_occidente`(`date`, `process`, `method`, `address`, `city`, `place_visit`, `trip`, `products`, `purchase_portfolio`, `observation`, `central_risk_id`) VALUES ('$date','$process','$method','$address','$city','$place_visit','$trip','$products','$purchase_portfolio','$observation','$base_id')")) {
        echo("Error description: " . $mysqli -> error);
    }
    $id_create=$mysqli->insert_id;

    // Perform query
    if (!$mysqli -> query("INSERT INTO `scheduling_status_occidente`(`scheduling_id`, `status_id`, `current`, `user_id`, `notes`) VALUES ($id_create',12,1,'$user_id','agendado')")) {
        echo("Error description: " . $mysqli -> error);
    }

    if($purchase_portfolio == "Si"){
        if (!$mysqli -> query("UPDATE `scheduling_occidente` SET `banco` = '$banco', `score` = '$score', `purchase_value` = '$purchase_value' WHERE `scheduling_occidente`.`id` = $id_create;")) {
            echo("Error description: " . $mysqli -> error);
        }
    }

   
    $mysqli -> close();
    header('Location: ../asesor/gestionar.php?f=1');
    exit;

?>
