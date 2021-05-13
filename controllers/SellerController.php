<?php

require_once ROOT  . '/View.php';
require_once ROOT  . '/models/Seller.php';
require_once ROOT  . '/models/Menuitems.php';

class SellerController
{
  // seller/dash
  public function dash()
  {
    $model = new Seller();
    $count = $model->getCount();

    $view = new View("seller/dash");
    $view->assign('count', $count);
  }

  // seller/my-profile
  public function myProfile()
  {
    $id = $_GET['id'];
    $model = new Seller();
    $user = $model->findUserById($id);

    $data = [
      'id' => '',
      'seller_name' => '',
      'res_name' => '',
      'res_address' => '',
      'tele' => '',
      'email' => '',
      'usernameError' => '',
      'emailError' => ''
    ];


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'id' => $_GET['id'],
        'seller_name' => trim($_POST['sellername']),
        'res_name' => trim($_POST['resname']),
        'res_address' => trim($_POST['resaddress']),
        'tele' => trim($_POST['tele']),
        'email' => trim($_POST['email']),
        'usernameError' => '',
        'emailError' => ''
      ];

      $nameValidation = "/^[a-zA-Z0-9]*$/";

      //Validate username on letters/numbers
      if (empty($data['seller_name'])) {
        $data['usernameError'] = 'Please enter sellername.';
      } elseif (!preg_match($nameValidation, $data['seller_name'])) {
        $data['usernameError'] = 'Name can only contain letters and numbers.';
      }

