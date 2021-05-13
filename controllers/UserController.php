<?php

require_once ROOT  . '/View.php';
require_once ROOT . '/models/Post.php';
require_once ROOT . '/models/Order.php';
require_once ROOT . '/models/RegisteredUser.php';
require_once ROOT . '/models/Mealplan.php';


class UserController {

  // user/user-dash
    public function userDash() {
      $view = new View("user/user-dash"); 
    }

  //user/add-post
    public function addPost() {
      $id = $_GET['id'];

      if (isset($_POST['submit2'])){
        $target_dir =  ROOT . "/assets/posts/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          $file = "assets/posts/" . basename($_FILES["fileToUpload"]["name"]);
        } else {
          header("Location: post-add?id=$id");
          echo "Sorry, there was an error uploading your file.";
          die();
        } 

        $model = new Post();
        $model->addPost($_POST,$file,$id);
        header("Location: view-post?id=$id");
      }
    $view = new View("user/add-post");
  }

  //user/view-post
    public function viewPost() {
      $id = $_GET['id'];
      $model = new Post();
      $posts = $model->getPost($id);
      $view = new View("user/view-post");
      $view->assign('posts', $posts);
    }

  //user/update-post
    public function updatePost(){
      $post_id = $_GET['id'];
      $model = new Post();
      $data = $model->getPostDetails($post_id);

      if (isset($_POST['submit2'])){
        if (isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload']['name'])) {
          $target_dir =  ROOT . "/assets/posts/";
          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $file = "assets/posts/" . basename($_FILES["fileToUpload"]["name"]);
          }else{
            header("Location: view-post");
            die();
          }
        }else{
          $file = $data['image'];
        }

        $model = new Post();
        $model->editPost($_POST, $file, $post_id);
        header("Location: view-post?id=".$_POST['user_id'].""); 
      }

      $view = new View("user/update-post");
      $view->assign('data', $data);
    }

  //user/delete-post
    public function deletePost(){
      $id = $_GET['id'];
      $model = new Post();
      $data = $model->getPostDetails($id);
      $user_id = $data['user_id'];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $model = new Post();
        if($model->delete($id)){
          header("Location: view-post?id=$user_id");
        }else{
          die('Something went wrong!');
        }
      }
    }

  //user/contact-admin
  public function contactAdmin(){
    $id = $_GET['id'];
    $model = new RegisteredUser();
    $user = $model->findUserById($id);

    $data = [
      'from_id' => '',
      'to_id' => '',
      'email' => '',
      'subject' => '',
      'message' => '',
      'status' => ''
    ];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'from_id' => $_GET['id'],
        'to_id' => trim($_POST['to']),
        'email' => $user['email'],
        'subject' => trim($_POST['subject']),
        'message' => trim($_POST['message']),
        'status' => '0'
      ];
    
      $model = new RegisteredUser();
      if ($model->sendMessage($data)) {
        echo "<script>";
        echo "alert('Successfully Send the message!');";
        echo "window.location = '../user/contact-admin?id=".$data['from_id']."'"; // redirect with javascript, after page loads
        echo "</script>";
      } else {
        die('Something went wrong.');
      }
    }

    $view = new View("user/contact-admin");
  }

  //user/contact-nutritionist
  public function contactNutritionist() {
    $id = $_GET['id'];
    $model = new RegisteredUser();
    $user = $model->findUserById($id);

    $data = [
      'from_id' => '',
      'to_id' => '',
      'email' => '',
      'subject' => '',
      'message' => '',
      'status' => ''
    ];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'from_id' => $_GET['id'],
        'to_id' => trim($_POST['to']),
        'email' => $user['email'],
        'subject' => trim($_POST['subject']),
        'message' => trim($_POST['message']),
        'status' => '0'
      ];
    
      $model = new RegisteredUser();
      if ($model->sendMessage($data)) {
        echo "<script>";
        echo "alert('Successfully Send the message!');";
        echo "window.location = '../user/contact-nutritionist?id=".$data['from_id']."'"; // redirect with javascript, after page loads
        echo "</script>";
      } else {
        die('Something went wrong.');
      }
    }

    $view = new View("user/contact-nutritionist");
  }



  //user/request-meal-plan
    public function requestMealPlan(){
      $id = $_GET['id'];
      $model = new RegisteredUser();
      $user = $model->findUserById($id);

      $data = [
        'id' => '',
        'name' => '',
        'gender' => '',
        'age' => '',
        'height' => '',
        'weight' => '',
        'bmi' => '',
        'active_level' => '',
        'preference' => '',
        'note' => '',
      ];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $_GET['id'],
          'name' =>  $user['name'],
          'gender' => trim($_POST['gender']),
          'age' => trim($_POST['age']),
          'height' => trim($_POST['height']),
          'weight' => trim($_POST['weight']),
          'bmi' => '',
          'activity_level' => trim($_POST['activity_level']),
          'preference' => trim($_POST['preference']),
          'note' => trim($_POST['note']),
        ];

        //calculate bmi
        $height = $data['height'];
        $weight = $data['weight'];
        $bmi = $weight / ($height * $height);
        $data['bmi'] = $bmi;

        $model = new RegisteredUser();
        if ($model->requestMealPlan($data)) {
          echo "<script>";
          echo "alert('request successfully send!');";
          echo "window.location = '../user/user-dash'"; // redirect with javascript, after page loads
          echo "</script>";
        } else {
          die('Something went wrong.');
        }
      
 
    }
    $view = new View("user/request-meal-plan");
    $view->assign('age', $user['age']);
    $view->assign('height', $user['height']);
    $view->assign('weight', $user['weight']);
  }
   //user/request-meal-plan list
   public function myMealPlan(){
    $id = $_GET['id'];
    $model = new Mealplan();
    $myplans = $model->myList($id);
    $view = new View("user/my-plan");
    $view->assign('myplans', $myplans);
    $view->assign('id', $myplans['request_id']);
   }

   public function viewMealPlan(){
      $id = $_GET['id'];
      $model = new Mealplan();
      $plan = $model->getMyDetails($id);
      $view = new View("user/view-mealplan");
      $view->assign('plans', $plan);
      
   }

   public function deleteMealPlan(){
    $id = $_GET['id'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $model = new Mealplan();
      if($model->delete($id)) {
        header('location: my-plan');
      } else {
        die('Something went wrong!');
      }
    }
  }
  
  //user/user-profile
    public function userProfile() {
      $id = $_GET['id'];
      $model = new RegisteredUser();
      $user = $model->findUserById($id);

  
      $data = [
        'id' => '',
        'name' => '',
        'username' => '',
        'email' => '',
        'tele_no' => '',
        'usernameError' => '',
        'emailError' => ''
      ];
  
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'id' => $_GET['id'],
          'name' => trim($_POST['name']),
          'username' => trim($_POST['username']),
          'email' => trim($_POST['email']),
          'tele_no' => trim($_POST['tele_no']),
          'usernameError' => '',
          'emailError' => ''
        ];
  
        $nameValidation = "/^[a-zA-Z0-9]*$/";
  
        //Validate username on letters/numbers
          if (empty($data['username'])) {
              $data['usernameError'] = 'Please enter username.';
          } elseif (!preg_match($nameValidation, $data['username'])) {
              $data['usernameError'] = 'Name can only contain letters and numbers.';
          }
  
        //Validate email
          if (empty($data['email'])) {
              $data['emailError'] = 'Please enter email address.';
          } elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Please enter the correct format.';
          }
  
          $model = new RegisteredUser();
          if($model->changeUsername($data['id'],$data['username'])){
              $model = new RegisteredUser();
              if ($model->findUserByUsername($data['username'])) {
                $data['usernameError'] = 'Username is already taken.';
              }
          }
  
          if($model->changeEmail($data['id'],$data['email'])){
            $model = new RegisteredUser();
            if ($model->findUserByEmail($data['email'])) {
              $data['emailError'] = 'Email is already taken.';
            }
          }
          
  
          if (empty($data['usernameError']) && empty($data['emailError'])) {
              $model = new RegisteredUser();
              if ($model->update($data)) {
                echo "<script>";
                echo "alert('Successfully Changed!');";
                echo "window.location = '../user/user-profile?id=".$data['id']."'"; // redirect with javascript, after page loads
                echo "</script>";
              } else {
                  die('Something went wrong.');
              }
          }
        }
  
      $view = new View("user/user-profile");
      $view->assign('id', $user['user_id']);
      $view->assign('name', $user['name']);
      $view->assign('username', $user['username']);
      $view->assign('email', $user['email']);
      $view->assign('tele_no', $user['tele_no']);
      $view->assign('usernameError', $data['usernameError']);
      $view->assign('emailError', $data['emailError']);
    }

  //user/change-password
    public function changePassword(){
    $data = [
      'id' => '',
      'currentPassword' => '',
      'password' => '',
      'confirmPassword' => '',
      'passwordError' => '',
      'confirmPasswordError' => '',
      'error' =>''
    ];
  
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'id' => $_GET['id'],
        'currentPassword' => trim($_POST['currentPassword']),
        'password' => trim($_POST['password']),
        'confirmPassword' => trim($_POST['confirmPassword']),
        'passwordError' => '',
        'confirmPasswordError' => '',
        'error' => ''
      ];

      if(!empty($data['currentPassword'])){
        $model = new RegisteredUser;
        if($model->passwordVerify($data['id'], $data['currentPassword'])){
          
          $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
  
          // Validate password on length, numeric values,
          if(empty($data['password'])){
            $data['passwordError'] = 'Please enter password.';
          } elseif(strlen($data['password']) < 8){
            $data['passwordError'] = 'Password must be at least 8 characters';
          } elseif (preg_match($passwordValidation, $data['password'])) {
            $data['passwordError'] = 'Password must be have at least one numeric value.';
          }
  
          //Validate confirm password
          if(empty($data['confirmPassword'])){
            $data['confirmPasswordError'] = 'Please enter confirm password.';
          }else{
            if ($data['password'] != $data['confirmPassword']){
              $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
            }
          }
  
          if(empty($data['passwordError']) && empty($data['confirmPasswordError'])){
  
            // Hash password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $model = new RegisteredUser();
            if ($model->updatePassword($data)){
              echo "<script>";
              echo "alert('Successfully Changed!');";
              echo "window.location = '../user/user-profile?id=".$data['id']."'"; // redirect with javascript, after page loads
              echo "</script>";
            }else{
              die('Something went wrong.');
            }
          }
        }else{
          $data['error'] = 'Current Password not matched.';
        }
      }else{
        $data['error'] = 'Current Password cannot be empty.';
      }
    }
  
    $view = new View("user/change-password");
    $view->assign('passwordError', $data['passwordError']);
    $view->assign('confirmPasswordError', $data['confirmPasswordError']);
    $view->assign('error', $data['error']);
  }

  //user/logout
  public function logout() {
    $view = new View("user/logout");
  }


  public function orderFood() {

    $model = new Order();
    $orders = $model ->showRestaurant();
    // print_r($orders);
    // die();
    $view = new View("user/order-food");
    $view -> assign('orders',$orders);
  }

  public function restaurentMenu() {
    $id = $_GET['id'];
    $model = new Order();
    $orders = $model ->showMenu($id);
    $view = new View("user/restaurent-Menu");
    $view -> assign('orders',$orders);
    }

  public function userInbox() {
      $id = $_GET['id'];
      $model = new RegisteredUser();
      $regusers = $model->getMessages($id);
     //print_r($registeredusers);
      //die();
      $view = new View("user/user-inbox");
      $view->assign('regusers', $regusers);
    }

    public function addToCart() {
      $id = $_GET['id'];
      $model = new Order();
      $orders = $model->findItemById($id);
  
  
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
        
      if (empty($data['Error'])){
        $model = new Order();
        if ($model->addCart($data)) {
                  echo "<script>";
                  echo "alert('Successfully Add to cart!');";
                  echo "window.location = '../user/restaurant-menu?id=".$id."'"; // redirect with javascript, after page loads
                  echo "</script>";
        } else {
            die('Something went wrong.');
        }
      }  
    }
      $view = new View("user/restaurent-menu");
      $view->assign('Error', $data['Error']);
    }
    
  
  public function viewCart() {
        $id = $_GET['id'];
        $model = new Order();
        $orders = $model->showCart($id);
        $view = new View("user/view-cart");
        $view->assign('orders', $orders);
      }
}

