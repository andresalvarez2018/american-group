<?php
 session_start();
include "config.php";
include "utils.php";
$dbConn =  connect($db);
$id_usuario=$_SESSION['id'];
$role_id=$_SESSION["role_id"];
/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id']))
    {
      //Mostrar un post
      $sql = $dbConn->prepare("SELECT u.id,u.complete_name FROM details_group_jobs as dgj inner join user as u on u.id=dgj.user_id where dgj.group_jobs_id=:id and u.role_id=1 and u.is_active=1");
      $sql->bindValue(':id', $_GET['id']);
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll()  );
      exit();
	  }
    else {
      //Mostrar lista de post
      $sql = $dbConn->prepare("SELECT u.id,u.complete_name FROM details_group_jobs as dgj inner join user as u on u.id=dgj.user_id and u.role_id=1 and u.is_active=1");
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
      
      
	 }
}
//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$id = $_GET['id'];
  $statement = $dbConn->prepare("DELETE FROM user where id=:id");
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
    $sql = "";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}
//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
?>