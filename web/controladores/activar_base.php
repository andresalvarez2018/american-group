<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }
    $user_id=$_SESSION["id"];
    $mysqli = new mysqli("db","db_american_group","4m3r1c4n2021","db");

    $id_base=$_GET['id'];

     // Perform query
     if (!$mysqli -> query("UPDATE `bases_archivo` SET `is_active` = '1' WHERE `bases_archivo`.`id` = '$id_base'")) {
        echo("Error description: " . $mysqli -> error);
    }

    if ($result_cant_reg_proc = $mysqli -> query("SELECT prefijo,name_base,campana.id FROM `bases_archivo` inner join campana on bases_archivo.campana_id=campana.id  WHERE `bases_archivo`.`id` = '$id_base'")) {
        while ($reg_cant_reg_proc = $result_cant_reg_proc->fetch_array()) {
           $prefijo=$reg_cant_reg_proc['prefijo'];
           $name_base=$reg_cant_reg_proc['name_base'];
           $id_campana=$reg_cant_reg_proc['id'];
        }
    }

    if (!$mysqli -> query("UPDATE `base_$prefijo` SET `is_active` = '1' WHERE `base_$prefijo`.`archivo_id` = $id_base;")) {
        echo("Error description: " . $mysqli -> error);
    }

    $mysqli -> close();
    header('Location: ../admin/bases.php?sa=2&name_base='.$name_base.'&campana_select_id='.$id_campana);
    exit;

?>   