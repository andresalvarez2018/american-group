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
        <div class="col-sm-12">
            <?php
                if ($result_from = $mysqli -> query("SELECT  cr.name,cr.identification,cr.civil_status,cr.type_dwelling,cr.income,cr.date_birth,cr.phone_contact,so.created_at,so.date,so.process,so.method,so.address,so.city,so.place_visit,so.trip,so.products,so.purchase_portfolio,so.observation,so.id FROM central_risk as cr inner join scheduling_occidente as so on so.central_risk_id=cr.id inner join scheduling_status_occidente as sso on so.id=sso.scheduling_id inner join status as s on s.id=sso.status_id inner join user as u on u.id=sso.user_id where cr.id=$form_id and sso.current=1")) {
                
                    while ($reg_form= $result_from->fetch_array()) {
                        $full_name=$reg_form['name'];            
                        $identification=$reg_form['identification'];            
                        $civil_status=$reg_form['civil_status'];            
                        $type_dwelling=$reg_form['type_dwelling'];            
                        $income=$reg_form['income'];            
                        $date_birth=$reg_form['date_birth'];            
                        $phone_contact=$reg_form['phone_contact'];            
                        $created_at=$reg_form['created_at'];            
                        $date=$reg_form['date'];            
                        $process=$reg_form['process'];            
                        $method=$reg_form['method'];            
                        $address=$reg_form['address'];            
                        $city=$reg_form['city'];            
                        $place_visit=$reg_form['place_visit'];            
                        $trip=$reg_form['trip'];            
                        $products=$reg_form['products'];            
                        $purchase_portfolio=$reg_form['purchase_portfolio'];            
                        $observation=$reg_form['observation'];            
                        $id_scheduling=$reg_form['id'];            
            ?>
            
            <div class="row">
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Nombre Completo</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?php echo $full_name ?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Cedula</label>
                    <input type="text" name="identification" class="form-control" id="identification" value="<?php echo $identification ?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Estado Civil</label>
                    <input type="text" name="data" class="form-control" id="date" value="<?php echo $civil_status ?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Tipo Vivienda</label>
                    <input type="text" name="data" class="form-control" id="date" value="<?php echo $type_dwelling ?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Ingresos</label>
                    <input type="text" name="data" class="form-control" id="date" value="<?php echo $income ?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Fecha Nacimiento</label>
                    <input type="text" name="data" class="form-control" id="date" value="<?php echo $date_birth ?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Telefono Contacto</label>
                    <input type="text" name="data" class="form-control" id="date" value="<?php echo $phone_contact ?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Fecha Creación</label>
                    <input type="text" name="data" class="form-control" id="date" value="<?php echo $created_at ?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Fecha Agendamiento</label>
                    <input type="text" name="data" class="form-control" id="date" value="<?php echo $date ?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Proceso</label>
                    <input type="text" name="data" class="form-control" id="date" value="<?php echo $process ?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Metodo</label>
                    <input type="text" name="data" class="form-control" id="date" value="<?php echo $method ?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Dirrección</label>
                    <input type="text" name="address" class="form-control" id="address"value="<?php echo $address ?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Ciudad</label>
                    <input type="text" name="city" class="form-control" id="city"  value="<?php echo $city ?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Lugar Visita</label>
                    <input type="text" name="place_visit" class="form-control" id="place_visit"  value="<?php echo $place_visit ?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Jornada</label>
                    <input type="text" name="data" class="form-control" id="date" value="<?php echo $trip ?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Productos</label>
                    <input type="text" name="products" class="form-control" id="products" value="<?php echo $products ?>" disabled>
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Compra de cartera</label>
                    <input type="text" name="purchase_portfolio" class="form-control" id="purchase_portfolio" value="<?php echo $purchase_portfolio ?>" disabled >
                </div>
                <div class="form-group col-sm-6 ">
                    <label for="exampleInputEmail1">Observaciones</label>
                    <textarea name="observation" class="form-control" id="exampleInputEmail1" disabled ><?php echo $observation ?></textarea>
                </div>
            </div> 
            <hr>
            <h5>Cambio de estado</h5>
            <form action="../controladores/update_scheduling.php" method="POST">
           
                <div class="input-group col-sm-12">
                    <label class="input-group-text" for="inputGroupSelect01">Tipificaciones</label>
                    <select class="form-control" id="select_status" required name="status" onchange="select_volver_llamar()">
                        <option disabled selected>Seleccione...</option>
                        <?php 
                            if ($status = $mysqli -> query("SELECT * FROM `status` where sector=3")) {
                                while ($status_result = $status->fetch_array()) {
                        ?>
                        <option value="<?php echo $status_result['id'] ?>"><?php echo $status_result['name'] ?></option>
                        <?php 
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-sm-12 ">
                    <label for="exampleInputEmail1">Observaciones</label>
                    <textarea name="observation" class="form-control" id="exampleInputEmail1" ></textarea>
                </div>
                <input type="hidden" name="base_id" value="<?php echo $id_scheduling?>"/>
                <button type="SUBMIT" class="btn btn-outline-primary btn-block">Enviar Información</button>
            </form>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>