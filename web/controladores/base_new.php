<?php
    session_start();
    require_once './PHPExcel/Classes/PHPExcel.php';

    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }
    $user_id=$_SESSION["id"];
      $mysqli = new mysqli("db","db_american_group","4m3r1c4n2021","db");


    // Check connection
    if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
    }
    $hoy = date("Y-m-d H:i:s");

    $complete_name=$_POST["complete_name"];
    $campana_id=$_POST["campana_id"];

    // Perform a query, check for error
    if (!$mysqli -> query("INSERT INTO `bases_archivo`(`created_at`, `name_base`, `is_active`, `campana_id`, `user_id`) VALUES ('$hoy','$complete_name','1','$campana_id','$user_id')")) {
        echo("Error description: " . $mysqli -> error);
    }

    $id_create=$mysqli->insert_id;

    $target_path = "./uploads/";
    $target_path = $target_path . basename( $_FILES['base_upload']['name']); 
    $numero = rand();
    $target_path_2 = "./uploads/";
    $target_path_2 = $target_path_2 .$numero.".xlsx";
    if(move_uploaded_file($_FILES['base_upload']['tmp_name'], $target_path)) {
        rename($target_path, $target_path_2);
    } else{
        echo "Ha ocurrido un error, trate de nuevo!";
    }

    $nombre_archivo=$numero.".xlsx";

    $archivo = $nombre_archivo;

    // Perform query
    if (!$mysqli -> query("UPDATE `bases_archivo` SET `name_file` = '$nombre_archivo' WHERE `bases_archivo`.`id` = '$id_create'")) {
        echo("Error description: " . $mysqli -> error);
    }

    $inputFileType = PHPExcel_IOFactory::identify('./uploads/'.$archivo);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load('./uploads/'.$archivo);
    $sheet = $objPHPExcel->getSheet(0); 
    $highestRow = $sheet->getHighestRow(); 
    $highestColumn = $sheet->getHighestColumn();
    $num=0;
    $count=0;
    for ($row = 2; $row <= $highestRow; $row++){ $num++;
        $count++;
        // Perform a query, check for error
        $nombre_registro=$sheet->getCell("A".$row)->getValue();
        $identification=$sheet->getCell("B".$row)->getValue();
        $phone_number=$sheet->getCell("C".$row)->getValue();
        if (!$mysqli -> query("INSERT INTO `base_occidente`( `created_at`, `complete_name`, `identification`, `phone_number`, `assigned`, `processed`, `processed_at`, `status_id`, `archivo_id`, `is_active`) VALUES ('$hoy','$nombre_registro','$identification','$phone_number','0','0',null,null,'$id_create',1)")) {
            echo("Error description: " . $mysqli -> error);
            $count=$count-1;
        }
    }
    
    $mysqli -> close();
    // header('Location: ../admin/base_new.php?r='.$count);
    // exit;

?>
<html>
    <body onload="load();">
        <script>
            function load() {
                location.replace("../admin/base_new.php?r=<?php echo $count ?>")
            }
        </script>
    </body>
</html> 