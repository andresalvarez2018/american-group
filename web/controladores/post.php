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
    if (isset($_GET['idchat']))
    {
    $idchat=$_GET['idchat'];
      //Mostrar un post
      $sql = $dbConn->prepare("SELECT c.send_user_id,c.receiver_user_id,u.complete_name as send ,u1.complete_name as receiver,c.message,c.created_at,u.url_image,u1.url_image FROM `chat` as c inner join user as u on c.send_user_id=u.id inner join user as u1 on c.receiver_user_id=u1.id WHERE (c.`send_user_id` = $id_usuario AND c.`receiver_user_id` = $idchat) or (c.`send_user_id` = $idchat AND c.`receiver_user_id` = $id_usuario) order by c.created_at asc");
      $sql->bindValue(':id', $_GET['idchat']);
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll()  );
      exit();
	  }
    else {
      //Mostrar lista de post
      $sql = $dbConn->prepare("SELECT * FROM posts");
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