<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }
    
    $hoy = date("Y-m-d H:i:s");

   $mysqli = new mysqli("db","db_american_group","4m3r1c4n2021","db");

    
    $base_id=$_POST['base_id'];

    if ($central_risk = $mysqli -> query("SELECT * FROM `central_risk` WHERE `id` = $base_id")) {
        while ($central_risk_result = $central_risk->fetch_array()) {
            $action=$central_risk_result['action'];
        }
    }
    
    switch ($action) {
        case 'Prestamo':
            header('Location: ../asesor/gestionar.php?v=1');
            exit; 
        break;
        
        case 'TCD':
            header('Location: ../form/agenda.php?id='.$base_id);
            exit;    
        break;
       
    }
    
    
    
    
?>
