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
    if (!$mysqli -> query("DELETE FROM `bases_group_job` WHERE group_jobs_id=$select_group_job and base_id=$base_id")) {
        echo("Error description: " . $mysqli -> error);
        header('Location: ../admin/assigned_group_jobs.php?id='.$base_id.'&sa=4');
        exit;
    }

    $mysqli -> close();
    header('Location: ../admin/assigned_group_jobs.php?id='.$base_id.'&sa=3');
    exit;

?>