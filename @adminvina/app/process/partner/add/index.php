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

		$image = $_FILES['partnerLogo']['name'];
		$ext = substr($image, -4);
		$filename = substr($image, 0, -4);
		$imgUpload = '';
		if (in_array($ext, $array_ext_image)) {
			$path = $def['imgUploadPartnerRealPath'];
			if ($ext == 'jpeg' || $ext == 'JPEG' || $ext == 'webp') {
				$extGet = substr($image, -5);
				$filename = substr($image, 0, -5);
			} else
				$extGet = $ext;
			move_uploaded_file($_FILES['partnerLogo']['tmp_name'], $path.stringImage($filename).'-'.'partner'.time().$extGet);
			$imgUpload = stringImage($filename).'-'.'partner'.time().$extGet;
		}
		$data['partnerLogo'] = $imgUpload;
		$table = $prefixTable.$def['tablePartner'];
		$result = $h->insertDataBy($data, $table, $user_id);
		if ($result) 
			echo '1;success';
		else
			echo '2;error';
	} else
		echo '5;error';
