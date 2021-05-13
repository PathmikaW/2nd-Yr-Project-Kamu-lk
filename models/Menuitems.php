<?php

require_once ROOT . "/Database.php";

class Menuitems extends Database
{
    public function addFood($data, $file,$id)
    {
      $foodName = $data['foodName'];
      $descrption = $data['description'];
      $price = $data['price'];
      $image = $file;
      $vtype = $data['vtype'];

      $nameError =$data['Error'];
  
      if ($foodName == "") {
        $nameError= "Food name cannot be blank";
        return;
      }
  
  
      $sql = "INSERT INTO menu_item (item_name,description,price,vegetarian,image,res_id) VALUES ('$foodName', '$descrption', '$price','$vtype', '$image' , '$id')";
      if ($this->con->query($sql)) {
        return true;
      } else {
        return false;
      }
    }
  
    public function editFood($data, $file)
    {
      $foodName = $data['foodName'];
      $descrption = $data['description'];
      $price = $data['price'];
      $image = $file;
      $res_id = $data['user_id'];
      $vtype = $data['vtype'];
  
  
      // if ($foodName == "") {
      //   $_SESSION['menu_item']['item_name'] = "Food name cannot be blank";
      //   return;
      // }
  
      $id = $_GET['id'];
  
  
      $sql = "update menu_item set item_name = '$foodName', description = '$descrption', price = $price,vegetarian = $vtype, image = '$image', res_id = $res_id where id = $id ";
      if ($this->con->query($sql)) {
        return true;
      } else {
        return false;
      }
    }
  
    public function getMenuItems($id)
    {
      $sql = "select * from menu_item WHERE res_id='$id'";
      $query = $this->con->query($sql);
      $query->execute();
      $data = $query->fetchAll();
      return $data;
    }
    public function findMenuItem($itemName,$id){
      $sql = "select * from menu_item WHERE res_id='$id' and item_name = '$itemName'";
      $query = $this->con->query($sql);
      $query->execute();
      if ($query->rowCount() > 0){
        return true;
      }else{
        return false;
      }
    }
  
    public function getMenuItem($item_id)
    {
      $sql = "select * from menu_item where id = $item_id";
      $query = $this->con->query($sql);
      $query->execute();
      $data = $query->fetch();
      return $data;
    }

    public function deleteitems($id){
      $sql = "DELETE FROM menu_item WHERE id = '$id'";
      if($this->con->query($sql)){
        return true;
      }else{
        return false;
      }
    }

}    