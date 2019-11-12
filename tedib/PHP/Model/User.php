<?php
// model to interact with the user table

class User{
  // DB properties
  private $Conn;
  private $table="users";

  // user properties
  public $id;
  public $userName;
  public $userEmail;
  public $userPassword;

  // constructor that recives Conn to DB
  public function __construct($db){
    $this->conn=$db;
  }

  //get all users
  public function readAll(){

    $query='SELECT * from '.$this->table;

    // prep PDOStatement
    $stmt=$this->conn->prepare($query);
    // execute query
    $stmt->execute();

    //  $result=$stmt->fetchAll();
    return $stmt;
  }


  // read single user
  public function readSingleUser(){

    $query='SELECT * from '.$this->table.' WHERE id =:id';

    // prep PDOStatement
    $stmt=$this->conn->prepare($query);
    $stmt->bindParam('id',$this->id);
    // execute query
    $stmt->execute();

    return $stmt;


  }


  // create user
  public function createUser(){

    $query='INSERT INTO '.$this->table.'
    SET
    username=:username,
    email=:email,
    password=:password';

    $stmt=$this->conn->prepare($query);

    $stmt->bindParam('username',$this->userName);
    $stmt->bindParam('email',$this->userEmail);
    $stmt->bindParam('password',$this->userPassword);

    if($stmt->execute()){
      return true;
    }
    else{
      // errors
      echo "Error: ".$stmt->error();
      return false;
    }

  }


  // update user
  public function updateUser(){

    $query='UPDATE '.$this->table.'
    SET
    username=:username,
    email=:email,
    password=:password
    WHERE
    id=:id';

    $stmt=$this->conn->prepare($query);

    $stmt->bindParam('username',$this->userName);
    $stmt->bindParam('email',$this->userEmail);
    $stmt->bindParam('password',$this->userPassword);
    $stmt->bindParam('id',$this->id);

    if($stmt->execute()){
      return true;
    }
    else{
      // errors
      echo "Error: ".$stmt->error();
      return false;
    }

  }

  // delete user
  public function deleteUser(){

    $query='DELETE FROM '.$this->table.'
    WHERE id=:id';

    $stmt=$this->conn->prepare($query);

    $stmt->bindParam('id',$this->id);

    if($stmt->execute()){
      return true;
    }
    else{
      // errors
      echo "Error: ".$stmt->error();
      return false;
    }

  }


}
?>