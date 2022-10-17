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
    $id = $_POST['id'];
    $data['active'] = $_POST['active'];
    $dataProduct['active'] = $_POST['active'];
    $table = $prefixTable.$def['tableCategories'];
    $tableProducts = $prefixTable.$def['tableProducts'];
    
    $result = $h->updateDataBy($data, $table, " where id = $id", $user_id);
    $resultProduct = $h->updateDataBy($dataProduct, $tableProducts, " where cateID = $id", $user_id);
  } else
    echo '5;error';
