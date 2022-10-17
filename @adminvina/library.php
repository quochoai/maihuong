<?php
  ini_set("default_socket_timeout", 6000);
  ini_set('session.gc_maxlifetime', 28800); // 8 hours
  set_time_limit(1200);
  @session_start();
  ob_start();
  define('INDEX', true);
  define("_dir_root_", str_replace("\\", "/", __DIR__));
  //define("_dir_root_", __DIR__);
  error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
  // Include required files
  require_once "define/def.php";
  require_once "language/vi.php";
  require_once "common/functions_mysql.php";  // Mysql functions
  //require_once "common/functions_common.php";  // Common functions
  require_once "common/function.php"; // Functions
  require_once "config/db_connection.php";  // DB connections
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $prefixTable = "mh_";
  $lng = "";
  $lngDefault = ""; // _vi
  $lngEn = "";
  $lngDefaultText = ""; // (Vi)
  $lngEnText = "";
