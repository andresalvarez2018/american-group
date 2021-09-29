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
                                        <input type="text" name="complete_name" class="form-control" id="complete_name" placeholder="Ingrese Nombre Completo" required>
                                    </div>
                                    <div class="form-group col-sm-6 ">
                                        <label for="exampleInputEmail1">Cedula</label>
                                        <input type="text" name="identification" class="form-control" id="identification" placeholder="Numero de identificación " required>
                                    </div>
                                    <div class="form-group col-sm-6 ">
                                        <label for="exampleInputEmail1">Estado civil</label>
                                        <select class="form-control" aria-label="Default select example" name="civil_status" required>
                                            <option value="Soltero">Soltero</option>
                                            <option value="Casado">Casado</option>
                                            <option value="Union Libre">Union Libre</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 ">
                                        <label for="exampleInputEmail1">Tipo de vivienda</label>
                                        <select class="form-control" aria-label="Default select example" name="type_dwelling" required>
                                            <option value="Propia">Propia</option>
                                            <option value="Familiar">Familiar</option>
                                            <option value="Arriendo">Arriendo</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 ">
                                        <label for="exampleInputEmail1">Ingresos</label>
                                        <input type="number" name="income" class="form-control" id="income" placeholder="Ingresos" required>
                                    </div>
                                    <div class="form-group col-sm-6 ">
                                        <label for="exampleInputEmail1">Fecha Nacimiento</label>
                                        <input type="date" name="date_birth" class="form-control" id="date_birth"required >
                                    </div>
                                    <div class="form-group col-sm-6 ">
                                        <label for="exampleInputEmail1">Teléfono Contacto</label>
                                        <input type="text" name="phone_contact" class="form-control" id="phone_contact" placeholder="Teléfono contacto" required>
                                    </div>
                                    <div class="form-group col-sm-6 ">
                                        <label for="exampleInputEmail1">Extension</label>
                                        <input type="text" name="extension" class="form-control" id="exampleInputEmail1" placeholder="Extension" required>
                                    </div>
                                    <div class="form-group col-sm-6 ">
                                        <label for="exampleInputEmail1">Tipo Venta</label>
                                        <select class="form-control" aria-label="Default select example" name="tipo_venta" required>
                                            <option value="Tradicional">Tradicional</option>
                                            <option value="Digital">Digital</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 ">
                                        <label for="exampleInputEmail1">Tramite</label>
                                        <select class="form-control"  name="action" onchange="tramite()" required id="select_status" >
                                          <option disabled selected>Seleccione...</option>
                                            <option value="TCD">TCD</option>
                                            <option value="Prestamo">Prestamo</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6" style="display: none;" id="TCD_VISA">
                                        <label for="exampleInputEmail1">TCD VISA</label>
                                        <select class="form-control" aria-label="Default select example" name="tcd_visa">
                                            <option value="No Aplica"selected>No Aplica</option>
                                            <option value="Visa Clasica">Visa Clasica</option>
                                            <option value="Visa Oro">Visa Oro</option>
                                            <option value="Visa Platinum">Visa Platinum</option>
                                            <option value="Visa Signature">Visa Signature </option>
                                            <option value="Visa Latam Clasica">Visa Latam Clasica</option>
                                            <option value="Visa Latam Oro">Visa Latam Oro</option>
                                            <option value="Visa Latam Platinum">Visa Latam Platinum</option>
                                            <option value="Visa Latam Signature">Visa Latam Signature</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6" style="display: none;" id="TCD_MASTERCARD">
                                        <label for="exampleInputEmail1">TCD MASTERCARD</label>
                                        <select class="form-control" aria-label="Default select example" name="tcd_master">
                                            <option value="No Aplica"selected>No Aplica</option>
                                            <option value="Master Clasica">Master Clasica</option>
                                            <option value="Master Oro">Master Oro</option>
                                            <option value="Master Platinum">Master Platinum</option>
                                            <option value="Master Black ">Master Black</option>
                                            <option value="Master Unicef Oro">Master Unicef Oro</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6" style="display: none;" id="autorizacion">
                                        <label for="exampleInputEmail1">Envio Autorización</label>
                                        <select class="form-control" id="autorizacion_select" onchange="autorizacion_selects()" aria-label="Default select example" name="autorizacion">
                                            <option disabled selected>Seleccione...</option>
                                            <option value="Correo Electonico">Correo Electonico</option>
                                            <option value="Whatsapp">Whatsapp</option>
                                            <option value="Presencial">Presencial</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6" style="display: none;" id="mail_send">
                                        <label for="exampleInputEmail1">Correo Electronico</label>
                                        <input type="mail"  class="form-control" name="mail_send" >
                                    </div>
                                    <div class="form-group col-sm-6" style="display: none;" id="number_whatsapp">
                                        <label for="exampleInputEmail1">Numero Whatsapp</label>
                                        <input type="text"  class="form-control" name="number_whatsapp" >
                                    </div>
                                </div>  
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <input type="hidden" name="base_id" value="<?php echo $_GET['id'] ?>"/>
                                <button id="submit" type="submit" disabled class="btn btn-success">Consultar</button>
                            </div>
                        </form>
                    </div>
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
                                    <textarea class="form-control" rows="3" placeholder="Esperando..." disabled style="height: 380px;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
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
<script>
    
    function textAreaAdjust(element) {
        element.style.height = "1px";
        element.style.height = (25+element.scrollHeight)+"px";
    }
</script>
<script>
    function tramite() {
        var x = document.getElementById("select_status").value;
        if (x === 'TCD') {
          document.getElementById("TCD_MASTERCARD").style.display = "block";
          document.getElementById("TCD_VISA").style.display = "block";
          document.getElementById("autorizacion").style.display = "none";
          document.getElementById("mail_send").style.display = "none";
          document.getElementById("number_whatsapp").style.display = "none";
          document.getElementById("submit").disabled=false;
        }else{
          document.getElementById("TCD_MASTERCARD").style.display = "none";
          document.getElementById("TCD_VISA").style.display = "none";
          document.getElementById("autorizacion").style.display = "block";
          document.getElementById("mail_send").style.display = "block";
          document.getElementById("number_whatsapp").style.display = "block";
          document.getElementById("submit").disabled=false;
        }
    }
    function autorizacion_selects() {
      var y = document.getElementById("autorizacion_select").value;
      if (y == "Correo Electonico") {
        document.getElementById("number_whatsapp").style.display = "none";
        document.getElementById("mail_send").style.display = "block";
      }else if(y == "Whatsapp"){
        document.getElementById("mail_send").style.display = "none";
        document.getElementById("number_whatsapp").style.display = "block";
      }else if(y == "Presencial"){
        document.getElementById("mail_send").style.display = "none";
        document.getElementById("number_whatsapp").style.display = "none";
      }
    }
</script>
</body>
</html>
