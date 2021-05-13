<?php

require_once ROOT . "/Database.php";

class Food extends Database {
    public function addFood($data) {
        $foodName = $data['foodName'];
        $calories = $data['calories'];
        $protein = $data['protein'];
        $fat = $data['fat'];
        
        $sql = "INSERT INTO food (foodName,calories,protein,fat) VALUES ('$foodName', '$calories', '$protein', '$fat')";
        if($this->con->query($sql)){
          return true;
        }else{
          return false;
        }
    }

    public function findFood($foodName) {
      $sql = "SELECT * FROM food WHERE foodName='$foodName'";
      $query = $this->con->query($sql);
      $query->execute();
    
      if ($query->rowCount() > 0){
        return true;
      }else{
        return false;
      }
    }

    public function findFoodById($id) {
      $sql = "SELECT * FROM food WHERE id='$id'";
      $query = $this->con->query($sql);
      $query->execute();
      $data = $query->fetch(PDO::FETCH_ASSOC);
      return $data;
    }

    public function show() {
      $sql = "select * from food";
      $query = $this->con->query($sql);
      $query->execute();
      $data = $query->fetchAll();
      return $data;
    } 

    public function update($data){
      $id = $data['id'];
      $foodName = $data['foodName'];
      $calories = $data['calories'];
      $protein = $data['protein'];
      $fat = $data['fat'];

      $sql = "UPDATE food SET id='$id',foodName='$foodName',calories='$calories',protein='$protein',fat='$fat' WHERE id='$id'";
        if($this->con->query($sql)){
          return true;
        }else{
          return false;
        }
    }

    public function delete($id){
      $sql = "DELETE FROM food WHERE id = '$id'";
      if($this->con->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function countFood(){
      $sql = "SELECT * FROM food";
      $query = $this->con->query($sql);
      $query->execute();
      $count = $query->rowCount();
      return $count;
    }
  }