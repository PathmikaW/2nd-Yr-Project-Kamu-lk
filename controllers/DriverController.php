<?php

require_once ROOT  . '/View.php';
require_once ROOT . '/models/Driver.php';

class DriverController {
  // driver/dash
  public function dash() {

  
    $view = new View("driver/dash");
  }
  public function updateStatus() {
   
    $id = $_GET['id'];
    $model = new Driver();
    $user = $model->findUserById($id);

    $data = [
      'id' => '',
      'status' => '',
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'id' => $_GET['id'],
        'status' => trim($_POST['status'])
      ];
      //  print_r($data);
      //  die;
      $model = new Driver();
      if ($model->updateStatus($data)) {
        echo "<script>alert('Status Updated')</script>";
      } else {
        die('Something went wrong.');
      } 

      if ($data['status']==1) {       
        // print_r($data);
        // die();
        echo "<script>alert('Drivar Available')</script>";
      } else {   
        echo "<script>alert('Currently Unavailable')</script>";
      }  
    
    $model = new Driver();
    $view = new View("driver/dash");
    $view->assign('status', $data['status']);
  }
}

  // driver/accept-orders
  public function acceptOrders() {
    $model = new Driver();
    $data = $model->getOrders();
    $view = new View("driver/accept-orders");
    $view->assign("data", $data);
  }

  //contact admin
  public function contactAdmin()
  {
    $id = $_GET['id'];
    $model = new Driver();
    $user = $model->findUserById($id);
    // print_r($user);
    // die();
    $data = [
      'id' => '',
      'username' => '',
      'email' => '',
      'subject' => '',
      'message' => '',
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'id' => $_GET['id'],
        'username' => $user['username'],
        'email' => $user['email'],
        'subject' => trim($_POST['subject']),
        'message' => trim($_POST['message'])
      ];


      $model = new Driver();
      if ($model->sendMessage($data)) {
        echo "<script>alert('Successfully Sent!')</script>";
      } else {
        die('Something went wrong.');
      }
    }
    $model = new Driver();

    $view = new View("driver/contact-admin");
  }



  // driver/earnings
  public function earnings() {
    $view = new View("driver/earnings");
  }


  // driver/my-profile
  public function myProfile()
  {
    $id = $_GET['id'];
    $model = new Driver();
    $user = $model->findUserById($id);

    $data = [
      'id' => '',
      'drivername' => '',
      'nic' => '',
      'licenseId' => '',
      'tele' => '',
      'email' => '',
      'usernameError' => '',
      'emailError' => ''
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'id' => $_GET['id'],
        'drivername' => trim($_POST['drivername']),
        'nic' => trim($_POST['nic']),
        'licenseId' => trim($_POST['license']),
        'tele' => trim($_POST['tele']),
        'email' => trim($_POST['email']),
        'usernameError' => '',
        'emailError' => ''
      ];

      $nameValidation = "/^[a-zA-Z0-9]*$/";

      //Validate username on letters/numbers
      if (empty($data['drivername'])) {
        $data['usernameError'] = 'Please enter driver name.';
      } elseif (!preg_match($nameValidation, $data['drivername'])) {
        $data['usernameError'] = 'Name can only contain letters and numbers.';
      }

      //Validate email
      if (empty($data['email'])) {
        $data['emailError'] = 'Please enter email address.';
      } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $data['emailError'] = 'Please enter the correct format.';
      }

      $model = new Driver();
      if ($model->changeUsername($data['id'], $data['drivername'])) {
        $model = new Driver();
        if ($model->findUserByUsername($data['drivername'])) {
          $data['usernameError'] = 'Username is already taken.';
        }
      }

      if ($model->changeEmail($data['id'], $data['email'])) {
        $model = new Driver();
        if ($model->findUserByEmail($data['email'])) {
          $data['emailError'] = 'Email is already taken.';
        }
      }


      if (empty($data['usernameError']) && empty($data['emailError'])) {
        $model = new Driver();
        if ($model->update($data)) {
          echo "<script>";
          echo "alert('Successfully Changed!');";
          echo "window.location = '../driver/my-profile?id=" . $data['id'] . "'"; // redirect with javascript, after page loads
          echo "</script>";
        } else {
          die('Something went wrong.');
        }
      }
    }


    $view = new View("driver/my-profile");
    $view->assign('id', $user['id']);
    $view->assign('drivername', $user['username']);
    $view->assign('nic', $user['nic']);
    $view->assign('license', $user['license']);
    $view->assign('tele', $user['contact']);
    $view->assign('email', $user['email']);
    $view->assign('usernameError', $data['usernameError']);
    $view->assign('emailError', $data['emailError']);
  }


  public function logout()
  {
    $view = new View("driver/logout");
  }


  public function changePassword()
  {
    $data = [
      'id' => '',
      'currentPassword' => '',
      'password' => '',
      'confirmPassword' => '',
      'passwordError' => '',
      'confirmPasswordError' => '',
      'error' => ''
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // print_r($_POST);
      // die();
      $data = [
        'id' => $_GET['id'],
        'currentPassword' => trim($_POST['currentPassword']),
        'password' => trim($_POST['password']),
        'confirmPassword' => trim($_POST['confirmPassword']),
        'passwordError' => '',
        'confirmPasswordError' => '',
        'error' => ''
      ];
      // print_r($data);
      // die();

      if (!empty($data['currentPassword'])) {
        $model = new Driver;
        if ($model->passwordVerify($data['id'], $data['currentPassword'])) {

          $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

          // Validate password on length, numeric values,
          if (empty($data['password'])) {
            $data['passwordError'] = 'Please enter password.';
          } elseif (strlen($data['password']) < 8) {
            $data['passwordError'] = 'Password must be at least 8 characters';
          } elseif (preg_match($passwordValidation, $data['password'])) {
            $data['passwordError'] = 'Password must be have at least one numeric value.';
          }

          //Validate confirm password
          if (empty($data['confirmPassword'])) {
            $data['confirmPasswordError'] = 'Please enter confirm password.';
          } else {
            if ($data['password'] != $data['confirmPassword']) {
              $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
            }
          }

          if (empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

            // Hash password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $model = new Driver();
            if ($model->updatePassword($data)) {
              echo "<script>";
              echo "alert('Successfully Changed!');";
              echo "window.location = '../driver/my-profile?id=" . $data['id'] . "'"; // redirect with javascript, after page loads
              echo "</script>";
            } else {
              die('Something went wrong.');
            }
          }
        } else {
          $data['error'] = 'Current Password not matched.';
        }
      } else {
        $data['error'] = 'Current Password cannot be empty.';
      }
    }


    $view = new View("driver/change-password");
    $view->assign('passwordError', $data['passwordError']);
    $view->assign('confirmPasswordError', $data['confirmPasswordError']);
    $view->assign('error', $data['error']);
  }


}