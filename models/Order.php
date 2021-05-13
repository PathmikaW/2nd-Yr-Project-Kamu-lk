<?php

require_once ROOT . "/Database.php";

class Order extends Database {
  public function showRestaurant() {
    $sql = "select * from seller";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll();
    return $data;
 }

 public function showMenu($id) {

    $sql="SELECT distinct * FROM menu_item,seller WHERE seller.res_id = $id and seller.res_id = menu_item.res_id";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll();
    return $data;
 }
  public function countPost(){

    $sql = "SELECT * FROM post WHERE post_id= '1'";
    $query = $this->con->query($sql);
    $query->execute();
    $count = $query->rowCount();
    return $count;

  }

  public function countOrder(){

    $sql = "SELECT * FROM post WHERE post_id='1'";
    $query = $this->con->query($sql);
    $query->execute();
    $count = $query->rowCount();
    return $count;
      
  }

  public function countReqMealplan(){
    $sql = "SELECT * FROM reply WHERE users_id='1'";
    $query = $this->con->query($sql);
    $query->execute();
    $count = $query->rowCount();
    return $count;
    
    }

public function findItemById($id) {
        //$sql="SELECT distinct * FROM menu_item,cart WHERE cart.item_id = $id and cart.item_id = menu_item.id";
        $sql = "SELECT * FROM menu_item WHERE id='$id'";
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

public function addCart($data) {
    $item_id = $data['id'];
    $item_name= $data['item_name'];
    $price= $data['price'];


    $sql = "INSERT INTO cart (item_id,item_name , price) VALUES ( '$item_id', '$item_name', '$price')";
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
}
   public function showCart($id) {
    $sql = "SELECT * FROM cart";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll();
    return $data;
  }
}















