<?php

require_once ROOT . "/Database.php";

class Auth extends Database {
  public function login($username, $password) {
    $sql = "SELECT * FROM users WHERE username='$username'";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);

    if (password_verify($password, $data['password'])) {
        return $data;
    }else {
        return false;
    }
  } 

  public function userSignUp($data) {
    $email = $data['email'];
    $username = $data['username'];
    $password = $data['password'];
    $userTypeId = $data['userTypeId'];
    
    $sql = "INSERT INTO users (email,username,password,user_type_id) VALUES ('$email', '$username', '$password', '$userTypeId')";

    if($this->con->query($sql)){
      $sql1 = "SELECT * FROM users WHERE username='$username'";
      $query = $this->con->query($sql1);
      $query->execute();
      $data = $query->fetch(PDO::FETCH_ASSOC);
      
      $user_id = $data['id'];
      $username = $data['username'];
      $email = $data['email'];
      $password = $data['password'];

      $sql2 = "INSERT INTO user_details(user_id,username,email,password) VALUES ('$user_id','$username','$email', '$password')";
      if($this->con->query($sql2)){
        return true;
      }else{
          return false;
      }
    }else
        return false;
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

  public function insertCode($code,$emailTo){
    $sql = "INSERT INTO reset_password(code,email) VALUES ('$code','$emailTo')";
    if($this->con->query($sql)){
      return true;
    }else{
        return false;
    }
  }

  public function getEmail($code){
    $sql = "SELECT email FROM reset_password WHERE code='$code'";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);

    if ($query->rowCount() > 0){
      return $data;
    }else{
      return false;
    }
  }

  public function resetPassword($password,$email){
    $sql1 = "UPDATE users SET password='$password' where email='$email'";
    $sql2 = "UPDATE user_details SET password='$password' where email='$email'";
    $sql3 = "DELETE FROM reset_password WHERE email= '$email'";

    if($this->con->query($sql1)){
      if($this->con->query($sql2)){
        if($this->con->query($sql3)){
          return true;
        }else{ 
          return false;
        }
      }else{ 
        return false;
      }
    }else{
      return false;
    }
  }

  public function signupSeller($data) {
    $resname = $data['resname'];
    $resaddress = $data['resaddress'];
    $sellername = $data['sellername'];
    $tele = $data['tele'];
    $email = $data['email'];
    $password = $data['password'];
    $userTypeId = $data['userTypeId'];
    
    $sql = "INSERT INTO req_seller (resname,resaddress,sellername,phonenumber,email,password,user_type_id) VALUES ('$resname', '$resaddress', '$sellername','$tele', '$email', '$password', '$userTypeId')";

    if($this->con->query($sql)){
        return true;
      }else{
          return false;
      }

    }

    public function signupDriver($data) {
      $drivername = $data['drivername'];
      $nic = $data['nic'];
      $licenseId = $data['licenseId'];
      $tele = $data['tele'];
      $email = $data['email'];
      $password = $data['password'];
      $userTypeId = $data['userTypeId'];
      
      $sql = "INSERT INTO req_driver(drivername,nic,license,contact,email,password,user_type_id) VALUES ('$drivername', '$nic', '$licenseId','$tele', '$email', '$password', '$userTypeId')";
  
      if($this->con->query($sql)){
          return true;
        }else{
            return false;
        }
  
      }
}