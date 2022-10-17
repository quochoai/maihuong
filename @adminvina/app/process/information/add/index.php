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
		if (isset($_POST['active']))
			$data['active'] = 1;
		else
			$data['active'] = 0;
		$array_ext_image = array(".png", ".jpg", "jpeg", ".gif", ".bmp", ".PNG", ".JPG", "JPEG", ".GIF", ".BMP", "webp");

		$imageShareFb = $_FILES['imageShareFb']['name'];
		$extShareFb = substr($imageShareFb, -4);
		$filenameShareFb = substr($imageShareFb, 0, -4);
		$imgUploadShareFb = '';
		if (in_array($extShareFb, $array_ext_image)) {
			$path = $def['imgUploadInfoRealPath'];
			if ($extShareFb == 'jpeg' || $extShareFb == 'JPEG' || $extShareFb == 'webp') {
				$extGetFb = substr($imageShareFb, -5);
				$filenameShareFb = substr($imageShareFb, 0, -5);
			} else
				$extGetFb = $extShareFb;
			move_uploaded_file($_FILES['imageShareFb']['tmp_name'], $path.stringImage($filenameShareFb).'-'.'infoShareFB'.time().$extGetFb);
			$imgUploadShareFb = stringImage($filenameShareFb).'-'.'infoShareFB'.time().$extGetFb;
		}
		$data['imageShareFb'] = $imgUploadShareFb;
		
		$table = $prefixTable.$def['tableInformations'];
		$result = $h->insertDataBy($data, $table, $user_id);
		if ($result)
			echo '1;success';
		else
			echo '2;error';
	} else
		echo '5;error';