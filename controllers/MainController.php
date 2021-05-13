<?php

require_once ROOT  . '/View.php';
require_once ROOT . '/models/Restaurant.php';
require_once ROOT . '/models/Post.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MainController {
  public function index() {
    $view = new View("main/index");
  }

  public function aboutUs() {
    $view = new View("main/about-us");
  }

  public function blog() {
    $model = new Post();
    $posts = $model->viewAllPost();
    
    $view = new View("main/blog");
    $view->assign('posts', $posts);

  }

  public function restaurant() {
    $view = new View("main/restaurant");
    $model = new Restaurant();
    $restaurants = $model->show();
    $view->assign('restaurants', $restaurants);
  }

  public function details() {
    $id = $_GET['id'];
    $model = new Restaurant();
    $restaurants = $model->showById($id);
    $view = new View("main/restaurant");
    $view->assign('restaurants', $restaurants);
  }
  
  public function contactUs() {
    // $data = [
    //   'email' => '',
    //   'message' => '',
    // ];

    // if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //   $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    //   $data = [
    //     'email' => trim($_POST['email']),
    //     'message' => trim($_POST['message']),
    //   ];
    // $model = new Admin();
    // if($model->contactus($data)){
    //   header('location: dashboard');
    // }
    $view = new View("main/contact-us");
  }
}
