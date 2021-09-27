<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }

    $mysqli = new mysqli("localhost","root","","db");

    // Check connection
    if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
    }
    $hoy = date("Y-m-d H:i:s");

    $complete_name=$_POST["complete_name"];
    $user_name=$_POST["user_name"];
    $password=$_POST["password"];
    $reply_password=$_POST["reply_password"];
    $role_id=$_POST["role_id"];
    $campana_id=$_POST["campana_id"];

    if ($reply_password !== $password) {
        header('Location: /admin/new.php?e=1');
        exit;
    }
    $password = md5($password);
    if (!$mysqli -> query("INSERT INTO `user`( `complete_name`, `username`, `pasword`, `role_id`, `created_at`,`is_active`, `update_password`,`campana_id`) VALUES ('$complete_name','$user_name','$password','$role_id','$hoy','1','1','$campana_id')")) {
        echo("Error description: " . $mysqli -> error);
    }
    $id_create=$mysqli->insert_id;

    // crea la carpeta del usuario si no existe
    $micarpeta = '../imagen/usuarios/'.$id_create;
    if (!file_exists($micarpeta)) {
        mkdir($micarpeta, 0777, true);
    }

    $target_path = "../imagen/usuarios/".$id_create."/";
    $target_path = $target_path . basename( $_FILES['user_photo']['name']); 
    $numero = rand();
    $target_path_2 = "../imagen/usuarios/".$id_create."/";
    $target_path_2 = $target_path_2 .$numero.".png";
    if(move_uploaded_file($_FILES['user_photo']['tmp_name'], $target_path)) {
        echo "El archivo ".  basename( $_FILES['user_photo']['name']). 
        " ha sido subido";
        rename($target_path, $target_path_2);
    } else{
        echo "Ha ocurrido un error, trate de nuevo!";
    }

   
    // Perform query
    if ($result = $mysqli -> query("UPDATE `user` SET `url_image`='$target_path_2' WHERE id=$id_create")) {
        
        header('Location: /admin/new.php?s=1');
        exit;
    }

    $mysqli -> close();

?>