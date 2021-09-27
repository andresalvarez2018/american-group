<?php
    session_start();
    
    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }

    $nombre_usuario=$_SESSION['user'];
    $campana_id=$_SESSION["campana_id"];
    $mysqli = new mysqli("localhost","root","","db");

    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    // Perform query
    if ($result_user_campana = $mysqli -> query("SELECT * FROM `campana` WHERE id=$campana_id")) {
        while ($reg_user_campana = $result_user_campana->fetch_array()) {
          $prefijo_campana=$reg_user_campana['prefijo'];
        }
  
        // Free result set
        $result_user_campana -> free_result();
    }
    $form_id=$_GET['id'];

?>  
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="row">
        <div class="col-sm-6">
            <?php
                $central_risk_id=$_GET['id'];
                if ($result_central_risk = $mysqli -> query("SELECT * FROM `central_risk` WHERE id=$central_risk_id")) {
                    while ($reg_central_risk = $result_central_risk->fetch_array()) {
                      $central_risk_name=$reg_central_risk['name'];
                      $central_risk_identification=$reg_central_risk['identification'];
                      $central_risk_civil_status=$reg_central_risk['civil_status'];
                      $central_risk_type_dwelling=$reg_central_risk['type_dwelling'];
                      $central_risk_income=$reg_central_risk['income'];
                      $central_risk_date_birth=$reg_central_risk['date_birth'];
                      $central_risk_phone_contact=$reg_central_risk['phone_contact'];
                      $central_risk_extension=$reg_central_risk['extension'];
                      $central_risk_action=$reg_central_risk['action'];
                      $central_risk_observation=$reg_central_risk['observation'];
                    }
              
                    // Free result set
                    $result_central_risk -> free_result();
            ?>
            
            <div class="row">
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Nombre completo</label>
                    <input type="text" name="complete_name" class="form-control" id="complete_name" value="<?php echo  $central_risk_name?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Cedula</label>
                    <input type="text" name="identification" class="form-control" id="identification"  value="<?php echo  $central_risk_identification?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Estado civil</label>
                    <input type="text" name="civil_status" class="form-control" id="civil_status"  value="<?php echo  $central_risk_civil_status?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Tipo de vivienda</label>
                    <input type="text" name="type_dwelling" class="form-control" id="type_dwelling"  value="<?php echo  $central_risk_type_dwelling?>" disabled>

                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Ingresos</label>
                    <input type="text" name="income" class="form-control" id="income" value="<?php echo  $central_risk_income?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Fecha Nacimiento</label>
                    <input type="text" name="date_birth" class="form-control" id="date_birth" value="<?php echo  $central_risk_date_birth?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Teléfono Contacto</label>
                    <input type="text" name="phone_contact" class="form-control" id="phone_contact" value="<?php echo  $central_risk_phone_contact?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Extension</label>
                    <input type="text" name="extension" class="form-control" id="extension" value="<?php echo  $central_risk_extension?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Tramite</label>
                    <input type="text" name="action" class="form-control" id="action"  value="<?php echo  $central_risk_action?>" disabled>
                </div>
            </div>  
            <?php
                    }
            ?>
        </div>
        <div class="col-sm-6 ">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Información</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Respuesta Supervisor</label>
                            <textarea class="form-control" rows="3" placeholder="Esperando..." disabled style="height: 380px;"><?php echo $central_risk_observation ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>