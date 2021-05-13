<?php

require_once ROOT . "/Database.php";

class Driver extends Database {

    //accept orders
    public function getOrders() {
        $sql = "select orderh.id, orderh.ddate, orderh.customer_name, sd.address, sd.tele from orderh, shipping_details as sd where orderh.id = sd.order_id and orderh.driver_id = 1";
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
//find driver
    public function findUserById($id)
    {
      $sql = "SELECT * FROM deliverydriver WHERE id='$id'";
      $query = $this->con->query($sql);
      $query->execute();
      $data = $query->fetch(PDO::FETCH_ASSOC);
      return $data;
    }
//send message
    public function sendMessage($data)
  {
    $id = $data['id'];
    $email = $data['email'];
    $username = $data['username'];
    $subject = $data['subject'];
    $message = $data['message'];

    $sql = "INSERT INTO contact_admin (user_id,username,email,subject,message) VALUES (' $id', '$username', '$email', '$subject','$message')";
    if ($this->con->query($sql)) {
      return true;
    } else {
      return false;
    }
  }

  public function changeUsername($id, $drivername)
  {
    $sql = "SELECT * FROM users WHERE id='$id'";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);
    if ($drivername == $data['username']) {
      return false;
    } else {
      return true;
    }
  }

  public function changeEmail($id, $email)
  {
    $sql = "SELECT * FROM users WHERE id='$id'";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);

    if ($email == $data['email']) {
      return false;
    } else {
      return true;
    }
  }

  public function findUserByUsername($drivername)
  {
    $sql = "SELECT * FROM users WHERE username='$drivername'";
    $query = $this->con->query($sql);
    $query->execute();

    if ($query->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function findUserByEmail($email)
  {
    $sql = "SELECT * FROM users WHERE email='$email'";
    $query = $this->con->query($sql);
    $query->execute();

    if ($query->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function update($data)
  {
    $id = $data['id'];
    $drivername = $data['drivername'];
    $nic = $data['nic'];
    $licenseId = $data['licenseId'];
    $tele = $data['tele'];
    $email = $data['email'];

    $sql1 = "UPDATE users SET id='$id',email='$email',username='$drivername',user_type_id=5 where id='$id'";
    $sql2 = "UPDATE deliverydriver SET id=$id, username=' $drivername ', nic='$nic', license='$licenseId', contact='$tele', email='$email'  WHERE id='$id'";

    if ($this->con->query($sql1)) {
      if ($this->con->query($sql2)) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function passwordVerify($id, $password)
  {
    $sql = "SELECT * FROM users WHERE id='$id'";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);

    if (password_verify($password, $data['password'])) {
      return true;
    } else {
      return false;
    }
  }

  public function updatePassword($data)
  {
    $id = $data['id'];
    $password = $data['password'];

    $sql1 = "UPDATE users SET password='$password' where id='$id'";
    $sql2 = "UPDATE deliverydriver SET password='$password' where id='$id'";

    if ($this->con->query($sql1)) {
      if ($this->con->query($sql2)) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function updateStatus($data)
  {
    $id = $data['id'];
    $status = $data['status'];

    $sql = "UPDATE deliverydriver SET status='$status'  WHERE id='$id'";
      if ($this->con->query($sql)) {
        return true;
      } else {
        return false;
      }
    }




}
