<?php

require_once ROOT . "/Database.php";

class Nutritionist extends Database {
    public function findUserById($id) {
        $sql = "SELECT * FROM nutritionist WHERE user_id='$id'";
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
        $med_id = $data['med_id'];
        $name = $data['name'];
        $username = $data['username'];
        $email = $data['email'];
        $med_id = $data['med_id'];
        $tele_no = $data['tele_no'];
 
        $sql1 = "UPDATE users SET id='$id',email='$email',username='$username',user_type_id=2 where id='$id'";
        $sql2 = "UPDATE nutritionist SET user_id='$id', medical_id=' $med_id', name='$name', username='$username', email='$email', tele_no='$tele_no'  WHERE user_id='$id'";
          
        if($this->con->query($sql1)){
          if($this->con->query($sql2)){
            return true;
          }else{
            return false;
          }
        }else{
          return false;
        }
    }

    public function updatePassword($data){
      $id = $data['id'];
      $password = $data['password'];

      $sql1 = "UPDATE users SET password='$password' where id='$id'";
      $sql2 = "UPDATE nutritionist SET password='$password' where user_id='$id'";

      if($this->con->query($sql1)){
        if($this->con->query($sql2)){
          return true;
        }else{
          return false;
        }
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
        

}