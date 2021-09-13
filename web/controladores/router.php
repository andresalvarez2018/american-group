<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }

    if ($_SESSION['update_password'] == "1") {
        header('Location: ../login/update_password.php');
        exit;
    }
    
    $role_id=$_SESSION["role_id"];

    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Content-Type: application/xml; charset=utf-8");

    switch ($role_id) {
        case '1':
            header('Location: ../asesor/index.php');
            exit;    
        break;
        case '2':
            header('Location: ../admin/index.php');
            exit;    
        break;
        case '3':
            header('Location: ../supervisor/index.php');
            exit;    
        break;
        
    }

?>