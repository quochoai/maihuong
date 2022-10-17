<?php
  require_once "../../../library.php";
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $remember = $_POST['remember'];
  $table = $prefixTable.'admins';
  $login = $h->loginUser($username, $password, $remember, $table);
  