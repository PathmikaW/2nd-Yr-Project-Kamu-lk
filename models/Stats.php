<?php

require_once ROOT . "/Database.php";

class Stats extends Database {

    //---------------User Statistics--------------------------------------------------------//
    public function countAdmin(){
        $sql = "SELECT * FROM users WHERE user_type_id='1'";
        $query = $this->con->query($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
      }
  
      public function countNutritionist(){
        $sql = "SELECT * FROM users WHERE user_type_id='2'";
        $query = $this->con->query($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
      }
  
      public function countReguser(){
        $sql = "SELECT * FROM users WHERE user_type_id='3'";
        $query = $this->con->query($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
      }
  
      public function countSeller(){
        $sql = "SELECT * FROM users WHERE user_type_id='4'";
        $query = $this->con->query($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
      }
  
      public function countDriver(){
        $sql = "SELECT * FROM users WHERE user_type_id='5'";
        $query = $this->con->query($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
      }
//--------------------- Delivery Statistics -------------------------------------------------------//
      public function orderDelivered(){
        $sql = "SELECT * FROM users WHERE user_type_id='4'";
        $query = $this->con->query($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
      }

      public function orderOnprocess(){
        $sql = "SELECT * FROM users WHERE user_type_id='3'";
        $query = $this->con->query($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
      }

      public function orderCancelled(){
        $sql = "SELECT * FROM users WHERE user_type_id='2'";
        $query = $this->con->query($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
      }

      public function orderRejected(){
        $sql = "SELECT * FROM users WHERE user_type_id='5'";
        $query = $this->con->query($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
      }

      //---------------Consultancy Statistics--------------------------------------------------------//

      public function consultancyChecked(){
        $sql = "SELECT * FROM users WHERE user_type_id='5'";
        $query = $this->con->query($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
      }

      public function consultancyOnprocess(){
        $sql = "SELECT * FROM users WHERE user_type_id='5'";
        $query = $this->con->query($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
      }

      public function consultancyCancelled(){
        $sql = "SELECT * FROM users WHERE user_type_id='5'";
        $query = $this->con->query($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
      }

      public function consultancyRejected(){
        $sql = "SELECT * FROM users WHERE user_type_id='5'";
        $query = $this->con->query($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
      }

      //---------------Consultancy Statistics--------------------------------------------------------//

      public function countAllUsers(){
        $sql = "SELECT * FROM users";
        $query = $this->con->query($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
      }

      public function countMealRequest(){
        $sql = "SELECT * FROM req_meal_plans";
        $query = $this->con->query($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
      }

      public function countOrders(){
        $sql = "SELECT * FROM orderd";
        $query = $this->con->query($sql);
        $query->execute();
        $count = $query->rowCount();
        return $count;
      }
      public function calculatePayable(){
        $sql = "SELECT SUM(amount) AS Totalpayable FROM transaction WHERE payment_type='payable'";
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
      }

      public function calculateRecievable(){
        $sql = "SELECT SUM(amount) AS Totalrecievable FROM transaction WHERE payment_type='recievable'";
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
      }

      public function calculateRevenue(){
        $sql = "SELECT SUM(amount) AS Totalrevenue FROM transaction WHERE payment_type='payable'";
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
      }

      

    


}