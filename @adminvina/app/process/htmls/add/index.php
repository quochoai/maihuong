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
		
		$table = $prefixTable.$def['tableHtmls'];
		$result = $h->insertDataBy($data, $table, $user_id);
		if ($result)
			echo '1;success';
		else
			echo '2;error';
	} else
		echo '5;error';
