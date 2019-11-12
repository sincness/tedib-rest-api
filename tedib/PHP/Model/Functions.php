<?php

include_once'../Model/Database.php';
include_once'../Model/User.php';



//--------------- functions ----------------------------
// Create user
function createUser(){

  // make DB object
  $database=new Database();
  $db=$database->connect();

  // maker usermodel object
  $userModel=new User($db);

  // get post Data
  $postData=json_decode(file_get_contents("php://input"));

  // set data to the model
  $userModel->userName=$postData->username;
  $userModel->userEmail=$postData->useremail;
  $userModel->userPassword=$postData->userpassword;
  // run create user
  if($userModel->createUser()){
    echo json_encode(['message'=>'User created']);
  }
  else{
    echo json_encode(['message'=>'User not created!']);
  }

}


//----------------------------------------------------
// Delete User
function deleteUser(){

  // make DB object
  $database=new Database();
  $db=$database->connect();

  // maker usermodel object
  $userModel=new User($db);

  // get post Data
  $postData=json_decode(file_get_contents("php://input"));

  // set data to the model

  $userModel->id=$postData->id;

  // run update user
  if($userModel->deleteUser()){
    echo json_encode(['message'=>'User deleted']);
  }
  else{
    echo json_encode(['message'=>'User not deleted!']);
  }

}

//----------------------------------------------------------
// Read all users

function readAllUsers(){
  // make DB object
  $database=new Database();
  $db=$database->connect();

  // maker usermodel object
  $userModel=new User($db);

  $result=$userModel->readAll();

  $num=$result->rowCount();
  //
  if($num>0){
    $returnData=$result->fetchAll();
    // write json to the dom
    echo json_encode($returnData);

  }
  else{
    // no posts
    echo json_encode(['message'=>'no users found!']);
  }
}

//----------------------------------------------------------
// Read one user

function readSingleUser(){
  // make DB object
  $database=new Database();
  $db=$database->connect();

  // maker usermodel object
  $userModel=new User($db);

  $userModel->id= $_GET['id'];

  //get data

  $result=$userModel->readSingleUser();

    $returnData=$result->fetch();

  if($returnData){
    // write json to the dom
    echo json_encode($returnData);
  }
  else{
    // no posts
    echo json_encode(['message'=>'no users found!']);
  }
}

//----------------------------------------------------------
// Update user

function updateUser(){

  // make DB object
  $database=new Database();
  $db=$database->connect();

  // maker usermodel object
  $userModel=new User($db);

  // get post Data
  $postData=json_decode(file_get_contents("php://input"));

  // set data to the model

  $userModel->id=$postData->id;
  $userModel->userName=$postData->username;
  $userModel->userEmail=$postData->useremail;
  $userModel->userPassword=$postData->userpassword;
  // run update user
  if($userModel->updateUser()){
    echo json_encode(['message'=>'User updated']);
  }
  else{
      echo json_encode(['message'=>'User not updated!']);
  }

}


//--------------------------------------------------------------
//service functions

function jsonValidate($string)
{
    // try to decode  JSON
    $result = json_decode($string);

    // switch and check possible errors
    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            $error = 0; // JSON is valid // No error has occurred
            break;
        case JSON_ERROR_DEPTH:
            $error = 'The maximum stack depth has been exceeded.';
            break;
        case JSON_ERROR_STATE_MISMATCH:
            $error = 'Invalid or malformed JSON.';
            break;
        case JSON_ERROR_CTRL_CHAR:
            $error = 'Control character error, possibly incorrectly encoded.';
            break;
        case JSON_ERROR_SYNTAX:
            $error = 'Syntax error, malformed JSON.';
            break;
        // PHP >= 5.3.3
        case JSON_ERROR_UTF8:
            $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
            break;
        // PHP >= 5.5.0
        case JSON_ERROR_RECURSION:
            $error = 'One or more recursive references in the value to be encoded.';
            break;
        // PHP >= 5.5.0
        case JSON_ERROR_INF_OR_NAN:
            $error = 'One or more NAN or INF values in the value to be encoded.';
            break;
        case JSON_ERROR_UNSUPPORTED_TYPE:
            $error = 'A value of a type that cannot be encoded was given.';
            break;
        default:
            $error = 'Unknown JSON error occured.';
            break;
    }


    return $error;
}


?>