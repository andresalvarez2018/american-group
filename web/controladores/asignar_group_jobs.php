<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }
    $select_group_job=$_POST["select_group_job"];
    $base_id=$_POST["base_id"];
   $mysqli = new mysqli("db","db_american_group","4m3r1c4n2021","db");
    
     // Perform query
    if (!$mysqli -> query("INSERT INTO `bases_group_job`(`base_id`, `group_jobs_id`, `is_active`) VALUES ('$base_id','$select_group_job','1')")) {
        echo("Error description: " . $mysqli -> error);
        header('Location: ../admin/assigned_group_jobs.php?id='.$base_id.'&sa=1');
        exit;
    }

    $mysqli -> close();
    header('Location: ../admin/assigned_group_jobs.php?id='.$base_id.'&sa=2');
    exit;

?>