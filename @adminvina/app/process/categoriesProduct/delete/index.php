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
    $ids = $_POST['id'];
    $table = $prefixTable.$def['tableCategories'];
    $tableProducts = $prefixTable.$def['tableProducts'];
    if (is_array($ids)) {
      foreach ($ids as $id) {
        $result = $h->softDeleteBy($table, " where id = $id", $user_id);
        $resultProduct = $h->softDeleteBy($tableProducts, " where cateID = $id", $user_id);
      }
    } else {
      $result = $h->softDeleteBy($table, " where id = $ids", $user_id);
      $resultProduct = $h->softDeleteBy($tableProducts, " where cateID = $ids", $user_id);
    }
  } else
    echo '5;error';
