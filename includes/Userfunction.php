<?php
 class Userfunction{
  private $pdo;
  public function __construct($pdo){
    $this->pdo = $pdo;
  }
  public function __destruct(){}

// userTable 정보 가저오는 Qurey
  public function seachQurey($sql){
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
  
// Category 함수
  public function categorychange($str){
    if($str == "toy")
      $str = 1001;
    else if($str == "elec")
      $str = 1002;
    else if($str == "food")
      $str = 1003;
    else
      $str = 1004;
    return $str;
  }
  
 }
 