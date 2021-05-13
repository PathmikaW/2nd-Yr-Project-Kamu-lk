<?php

require_once ROOT . "/Database.php";

class Mealplan extends Database {
    public function showRequest() {
        $sql = "select * from req_meal_plans WHERE status='0'";
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
      } 

    public function showSent() {
        $sql = "select * from req_meal_plans WHERE status='1'";
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
      } 

    public function countSentPlans() {
        $sql = "select * from req_meal_plans WHERE status='1'";
        $query = $this->con->query($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
      } 

    public function findMealPlanById($id) {
        $sql = "SELECT * FROM req_meal_plans WHERE request_id ='$id'";
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
      }

    public function delete($id){
        $sql = "DELETE FROM req_meal_plans WHERE request_id = '$id'";
        if($this->con->query($sql)){
          return true;
        }else{
          return false;
        }
      }

    public function sendMealPlan($request_id,$meal_type, $food,$quantity,$specialNote) {
      $sql = "UPDATE req_meal_plans SET status = 1,specialNotes='$specialNote' WHERE request_id='$request_id'";
      if($this->con->query($sql)){
          foreach($meal_type as $key => $value){
            $sql = "INSERT INTO mealplan(request_id,meal_type,food,quantity) VALUES ('$request_id', '$value', '$food[$key]', '$quantity[$key]')";
            $this->con->query($sql);
          }  
      }return true;
    }

    public function viewMealPlan($id){
      $sql = "SELECT * FROM mealplan WHERE request_id ='$id' ORDER BY meal_type";
      $query = $this->con->query($sql);
      $query->execute();
      $data = $query->fetchAll();
      return $data;
    }

    public function myList($id){
        $sql = "SELECT * FROM req_meal_plans WHERE user_id ='$id' and status=1";
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function getMyDetails($id){
      $sql = "SELECT * FROM mealplan WHERE request_id = $id  ORDER BY mealplan.meal_type";
      $query = $this->con->query($sql);
      $query->execute();
      $data = $query->fetchAll();
      return $data;
    }
}