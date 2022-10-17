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
		
		$pd = $data['postDate'];
		if ($pd != '') {
			$pd = explode("/", $pd);
			$data['postDate'] = $pd[2].'-'. $pd[1].'-'.$pd[0].' '.date("H:i:s");
		}
		$array_ext_image = array(".png", ".jpg", "jpeg", ".gif", ".bmp", ".PNG", ".JPG", "JPEG", ".GIF", ".BMP", "webp");

		$image = $_FILES['imageOrder']['name'];
		$ext = substr($image, -4);
		$filename = substr($image, 0, -4);
		$imgUpload = '';
		if (in_array($ext, $array_ext_image)) {
			$path = $def['imgUploadOrderRealPath'];
			//if (!file_exists($path.stringImage($image))) {
			$width = 500;
			$height = 333;
			if ($ext == 'jpeg' || $ext == 'JPEG' || $ext == 'webp')
				$extGet = '.'.$ext;
			else
				$extGet = $ext;
			$imgUpload = resizeImage2($width, $height, stringImage($image), $path, $_FILES['imageOrder']['tmp_name'], stringImage($filename).'-'.'ordernews'.time().$extGet);
			//}
		}
		$data['imageOrder'] = $imgUpload;

		$imageShareFb = $_FILES['imageShareFb']['name'];
		$extShareFb = substr($imageShareFb, -4);
		$filenameShareFb = substr($imageShareFb, 0, -4);
		$imgUploadShareFb = '';
		if (in_array($extShareFb, $array_ext_image)) {
			$path = $def['imgUploadOrderRealPath'];
			//if (!file_exists($path.stringImage($image))) {
			$widthFb = 450;
			$heightFb = 235;
			if ($extShareFb == 'jpeg' || $extShareFb == 'JPEG' || $extShareFb == 'webp')
				$extGetFb = '.'.$extShareFb;
			else
				$extGetFb = $extShareFb;
			$imgUploadShareFb = resizeImage2($widthFb, $heightFb, stringImage($imageShareFb), $path, $_FILES['imageShareFb']['tmp_name'], stringImage($filenameShareFb).'-'.'ordernewsShareFB'.time().$extGetFb);
			//}
		}
		$data['imageShareFb'] = $imgUploadShareFb;
		$tags = $_POST['tags'];
		if (count($tags) > 0) {
			$data['tags'] = implode(",", $tags);
		}
		
		$table = $prefixTable.$def['tableOrders'];
		$result = $h->insertDataBy($data, $table, $user_id);
		if ($result) {
			echo '1;success';
		} else
			echo '2;error';
	} else
		echo '5;error';