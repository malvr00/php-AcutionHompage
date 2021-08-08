<?php
 class Userfunction{
  private $pdo;
  public function __construct($pdo){
    $this->pdo = $pdo;
  }
  public function __destruct(){}

// userTable User Qurey
  public function seachUser($sql){
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }
  
// Insert Table
  public function insertData($sql, $param){
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($param);
    return $stmt;
  }
 }
 
