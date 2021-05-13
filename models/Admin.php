<?php

require_once ROOT . "/Database.php";

class Admin extends Database {
    public function findUserById($id) {
        $sql = "SELECT * FROM users WHERE id='$id'";
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
      }

    public function findUserByUsername($username) {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $query = $this->con->query($sql);
        $query->execute();
    
        if ($query->rowCount() > 0){
          return true;
        }else{
          return false;
        }
      }

    public function findUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $query = $this->con->query($sql);
        $query->execute();
    
        if ($query->rowCount() > 0){
          return true;
        }else{
          return false;
        }
      }

    public function passwordVerify($id, $password) {
        $sql = "SELECT * FROM users WHERE id='$id'";
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
    
        if (password_verify($password, $data['password'])) {
            return true;
        }else {
            return false;
        }
    } 

    public function changeUsername($id,$username){
      $sql = "SELECT * FROM users WHERE id='$id'";
      $query = $this->con->query($sql);
      $query->execute();
      $data = $query->fetch(PDO::FETCH_ASSOC);

      if($username == $data['username'] ){
        return false;
      }else{
        return true;
      }
    }

    public function changeEmail($id,$email){
      $sql = "SELECT * FROM users WHERE id='$id'";
      $query = $this->con->query($sql);
      $query->execute();
      $data = $query->fetch(PDO::FETCH_ASSOC);

      if($email == $data['email'] ){
        return false;
      }else{
        return true;
      }
    }

    public function update($data){
        $id = $data['id'];
        $email = $data['email'];
        $username = $data['username'];
 
        $sql1 = "UPDATE users SET id='$id',email='$email',username='$username',user_type_id=1 where id='$id'";
          
        if($this->con->query($sql1)){
            return true;
          }else{
          return false;
        }
    }

    public function updatePassword($data){
      $id = $data['id'];
      $password = $data['password'];

      $sql1 = "UPDATE users SET password='$password' where id='$id'";

      if($this->con->query($sql1)){
          return true;
      }else{
        return false;
      }
    }

    public function sendMessage($data){
      $from_id = $data['from_id'];
      $to_id = $data['to_id'];
      $email = $data['email'];
      $subject = $data['subject'];
      $message = $data['message'];
      $status = $data['status'];
      
      $sql = "INSERT INTO inbox (from_id,to_id,email,subject,message,status) VALUES (' $from_id', '$to_id','$email', '$subject', '$message',' $status')";
      if($this->con->query($sql)){
        return true;
      }else{
        return false;
      }
    }
        
    public function contactus($data){
      $email = $data['email'];
      $message = $data['message'];
      $sql = "INSERT INTO contactus (email,message) VALUES (' $email','$message')";
      if($this->con->query($sql)){
        return true;
      }else{
        return false;
      }
    }
}