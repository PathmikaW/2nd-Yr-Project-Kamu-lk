<?php

require_once ROOT  . '/View.php';
require_once ROOT . '/models/Food.php';
require_once ROOT . '/models/Nutritionist.php';
require_once ROOT . '/models/Mealplan.php';
require_once ROOT . '/models/Post.php';
require_once ROOT . '/models/Message.php';

class NutritionistController{
  //nutritionist/dashboard
  public function dashboard(){
    // send the total food count to the dashboard view
    $model = new Food();
    $countFood = $model->countFood();
    $view = new View("nutritionist/dashboard");
    $view->assign('foodCount', $countFood);

    // send the total client messages count to the dashboard view
    $type = 2;
    $model = new Message();
    $messageCount = $model->countMessage($type);
    $view->assign('messageCount', $messageCount);

    // send the total client messages count to the dashboard view
    $model = new Mealplan();
    $sentCount = $model->countSentPlans();
    $view->assign('sentCount', $sentCount);

    // send request meal plan details to the dashboard
    $model = new Mealplan();
    $plans = $model->showRequest();
    $view->assign('plans', $plans);
  }

  //nutritionist/food-add
  public function addFood(){
    $data = [
      'foodName' => '',
      'calories' => '',
      'protein' => '',
      'fat' => '',
      'Error' => ''
    ];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      //sanitize POST variable, remove tags and encode special characters
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'foodName' => trim($_POST['foodName']),
        'calories' => trim($_POST['calories']),
        'protein' => trim($_POST['protein']),
        'fat' => trim($_POST['fat']),
        'Error' => ''
      ];

      //Check if food already exists.
      $model = new Food();
      if ($model->findFood($data['foodName'])){
        $data['Error'] = 'Food is already inserted';
      }

