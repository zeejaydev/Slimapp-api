<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->options('/{routes:.+}', function ($request, $response, $args) {
  return $response;
});

//get all events
$app->get('/api/events', function (Request $request, Response $respones){
  $sql = "SELECT * FROM vacs ORDER BY id";
  $data = array();
  try{
    //get the db object
    $db = new db();
    //connect
    $db = $db->connect();

   
    $stmt = $db->query($sql);
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $db = null;
    
    foreach($events as $row){
      $data [] = array (
        'id'  => $row['id'],
        'title'   => $row["title"],
        'start'   => $row["start_event"],
        'end'   => $row["end_event"],
        'color'   => $row["color_event"],
       
      );
    };
    echo json_encode($data);

  }catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMessage().'}';
  }
});

//add event
$app->post('/api/events/add', function (Request $request, Response $respones){

  if(isset($_POST["title"])){
    $sql = "INSERT INTO vacs (title, start_event, end_event, color_event) VALUES (:title, :start_event, :end_event, :color_event)";
  try{
    //get the db object
    $db = new db();
    //connect
    $db = $db->connect();

   
    $stmt = $db->prepare($sql);
    $stmt->execute(
      array(
        ':title'  => $_POST['title'],
        ':start_event'  =>  $_POST['start'],
        ':end_event'  =>  $_POST['end'],
        ':color_event'  =>  $_POST['color']
      )
    );
  }catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMessage().'}';
  }
  }
});

//update event
$app->post('/api/events/update', function (Request $request, Response $respones){

  if(isset($_POST["id"])){
    $sql = "UPDATE vacs SET title=:title, start_event=:start_event, end_event=:end_event WHERE id=:id";
  try{
    //get the db object
    $db = new db();
    //connect
    $db = $db->connect();

   
    $stmt = $db->prepare($sql);
    $stmt->execute(
      array(
        ':title'  => $_POST['title'],
        ':start_event'  =>  $_POST['start'],
        ':end_event'  =>  $_POST['end'],
        ':id'   =>  $_POST['id']
      )
    );
  }catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMessage().'}';
  }
  }
});

//delete event
$app->post('/api/events/delete', function (Request $request, Response $respones){

  if(isset($_POST["id"])){
    $sql = "DELETE from vacs WHERE id=:id";
  try{
    //get the db object
    $db = new db();
    //connect
    $db = $db->connect();

   
    $stmt = $db->prepare($sql);
    $stmt->execute(
      array(
        ':id'   =>  $_POST['id']
      )
    );
  }catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMessage().'}';
  }
  }
});