<?php

require_once ROOT . "/Database.php";

class Seller extends Database
{
  public function getOrders()
  {
    $sql = "select distinct orderh.id, orderh.accepted, orderh.ddate, orderh.customer_name, orderd.qty, orderd.price, menu_item.item_name from orderh, orderd, menu_item where orderh.id = orderd.order_id and orderd.menu_item_id = menu_item.id";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll();
    return $data;
  }

  public function acceptOrder($id)
  {
    $sql = "update orderh set accepted = true where id = $id";
    $query = $this->con->query($sql);
    $query->execute();
  }

  public function rejectOrder($id)
  {
    $sql = "update orderh set accepted = false where id = $id";
    $query = $this->con->query($sql);
    $query->execute();
  }

  public function getDrivers()
  {
    $sql = "select * from deliverydriver";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll();
    return $data;
  }

  public function getCount()
  {
    $sql = "select count(*) from orderh";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch();
    return $data;
  }

  public function assignDriver($driver, $id)
  {
    $sql = "update orderh set driver_id = $driver where id = $id";
    $query = $this->con->query($sql);
    $query->execute();
  }




  /**profile */

  public function findUserById($id)
  {
    $sql = "SELECT * FROM seller WHERE res_id='$id'";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  public function changeUsername($id, $sellername)
  {
    $sql = "SELECT * FROM users WHERE id='$id'";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);
    if ($sellername == $data['username']) {
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

  public function update($data,$file)
  {
    $id = $data['id'];
    $seller_name = $data['seller_name'];
    $res_name = $data['res_name'];
    $res_address = $data['res_address'];
    $tele = $data['tele'];
    $email = $data['email'];
    $res_image = $file;

    $sql1 = "UPDATE users SET id='$id',email='$email',username='$seller_name',user_type_id=4 where id='$id'";
    $sql2 = "UPDATE seller SET res_id='$id', resname=' $res_name ', resaddress='$res_address', phonenumber='$tele', email='$email', sellername='$seller_name', res_img='$res_image' WHERE res_id='$id'";

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

  public function findUserByUsername($seller_name)
  {
    $sql = "SELECT * FROM users WHERE username='$seller_name'";
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
    $sql2 = "UPDATE seller SET password='$password' where user_id='$id'";

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
  public function findSellerById($id)
  {
    $sql = "SELECT * FROM req_seller WHERE id='$id'";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);
    return $data;
  }




}
