<?php
# Database connection
// Database info
if (!defined('INDEX')) exit;
$database['server'] = "localhost"; // host
$database['user'] = "root"; //  username access to database
$database['pwd'] = ""; // password access to databse 
$database['name'] = "maihuong"; // database name
// Create connection
$h = new mysql();
$con = $h->connect($database['server'],$database['user'],$database['pwd'],$database['name']);
//$h->query("SET NAMES 'utf8'");
$adminemail = "quochoai.2202@gmail.com";
