<?php
  require_once "../../../../library.php";
	if (isset($_SESSION['is_logined']) || isset($_COOKIE['islogined'])) {
		if (isset($_SESSION['is_logined'])) {
			$user = $_SESSION['is_logined'];
			$user_id = $user['id'];
		} else {
			$islogin = explode("kiecook", $_COOKIE['islogined']);
			$muser = explode("cookie", $islogin[0]);
			$user_id = $muser[1];
		}
		$oldPassword = $_POST['oldPassword'];
		$newPassword = $_POST['newPassword'];
    $table = $prefixTable.$def['tableAdmin'];
		$admin = $h->getById($table, $user_id);
		$pass = $admin['password'];
		$oldPass = $h->encodePQH($oldPassword);
		if ($oldPass != $pass) 
			_e('3;error');
		else {
			$data['password'] = $h->encodePQH($newPassword);
			$result = $h->updateDataBy($data, $table, " where id = $user_id", $user_id);
			_e('1;success');
		}
  } else
    echo '5;error';