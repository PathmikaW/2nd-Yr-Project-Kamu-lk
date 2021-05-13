<?php

require_once ROOT  . '/View.php';
require_once ROOT . '/models/Auth.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class AuthController {

  public function login() {  
    $data = [
        'username' => '',
        'password' => '',
        'usernameError' => '',
        'passwordError' => '',
    ];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'username' => trim($_POST['username']),
        'password' => trim($_POST['password']),
        'usernameError' => '',
        'passwordError' => '',
      ];

      //validate username
        if (empty($data['username'])) {
          $data['usernameError'] = 'Please enter a username.';
        }
      //Validate password
        if (empty($data['password'])) {
          $data['passwordError'] = 'Please enter a password.';
        }
        
      //check for username
        $model = new Auth();
        if(!$model->findUserByUsername($data['username'])){
          $data['usernameError'] = 'Invalid username.';
        }

        if (empty($data['usernameError']) && empty($data['passwordError'])) {
          $model = new Auth();
          $loggedInUser = $model->login($data['username'], $data['password']);
          
          if($loggedInUser){
            if ($loggedInUser['user_type_id'] == 1) {
              session_start();
              $_SESSION['loggedin'] = ['user_type' => 'ADMIN', 'user_id' => $loggedInUser['id'], 'username' => $loggedInUser['username']];
              header('location: ../admin/admin');
              die();
            }
            else if ($loggedInUser['user_type_id'] == 2) {
              session_start();
              $_SESSION['loggedin'] = ['user_type' => 'NUTRITIONIST', 'user_id' => $loggedInUser['id'], 'username' => $loggedInUser['username'], 'email' => $loggedInUser['email']];
              // print_r($_SESSION['loggedin']);
              // die();
              header('location: ../nutritionist/dashboard');
              die();
            }else if ($loggedInUser['user_type_id'] == 3) {
              session_start();
              $_SESSION['loggedin'] = ['user_type' => 'USER', 'user_id' => $loggedInUser['id'], 'username' => $loggedInUser['username']];
              // print_r($_SESSION['loggedin']['user_id']);
              // die();
              header('location: ../user/user-dash');
              die();
            }else if ($loggedInUser['user_type_id'] == 4) {
              session_start();
              $_SESSION['loggedin'] = ['user_type' => 'SELLER', 'user_id' => $loggedInUser['id'], 'username' => $loggedInUser['username']];
              header('location: ../seller/dash');
              die();
            }else if ($loggedInUser['user_type_id'] == 5) {
              session_start();
              $_SESSION['loggedin'] = ['user_type' => 'DRIVER', 'user_id' => $loggedInUser['id'], 'username' => $loggedInUser['username']];
              header('location: ../driver/dash');
              die();
            }
          } else {
            $data['passwordError'] = 'Password or username is incorrect. Please try again.';
          }
        } 
      }else{
        $data = [
          'username' => '',
          'password' => '',
          'usernameError' => '',
          'passwordError' => ''
        ];
      } 
      $view = new View("auth/login");
      $view->assign('usernameError', $data['usernameError']);
      $view->assign('passwordError', $data['passwordError']);
  }

  public function signUpUser(){
      $data = [
        'username' => '',
        'email' => '',
        'password' => '',
        'confirmPassword' => '',
        'userTypeId' => '',
        'usernameError' => '',
        'emailError' => '',
        'passwordError' => '',
        'confirmPasswordError' => ''
      ];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'username' => trim($_POST['username']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirmPassword' => trim($_POST['confirmPassword']),
          'userTypeId' => trim($_POST['userTypeId']),
          'usernameError' => '',
          'emailError' => '',
          'passwordError' => '',
          'confirmPasswordError' => ''
      ];

        $nameValidation = "/^[a-zA-Z0-9]*$/";
        $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

        //Validate username on letters/numbers
        if (empty($data['username'])) {
          $data['usernameError'] = 'Please enter username.';
        } elseif (!preg_match($nameValidation, $data['username'])) {
          $data['usernameError'] = 'Name can only contain letters and numbers.';
        }else {
          //Check if username exists.
          $model = new Auth();
          if ($model->findUserByUsername($data['username'])) {
          $data['usernameError'] = 'Username is already taken.';
          }
        }

        //Validate email
        if (empty($data['email'])) {
            $data['emailError'] = 'Please enter email address.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $data['emailError'] = 'Please enter the correct format.';
        } else {
            //Check if email exists.
            $model = new Auth();
            if ($model->findUserByEmail($data['email'])) {
            $data['emailError'] = 'Email is already taken.';
            }
        }

        // Validate password on length, numeric values,
        if(empty($data['password'])){
          $data['passwordError'] = 'Please enter password.';
        } elseif(strlen($data['password']) < 8){
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

        // Make sure that errors are empty
        if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

            // Hash password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $model = new Auth();

            if ($model->userSignUp($data)) {
                header('location: login');
            } else {
                die('Something went wrong.');
            }
        }
  }
    $view = new View("auth/signup-user");
    $view->assign('usernameError', $data['usernameError']);
    $view->assign('emailError', $data['emailError']);
    $view->assign('passwordError', $data['passwordError']);
    $view->assign('confirmPasswordError', $data['confirmPasswordError']);
  }

  public function forgotPassword(){

    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';

    $data = [
      'email' => '',
      'emailError' => ''
    ];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
 
      //sanitize POST variable, remove tags and encode special characters
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'email' => trim($_POST['email']),
        'emailError' => ''
      ];

      //Validate email
      if(empty($data['email'])) {
        $data['emailError'] = 'Please enter email address.';
      }elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
          $data['emailError'] = 'Please enter the correct format.';
      }else{
          //Check if email exists.
          $model = new Auth();
          if (!$model->findUserByEmail($data['email'])) {
            $data['emailError'] = 'Email not found.';
          }
      }

      if(empty($data['emailError'])){
        $emailTo = $data['email'];
        $code = uniqid(true);

        $model = new Auth();
        if($model->insertCode($code,$emailTo)){
          //Instantiation and passing `true` enables exceptions
          $mail = new PHPMailer(true);
          try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'kamuproject2021@gmail.com';                     //SMTP username
            $mail->Password   = 'KAMUproject123';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('kamuproject2021@gmail.com', 'Kamuproject');
            $mail->addAddress("$emailTo");     //Add a recipient             
            $mail->addReplyTo('no-reply@kamuproject2021.com', 'No-reply');

            //Content
            $url = "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/auth/reset-password?code=$code";
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Your Password reset link';
            $mail->Body    = "<h1>You requested the password reset</h1>
                                Click <a href=$url>this link</a> to reset password";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            $data['emailError'] = 'Reset link send to your email.Please Check!';
          }catch (Exception $e){
                  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
          }           
        }
      }

    }

    $view = new View("auth/forgot-password");
    $view->assign('emailError', $data['emailError']);
  }

  public function resetPassword(){
    if(!isset($_GET['code'])){
      exit("Cant Find Page");
    }

    $code = $_GET['code'];

    $model =new Auth();
    $user = $model->getEmail($code);
   
    if($user){
      $email = $user['email'];
     
    }else{
      exit("Cant Find Page");
    }

    $data = [
      'email' => "$email",
      'password' => '',
      'passwordError' => ''
    ];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
 
      //sanitize POST variable, remove tags and encode special characters
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'email' => "$email",
        'password' => trim($_POST['password']),
        'passwordError' => ''
      ];

      $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

      // Validate password on length, numeric values,
      if(empty($data['password'])){
        $data['passwordError'] = 'Please enter password.';
      } elseif(strlen($data['password']) < 8){
        $data['passwordError'] = 'Password must be at least 8 characters';
      } elseif (preg_match($passwordValidation, $data['password'])) {
        $data['passwordError'] = 'Password must be have at least one numeric value.';
      }

      // Make sure that errors are empty
      if (empty($data['passwordError'])){
      // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $model = new Auth();
        if($model->resetPassword($data['password'],$email)){
          header('location: login');
        }else {
          die('Something went wrong.');
        }
      }
    }
    $view = new View("auth/reset-password");
    $view->assign('passwordError', $data['passwordError']);
}


