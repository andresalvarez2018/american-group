<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }
    $hoy = date("Y-m-d H:i:s");

   $mysqli = new mysqli("db","db_american_group","4m3r1c4n2021","db");

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
    $tipo_venta=$_POST['tipo_venta'];
    $tcd_visa=$_POST['tcd_visa'];
    $tcd_master=$_POST['tcd_master'];
    if (isset($_POST['autorizacion'])) {
        $autorizacion=$_POST['autorizacion'];
        $mail_send=$_POST['mail_send'];
        $number_whatsapp=$_POST['number_whatsapp'];
    }
    $base_id=$_POST['base_id'];
    if ($action == "TCD") {
        $sql= "INSERT INTO `central_risk` (  `name`, `identification`, `civil_status`, `type_dwelling`, `income`, `date_birth`, `phone_contact`, `extension`, `action`, `observation`, `base_id`, `status_id`, `user_id`, `tipo_venta` ,`tcd_visa`, `tcd_master`) VALUES ('$complete_name', ' $identification', '$civil_status', '$type_dwelling', '$income', '$date_birth', '$phone_contact', '$extension', '$action', NULL, '$base_id', NULL, '$user_id', '$tipo_venta', '$tcd_visa', '$tcd_master')";
    }else{
        if ($autorizacion == "Correo Electonico") {
            $sql= "INSERT INTO `central_risk` (  `name`, `identification`, `civil_status`, `type_dwelling`, `income`, `date_birth`, `phone_contact`, `extension`, `action`, `observation`, `base_id`, `status_id`, `user_id`, `tipo_venta`, `autorizacion`, `mail_send`) VALUES ('$complete_name', ' $identification', '$civil_status', '$type_dwelling', '$income', '$date_birth', '$phone_contact', '$extension', '$action', NULL, '$base_id', NULL, '$user_id', '$tipo_venta', '$autorizacion', '$mail_send')";
        }elseif ($autorizacion == "Whatsapp") {
            $sql= "INSERT INTO `central_risk` (  `name`, `identification`, `civil_status`, `type_dwelling`, `income`, `date_birth`, `phone_contact`, `extension`, `action`, `observation`, `base_id`, `status_id`, `user_id`, `tipo_venta`, `autorizacion`, `number_whatsapp`) VALUES ('$complete_name', ' $identification', '$civil_status', '$type_dwelling', '$income', '$date_birth', '$phone_contact', '$extension', '$action', NULL, '$base_id', NULL, '$user_id', '$tipo_venta', '$autorizacion', '$number_whatsapp')";
        }else{
            $sql= "INSERT INTO `central_risk` (  `name`, `identification`, `civil_status`, `type_dwelling`, `income`, `date_birth`, `phone_contact`, `extension`, `action`, `observation`, `base_id`, `status_id`, `user_id`, `tipo_venta`, `autorizacion`) VALUES ('$complete_name', ' $identification', '$civil_status', '$type_dwelling', '$income', '$date_birth', '$phone_contact', '$extension', '$action', NULL, '$base_id', NULL, '$user_id', '$tipo_venta', '$autorizacion')";
        }
        
    }
    // Perform query
    if (!$mysqli -> query($sql)) {
        echo("Error description: " . $mysqli -> error);
    }

    $id_create=$mysqli->insert_id;

    $mysqli -> close();
    header('Location: ../central_risk/reply.php?id='.$id_create);
    exit;
?>
