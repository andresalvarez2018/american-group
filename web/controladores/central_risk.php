<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }
    $hoy = date("Y-m-d H:i:s");

    $mysqli = new mysqli("localhost","root","","db");

    $user_id=$_SESSION["id"];

    $complete_name=$_POST['complete_name'];
    $identification=$_POST['identification'];
    $civil_status=$_POST['civil_status'];
    $type_dwelling=$_POST['type_dwelling'];
    $income=$_POST['income'];
    $date_birth=$_POST['date_birth'];
    $phone_contact=$_POST['phone_contact'];
    $extension=$_POST['extension'];
    $action=$_POST['action'];
    $base_id=$_POST['base_id'];

     // Perform query
    if (!$mysqli -> query("INSERT INTO `central_risk` (  `name`, `identification`, `civil_status`, `type_dwelling`, `income`, `date_birth`, `phone_contact`, `extension`, `action`, `observation`, `base_id`, `status_id`, `user_id`) VALUES ('$complete_name', ' $identification', '$civil_status', '$type_dwelling', '$income', '$date_birth', '$phone_contact', '$extension', '$action', NULL, '$base_id', NULL, '$user_id');")) {
        echo("Error description: " . $mysqli -> error);
    }

    $id_create=$mysqli->insert_id;

    $mysqli -> close();
    header('Location: ../central_risk/reply.php?id='.$id_create);
    exit;
?>
