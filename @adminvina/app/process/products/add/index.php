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

		$image = $_FILES['imageProduct']['name'];
		$ext = substr($image, -4);
		$filename = substr($image, 0, -4);
		$imgUpload = '';
		$path = $def['imgUploadProductRealPath'];
		if (in_array($ext, $array_ext_image)) {
			if ($ext == 'jpeg' || $ext == 'JPEG' || $ext == 'webp') {
				$extGet = substr($image, -5);
				$filename = substr($image, 0, -5);
			} else
				$extGet = $ext;
			move_uploaded_file($_FILES['imageProduct']['tmp_name'], $path.stringImage($filename).'-'.'product'.time().$extGet);
			$imgUpload = stringImage($filename).'-'.'product'.time().$extGet;
		}
		$data['imageProduct'] = $imgUpload;

		$imageShareFb = $_FILES['imageShareFb']['name'];
		$extShareFb = substr($imageShareFb, -4);
		$filenameShareFb = substr($imageShareFb, 0, -4);
		$imgUploadShareFb = '';
		if (in_array($extShareFb, $array_ext_image)) {
			if ($extShareFb == 'jpeg' || $extShareFb == 'JPEG' || $extShareFb == 'webp') {
				$extGetFb = substr($imageShareFb, -5);
				$filenameShareFb = substr($imageShareFb, 0, -5);
			} else
				$extGetFb = $extShareFb;
			move_uploaded_file($_FILES['imageShareFb']['tmp_name'], $path.stringImage($filenameShareFb).'-'.'productShareFB'.time().$extGetFb);
			$imgUploadShareFb = stringImage($filenameShareFb).'-'.'productShareFB'.time().$extGetFb;
		}
		$data['imageShareFb'] = $imgUploadShareFb;

		$images = $_FILES['images']['name'];
		if (count($images) > 0) {
			$imgUploadDetail = '';
			foreach ($images as $ki => $vi) {
				$extDetail = substr($vi, -4);
				$filenameDetail = substr($vi, 0, -4);
				if (in_array($extDetail, $array_ext_image)) {
						if ($extDetail == 'jpeg' || $extDetail == 'JPEG' || $extDetail == 'webp') {
								$extGetDetail = substr($vi, -5);
								$filenameDetail = substr($vi, 0, -5);
						} else {
								$extGetDetail = $extDetail;
						}
						move_uploaded_file($_FILES['images']['tmp_name'][$ki], $path.stringImage($filenameDetail).'-'.'productDetail'.time().$extGetDetail);
						$imgUploadDetail .= stringImage($filenameDetail).'-'.'productDetail'.time().$extGetDetail.';';
				}
			}
			$imgUploadDetail = ($imgUploadDetail != '') ? substr($imgUploadDetail, 0, -1) : '';
			$data['imageDetail'] = $imgUploadDetail;
		}

		$tags = $_POST['tags'];
		if (count($tags) > 0) {
			$data['tags'] = implode(",", $tags);
		}
		
		$table = $prefixTable.$def['tableProducts'];
		$result = $h->insertDataBy($data, $table, $user_id);
		if ($result)
			_e('1;success');
		else
			_e('2;error');
	} else
		_e('5;error');