      //add food to database
      if (empty($data['Error'])){
        $model = new Food();
        if ($model->addFood($data)){
          header('location: food-view');
        }else {
          die('Something went wrong.');
        }
      }  
    }

    $view = new View("nutritionist/food-add");
    $view->assign('Error', $data['Error']);
  }

  //nutritionist/food-view
  public function viewFood(){
    $view = new View("nutritionist/food-view");
    $model = new Food();
    $foods = $model->show();
    $view->assign('foods', $foods);
  }

  //nutritionist/food-update
  public function updateFood(){
    $id = $_GET['id'];
    $model = new Food();
    $foods = $model->findFoodById($id);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'id' => $_GET['id'],
        'foodName' => trim($_POST['foodName']),
        'calories' => trim($_POST['calories']),
        'protein' => trim($_POST['protein']),
        'fat' => trim($_POST['fat']),
        'Error' => ''
      ];

      $model = new Food();
      if ($model->update($data)){
        header('location: food-view');
      } else {
          die('Something went wrong.');
      }
    }

    $view = new View("nutritionist/food-update");
    $view->assign('id', $foods['id']);
    $view->assign('foodName', $foods['foodName']);
    $view->assign('calories', $foods['calories']);
    $view->assign('protein', $foods['protein']);
    $view->assign('fat', $foods['fat']);
  }

  //nutritionist/food-delete
  public function deleteFood(){
    $id = $_GET['id'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $model = new Food();
      if($model->delete($id)) {
        header('location: food-view');
      } else {
        die('Something went wrong!');
      }
    }
  }

  //nutritionist/request-list
  public function requestList(){
    $model = new Mealplan();
    $plans = $model->showRequest();
    $view = new View("nutritionist/request-list");
    $view->assign('plans', $plans);
  }

  //nutritionist/request-list
  public function sentList(){
    $model = new Mealplan();
    $plans = $model->showSent();
    $view = new View("nutritionist/sent-list");
    $view->assign('plans', $plans);
  }

  //nutritionist/mealplan-ignore
  public function ignoreMealPlan(){
    $id = $_GET['id'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $model = new Mealplan();
      if($model->delete($id)) {
        header('location: request-list');
      } else {
        die('Something went wrong!');
      }
    }
  }

  //nutritionist/mealplan-add
  public function addMealPlan(){
    $id = $_GET['id'];
    $model = new Mealplan();
    $plans = $model->findMealPlanById($id);

    $model = new Food();
    $foods = $model->show();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $meal_type = $_POST['meal_type'];
      $food =$_POST['food'];
      $quantity = $_POST['quantity'];
      $request_id = $_GET['id'];
      $specialNote = $_POST['specialNote'];

      $model = new Mealplan();
      if($model->sendMealPlan($request_id,$meal_type, $food,$quantity,$specialNote)){
        header("Location: request-list");
      }
    }

    $view = new View("nutritionist/mealplan-add");
    $view->assign('request_id', $plans['request_id']);
    $view->assign('user_id', $plans['user_id']);
    $view->assign('name', $plans['name']);
    $view->assign('gender', $plans['gender']);
    $view->assign('age', $plans['age']);
    $view->assign('height', $plans['height']);
    $view->assign('weight', $plans['weight']);
    $view->assign('bmi', $plans['bmi']);
    $view->assign('activity_level', $plans['activity_level']);
    $view->assign('preference', $plans['preference']);
    $view->assign('notes', $plans['notes']);
    $view->assign('foods', $foods);
  }

  //nutritionist/mealplan-view
  public function viewMealPlan() {
    $id = $_GET['id'];
    $model = new Mealplan();
    $plans = $model->findMealPlanById($id);

    $model = new Mealplan();
    $viewplans = $model->viewMealPlan($id);
    // print_r($viewplans);
    // die();

    $view = new View("nutritionist/mealplan-view");
    $view->assign('request_id', $plans['request_id']);
    $view->assign('user_id', $plans['user_id']);
    $view->assign('name', $plans['name']);
    $view->assign('gender', $plans['gender']);
    $view->assign('age', $plans['age']);
    $view->assign('height', $plans['height']);
    $view->assign('weight', $plans['weight']);
    $view->assign('bmi', $plans['bmi']);
    $view->assign('activity_level', $plans['activity_level']);
    $view->assign('preference', $plans['preference']);
    $view->assign('notes', $plans['notes']);
    //$view->assign('name', $viewplans['name']);
    $view->assign('viewplans', $viewplans);
  }

  //nutritionist/mealplan-delete
  public function deleteMealPlan(){
    $id = $_GET['id'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $model = new Mealplan();
      if($model->delete($id)) {
        header('location: sent-list');
      } else {
        die('Something went wrong!');
      }
    }
  }

  //nutritionist/post-add
  public function addPost() {
    $id = $_GET['id'];

    if (isset($_POST['submit2'])){
      // print_r($_POST);
      // die();
      $target_dir =  ROOT . "/assets/posts/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
        $file = "assets/posts/" . basename($_FILES["fileToUpload"]["name"]);
      }else{
        header("Location: post-add");
        echo "Sorry, there was an error uploading your file.";
        die();
      } 
      
      $model = new Post();
      $model->addPost($_POST,$file,$id);
      header("Location: post-view?id=$id");
    }
    $view = new View("nutritionist/post-add");
  }

  //nutritionist/post-view
  public function viewPost() {
    $id = $_GET['id'];
    $model = new Post();
    $posts = $model->getPost($id);
    $view = new View("nutritionist/post-view");
    $view->assign('posts', $posts);
  }

  //nutritionist/post-update
  public function updatePost() {
    $post_id = $_GET['id'];
    $model = new Post();
    $data = $model->getPostDetails($post_id);

    if (isset($_POST['submit2'])){
      if (isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload']['name'])){
        $target_dir =  ROOT . "/assets/posts/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
            $file = "assets/posts/" . basename($_FILES["fileToUpload"]["name"]);
          }else{
            header("Location: post-view");
          die();
          }
      }else{
        $file = $data['image'];
      }

      $model = new Post();
      $model->editPost($_POST, $file, $post_id);
      header("Location: post-view?id=".$_POST['user_id'].""); 
    }

  $view = new View("nutritionist/post-update");
  $view->assign('data', $data);
}

  //nutritionist/post-delete
  public function deletePost(){
    $id = $_GET['id'];
    $model = new Post();
    $data = $model->getPostDetails($id);
    $user_id = $data['user_id'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $model = new Post();
      if($model->delete($id)){
        header("Location: post-view?id=$user_id");
      }else{
        die('Something went wrong!');
      }
    }
  }

  //nutritionist/contact-admin
  public function contactAdmin() {
    $id = $_GET['id'];
    $model = new Nutritionist();
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
    
      $model = new Nutritionist();
      if ($model->sendMessage($data)){
        echo "<script>";
        echo "alert('Successfully Send the message!');";
        echo "window.location = '../nutritionist/contact-admin?id=".$data['from_id']."'"; // redirect with javascript, after page loads
        echo "</script>";
      } else {
        die('Something went wrong.');
      }
    }

    $view = new View("nutritionist/contact-admin");
  }

  //nutritionist/my-profile
  public function myProfile() {
    $id = $_GET['id'];
    $model = new Nutritionist();
    $user = $model->findUserById($id);
  
    $data = [
      'id' => '',
      'name' => '',
      'username' => '',
      'email' => '',
      'med_id' => '',
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
        'med_id' => trim($_POST['med_id']),
        'tele_no' => trim($_POST['tele_no']),
        'usernameError' => '',
        'emailError' => ''
      ];
  
      $nameValidation = "/^[a-zA-Z0-9]*$/";
  
      //Validate username on letters/numbers
      if (empty($data['username'])){
        $data['usernameError'] = 'Please enter username.';
      }elseif (!preg_match($nameValidation, $data['username'])) {
        $data['usernameError'] = 'Name can only contain letters and numbers.';
      }
  
      //Validate email
      if (empty($data['email'])){
        $data['emailError'] = 'Please enter email address.';
      }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
        $data['emailError'] = 'Please enter the correct format.';
      }
  
      //check if the username is changed
      $model = new Nutritionist();
      if($model->changeUsername($data['id'],$data['username'])){
        $model = new Nutritionist();
        if ($model->findUserByUsername($data['username'])) {
          $data['usernameError'] = 'Username is already taken.';
        }
      }
  
      //check if the email is changed
      if($model->changeEmail($data['id'],$data['email'])){
        $model = new Nutritionist();
        if($model->findUserByEmail($data['email'])) {
          $data['emailError'] = 'Email is already taken.';
        }
      }
          
  
      if (empty($data['usernameError']) && empty($data['emailError'])) {
        $model = new Nutritionist();
        if ($model->update($data)) {
          echo "<script>";
          echo "alert('Successfully Changed!');";
          echo "window.location = '../nutritionist/my-profile?id=".$data['id']."'"; // redirect with javascript, after page loads
          echo "</script>";
        }else{
          die('Something went wrong.');
        }
      }
    }
  
    $view = new View("nutritionist/my-profile");
    $view->assign('id', $user['user_id']);
    $view->assign('med_id', $user['medical_id']);
    $view->assign('name', $user['name']);
    $view->assign('username', $user['username']);
    $view->assign('email', $user['email']);
    $view->assign('tele_no', $user['tele_no']);
    $view->assign('usernameError', $data['usernameError']);
    $view->assign('emailError', $data['emailError']);
  }
  
  //nutritionist/change-password
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

      if($data['currentPassword'] == $data['password']){
        $data['passwordError'] = 'Password Same as current password.Please enter new password.';
      }

      if(!empty($data['currentPassword'])){
        $model = new Nutritionist;
        if($model->passwordVerify($data['id'], $data['currentPassword'])){
          
          $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
  
          // Validate password on length, numeric values,
          if(empty($data['password'])){
            $data['passwordError'] = 'New Password cannot be blank.';
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
            $model = new Nutritionist();
            if ($model->updatePassword($data)){
              echo "<script>";
              echo "alert('Successfully Changed!');";
              echo "window.location = '../nutritionist/my-profile?id=".$data['id']."'"; // redirect with javascript, after page loads
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
  
    $view = new View("nutritionist/change-password");
    $view->assign('passwordError', $data['passwordError']);
    $view->assign('confirmPasswordError', $data['confirmPasswordError']);
    $view->assign('error', $data['error']);
  }

  //nutritionist/inbox
  public function inbox(){
    $id = $_GET['id'];
    $type = 2;
    $model = new Message();
    $unreads = $model->viewUnread($type);
    $replys = $model->viewReply($id);
    $sents = $model->viewSent($type);

    $view = new View("nutritionist/inbox");
    $view->assign('unreads', $unreads);
    $view->assign('replys', $replys);
    $view->assign('sents', $sents);
  }

  //nutritionist/send-reply
  public function sendReply(){
    $id = $_GET['id'];
    $model = new Message();
    $message = $model->findMessageById($id);

    $data = [
      'inbox_id' => '',
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
        'inbox_id' => $_GET['id'],
        'from_id' => trim($_POST['from']),
        'to_id' => $message['from_id'],
        'email' => trim($_POST['email']),
        'subject' => $message['subject'],
        'reply' => trim($_POST['reply']),
        'status' => 1
      ];

      $model = new Message();
      if ($model->sendReply($data)){
        header("Location: inbox?id=17");
      } else {
        die('Something went wrong.');
      }

    }
  
    $view = new View("nutritionist/send-reply");
    $view->assign('id', $message['inbox_id']);
    $view->assign('email', $message['email']);
    $view->assign('subject', $message['subject']);
    $view->assign('message', $message['message']);
  }

  //nutritionist/logout
  public function logout() {
    $view = new View("nutritionist/logout");
  }
}