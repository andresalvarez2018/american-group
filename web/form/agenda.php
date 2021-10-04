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
                    <p>Agendamiento</p>
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
            <h1 class="m-0">Agendamiento</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../controladores/router.php">Home</a></li>
              <li class="breadcrumb-item active">Gestionar</li>
              <li class="breadcrumb-item active">Agendamiento</li>
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
                        <!-- form start -->
              <div class="card card-primary">
                  <div class="card-header">
                      <h3 class="card-title">Información</h3>
                  </div>
                  <form id="quickForm" enctype="multipart/form-data" method="POST" action="../controladores/scheduling.php">
                      <div class="card-body">
                          <div class="row">
                              <div class="form-group col-sm-6 ">
                                  <label for="exampleInputEmail1">Fecha</label>
                                  <input type="date" name="date" class="form-control" id="date"  required>
                              </div>
                              <div class="form-group col-sm-6 ">
                                  <label for="exampleInputEmail1">Proceso</label>
                                  <select class="form-control" aria-label="Default select example" name="process" required>
                                      <option disabled selected>Seleccione...</option>
                                      <option value="TCD">TCD</option>
                                      <option value="PP">PP</option>
                                  </select>
                              </div>
                              <div class="form-group col-sm-6 ">
                                  <label for="exampleInputEmail1">Metodo</label>
                                  <select class="form-control" aria-label="Default select example" name="method" required>
                                      <option disabled selected>Seleccione...</option>
                                      <option value="Tradicional">Tradicional</option>
                                      <option value="Digital">Digital</option>
                                  </select>
                              </div>
                              <div class="form-group col-sm-12 ">
                                  <label for="exampleInputEmail1">Dirrección</label>
                                  <input type="text" name="address" class="form-control" id="address" placeholder="Dirrección" required>
                              </div>
                              <div class="form-group col-sm-6 ">
                                  <label for="exampleInputEmail1">Ciudad</label>
                                  <input type="text" name="city" class="form-control" id="city" placeholder="Ciudad" required>
                              </div>
                              <div class="form-group col-sm-6 ">
                                  <label for="exampleInputEmail1">Lugar Visita</label>
                                  <input type="text" name="place_visit" class="form-control" id="place_visit" placeholder="Lugar Visita" required>
                              </div>
                              <div class="form-group col-sm-6 ">
                                  <label for="exampleInputEmail1">Jornada</label>
                                  <select class="form-control" aria-label="Default select example" name="trip" required>
                                      <option disabled selected>Seleccione...</option>
                                      <option value="AM">AM</option>
                                      <option value="PM">PM</option>
                                  </select>
                              </div>
                              <div class="form-group col-sm-6 ">
                                  <label for="exampleInputEmail1">Productos</label>
                                  <input type="text" name="products" class="form-control" id="products" placeholder="Productos" required>
                              </div>
                              <div class="form-group col-sm-6 ">
                                  <label for="exampleInputEmail1">Compra de cartera</label>
                                  <select class="form-control" name="purchase_portfolio" id="purchase_portfolio" aria-label="Default select example" name="trip" required onchange=purchase_change()>
                                      <option disabled selected>Seleccione...</option>
                                      <option value="Si">Si</option>
                                      <option value="No">No</option>
                                  </select>
                              </div>
                              <div class="form-group col-sm-6" style="display:none" id="banco_div">
                                  <label for="exampleInputEmail1">Banco Asociado</label>
                                  <input type="text" name="banco" class="form-control" id="banco" placeholder="Banco" >
                              </div>
                              <div class="form-group col-sm-6 " style="display:none" id="score_div">
                                  <label for="exampleInputEmail1">Puntaje</label>
                                  <input type="text" name="score" class="form-control" id="score" placeholder="Puntaje" >
                              </div>
                              <div class="form-group col-sm-6 " style="display:none" id="purchase_value_div">
                                  <label for="exampleInputEmail1">Valor Compra</label>
                                  <input type="text" name="purchase_value" class="form-control" id="purchase_value" placeholder="Valor Compra" >
                              </div>
                              <div class="form-group col-sm-6 ">
                                  <label for="exampleInputEmail1">Observaciones</label>
                                  <textarea name="observation" class="form-control" id="exampleInputEmail1" placeholder="observation" required></textarea>
                              </div>
                          </div>  
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                          <input type="hidden" name="base_id" value="<?php echo $_GET['id'] ?>"/>
                          <button type="submit" class="btn btn-success">Guardar</button>
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
<script>
    
    function textAreaAdjust(element) {
        element.style.height = "1px";
        element.style.height = (25+element.scrollHeight)+"px";
    }

    function purchase_change() {
      var x = document.getElementById("purchase_portfolio").value;
      switch (x) {
        case 'Si':
            document.getElementById("banco_div").style.display = "block";
            document.getElementById("score_div").style.display = "block";
            document.getElementById("purchase_value_div").style.display = "block";

            document.getElementById("banco").required = true;
            document.getElementById("score").required = true;
            document.getElementById("purchase_value").required = true;
          break;

        case 'No':
            document.getElementById("banco_div").style.display = "none";
            document.getElementById("score_div").style.display = "none";
            document.getElementById("purchase_value_div").style.display = "none";
            document.getElementById("banco").required = false;
            document.getElementById("score").required = false;
            document.getElementById("purchase_value").required = false;
          break;
      }
    }
</script>
</body>
</html>
