<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }
    $hoy = date("Y-m-d H:i:s");   
    $role_id=$_SESSION["role_id"];
    $select_grupo_jobs=$_REQUEST['select_grupo_jobs'];
    $select_users=$_REQUEST['select_users'];
    $id_status=$_REQUEST['id_status'];
    $base_id=$_REQUEST['base_id'];
    $registros=$_REQUEST['registros'];

      $mysqli = new mysqli("localhost","root","","db");

    $id_reg=[];

    if ($result_status = $mysqli -> query("SELECT * FROM `bases_archivo` WHERE `id` = $base_id")) {
        while ($result_statu = $result_status->fetch_array()) {
            $campana_id=$result_statu['campana_id'];
            if ($result_campanas = $mysqli -> query("SELECT * FROM `campana` WHERE `id` = $campana_id")) {
                while ($result_campana = $result_campanas->fetch_array()) {
                    $prefijo=$result_campana['prefijo'];
                    if ($result_bases = $mysqli -> query("SELECT id FROM `base_$prefijo` WHERE `status_id` = $id_status AND `archivo_id` = $base_id limit $registros")) {
                        while ($result_base = $result_bases->fetch_array()) {
                            array_push($id_reg,$result_base['id']);
                        }
                    }
                }
            }
        }
    }

    $count_registros=count($id_reg);
    $count_user=count($select_users);
    $q=0;
    $s=0;
    for ($i=0; $i < $count_registros; $i++) { 
        
        if($q == $count_user){
            $q=0;
            if (!$mysqli -> query("UPDATE `base_$prefijo` as b SET `assigned_at` = '$hoy', `processed` = 0, `status_id` = null,user_assigned = $select_users[$q], `reassigned` = 1 WHERE b.id=$id_reg[$i] ;")) {
                echo("Error description: " . $mysqli -> error);
            }
            $s++;
        }else{
            if (!$mysqli -> query("UPDATE `base_$prefijo` as b SET `assigned_at` = '$hoy', `processed` = 0, `status_id` = null,user_assigned = $select_users[$q], `reassigned` = 1 WHERE  b.id=$id_reg[$i];")) {
                echo("Error description: " . $mysqli -> error);
            }
            $s++;
        }

       $q++;
    }

    
    
    $mysqli -> close();
    switch ($role_id) {
        case '2':
            header('Location: ../admin/detalle_base.php?id='.$base_id."&re=".$s."&sa=3");
            exit;
            break;

        case '3':
            # code...
            break;
        
    }
    
?>
