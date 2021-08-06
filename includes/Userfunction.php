<?php
 class Userfunction{
  private $pdo;
  public function __construct($pdo){
    $this->pdo = $pdo;
  }
  public function __destruct(){}

// userTable 정보 가저오는 Qurey
  public function seachUser($sql){
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }
  
// Insert 함수
  public function insertData($sql, $param){
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($param);
    return $stmt;
  }
 }
 