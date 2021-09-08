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

    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
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
          <img src="<?php echo $_SESSION['url_image'] ?>" class="img-circle elevation-2" alt="User Image">
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
                <a href="./gestionar.php" class="nav-link">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>Gestionar</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="./ventas.php" class="nav-link active">
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
            <h1 class="m-0">Ventas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../controladores/router.php">Home</a></li>
              <li class="breadcrumb-item active">Ventas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listado de ventas  </h3>
                </div>
                <!-- /.card-header -->
                  
                    <table id="list_usuarios" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombre Completo</th>
                                <th>Identificación</th>
                                <th>Fecha Estado</th>
                                <th>Name</th>
                                <th>**</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if ($result = $mysqli -> query("SELECT cr.id,cr.name,cr.identification,sso.created_at,s.name as estado FROM central_risk as cr inner join scheduling_occidente as so on so.central_risk_id=cr.id inner join scheduling_status_occidente as sso on so.id=sso.scheduling_id inner join status as s on s.id=sso.status_id where cr.user_id=7 and sso.current=1 and date_format(sso.created_at,'%m') = date_format(now(),'%m')")) {
                                while ($reg = $result->fetch_array()) {
                                ?>
                                <tr>
                                    <td><?php echo $reg['name'] ?></td>
                                    <td><?php echo $reg['identification'] ?></td>
                                    <td><?php echo $reg['created_at'] ?></td>
                                    <td><?php echo $reg['estado'] ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-xl" onclick="fetch_form(<?php echo $reg['id'] ?>)"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                 <?php
                                }
                                // Free result set
                                $result -> free_result();
                            }
                        ?>    
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nombre Completo</th>
                                <th>Identificación</th>
                                <th>Fecha Estado</th>
                                <th>Name</th>
                                <th>**</th>
                            </tr>
                        </tfoot>
                    </table>
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
<div class="modal fade" id="modal-xl" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="max-width: 90% !important;">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Información del cliente</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
          </button>
      </div>
      <div class="modal-body">
          <div id="fecth_data"></div>
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
<script>
    async function fetch_form(data) {      
    try {
        let response = await fetch('../controladores/fromData.php?id='+data); // Gets a promise
        document.getElementById("fecth_data").innerHTML = await response.text(); // Replaces body with response
    } catch (err) {
        console.log('Fetch error:' + err); // Error handling
    }
    }
</script>
</body>
</html>
