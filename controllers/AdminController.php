<?php

require_once ROOT  . '/View.php';
require_once ROOT . '/models/Admin.php';
require_once ROOT . '/models/User.php';
require_once ROOT . '/models/Message.php';
require_once ROOT . '/models/Stats.php';
require_once ROOT . '/models/Transaction.php';
require_once ROOT . '/models/Request.php';
require_once ROOT . '/models/Seller.php';
require_once ROOT . '/models/Driver.php';
require_once ROOT . '/models/Post.php';

class AdminController {
//----------------- Dashboard Statistics View ---------------------//

  public function showReport(){
    $model = new Stats();
    $countAllUsers= $model->countAllUsers();
    $countMealRequest= $model->countMealRequest();
    $countNutritionist= $model->countNutritionist();
    $countReguser= $model->countReguser();
    $countSeller= $model->countSeller();
    $countDriver= $model->countDriver();
    $countOrders= $model->countOrders();
    $calculateRevenue= $model->calculateRevenue();
    $calculatePayable= $model->calculatePayable();
    $calculateRecievable= $model->calculateRecievable();

    $view = new View("admin/admin");
    $view->assign('allUserCount', $countAllUsers);
    $view->assign('allMealPlan', $countMealRequest);
    $view->assign('nutritionistCount', $countNutritionist);
    $view->assign('reguserCount', $countReguser);
    $view->assign('sellerCount', $countSeller);
    $view->assign('driverCount', $countDriver);
    $view->assign('orderCount', $countOrders);
    $view->assign('totalRevenue', $calculateRevenue);
    $view->assign('totalPayable', $calculatePayable);
    $view->assign('totalRecievable', $calculateRecievable);
  }
  
//----------------- User Management Controller ---------------------//
  public function addUser() {
    $data = [
      'id' => '',
      'email' => '',
      'username' => '',
      'password' => '',
      'user_type_id' => '',
      'Error' => ''
    ];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'email' => trim($_POST['email']),
        'username' => trim($_POST['username']),
        'password' => trim($_POST['password']),
        'user_type_id' => trim($_POST['user_type_id']),
        'Error' => ''
      ];

      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
//----------------- Check User Existance  ---------------------//
      $model = new User();
      if ($model->findUser($data['username'])) {
        $data['Error'] = 'User is already inserted';
      }

    if (empty($data['Error'])){
      $model = new User();
      if ($model->addUser($data)){
        header('location: user-view');
      } else {
          die('Something went wrong.');
      }
    }  
  }
    $view = new View("admin/user-add");
    $view->assign('Error', $data['Error']);
  }
 
  public function viewUser() {
    $view = new View("admin/user-view");
    $model = new User();
    $users = $model->show();
    $view->assign('users', $users);
  }

  public function updateUser(){
    $id = $_GET['id'];
    $model = new User();
    $users = $model->findUserById($id);
    
    
    $type = $model->findUserType($users['user_type_id']);
 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'id' => $_GET['id'],
        'email' => trim($_POST['email']),
        'username' => trim($_POST['username']),
        'user_type_id' => trim($_POST['user_type_id']),
        'Error' => ''
      ];

      $model = new User();
      if ($model->update($data)) {
        header('location: user-view');
      } else {
          die('Something went wrong.');
      }
    }

    $view = new View("admin/user-update");
    $view->assign('id', $users['id']);
    $view->assign('email', $users['email']);
    $view->assign('username', $users['username']);
    $view->assign('password', $users['password']);
    $view->assign('user_type_id', $users['user_type_id']);
    $view->assign('user_type', $type['type']);  
  }

  public function deleteUser(){
    $id = $_GET['id'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $model = new User();
      if($model->delete($id)) {
        header('location: user-view');
      } else {
        die('Something went wrong!');
      }
    }
  }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------------- Manage - Posts ----------------------------------------------------------//
    public function managePosts() {
      $model = new Post();
      $posts = $model->viewAllPost();
      $authors = $model->findAuthor();
      
      $view = new View("admin/manage-posts");
      $view->assign('posts', $posts);
      $view->assign('author', $authors);
    }

    public function deletePosts(){
      $id = $_GET['id'];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $model = new Post();
        if($model->delete($id)) {
          header('location: manage-posts');
        } else {
          die('Something went wrong!');
        }
      }
    }

