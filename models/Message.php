<?php

require_once ROOT . "/Database.php";

class Message extends Database {
    public function viewUnread($type){
        $sql = "SELECT * FROM inbox WHERE to_id='$type' AND status='0'";
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function viewReply($id){
        $sql = "SELECT * FROM reply WHERE to_id='$id'";
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function viewSent($type){
        $sql = "SELECT * FROM inbox WHERE to_id='$type' AND status='1'";
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function findMessageById($id) {
        $sql = "SELECT * FROM inbox WHERE inbox_id='$id'";
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function sendReply($data){
        $inbox_id = $data['inbox_id'];
        $from_id = $data['from_id'];
        $to_id = $data['to_id'];
        $email = $data['email'];
        $subject = $data['subject'];
        $message = $data['reply'];
        $status = $data['status'];

        $sql1 = "UPDATE inbox SET status='$status' where inbox_id='$inbox_id'"; 
        $sql2 = "INSERT INTO reply (inbox_id,from_id,to_id,email,subject,reply) VALUES ('$inbox_id',' $from_id', '$to_id','$email', '$subject', '$message')";
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
      
    public function countMessage($type){
    $sql = "SELECT * FROM inbox WHERE to_id='$type' AND status='0'";
      $query = $this->con->query($sql);
      $query->execute();
      $count = $query->rowCount();
      return $count;
    }

    public function viewAdminReply($type){
        $sql = "SELECT * FROM reply WHERE from_id ='$type'";
        $query = $this->con->query($sql);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
  
      public function deleteUnread($id){
          $sql = "DELETE FROM inbox WHERE inbox_id = '$id' AND status='0'";
          if($this->con->query($sql)){
            return true;
          }else{
            return false;
          }
        }
  
        public function deleteSent($id){
          $sql = "DELETE FROM inbox WHERE inbox_id = '$id' AND status='1'";
          if($this->con->query($sql)){
            return true;
          }else{
            return false;
          }
        }
  
        public function deleteReply($id){
          $sql = "DELETE FROM reply WHERE reply_id = '$id'";
          if($this->con->query($sql)){
            return true;
          }else{
            return false;
          }
        }
}