<?php
  // Load Config
  require_once './config/config.php';
  require_once './helpers/url_helpers.php';

  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once APPROOT.'/libraries/'. $className . '.php';
  });