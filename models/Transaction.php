<?php

require_once ROOT . "/Database.php";

class Transaction extends Database {
    public function addTransaction($data) {
        $order_id = $data['order_id'];
        $user_id = $data['user_id'];
        $date = $data['date'];
        $payment_type = $data['payment_type'];
        $amount = $data['amount'];
        $status = $data['status'];
        
        
        $sql = "INSERT INTO transaction (order_id,user_id,date,payment_type,amount,status) VALUES ('$order_id','$user_id', '$date', '$payment_type','$amount','$status')";
        if($this->con->query($sql)){
          return true;
        }else{
          return false;
        }
    }

    public function findTransaction($order_id) {
      $sql = "SELECT * FROM transaction WHERE order_id='$order_id'";
      $query = $this->con->query($sql);
      $query->execute();
    
      if ($query->rowCount() > 0){
        return true;
      }else{
        return false;
      }
    }

    public function findTransactionById($trans_id) {
      $sql = "SELECT * FROM transaction WHERE trans_id='$trans_id'";
      $query = $this->con->query($sql);
      $query->execute();
      $data = $query->fetch(PDO::FETCH_ASSOC);
      return $data;
    }

    public function showPayable() {
      $sql = "SELECT * FROM transaction WHERE payment_type = 'payable'";
      $query = $this->con->query($sql);
      $query->execute();
      $data = $query->fetchAll();
      return $data;
    } 

    public function showRecievable() {
        $sql = "SELECT * FROM transaction  WHERE payment_type = 'recievable'";
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
      } 

    public function updatePayable($data){
        $trans_id = $data['trans_id'];
        $order_id = $data['order_id'];
        $user_id = $data['user_id'];
        $date = $data['date'];
        $payment_type = $data['payment_type'];
        $amount = $data['amount'];
        $status = $data['status'];
      

      $sql = "UPDATE transaction SET trans_id='$trans_id', order_id='$order_id', user_id='$user_id', date='$date',payment_type='$payment_type',amount='$amount',status='$status'  WHERE trans_id='$trans_id'";
        if($this->con->query($sql)){
          return true;
        }else{
          return false;
        }
    }

    public function updateRecievable($data){
        $trans_id = $data['trans_id'];
        $order_id = $data['order_id'];
        $user_id = $data['user_id'];
        $date = $data['date'];
        $payment_type = $data['payment_type'];
        $amount = $data['amount'];
        $status = $data['status'];
      

      $sql = "UPDATE transaction SET trans_id='$trans_id', order_id='$order_id', user_id='$user_id', date='$date',payment_type='$payment_type',amount='$amount',status='$status'  WHERE trans_id='$trans_id'";
        if($this->con->query($sql)){
          return true;
        }else{
          return false;
        }
    }

    public function deletePayable($trans_id){
      $sql = "DELETE FROM transaction WHERE trans_id = '$trans_id'";
      if($this->con->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function deleteRecievable($trans_id){
        $sql = "DELETE FROM transaction WHERE trans_id = '$trans_id'";
        if($this->con->query($sql)){
          return true;
        }else{
          return false;
        }
      }
  }