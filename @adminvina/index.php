<?php
  require_once "library.php";
  /*
  if ($_SERVER['HTTPS'] !== 'on') {
    $url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('Location: ' . $url, true, 301);
    exit();
  }
  */
  if(!isset($_SESSION['is_logined']) && !isset($_COOKIE['islogined'])) // 
    require_once $def['loginView'];
  else 
    require_once $def['app'];
