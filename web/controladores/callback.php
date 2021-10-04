<?php
 session_start();
include "config.php";
include "utils.php";
$dbConn =  connect($db);
$id_usuario=$_SESSION['id'];
$role_id=$_SESSION["role_id"];
$campana_id=$_SESSION["campana_id"];
/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['start']))
    {
    $start=$_GET['start'];
    $end=$_GET['end'];
      //Mostrar un post
      $sql = $dbConn->prepare("SELECT callback as start,callback as end ,'Nombre Protegido' as title, identification, phone_number,observation,id as base_id FROM `base_occidente` WHERE `status_id` = 2 and user_assigned=$id_usuario");
      $sql->bindValue(':id', $_GET['start']);
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll()  );
      exit();
	  }
    elseif (isset($_GET['id'])) {

      //Mostrar lista de post
      $sql = $dbConn->prepare("SELECT callback as start FROM `base_occidente` WHERE `status_id` = 2 and user_assigned=$id_usuario");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll()  );
      exit();
	}
}
// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $input = $_POST;
    $sql = "INSERT INTO chat
          (send_user_id, receiver_user_id, message,`read_message`)
          VALUES
          ($id_usuario, :chatid, :message,0)";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $dbConn->lastInsertId();
    if($postId)
    {
      switch ($role_id) {
        case '1':
          header('Location: ../asesor/chat.php?chatid='.$_POST['chatid']);
          exit;
        break;

        case '2':
          header('Location: ../admin/chat.php?chatid='.$_POST['chatid']);
          exit;
        break;

        case '3':
          header('Location: ../supervisor/chat.php?chatid='.$_POST['chatid']);
          exit;
        break;

        case '4':
            header('Location: ../backoffice/chat.php?chatid='.$_POST['chatid']);
            exit;
          break;
        
        
      }
      header('Location: ../admin/chat.php?chatid='.$_POST['chatid']);
      exit;
	 }
}
//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$id = $_GET['id'];
  $statement = $dbConn->prepare("DELETE FROM posts where id=:id");
  $statement->bindValue(':id', $id);
  $statement->execute();
	header("HTTP/1.1 200 OK");
	exit();
}
//Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    $postId = $input['idchat'];
    $fields = getParams($input);
    $sql = "UPDATE chat SET `read_message` = '1' WHERE `send_user_id` = $postId AND `receiver_user_id` = $id_usuario ";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}
//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
?>