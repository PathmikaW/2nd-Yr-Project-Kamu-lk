<?php

require_once ROOT . "/Database.php";

class Post extends Database {
  public function addPost($data, $file,$id) {
    $title = $data['title'];
    $descrption = $data['description'];
    $image = $file;
    $userId = $id;

    $sql = "INSERT INTO posts (title,description,image,user_id) VALUES ('$title', '$descrption', '$image' , '$userId')";
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function getPost($id) {
    $sql = "SELECT * FROM posts WHERE user_id=$id";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetchAll();
    return $data;
  }

  public function getPostDetails($post_id) {
    $sql = "select * from posts where post_id = $post_id";
    $query = $this->con->query($sql);
    $query->execute();
    $data = $query->fetch();
    return $data;
  }

  public function editPost($data,$file,$id) {
    $userId = $data['user_id'];
    $title = $data['title'];
    $descrption = $data['description'];
    $image = $file;

    $sql = "UPDATE posts SET title = '$title', description = '$descrption', image = '$image', user_id = $userId where post_id = $id ";
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

  public function delete($id){
    $sql = "DELETE FROM posts WHERE post_id = '$id'";
    if($this->con->query($sql)){
      return true;
    }else{
      return false;
    }
  }

    public function viewAllPost(){
      $sql = "SELECT posts.title, posts.description, posts.image, posts.post_id, users.username from users,posts WHERE users.id=posts.user_id";
      $query = $this->con->query($sql);
      $query->execute();
      $data = $query->fetchAll();
      return $data;
    }
}