// -----------*----------*---------*------Inbox (View/Update/Delete)---*-----------*-----------*--------------*-------//
// -------------------------------------- Inbox Controller Starts Here ------------------------------------------------//
    
  //admin/inbox
  public function inbox(){
    $type = 1;
    $model = new Message();
    $recieve = $model->viewUnread($type);
    $reply = $model->viewAdminReply($type);
    $sents = $model->viewSent($type);

    $view = new View("admin/inbox-view");
    $view->assign('recieve', $recieve);
    $view->assign('reply', $reply);
    $view->assign('sents', $sents);
  }

  //admin/send-reply
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
        header("Location: inbox-view");
      } else {
        die('Something went wrong.');
      }

    }
  
    $view = new View("admin/reply-add");
    $view->assign('id', $message['inbox_id']);
    $view->assign('email', $message['email']);
    $view->assign('subject', $message['subject']);
    $view->assign('message', $message['message']);
  }

  public function deleteUnreadMessage(){
    $id = $_GET['id'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $model = new Message();
      if($model->deleteUnread($id)) {
        header('location: inbox-view');
      } else {
        die('Something went wrong!');
      }
    }
  }

  public function deleteSentMessage(){
    $id = $_GET['id'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $model = new Message();
      if($model->deleteSent($id)) {
        header('location: inbox-view');
      } else {
        die('Something went wrong!');
      }
    }
  }

  public function deleteReplyMessage(){
    $id = $_GET['id'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $model = new Message();
      if($model->deleteReply($id)) {
        header('location: inbox-view');
      } else {
        die('Something went wrong!');
      }
    }
  }



