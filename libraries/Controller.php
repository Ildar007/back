<?php
  class Controller {
    // Load model
    public function model($model){
      // Require model file
      require_once  APPROOT.'/models/' . $model . '.php';

      // Instatiate model
      return new $model();
    }

    // Load view
    public function view($view, $data = []){
      // Check for view file
      if(file_exists('../views/' . $view . '.php')){
        require_once '../views/' . $view . '.php';
      } else {
        // View does not exist
        die('View does not exist');
      }
    }
  }