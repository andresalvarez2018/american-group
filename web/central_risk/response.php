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
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-file-prescription"></i>
                    <p>Central de riesgo</p>
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
      <?php
        if (isset($_GET['s'])) {
          $valor=$_GET['s'];
          switch ($valor) {
            case '1':
        ?>
          <div>
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h5><i class="icon fas fa-check"></i>Enhora buena!!</h5>
              Central de riesgo respondida con exito!!! 
            </div>
          </div>
        <?php
              break;
          }
        ?>
        
        <?php
        }
        ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Central de riesgo</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../controladores/router.php">Home</a></li>
              <li class="breadcrumb-item active">Gestionar</li>
              <li class="breadcrumb-item active">Central de riesgo</li>
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
            <div class="row">
                <div class="col-sm-6 ">
                     <!-- form start -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Información</h3>
                        </div>
                        <form id="quickForm" enctype="multipart/form-data" method="POST" action="../controladores/central_risk.php">
                            <div class="card-body">
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
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 ">
                    <form action="../controladores/response_central_supervisor.php" method="POST">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Información</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Respuesta Supervisor</label>
                                        <textarea class="form-control" rows="3" placeholder="Esperando..."  style="height: 380px;" id="observation_supervisor" name="observation_supervisor"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="form-group col-sm-12 " style="display: flex;align-items: flex-end;justify-content: space-evenly;">
                                        <input type="hidden" name="base_id" value="<?php echo $_GET['id'] ?>"/>
                                        <button type="submit" class="btn btn-success btn-block"  id="btn_central_risk" >Responder</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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

</body>
</html>