//---------------*----------------------Transaction Functions Control--------------------*----------------------*--------//
    
  public function addTransaction() {
      $data = [
        'trans_id' => '',
        'order_id' => '',
        'user_id' => '',
        'date' => '',
        'payment_type' => '',
        'amount' => '',
        'status' => '',
        'Error' => ''
      ];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'order_id' => trim($_POST['order_id']),
          'user_id' => trim($_POST['user_id']),
          'date' => trim($_POST['date']),
          'payment_type' => trim($_POST['payment_type']),
          'amount' => trim($_POST['amount']),
          'status' => trim($_POST['status']),
          'Error' => ''
      ];

      //Check if Transaction already recorded.
      $model = new Transaction();
      if ($model->findTransaction($data['order_id'])) {
        $data['Error'] = 'Transaction is already inserted';
      }

      if (empty($data['Error'])){
        $model = new Transaction();
        if ($model->addTransaction($data)) {
          header('location: recievable-view');
        } else {
            die('Something went wrong.');
        }
      } 
    }
      $view = new View("admin/income-add");
      $view->assign('Error', $data['Error']);
    }

    public function viewPayable(){
      $view = new View("admin/payable-view");
      $model = new Transaction();
      $trans = $model->showPayable();
      $view->assign('trans', $trans);
    }

    public function viewRecievable(){
      $view = new View("admin/recievable-view");
      $model = new Transaction();
      $trans = $model->showRecievable();
      $view->assign('trans', $trans);
    }

    public function payableUpdate(){
      $trans_id = $_GET['id'];
      $model = new Transaction();
      $trans = $model->findTransactionById($trans_id);

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'trans_id' => $_GET['trans_id'],
          'order_id' => trim($_POST['order_id']),
          'user_id' => trim($_POST['user_id']),
          'date' => trim($_POST['date']),
          'payment_type' => trim($_POST['payment_type']),
          'amount' => trim($_POST['amount']),
          'status' => trim($_POST['status']),
          'Error' => ''
        ];

        $model = new Transaction();
        if ($model->updatePayable($data)) {
          header('location: payable-view');
        } else {
            die('Something went wrong.');
        }
      }

      $view = new View("admin/payable-update");
      $view->assign('trans_id', $trans['trans_id']);
      $view->assign('order_id', $trans['order_id']);
      $view->assign('user_id', $trans['user_id']);
      $view->assign('date', $trans['date']);
      $view->assign('payment_type', $trans['payment_type']);
      $view->assign('amount', $trans['amount']);
      $view->assign('status', $trans['status']);
      
    }

    public function payableDelete(){
      $id = $_GET['id'];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $model = new Transaction();
        if($model->deletePayable($id)) {
          header('location: payable-view');
        } else {
          die('Something went wrong!');
        }
      }
    }

    public function recievableUpdate(){
      $id = $_GET['id'];
      $model = new Transaction();
      $trans = $model->findTransactionById($id);

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'trans_id' => $_GET['trans_id'],
          'order_id' => trim($_POST['order_id']),
          'user_id' => trim($_POST['user_id']),
          'date' => trim($_POST['date']),
          'payment_type' => trim($_POST['payment_type']),
          'amount' => trim($_POST['amount']),
          'status' => trim($_POST['status']),
          'Error' => ''
        ];

        $model = new Transaction();
        if ($model->updateRecievable($data)) {
          header('location: recievable-view');
        } else {
            die('Something went wrong.');
        }
      }

      $view = new View("admin/recievable-update");
      $view->assign('trans_id', $trans['trans_id']);
      $view->assign('order_id', $trans['order_id']);
      $view->assign('user_id', $trans['user_id']);
      $view->assign('date', $trans['date']);
      $view->assign('payment_type', $trans['payment_type']);
      $view->assign('amount', $trans['amount']);
      $view->assign('status', $trans['status']);
      
      
    }

    public function recievableDelete(){
      $id = $_GET['id'];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $model = new Transaction();
        if($model->deleteRecievable($id)) {
          header('location: recievable-view');
        } else {
          die('Something went wrong!');
        }
      }
    }
    //--------------------------------------*******************--------------------*****************---------------//
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //------------------------- Seller- Requests ----------------------------------------------------------//
  public function viewRequest() {
    $model = new Request();
    $users = $model->showRequest();
    $view = new View("admin/seller-request");
    $view->assign('users', $users);
  }

  public function acceptRequest() {
    $id = $_GET['id'];
    $model = new Seller();
    $seller = $model->findSellerByID($id);
    $model = new Request();
    if($model->acceptSeller($seller)){
      header('location: user-view');
    }
    $view = new View("admin/accept-request");
  }

  public function deleteRequest(){
    $id = $_GET['id'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $model = new Request();
      if($model->removeRequest($id)) {
        header('location: seller-request');
      } else {
        die('Something went wrong!');
      }
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //------------------------- Driver - Requests ----------------------------------------------------------//
  public function viewDriverRequest() {
    $model = new Request();
    $users = $model->showDriverRequest();
    $view = new View("admin/driver-request");
    $view->assign('users', $users);
  }

  public function acceptDriverRequest() {
    $id = $_GET['id'];
    $model = new Driver();
    $driver = $model->findDriverByID($id);
    $model = new Request();
    if($model->acceptDriver($driver)){
      header('location: user-view');
    }
    $view = new View("admin/driver-request");
  }

  public function deleteDriverRequest(){
    $id = $_GET['id'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $model = new Request();
      if($model->removeDriverRequest($id)) {
        header('location: driver-request');
      } else {
        die('Something went wrong!');
      }
    }
  }
  
    //--------------------------------------Admin Profile Controller--------------------*****************---------------//
    public function myProfile() {
      $id = $_GET['id'];
      $model = new Admin();
      $user = $model->findUserById($id);
    
      $data = [
        'id' => '',
        'email' => '',
        'username' => '',
        'usernameError' => '',
        'emailError' => ''
      ];
    
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'id' => $_GET['id'],
          'email' => trim($_POST['email']),
          'username' => trim($_POST['username']),
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
        $model = new Admin();
        if($model->changeUsername($data['id'],$data['username'])){
          $model = new Admin();
          if ($model->findUserByUsername($data['username'])) {
            $data['usernameError'] = 'Username is already taken.';
          }
        }
    
        //check if the email is changed
        if($model->changeEmail($data['id'],$data['email'])){
          $model = new Admin();
          if($model->findUserByEmail($data['email'])) {
            $data['emailError'] = 'Email is already taken.';
          }
        }
            
    
        if (empty($data['usernameError']) && empty($data['emailError'])) {
          $model = new Admin();
          if ($model->update($data)) {
            echo "<script>";
            echo "alert('Successfully Changed!');";
            echo "window.location = '../admin/my-profile?id=".$data['id']."'"; // redirect with javascript, after page loads
            echo "</script>";
          }else{
            die('Something went wrong.');
          }
        }
      }
    
      $view = new View("admin/my-profile");
      $view->assign('id', $user['id']);
      $view->assign('email', $user['email']);
      $view->assign('username', $user['username']);
      $view->assign('usernameError', $data['usernameError']);
      $view->assign('emailError', $data['emailError']);
    }
    
    //admin/change-password
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
          $model = new Admin;
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
              $model = new Admin();
              if ($model->updatePassword($data)){
                echo "<script>";
                echo "alert('Successfully Changed!');";
                echo "window.location = '../admin/my-profile?id=".$data['id']."'"; // redirect with javascript, after page loads
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
    
      $view = new View("admin/change-password");
      $view->assign('passwordError', $data['passwordError']);
      $view->assign('confirmPasswordError', $data['confirmPasswordError']);
      $view->assign('error', $data['error']);
    }
  // ------------------------------------------------- Profile Controller Ends Here ------------------------------------------------//
  
  


//----------------------------------------**********************************************************----------------------//
    public function admin() {
      $view = new View("admin/admin");
    }

    public function manageSellerRequest() {
      $view = new View("admin/seller-request");
    }

    public function logout() {
      $view = new View("admin/logout");
    }

}