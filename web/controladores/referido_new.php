<?php

session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../login/index.php');
    exit;
}
$user_id=$_SESSION["id"];
$campana_id=$_SESSION["campana_id"];
  $mysqli = new mysqli("db","db_american_group","4m3r1c4n2021","db");



    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
        }
        $hoy = date("Y-m-d H:i:s");
    
        $complete_name=$_POST["complete_name"];
        $identification=$_POST["identification"];
        $phone_number=$_POST["phone_number"];

    if (!$mysqli -> query("INSERT INTO `base_occidente`( `created_at`, `complete_name`, `identification`, `phone_number`, `assigned`, `processed`, `processed_at`, `status_id`, `archivo_id`, `is_active`) VALUES ('$hoy','$complete_name','$identification','$phone_number','0','0',null,null,null,1)")) {
        echo("Error description: " . $mysqli -> error);
    }
    $id_create=$mysqli->insert_id;
    if (!$mysqli -> query("UPDATE `base_occidente` SET `processed` = '1',observation = 'Referido Creado',status_id = '4',callback = null,processed_at='$hoy ',user_assigned=$user_id WHERE `base_occidente`.`id` = $id_create;")) {
        echo("Error description: " . $mysqli -> error);
    }

    $mysqli -> close();

    header('Location: ../central_risk/index.php?id='.$id_create);
    exit;
?>