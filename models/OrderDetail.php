<?php

require_once ROOT . "/Database.php";

class Order extends Database {


public function getForOrder($order_id){
  $sql= "SELECT order_detail.order_detail_id , menu_item.*  FROM order_detail  JOIN menu_item ON order_detail.item_id = menu_item.id";
  $query = $this->con->query($sql);
  $query->execute();
  $data = $query->fetchAll();
  return $data;
}


Public function create() {
    $user_id = $data['user_id'];
    $status = $data['status'];
    

    $sql = "INSERT INTO order (user_id , status) VALUES ('$user_id, $status')";
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function find($order_detail_id){
    $sql= "SELECT order_detail.* FROM order_detail WHERE order_detail.order_detail_id=$order_detail_id";
  $query = $this->con->query($sql);
  $query->execute();
  $data = $query->fetchAll();
  return $data;
  }

public function update() {
    $user_id = $data['user_id'];
    $status = $data['status'];
    

    $sql = "UPDATE order_detail SET qnt =$qnt , price=$price where order_detail_id = $order_detail_id ";
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }


  public function delete($id){
    $sql = "DELETE FROM order_detail WHERE order_detail__id = '$order_detail_id'";
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }


}