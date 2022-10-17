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
		$data = $_POST['data'];
		$data['password'] = $h->encodePQH($_POST['password']);
		$data['active'] = 1;
		
		$table = $prefixTable.$def['tableAdmin'];
		$result = $h->insertDataBy($data, $table, $user_id);
		if ($result)
			_e('1;success');
		else
			_e('2;error');
	} else
		_e('5;error');
