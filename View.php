<?php

class View
{
  private $data = array();

  private $render = FALSE;

  public function __construct($view_name)
  {
      try {
          $file = ROOT . '/views/' . $view_name . '.php';

          if (file_exists($file)) {
              $this->render = $file;
          } else {
            echo "View File Not Found";
            die();
          }
      }
      catch (Error $e) {
          echo $e;
      }
  }

  public function assign($variable, $value)
  {
      $this->data[$variable] = $value;
  }

  public function __destruct()
  {
      extract($this->data);
      include($this->render);
  }
}