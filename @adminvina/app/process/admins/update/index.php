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
    $id = $_POST['idAdmin'];
    $data = $_POST['data'];
    if (isset($_POST['active']))
      $data['active'] = 1;
    else
      $data['active'] = 0;
    
		$pass = $_POST['password'];
    if ($pass != '')
			$data['password'] = $h->encodePQH($pass);

		$table = $prefixTable.$def['tableAdmin'];
		$result = $h->updateDataBy($data, $table, "where id = $id", $user_id);
		if ($result)
			_e('1;success');
		else
			_e('2;error');
	} else
		_e('5;error');
