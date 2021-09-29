<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }
    
    $hoy = date("Y-m-d H:i:s");

   $mysqli = new mysqli("db","db_american_group","4m3r1c4n2021","db");

    
    $base_id=$_POST['base_id'];

        header('Location: ../form/agenda.php?id='.$base_id);
        exit;
    
    
    
?>
