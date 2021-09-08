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
                <p> Cerrar Sesión</p>
                </a>
            </li>
        </ul>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Menu</li>
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
        if (isset($_GET['s'])) {
        ?>
        <div>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Enhorabuena!!</h5>
            Registro guardado con exito.
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
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
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
                        if ($assigned = $mysqli -> query("SELECT * FROM `base_$campana_prefijo` WHERE `assigned` = 0 AND `processed` = 0 limit 1")) {
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
                                                          <th style="text-align: center;">Tipificación y observación</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <tr>
                                                          <td>
                                                              <div class="input-group mb-3">
                                                                  <label class="input-group-text" id="basic-addon3">Nombre Completo</label>
                                                                  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" disabled value="<?php echo $complete_name?>">
                                                              </div>
                                                              <div class="input-group mb-3">
                                                                  <label class="input-group-text" id="basic-addon3">Identificación</label>
                                                                  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" disabled value="<?php echo $identification?>">
                                                              </div>
                                                              <div class="input-group mb-3">
                                                                  <label class="input-group-text" id="basic-addon3">Teléfono</label>
                                                                  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" disabled value="<?php echo $phone_number?>">
                                                              </div>
                                                          </td>
                                                          <td>
                                                              <div class="input-group">
                                                                  <label class="input-group-text">Observaciones</label>
                                                                  <textarea class="form-control" aria-label="With textarea" rows="10" required name="observation"></textarea>
                                                              </div>
                                                              <div class="input-group mb-3">
                                                                  <label class="input-group-text" for="inputGroupSelect01">Tipificaciones</label>
                                                                  <select class="form-control" id="select_status" required name="status" onchange="select_volver_llamar()">
                                                                      <option disabled selected>Seleccione...</option>
                                                                      <?php 
                                                                          if ($status = $mysqli -> query("SELECT * FROM `status`")) {
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
                                                          <td colspan="2"><button type="SUBMIT" class="btn btn-outline-primary btn-block">Enviar Información</button></td>
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
                                                    <th style="text-align: center;">Tipificación y observación</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" id="basic-addon3">Nombre Completo</label>
                                                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" disabled value="<?php echo $complete_name?>">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" id="basic-addon3">Identificación</label>
                                                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" disabled value="<?php echo $identification?>">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" id="basic-addon3">Teléfono</label>
                                                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" disabled value="<?php echo $phone_number?>">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <label class="input-group-text">Observaciones</label>
                                                            <textarea class="form-control" aria-label="With textarea" rows="10" required name="observation"></textarea>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" for="inputGroupSelect01">Tipificaciones</label>
                                                            <select class="form-control" id="select_status" required name="status" onchange="select_volver_llamar()">
                                                                <option disabled selected>Seleccione...</option>
                                                                <?php 
                                                                    if ($status = $mysqli -> query("SELECT * FROM `status`")) {
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
                                                    <td colspan="2"><button type="SUBMIT" class="btn btn-outline-primary btn-block">Enviar Información</button></td>
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
                                        No hay registros por asignar, la campaña automatica esta desactivada!!
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
<script>
    function select_volver_llamar() {
        var x = document.getElementById("select_status").value;
        if (x === '3') {
            document.getElementById('volver_a_llamar').disabled = false
        }else{
            document.getElementById('volver_a_llamar').disabled = true
        }
    }
</script>
</body>
</html>