/**seller signup */

public function signUpSeller(){
  $data = [
    'resname' => '',
    'resaddress' => '',
    'sellername' => '',
    'tele' => '',
    'email' => '',
    'password' => '',
    'confirmPassword' => '',
    'userTypeId' => '',
    'usernameError' => '',
    'emailError' => '',
    'passwordError' => '',
    'confirmPasswordError' => ''
  ];

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $data = [
      'resname' => trim($_POST['resname']),
      'resaddress' => trim($_POST['resaddress']),
      'sellername' => trim($_POST['sellername']),
      'tele' => trim($_POST['tele']),
      'email' => trim($_POST['email']),
      'password' => trim($_POST['password']),
      'confirmPassword' => trim($_POST['confirmPassword']),
      'userTypeId' => trim($_POST['userTypeId']),
      'usernameError' => '',
      'emailError' => '',
      'passwordError' => '',
      'confirmPasswordError' => ''
  ];

    $nameValidation = "/^[a-zA-Z0-9]*$/";
    $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

    //Validate username on letters/numbers
    if (empty($data['sellername'])) {
      $data['usernameError'] = 'Please enter sellername.';
    } elseif (!preg_match($nameValidation, $data['sellername'])) {
      $data['usernameError'] = 'Name can only contain letters and numbers.';
    }else {
      //Check if username exists.
      $model = new Auth();
      if ($model->findUserByUsername($data['sellername'])) {
      $data['usernameError'] = 'Username is already taken.';
      }
    }

    //Validate email
    if (empty($data['email'])) {
        $data['emailError'] = 'Please enter email address.';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $data['emailError'] = 'Please enter the correct format.';
    } else {
        //Check if email exists.
        $model = new Auth();
        if ($model->findUserByEmail($data['email'])) {
        $data['emailError'] = 'Email is already taken.';
        }
    }

    // Validate password on length, numeric values,
    if(empty($data['password'])){
      $data['passwordError'] = 'Please enter password.';
    } elseif(strlen($data['password']) < 8){
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

    // Make sure that errors are empty
    if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $model = new Auth();

        if ($model->signupSeller($data)) {
            header('location: login');
        } else {
            die('Something went wrong.');
        }
    }
}
$view = new View("auth/signup-seller");
$view->assign('usernameError', $data['usernameError']);
$view->assign('emailError', $data['emailError']);
$view->assign('passwordError', $data['passwordError']);
$view->assign('confirmPasswordError', $data['confirmPasswordError']);
}

