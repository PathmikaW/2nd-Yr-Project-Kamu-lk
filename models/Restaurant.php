<?php

require_once ROOT . "/Database.php";

class Restaurant extends Database {
  public function show() {
    $sql = "select * from restaurant";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll();
    return $data;
  } 
  public function showById($id){
    $sql = "select * from restaurant WHERE id=$id";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll();
    return $data;
  }
}