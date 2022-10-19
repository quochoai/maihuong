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
    $id = $_POST['idNews'];
    $data = $_POST['data'];
    if (isset($_POST['active'])) {
        $data['active'] = 1;
    } else {
        $data['active'] = 0;
    }
		$pd = $data['postDate'];
		if ($pd != '') {
			$pd = explode("/", $pd);
			$data['postDate'] = $pd[2].'-'. $pd[1].'-'.$pd[0].' '.date("H:i:s");
		}

    $array_ext_image = array(".png", ".jpg", "jpeg", ".gif", ".bmp", ".PNG", ".JPG", "JPEG", ".GIF", ".BMP", "webp");

    $image = $_FILES['imageNews']['name'];
		if ($image != '') {
			$ext = substr($image, -4);
			$filename = substr($image, 0, -4);
			$imgUpload = '';
			if (in_array($ext, $array_ext_image)) {
				$path = $def['imgUploadNewsRealPath'];
				if ($ext == 'jpeg' || $ext == 'JPEG' || $ext == 'webp') {
					$extGet = substr($image, -5);
					$filename = substr($image, 0, -5);
				} else
					$extGet = $ext;
				move_uploaded_file($_FILES['imageNews']['tmp_name'], $path.stringImage($filename).'-'.'news'.time().$extGet);
				$imgUpload = stringImage($filename).'-'.'news'.time().$extGet;
			}
			$data['imageNews'] = $imgUpload;
		}

		$imageShareFb = $_FILES['imageShareFb']['name'];
		if ($imageShareFb != '') {
			$extShareFb = substr($imageShareFb, -4);
			$filenameShareFb = substr($imageShareFb, 0, -4);
			$imgUploadShareFb = '';
			if (in_array($extShareFb, $array_ext_image)) {
				$path = $def['imgUploadNewsRealPath'];
				if ($extShareFb == 'jpeg' || $extShareFb == 'JPEG' || $extShareFb == 'webp') {
					$extGetFb = substr($imageShareFb, -5);
					$filenameShareFb = substr($imageShareFb, 0, -5);
				} else
					$extGetFb = $extShareFb;
				move_uploaded_file($_FILES['imageShareFb']['tmp_name'], $path.stringImage($filenameShareFb).'-'.'newsShareFB'.time().$extGetFb);
				$imgUploadShareFb = stringImage($filenameShareFb).'-'.'newsShareFB'.time().$extGetFb;
			}
			$data['imageShareFb'] = $imgUploadShareFb;
		}
		/*
		$tags = $_POST['tags'];
		if (count($tags) > 0) {
			$data['tags'] = implode(",", $tags);
		} else {
			$data['tags'] = NULL;
		}
		*/
		$table = $prefixTable.$def['tableNews'];
		$result = $h->updateDataBy($data, $table, "where id = $id", $user_id);
		if ($result)
			echo '1;success';
		else
			echo '2;error';
	} else
		echo '5;error';