// signup driver
public function signUpDriver(){
  $data = [
    'drivername' => '',
    'nic' => '',
    'licenseId' => '',
    'tele' => '',
    'email' => '',
    'password' => '',
    'confirmPassword' => '',
    'userTypeId' => '',
    'usernameError' => '',
    'emailError' => '',
    'passwordError' => '',
    'confirmPasswordError' => ''
  ];

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $data = [
      'drivername' => trim($_POST['drivername']),
      'nic' => trim($_POST['nic']),
      'licenseId' => trim($_POST['licenceId']),
      'tele' => trim($_POST['tele']),
      'email' => trim($_POST['email']),
      'password' => trim($_POST['password']),
      'confirmPassword' => trim($_POST['confirmPassword']),
      'userTypeId' => trim($_POST['userTypeId']),
      'usernameError' => '',
      'emailError' => '',
      'passwordError' => '',
      'confirmPasswordError' => ''
  ];

    $nameValidation = "/^[a-zA-Z0-9]*$/";
    $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

    //Validate username on letters/numbers
    if (empty($data['drivername'])) {
      $data['usernameError'] = 'Please enter drivername.';
    } elseif (!preg_match($nameValidation, $data['drivername'])) {
      $data['usernameError'] = 'Name can only contain letters and numbers.';
    }else {
      //Check if username exists.
      $model = new Auth();
      if ($model->findUserByUsername($data['drivername'])) {
      $data['usernameError'] = 'Username is already taken.';
      }
    }

    //Validate email
    if (empty($data['email'])) {
        $data['emailError'] = 'Please enter email address.';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $data['emailError'] = 'Please enter the correct format.';
    } else {
        //Check if email exists.
        $model = new Auth();
        if ($model->findUserByEmail($data['email'])) {
        $data['emailError'] = 'Email is already taken.';
        }
    }

    // Validate password on length, numeric values,
    if(empty($data['password'])){
      $data['passwordError'] = 'Please enter password.';
    } elseif(strlen($data['password']) < 8){
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

    // Make sure that errors are empty
    if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $model = new Auth();

        if ($model->signupDriver($data)) {
            header('location: login');
        } else {
            die('Something went wrong.');
        }
    }
}
$view = new View("auth/signup-driver");
$view->assign('usernameError', $data['usernameError']);
$view->assign('emailError', $data['emailError']);
$view->assign('passwordError', $data['passwordError']);
$view->assign('confirmPasswordError', $data['confirmPasswordError']);
}





}