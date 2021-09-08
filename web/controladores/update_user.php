<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }

    $user_id=$_POST['id_user'];
    $user_name=$_POST["user_name"];
    $mysqli = new mysqli("db","db_american_group","4m3r1c4n2021","db");
     // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }
    $hoy = date("Y-m-d H:i:s");
    if ( $_FILES['user_photo']['name'] != null) {

        // crea la carpeta del usuario si no existe
        $micarpeta = '../imagen/usuarios/'.$user_id;
        if (!file_exists($micarpeta)) {
            mkdir($micarpeta, 0777, true);
        }

        $target_path = "../imagen/usuarios/".$user_id."/";
        $target_path = $target_path . basename( $_FILES['user_photo']['name']); 
        $numero = rand();
        $target_path_2 = "../imagen/usuarios/".$user_id."/";
        $target_path_2 = $target_path_2 .$numero.".png";
        if(move_uploaded_file($_FILES['user_photo']['tmp_name'], $target_path)) {
            echo "El archivo ".  basename( $_FILES['user_photo']['name']). 
            " ha sido subido";
            rename($target_path, $target_path_2);
        } else{
            echo "Ha ocurrido un error, trate de nuevo!";
        }

        // Perform query
        if ($result = $mysqli -> query("UPDATE `user` SET `complete_name`='$user_name',`update_at`='$hoy ',`url_image`='$target_path_2' WHERE id=$user_id")) {

            if($_POST["group_jobs"]){
                // Perform query
                $group_jobs=$_POST["group_jobs"];
                if ($mysqli -> query("INSERT INTO `details_group_jobs` (`group_jobs_id`, `user_id`) VALUES ( '$group_jobs', '$user_id') ON DUPLICATE KEY UPDATE group_jobs_id='$group_jobs',user_id='$user_id'")) {
                    header('Location: /admin/editar.php?id='.$user_id.'&s=1');
                    exit;
                }
                
            };
            
        }
    }else {
         // Perform query
        if ($result = $mysqli -> query("UPDATE `user` SET `complete_name`='$user_name',`update_at`='$hoy' WHERE id=$user_id")) {
            
            if($_POST["group_jobs"]){
                // Perform query
                $group_jobs=$_POST["group_jobs"];
                if ($mysqli -> query("INSERT INTO `details_group_jobs` (`group_jobs_id`, `user_id`) VALUES ( '$group_jobs', '$user_id') ON DUPLICATE KEY UPDATE group_jobs_id='$group_jobs',user_id='$user_id'")) {
                    header('Location: /admin/editar.php?id='.$user_id.'&s=1');
                    exit;
                }
                
            };
        }
    }

    $mysqli -> close();

?>