      //Validate email
      if (empty($data['email'])) {
        $data['emailError'] = 'Please enter email address.';
      } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $data['emailError'] = 'Please enter the correct format.';
      }

      $model = new Seller();
      if ($model->changeUsername($data['id'], $data['seller_name'])) {
        $model = new Seller();
        if ($model->findUserByUsername($data['seller_name'])) {
          $data['usernameError'] = 'Username is already taken.';
        }
      }

      if ($model->changeEmail($data['id'], $data['email'])) {
        $model = new Seller();
        if ($model->findUserByEmail($data['email'])) {
          $data['emailError'] = 'Email is already taken.';
        }
      }
      if (isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload']['name'])) {
        $target_dir =  ROOT . "/assets/restaurant/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {  
          echo "Sorry, there was an error uploading your file.";
          die();
        }
        $file = "assets/restaurant/" . basename($_FILES["fileToUpload"]["name"]);
      } 

      if (empty($data['usernameError']) && empty($data['emailError'])) {
        $model = new Seller();
        if ($model->update($data,$file)) {
          echo "<script>";
          echo "alert('Successfully Changed!');";
          echo "window.location = '../seller/my-profile?id=" . $data['id'] . "'"; // redirect with javascript, after page loads
          echo "</script>";
        } else {
          die('Something went wrong.');
        }
      }
    }

    $model = new Seller();
    $count = $model->getCount();

    $view = new View("seller/my-profile");
    $view->assign('id', $user['res_id']);
    $view->assign('seller_name', $user['sellername']);
    $view->assign('res_name', $user['resname']);
    $view->assign('res_address', $user['resaddress']);
    $view->assign('tele', $user['phonenumber']);
    $view->assign('email', $user['email']);
    $view->assign('image', $user['res_img']);
    $view->assign('usernameError', $data['usernameError']);
    $view->assign('emailError', $data['emailError']);
    $view->assign('count', $count);
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
        $model = new Seller;
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
            $model = new Seller();
            if ($model->updatePassword($data)) {
              echo "<script>";
              echo "alert('Successfully Changed!');";
              echo "window.location = '../seller/my-profile?id=" . $data['id'] . "'"; // redirect with javascript, after page loads
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

    $model = new Seller();
    $count = $model->getCount();

    $view = new View("seller/change-password");
    $view->assign('passwordError', $data['passwordError']);
    $view->assign('confirmPasswordError', $data['confirmPasswordError']);
    $view->assign('error', $data['error']);
    $view->assign('count', $count);
  }

  // seller/add-food-item
  public function addFoodItem()
  {
    $id = $_GET['id'];
 
    // $_SESSION['menu_item']['item_name'] = '';
 

    if (isset($_POST['submit'])) {
      if (isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload']['name'])) {
      $target_dir =  ROOT . "/assets/uploads/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {  
        echo "Sorry, there was an error uploading your file.";
        die();
      }
      $file = "assets/uploads/" . basename($_FILES["fileToUpload"]["name"]);
    } else {
      header("Location: add-food-item");
    }

    // $model = new Menuitems();
    // if($model->findMenuItem($_POST['item_name'],$id)){
    //   echo "Error name same";
    //   die();
    // }else{
    //   echo "Error name differnt";
    //   die();
    // }

      $model = new Menuitems();
      $model->addFood($_POST, $file,$id);
      header("Location: view-food-item?id=$id");
    }

    
    $model = new Seller();
    $count = $model->getCount();


    $view = new View("seller/add-food-item");
    $view->assign('count', $count);
  }

  // seller/edit-food-item
  public function editFoodItem()
  {
    $item_id = $_GET['id'];
    $model = new Menuitems();
    $data = $model->getMenuItem($item_id);
    $_SESSION['edit_menu_item']['item_name'] = '';

    if (isset($_POST['submit'])) {
      $user_id = $_POST['user_id'];
      if (isset($_FILES['fileToUpload']) && !empty($_FILES['fileToUpload']['name'])) {
        $target_dir =  ROOT . "/assets/uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
          echo "Sorry, there was an error uploading your file.";
          die();
        }

        $file = "assets/uploads/" . basename($_FILES["fileToUpload"]["name"]);
      } else {
        $file = $data['image'];
      }

      $model = new Menuitems();
      $model->editFood($_POST, $file);
      header("Location: view-food-item?id=$user_id");
    }
    $model = new Seller();
    $count = $model->getCount();

    $view = new View("seller/edit-food-item");
    $view->assign('data', $data);
    $view->assign('count', $count);
  }

  // seller/view-food-item
  public function viewFoodItem()
  {
    $id = $_GET['id'];
    $model = new Seller();
    $count = $model->getCount();
    $model = new Menuitems();
    $data = $model->getMenuItems($id);
    $view = new View("seller/view_food_item");
    $view->assign('data', $data);
    $view->assign('count', $count);
  }
  public function Deleteitem(){
    $id = $_GET['id'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $user_id = $_POST['user_id'];
      // print_r($id);
      // die();

      $model = new Menuitems();
      if($model->deleteitems($id)) {
        header("location: view-food-item?id=$user_id");
      } else {
        die('Something went wrong!');
      }
    }
  }

  // seller/view-order
  public function viewOrder()
  {
    $model = new Seller();
    $data = $model->getOrders();
    $drivers = $model->getDrivers();
    $count = $model->getCount();

    $view = new View("seller/view-order");
    $view->assign('data', $data);
    $view->assign('drivers', $drivers);
    $view->assign('count', $count);
  }


  // seller/contact-admin
  public function contactAdmin()
  {
    $id = $_GET['id'];
    $model = new Seller();
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
        'username' => $user['sellername'],
        'email' => $user['email'],
        'subject' => trim($_POST['subject']),
        'message' => trim($_POST['message'])
      ];


      $model = new Seller();
      if ($model->sendMessage($data)) {
        echo "<script>alert('Successfully Sent!')</script>";
      } else {
        die('Something went wrong.');
      }
    }
    $model = new Seller();
    $count = $model->getCount();

    $view = new View("seller/contact-admin");
    $view->assign('count', $count);
  }

  public function acceptOrder()
  {
    $id = $_GET['id'];
    $model = new Seller();
    $model->acceptOrder($id);
    header('Location: view-order');
  }

  public function rejectOrder()
  {
    $id = $_GET['id'];
    $model = new Seller();
    $model->rejectOrder($id);
    header('Location: view-order');
  }

  public function assignDriver()
  {
    $driver = $_POST['driver'];
    $id = $_POST['id'];

    $model = new Seller();
    $model->assignDriver($driver, $id);
    header('Location: view-order');
  }

  public function logout()
  {
    $view = new View("user/logout");
  }
}
