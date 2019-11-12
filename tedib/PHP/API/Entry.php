<?php
// acces control
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');

require "../Model/Functions.php";


switch ($_SERVER['REQUEST_METHOD']) {

  case 'GET':
  if(isset($_GET['id'])){
    readSingleUser();
  }
  else{
    readAllUsers();
  }


  break;


  case 'POST':


  $myBody=file_get_contents('php://input');

  if($myBody){

    // validate json format
    $jsonError=jsonValidate($myBody);


    if ($jsonError === 0) {
      // JSON is valid
      createUser();
    }
    else{
      echo json_encode(['message'=>$jsonError]);

    }

  }
  else
  {
    echo json_encode(['message'=>'Unknown data error']);
  }

  break;


  case 'PUT':
  $myBody=file_get_contents('php://input');

  if($myBody){

    // validate json format
    $jsonError=jsonValidate($myBody);


    if ($jsonError === 0) {
      // JSON is valid
      updateUser();
    }
    else{
      echo json_encode(['message'=>$jsonError]);

    }

  }
  else
  {
    echo json_encode(['message'=>'Unknown data error']);
  }

  break;
  case 'DELETE':
  deleteUser();
  echo json_encode(['response'=>'Deleted!']);
  break;

  default:
  // invalid req method
  header("HTTP/1.0 405 Method Not Allowed");
  break;
}


?>