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
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
        <li class="nav-item ">
                <a href="./index.php" class="nav-link ">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="./bases.php" class="nav-link active">
                    <i class="nav-icon fas fa-database"></i>
                    <p>Bases</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="./usuarios.php" class="nav-link ">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Usuarios</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="./upgrade.php" class="nav-link">
                    <i class="nav-icon fas fa-download"></i>
                    <p>Descargar Datos</p>
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
            <h1 class="m-0">Bases</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../controladores/router.php">Home</a></li>
              <li class="breadcrumb-item active">Bases</li>
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
        if (isset($_GET['sa'])) {
          $valor=$_GET['sa'];
          switch ($valor) {
            case '1':
        ?>
          <div>
            <div class="alert alert-warning alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h5><i class="icon fas fa-check"></i>Cuidado!!</h5>
              Se ha desactivado la base: <strong> <?php echo $_GET['name_base'] ?> </strong>
            </div>
          </div>
        <?php
              break;

            case '2':
        ?>
          <div>
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h5><i class="icon fas fa-check"></i>Enhorabuena!!</h5>
              Se ha activado la base: <strong> <?php echo $_GET['name_base'] ?> </strong>
            </div>
          </div>
        <?php
              break;
            
          }
        ?>
        
        <?php
        }
        ?>
        <div class="card">
          <form action="./bases.php" method="POST">
            <div class="form-group">
              <label style="padding-left: 36‒;margin-left: 10px;">Seleccion la Campaña</label>
              <select class="form-control select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true" name="campana_select_id">
                <option disabled selected="selected" data-select2-id="14">Campañas...</option>
                  <?php
                  if ($result_campana = $mysqli -> query("SELECT * FROM `campana`")) {
                    while ($reg_campana = $result_campana->fetch_array()) {
                  ?>
                    <option value="<?php echo $reg_campana['id']?>"><?php echo $reg_campana['name'] ?></option>
                  <?php
                    }
                  }
                  ?>
              </select>
              <button type="submit" class="btn btn-block btn-outline-primary ">Consultar</button>
            </div>
          </form>
        </div>
          
            <!-- Info boxes -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listado de bases de datos </h3>
                </div>
                <!-- /.card-header -->
                
                <div class="card-body">
                  <table id="list_usuarios" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre base</th>
                            <th>Cantidad Registros</th>
                            <th>Asignados</th>
                            <th>Procesados</th>
                            <th>Estado</th>
                            <th>Grupos de trabajo</th>
                            <th>**</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_REQUEST['campana_select_id'])) {
                          $id_camapana=$_REQUEST['campana_select_id'];
                          if ($result = $mysqli -> query("SELECT * FROM `campana` where id=$id_camapana")) {
                            while ($reg = $result->fetch_array()) {
                              $prefijo=$reg['prefijo'];
                              $id_camapana=$reg['id'];
                            }
                          }
                        }else {
                          $prefijo='';
                        }

                        if ($prefijo !== '') {
                          if ($result = $mysqli -> query("SELECT ba.name_base,ba.id,ba.is_active FROM `base_$prefijo` as b inner join bases_archivo as ba on ba.id = b.archivo_id where ba.campana_id=$id_camapana group by ba.id")) {
                            while ($reg = $result->fetch_array()) {
                            ?>
                                <tr>
                                    <td><?php echo $reg['name_base'] ?></td>
                                    <td>
                                      <?php 
                                        $reg_id=$reg['id'];
                                        if ($result_cant_reg = $mysqli -> query("SELECT COUNT(*)  as total  FROM `base_$prefijo` WHERE `archivo_id` = $reg_id")) {
                                          while ($reg_cant_reg = $result_cant_reg->fetch_array()) {
                                            echo $reg_cant_reg['total'];
                                          }
                                        }
                                      ?>
                                    </td>
                                    <td>
                                      <?php 
                                        $reg_id=$reg['id'];
                                        if ($result_cant_reg_asig = $mysqli -> query("SELECT count(*) as total FROM `base_$prefijo` WHERE `archivo_id` = $reg_id and (assigned is not null and assigned<>0)")) {
                                          while ($reg_cant_reg_asig = $result_cant_reg_asig->fetch_array()) {
                                            echo $reg_cant_reg_asig['total'];
                                          }
                                        }
                                      ?>
                                    </td>
                                    <td>
                                      <?php 
                                        $reg_id=$reg['id'];
                                        if ($result_cant_reg_proc = $mysqli -> query("SELECT count(*) as total FROM `base_$prefijo` WHERE `archivo_id` = $reg_id and (assigned is not null and assigned<>0) and (processed is not null and processed<>0)")) {
                                          while ($reg_cant_reg_proc = $result_cant_reg_proc->fetch_array()) {
                                            echo $reg_cant_reg_proc['total'];
                                          }
                                        }
                                      ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if ($reg['is_active'] == "1") {
                                                echo "Activo";
                                            }elseif ($reg['is_active'] == "0") {
                                                echo "Desactivada";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                      <?php 
                                        $reg_id=$reg['id'];
                                        if ($bases_group_job = $mysqli -> query("SELECT name FROM `bases_group_job` as bgj inner join group_jobs as gj on bgj.group_jobs_id=gj.id WHERE bgj.base_id=$reg_id group by bgj.group_jobs_id ")) {
                                          while ($reg_group_jobs = $bases_group_job->fetch_array()) {
                                            echo '<span class="right badge badge-warning">'.$reg_group_jobs['name'].'</span>';
                                          }
                                        }
                                      ?>
                                    </td>
                                    <td>
                                      <?php 
                                        if ($reg['is_active'] == "1") {
                                      ?>      
                                        <div class="btn-group btn-expand">
                                            <button type="button" class="btn btn-info">Acciones</button>
                                            <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                <span class="sr-only">Acciones sobre el usuario</span>
                                            </button>
                                            <div class="dropdown-menu " role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(68px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item" href="../controladores/desactivar_base.php?id=<?php echo $reg['id'] ?>">Desactivar Base</a>
                                                <a class="dropdown-item" href="./detalle_base.php?id=<?php echo $reg['id'] ?>">Detalle Base</a>
                                                <a class="dropdown-item" href="./assigned_group_jobs.php?id=<?php echo $reg['id'] ?>">Asignar Grupo Trabajo</a>
                                            </div>
                                        </div>
                                      <?php   
                                        }elseif ($reg['is_active'] == "0") {
                                      ?> 
                                        <div class="btn-group btn-expand">
                                            <button type="button" class="btn btn-info">Acciones</button>
                                            <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                <span class="sr-only">Acciones sobre el usuario</span>
                                            </button>
                                            <div class="dropdown-menu " role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(68px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item" href="../controladores/activar_base.php?id=<?php echo $reg['id'] ?>">Activar Base</a>
                                                <a class="dropdown-item" href="./detalle_base?id=<?php echo $reg['id'] ?>">Detalle Base</a>
                                            </div>
                                        </div>
                                      <?php  
                                        }
                                      ?>   
                                        
                                    </td>
                                </tr>
                        <?php
                            }
                          // Free result set
                          $result -> free_result();
                          }
                        }
                        ?>    
                    </tbody>
                    <tfoot>
                      <tr>
                          <th>Nombre base</th>
                          <th>Cantidad Registros</th>
                          <th>Asignados</th>
                          <th>Procesados</th>
                          <th>Estado</th>
                          <th>Grupos de trabajo</th>
                          <th>**</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard2.js"></script>

<script>
  $(function () {
   
    $('#list_usuarios').DataTable({
        responsive:true,
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 ', '25 ', '50 ', 'Mostrar todo' ]
        ],
        buttons: [
            'pageLength',
            {
                text: 'Subir Base de Datos',
                action: function ( e, dt, node, config ) {  
                    window.location.href = "./base_new.php"
                }
            }
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
            buttons: {
                pageLength: {
                    _: "Mostrando %d Registros",
                    '-1': "Mostrar todo"
                }
            }
        }
    });
  });
</script>
</body>
</html>
<?php
$mysqli -> close();
?>