<?php
    session_start();
    
    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
        exit;
    }
    
    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    $nombre_usuario=$_SESSION['user'];
    $id_usuario=$_SESSION['id'];

    $mysqli = new mysqli("localhost","root","","db");

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
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <style type="text/css">
    .global {
      height: 550px;
      border: 1px solid #ddd;
      background: #f1f1f1;
      overflow-y: scroll;
    }
  </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

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
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">Menu</li>
            <li class="nav-item active">
                <a href="./index.php" class="nav-link ">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="./central.php" class="nav-link">
                    <i class="nav-icon fas fa-code-branch"></i>
                    <p>Central de Riesgo</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="./consulta.php" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Consulta</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="./chat.php" class="nav-link active">
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
            <h1 class="m-0">Chat interactivo</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../controladores/router.php">Home</a></li>
              <li class="breadcrumb-item active">Chat </li>
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
              <div class="card-body" style=" height: 600px;">
                <div class="row">
                  <div class="col-4">
                    <!-- Contacts are loaded here -->
                    <div class="global">
                      <ul class="contacts-list">
                      <?php
                        // Perform query
                        if ($result_user_chat = $mysqli -> query("SELECT * FROM `user` WHERE `id` NOT IN ($id_usuario)")) {
                          while ($reg_user_chat = $result_user_chat->fetch_array()) {
                            $reg_user_chat_url_image=$reg_user_chat['url_image'];
                            $reg_user_chat_complete_name=$reg_user_chat['complete_name'];
                            $reg_user_chat_id=$reg_user_chat['id'];
                         
                      ?>
                        <li style="background: #353a40;" >
                          <a href="#" class="item_chat" id=<?php echo $reg_user_chat_id ?>>
                            <img class="contacts-list-img" src="<?php echo $reg_user_chat_url_image ?>">
                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                <?php echo $reg_user_chat_complete_name ?>
                                <small class="contacts-list-date float-right">
                                <?php 
                                  // Perform query
                                  if ($result_user_chat_last_date= $mysqli -> query("SELECT * FROM `chat` WHERE (`send_user_id` = $id_usuario AND `receiver_user_id` = $reg_user_chat_id) or (`send_user_id` = $reg_user_chat_id AND `receiver_user_id` = $id_usuario) order by created_at desc limit 1")) {
                                    while ($reg_user_chat_date = $result_user_chat_last_date->fetch_array()) {
                                      $reg_user_chat_last_date=$reg_user_chat_date['created_at'];
                                      $date = new DateTime($reg_user_chat_last_date);
                                      echo date_format($date, 'd/m/Y');
                                    }
                                  }
                                ?>
                                </small>
                              </span>
                              <span class="contacts-list-msg">
                              <?php 
                                // Perform query
                                if ($result_user_chat_last_message= $mysqli -> query("SELECT * FROM `chat` WHERE (`send_user_id` = $id_usuario AND `receiver_user_id` = $reg_user_chat_id) or (`send_user_id` = $reg_user_chat_id AND `receiver_user_id` = $id_usuario) order by created_at desc limit 1")) {
                                  while ($reg_user_chat_message = $result_user_chat_last_message->fetch_array()) {
                                    $reg_user_chat_last_message=$reg_user_chat_message['message'];
                                    echo substr($reg_user_chat_last_message,0,20);
                                  }
                                }
                              ?>
                              </span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <?php
                           }
                           // Free result set
                           $result_user_chat -> free_result();
                         }
                        ?>
                        <!-- End Contact Item -->
                      </ul>
                      <!-- /.contacts-list -->
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="card card-danger direct-chat direct-chat-danger" style="height: 550px;">
                      <div class="card-body">
                        <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages" id="all_chat" style="height: 480px;">
                          <!-- Message. Default to the left -->
                          
                          <!-- /.direct-chat-msg -->  
                          <!-- Message to the right -->
                          
                          <!-- /.direct-chat-msg -->
                        </div>
                        <!--/.direct-chat-messages-->
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <form action="../controladores/post.php" method="post">
                          <div class="input-group">
                            <input type="text" name="message" placeholder="Escribir mensaje" class="form-control" id="message_input_text">
                            <input type="hidden" name="chatid" id="chatid">
                            <span class="input-group-append">
                              <button type="submit" class="btn btn-primary">Enviar</button>
                            </span>
                          </div>
                        </form>
                      </div>
                      <!-- /.card-footer-->
                    </div>
                    <!--/.direct-chat -->
                  </div>
                </div>
              </div>
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
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 ', '25 ', '50 ', 'Mostrar todo' ]
        ],
        buttons: [
            'pageLength',
            {
                text: 'Nuevo Usuario',
                action: function ( e, dt, node, config ) {  
                    window.location.href = "./new.php"
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
<script>
window.onload = function () {
    var test =document.querySelectorAll('.item_chat')
    for(var i=0;i<test.length;i++){
        test[i].addEventListener("click", function(){
            var id_chat= this.id;
            var id_user_logueado= <?php echo $id_usuario ?>;

            fetch('../controladores/post.php?idchat='+id_chat,{
                  method: 'PUT'
              })
            .then(response => response.json())
            .then(data => console.log(data));

            fetch('../controladores/post.php?idchat='+id_chat)
            .then(response => response.json())
            .then(data => getchat(data));

            function getchat(data) {
              document.getElementById("all_chat").innerHTML="";
              document.getElementById("message_input_text").value = "";  
              document.getElementById("chatid").value = id_chat;  
                for (let index = 0; index < data.length; index++) {
                  const element = data[index];
                  if (element.receiver_user_id == id_chat) {
                    $('#all_chat').append("<div class='direct-chat-msg'><div class='direct-chat-infos clearfix'><span class='direct-chat-name float-left'>"+element.send+"</span><span class='direct-chat-timestamp float-right'>"+element.created_at+"</span></div><!-- /.direct-chat-infos --><img class='direct-chat-img' src='"+element.url_image+"' alt='message user image'><!-- /.direct-chat-img --><div class='direct-chat-text' >"+element.message+"</div><!-- /.direct-chat-text --></div>");
                  }else{
                    $('#all_chat').append("<div class='direct-chat-msg right'><div class='direct-chat-infos clearfix'><span class='direct-chat-name float-right'>"+element.send+"</span><span class='direct-chat-timestamp float-left'>"+element.created_at+"</span></div><!-- /.direct-chat-infos --><img class='direct-chat-img' src='"+element.url_image+"' alt='message user image'><!-- /.direct-chat-img --><div class='direct-chat-text' style='border-color: #007bff;background-color: #007bff;'>"+element.message+"</div><!-- /.direct-chat-text --></div>"); 
                  }
                }
                var objDiv = document.getElementById("all_chat");
                objDiv.scrollTop = objDiv.scrollHeight;
            }
            
        }); 
    }

    let params = new URLSearchParams(location.search);
    if (params.get('chatid')) {
      var chatid = params.get('chatid');
      getchatdatanew(chatid);
    }
    
    function getchatdatanew(params) {
      var id_chat= params;
      var id_user_logueado= <?php echo $id_usuario ?>;

      fetch('../controladores/post.php?idchat='+id_chat,{
                  method: 'PUT'
              })
      .then(response => response.json())
      .then(data => console.log(data));

      fetch('../controladores/post.php?idchat='+id_chat)
        .then(response => response.json())
        .then(data => getchatnew(data));

        function getchatnew(data) {
          document.getElementById("all_chat").innerHTML="";
          document.getElementById("message_input_text").value = "";  
          document.getElementById("chatid").value = id_chat;  
            for (let index = 0; index < data.length; index++) {
              const element = data[index];
              if (element.receiver_user_id == id_chat) {
                $('#all_chat').append("<div class='direct-chat-msg'><div class='direct-chat-infos clearfix'><span class='direct-chat-name float-left'>"+element.send+"</span><span class='direct-chat-timestamp float-right'>"+element.created_at+"</span></div><!-- /.direct-chat-infos --><img class='direct-chat-img' src='"+element.url_image+"' alt='message user image'><!-- /.direct-chat-img --><div class='direct-chat-text' >"+element.message+"</div><!-- /.direct-chat-text --></div>");
              }else{
                $('#all_chat').append("<div class='direct-chat-msg right'><div class='direct-chat-infos clearfix'><span class='direct-chat-name float-right'>"+element.send+"</span><span class='direct-chat-timestamp float-left'>"+element.created_at+"</span></div><!-- /.direct-chat-infos --><img class='direct-chat-img' src='"+element.url_image+"' alt='message user image'><!-- /.direct-chat-img --><div class='direct-chat-text' style='border-color: #007bff;background-color: #007bff;'>"+element.message+"</div><!-- /.direct-chat-text --></div>"); 
              }
            }
            var objDiv = document.getElementById("all_chat");
            objDiv.scrollTop = objDiv.scrollHeight;
        }
    }

    
}   


</script>
</body>
</html>
<?php
$mysqli -> close();
?>