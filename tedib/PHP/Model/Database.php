<?php
// database class  use to make connection using PDO
class Database{
// private properties
  private $host='localhost';
  private $db_name="www";
  private $user="root";
  private $password="root";


  private $conn;



  // connect function
  public function connect(){
    // set conn to null
    $this->conn=NULL;
    //
     $dsn="mysql:host=".$this->host.";dbname=".$this->db_name;
     
     $options = [PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES=> false,];

    try{
      $this->conn=new PDO($dsn,$this->user,$this->password,$options);
    }
    catch(PDOexception $e){
      echo ">Connection error: ".$e->getMessage();
    }
  return $this->conn;
  }



}
?>