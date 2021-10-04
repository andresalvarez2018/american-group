<?php
    session_start();
    
    if (!isset($_SESSION['id'])) {
        header('Location: ./login/index.php');
        exit;
    }else {
        header('Location: ./controladores/router.php');
        exit;
    }

?>  