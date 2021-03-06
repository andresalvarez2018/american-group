<?php
    session_start();
    
    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }

    $nombre_usuario=$_SESSION['user'];
    $id_usuario=$_SESSION['id'];
    $campana_id=$_SESSION['campana_id'];

      $mysqli = new mysqli("db","db_american_group","4m3r1c4n2021","db");

    $hoy = date("Y-m-d H:i:s");

    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    
    // Perform query
    if ($result_user_logueado = $mysqli -> query("SELECT * FROM `user` WHERE id=$id_usuario")) {
      while ($reg_user_loagueado = $result_user_logueado->fetch_array()) {
        $url_image_user_logueado=$reg_user_loagueado['url_image'];
      }

      // Free result set
      $result_user_logueado -> free_result();
    }

?>  

<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Group American</title>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="../plugins/fullcalendar/main.css">
</head>
<body class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
            <form class="form-inline" action="../consulta.php" method="POST">
                <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
                </div>
            </form>
            </div>
        </li> -->

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <?php
                // Perform query
                $notification_count=0;
                if ($result_count_chat= $mysqli -> query("SELECT * FROM `chat` as c inner join user as u on c.send_user_id=u.id WHERE `receiver_user_id` = $id_usuario AND `read_message` = 0 GROUP by send_user_id")) {
                  while ($reg_count_chat = $result_count_chat->fetch_array()) {
                    $notification_count++;
              ?>
          <span class="badge badge-danger navbar-badge"><?php echo $notification_count ?></span>
          <?php
                }

              // Free result set
              $result_count_chat -> free_result();
            }
          ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <?php
                // Perform query
                if ($result_user_chat= $mysqli -> query("SELECT u.id,u.url_image,u.complete_name,c.message,c.created_at FROM `chat` as c inner join user as u on c.send_user_id=u.id WHERE `receiver_user_id` = $id_usuario AND `read_message` = 0 GROUP by send_user_id")) {
                  while ($reg_user_chat = $result_user_chat->fetch_array()) {
                    $notification_id=$reg_user_chat['id'];
                    $notification_url_image=$reg_user_chat['url_image'];
                    $notification_complete_name=$reg_user_chat['complete_name'];
                    $notification_message=$reg_user_chat['message'];
                    $notification_created_at=$reg_user_chat['created_at'];
                  
              ?>
              <a href="./chat.php?chatid=<?php echo $notification_id ?>" class="dropdown-item">
                  <!-- Message Start -->
                  <div class="media">
                  <img src="<?php echo $notification_url_image ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                      <h3 class="dropdown-item-title">
                      <?php echo $notification_complete_name ?>
                      <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                      </h3>
                      <p class="text-sm"><?php echo $notification_message ?></p>
                      <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?php echo $notification_created_at ?></p>
                  </div>
                  </div>
                  <!-- Message End -->
              </a>
              <?php
                  }

                // Free result set
                $result_user_chat -> free_result();
                }
              ?>
            <div class="dropdown-divider"></div>
            <a href="./chat.php" class="dropdown-item dropdown-footer">Ver Todos los Mensajes</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-blue-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../controladores/router.php" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Group American </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $url_image_user_logueado ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $nombre_usuario ?></a>
        </div>  
      </div>
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="../controladores/logout.php" class="nav-link">
                <i class="nav-icon  fas fa-user-slash"></i>
                <p> Cerrar Sesi??n</p>
                </a>
            </li>
        </ul>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Menu</li>
            <li class="nav-item active">
                <a href="./index.php" class="nav-link ">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="./gestionar.php" class="nav-link active">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>Gestionar</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="./ventas.php" class="nav-link">
                    <i class="nav-icon fas fa-bookmark"></i>
                    <p>Ventas</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="./backlog.php" class="nav-link">
                    <i class="nav-icon far fa-bookmark"></i>
                    <p>Backlog</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="./consulta.php" class="nav-link">
                    <i class="nav-icon fas fa-search"></i>
                    <p>Consulta</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="./chat.php" class="nav-link">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>Chat</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="./referido.php" class="nav-link">
                    <i class="nav-icon fas fa-user-tag"></i>
                    <p>Referido</p>
                </a>
            </li>
            
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Gestionar</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../controladores/router.php">Home</a></li>
              <li class="breadcrumb-item active">Gestionar</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <?php
        if (isset($_GET['v'])) {
        ?>
        <div>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
            <h5><i class="icon fas fa-check"></i> Enhorabuena!!</h5>
            Se ha creado la viabilidad del cliente.
          </div>
        </div>
        <?php
        }
      ?>
      <?php
        if (isset($_GET['s'])) {
        ?>
        <div>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
            <h5><i class="icon fas fa-check"></i> Enhorabuena!!</h5>
            Registro guardado con exito.
          </div>
        </div>
        <?php
        }
      ?>
      <?php
        if (isset($_GET['c'])) {
        ?>
        <div>
          <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
            <h5><i class="icon fas fa-check"></i> Central de Riesgo!!</h5>
            Se ha Guardado la Central de Riesgo.
          </div>
        </div>
        <?php
        }
      ?>
      <?php
        if (isset($_GET['f'])) {
        ?>
        <div>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
            <h5><i class="icon fas fa-check"></i> Enhorabuena!!</h5>
            Formulario guardado con exito.
          </div>
        </div>
        <?php
        }
      ?>
            <!-- Info boxes -->
            <div class="row">
            <?php
            // Perform query
                if ($campana = $mysqli -> query("SELECT * from campana where id=$campana_id")) {
                    while ($campana_result = $campana->fetch_array()) {
                        $campana_prefijo=$campana_result['prefijo'];
                        $campana_automatico=$campana_result['automatico'];
                    }
                    if ($campana_automatico == 1) {

                      if ($details_group_jobs = $mysqli -> query("SELECT * from details_group_jobs where user_id=$id_usuario")) {
                        while ($details_group_jobs_result = $details_group_jobs->fetch_array()) {
                            $group_jobs_id=$details_group_jobs_result['group_jobs_id'];
                        }
                      }

                      if ($bases_group_job = $mysqli -> query("SELECT * FROM `bases_group_job` WHERE `group_jobs_id` = $group_jobs_id")) {
                        $base_group_in="";
                        while ($bases_group_job_result = $bases_group_job->fetch_array()) {
                            $base_id_id=$bases_group_job_result['base_id'];
                            $base_group_in .= $base_id_id . ',';
                        }
                        $base_group_in = substr($base_group_in, 0, -1);
                      }
                      

                        if ($assigned = $mysqli -> query("SELECT * FROM `base_$campana_prefijo` WHERE `assigned` = 0 AND `processed` = 0 and archivo_id in ($base_group_in)limit 1")) {
                            if ($assigned_result = $assigned->fetch_array()) {
                                $id_reg=$assigned_result['id'];
                                if (!$mysqli -> query("UPDATE `base_$campana_prefijo` SET `assigned` = '1',assigned_at='$hoy',user_assigned=$id_usuario WHERE `base_$campana_prefijo`.`id` = $id_reg ;")) {
                                    echo("Error description: " . $mysqli -> error);
                                }
                            }
                        }
                            if ($campana = $mysqli -> query("SELECT * FROM `base_$campana_prefijo` WHERE `assigned` = 1 AND processed = 0 AND  `user_assigned` = $id_usuario ORDER BY `base_$campana_prefijo`.`assigned_at` ASC limit 1")) {
                                if ($campana_result = $campana->fetch_array()) {
                                    $complete_name=$campana_result['complete_name'];
                                    $identification=$campana_result['identification'];
                                    $phone_number=$campana_result['phone_number'];
                                    $id_reg=$campana_result['id'];
                              ?>
                              <div class="container">
                                  <div class="card">
                                      <div class="card-body">
                                          <form action="../controladores/action_process.php" method="POST">
                                              <table style="width: 100%; margin-left: auto; margin-right: auto;" cellpadding="25">
                                                  <thead>
                                                      <tr>
                                                          <th style="text-align: center;">Datos del cliente</th>
                                                          <th style="text-align: center;">Tipificaci??n y observaci??n</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <tr>
                                                          <td>
                                                              <div class="input-group mb-3">
                                                                  <label class="input-group-text" id="basic-addon3">Nombre Completo</label>
                                                                  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" disabled value="Nombre Protegido">
                                                              </div>
                                                              <div class="input-group mb-3">
                                                                  <label class="input-group-text" id="basic-addon3">Identificaci??n</label>
                                                                  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" disabled value="Identificacion protegida">
                                                              </div>
                                                              <div class="input-group mb-3">
                                                                  <label class="input-group-text" id="basic-addon3">Tel??fono</label>
                                                                  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" disabled value="<?php echo $phone_number?>">
                                                              </div>
                                                          </td>
                                                          <td>
                                                              <div class="input-group">
                                                                  <label class="input-group-text">Observaciones</label>
                                                                  <textarea class="form-control" aria-label="With textarea" rows="10"  name="observation"></textarea>
                                                              </div>
                                                              <div class="input-group mb-3">
                                                                  <label class="input-group-text" for="inputGroupSelect01">Tipificaciones</label>
                                                                  <select class="form-control" id="select_status" required name="status" onchange="select_volver_llamar()">
                                                                      <option disabled selected>Seleccione...</option>
                                                                      <?php 
                                                                          if ($status = $mysqli -> query("SELECT * FROM `status` WHERE `sector` = 1 ORDER BY `status`.`name` ASC")) {
                                                                              while ($status_result = $status->fetch_array()) {
                                                                      ?>
                                                                      <option value="<?php echo $status_result['id'] ?>"><?php echo $status_result['name'] ?></option>
                                                                      <?php 
                                                                              }
                                                                          }
                                                                      ?>
                                                                  </select>
                                                              </div>
                                                              <div class="input-group mb-3">
                                                                  <label class="input-group-text" for="inputGroupSelect01">Volver a llamar</label>
                                                                  <input type="datetime-local" class="form-control" id="volver_a_llamar" name="callback" aria-describedby="basic-addon3" disabled/>
                                                              </div>
                                                          </td>
                                                      </tr>
                                                      <tr>
                                                          <input type="hidden" name="id_reg" value="<?php echo $id_reg ?>"/>
                                                          <td colspan="2"><button type="SUBMIT" class="btn btn-outline-primary btn-block">Enviar Informaci??n</button></td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                              <?php
                          }else {
                              ?>
                              <div>
                                  <div class="alert alert-danger alert-dismissible">
                                      <h5><i class="icon fas fa-check"></i> Error!!</h5>
                                      No hay registros por asignar
                                  </div>
                              </div>
                              <?php
                          }
                      }
                    }else {
                      if ($campana = $mysqli -> query("SELECT * FROM `base_$campana_prefijo` WHERE `assigned` = 1 AND processed = 0 AND  `user_assigned` = $id_usuario ORDER BY `base_occidente`.`assigned_at` ASC limit 1")) {
                        if ($campana_result = $campana->fetch_array()) {
                            $complete_name=$campana_result['complete_name'];
                            $identification=$campana_result['identification'];
                            $phone_number=$campana_result['phone_number'];
                            $id_reg=$campana_result['id'];
                        ?>
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                    <form action="../controladores/action_process.php" method="POST">
                                        <table style="width: 100%; margin-left: auto; margin-right: auto;" cellpadding="25">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;">Datos del cliente</th>
                                                    <th style="text-align: center;">Tipificaci??n y observaci??n</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" id="basic-addon3">Nombre Completo</label>
                                                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" disabled value="Nombre Protegido>">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" id="basic-addon3">Identificaci??n</label>
                                                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" disabled value="Identifiacion protegida>">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" id="basic-addon3">Tel??fono</label>
                                                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" disabled value="<?php echo $phone_number?>">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <label class="input-group-text">Observaciones</label>
                                                            <textarea class="form-control" aria-label="With textarea" rows="10"  name="observation"></textarea>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" for="inputGroupSelect01">Tipificaciones</label>
                                                            <select class="form-control" id="select_status" required name="status" onchange="select_volver_llamar()">
                                                                <option disabled selected>Seleccione...</option>
                                                                <?php 
                                                                    if ($status = $mysqli -> query("SELECT * FROM `status` WHERE `sector` = 1 ORDER BY `status`.`name` ASC")) {
                                                                        while ($status_result = $status->fetch_array()) {
                                                                ?>
                                                                <option value="<?php echo $status_result['id'] ?>"><?php echo $status_result['name'] ?></option>
                                                                <?php 
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" for="inputGroupSelect01">Volver a llamar</label>
                                                            <input type="datetime-local" class="form-control" id="volver_a_llamar" name="callback" aria-describedby="basic-addon3" disabled/>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <input type="hidden" name="id_reg" value="<?php echo $id_reg ?>"/>
                                                    <td colspan="2"><button type="SUBMIT" class="btn btn-outline-primary btn-block">Enviar Informaci??n</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                          }else {
                              ?>
                                <div>
                                    <div class="alert alert-danger alert-dismissible">
                                        <h5><i class="icon fas fa-check"></i> Error!!</h5>
                                        No hay registros por asignar, la campa??a automatica esta desactivada!!
                                    </div>
                                </div>
                              <?php
                          }
                      }
                    }
            ?>
                
            <?php
                }
            ?>
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
        </div>
    </footer> -->
</div>
<!-- ./wrapper -->
<div class="modal fade" id="modal-xl" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="max-width: 90% !important;">
    <div class="modal-content">
      <div class="modal-header">
          <h4 id="modalTitle" class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">??</span>
          </button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
              <form action="../controladores/action_process.php" method="POST">
                  <table style="width: 100%; margin-left: auto; margin-right: auto;" cellpadding="25">
                      <thead>
                          <tr>
                              <th style="text-align: center;"><h4>Datos del cliente</h4></th>
                              <th style="text-align: center;"><h4>Tipificaci??n y observaci??n</h4></th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>
                                  <div class="input-group mb-3">
                                      <label class="input-group-text" id="basic-addon3">Nombre Completo</label>
                                      <input type="text" class="form-control" id="modal_name" aria-describedby="basic-addon3" disabled value="">
                                  </div>
                                  <div class="input-group mb-3">
                                      <label class="input-group-text" id="basic-addon3">Identificaci??n</label>
                                      <input type="text" class="form-control" id="modal_identification" aria-describedby="basic-addon3" disabled value="">
                                  </div>
                                  <div class="input-group mb-3">
                                      <label class="input-group-text" id="basic-addon3">Tel??fono</label>
                                      <input type="text" class="form-control" id="modal_phone" aria-describedby="basic-addon3" disabled value="">
                                  </div>
                              </td>
                              <td>
                                  <div class="input-group">
                                      <label class="input-group-text">Observaciones</label>
                                      <textarea class="form-control" id="modal_observation" aria-label="With textarea" rows="10" required name="observation"></textarea>
                                  </div>
                                  <div class="input-group mb-3">
                                      <label class="input-group-text" for="inputGroupSelect01">Tipificaciones</label>
                                      <select class="form-control" id="select_status_modal" required name="status" onchange="select_volver_llamar_modal()">
                                          <option disabled selected>Seleccione...</option>
                                          <?php 
                                              if ($status = $mysqli -> query("SELECT * FROM `status` WHERE `sector` = 1 ORDER BY `status`.`name` ASC")) {
                                                  while ($status_result = $status->fetch_array()) {
                                          ?>
                                          <option value="<?php echo $status_result['id'] ?>"><?php echo $status_result['name'] ?></option>
                                          <?php 
                                                  }
                                              }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="input-group mb-3">
                                      <label class="input-group-text" for="inputGroupSelect01">Volver a llamar</label>
                                      <input type="datetime-local" class="form-control" id="volver_a_llamar_modal" name="callback" aria-describedby="basic-addon3" disabled/>
                                  </div>
                              </td>
                          </tr>
                          <tr>
                              <input type="hidden" id="id_reg" name="id_reg" value=""/>
                              <td colspan="2"><button type="SUBMIT" class="btn btn-outline-primary btn-block">Enviar Informaci??n</button></td>
                          </tr>
                      </tbody>
                  </table>
              </form>
          </div>
      </div>
      </div>
      <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
<!-- /.modal-dialog -->
</div>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../plugins/raphael/raphael.min.js"></script>
<script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard2.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/fullcalendar/main.js"></script>
<script src='../plugins/fullcalendar/locales/es.js'></script>
<script>
    function select_volver_llamar() {
        var x = document.getElementById("select_status").value;
        console.log(x);
        if (x === '2') {
            document.getElementById('volver_a_llamar').disabled = false
            document.getElementById('volver_a_llamar').required = true
        }else{
            document.getElementById('volver_a_llamar').disabled = true
        }
    }
    function select_volver_llamar_modal() {
        var x = document.getElementById("select_status_modal").value;
        console.log(x);
        if (x === '2') {
            document.getElementById('volver_a_llamar_modal').disabled = false
            document.getElementById('volver_a_llamar_modal').required = true
        }else{
            document.getElementById('volver_a_llamar_modal').disabled = true
        }
    }
</script>
<!-- Page specific script -->
<script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'timeGridWeek',
          events: '../controladores/callback.php',
          locale: 'es',
          eventColor: '#378006',
          //Evento Click
          eventClick: function(info) {
            $('#modalTitle').html(info.event._def.title);
            //document.getElementById("modal_name").value = info.event._def.title;
            //document.getElementById("modal_identification").value = info.event._def.extendedProps.identification;
            document.getElementById("modal_phone").value = info.event._def.extendedProps.phone_number;
            document.getElementById("modal_observation").value = info.event._def.extendedProps.observation;
            document.getElementById("id_reg").value = info.event._def.extendedProps.base_id;
            document.getElementById("modal_name").value = "Nombre Protegido";
            //document.getElementById("modal_phone").value = "Nombre Protegido";
            document.getElementById("modal_identification").value = "Nombre Protegido";
            $('#modal-xl').modal();
          }
        });
        calendar.render();
      });

    </script>
</body>
</html>
