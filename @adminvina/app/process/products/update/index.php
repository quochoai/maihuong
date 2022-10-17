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
    $id = $_POST['idProduct'];
    $data = $_POST['data'];
    if (isset($_POST['active'])) {
        $data['active'] = 1;
    } else {
        $data['active'] = 0;
    }

    $array_ext_image = array(".png", ".jpg", "jpeg", ".gif", ".bmp", ".PNG", ".JPG", "JPEG", ".GIF", ".BMP", "webp");
		$image = $_FILES['imageProduct']['name'];
		$ext = substr($image, -4);
		$filename = substr($image, 0, -4);
		$imgUpload = '';
		if (in_array($ext, $array_ext_image)) {
			$path = $def['imgUploadProductRealPath'];
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
			$path = $def['imgUploadProductRealPath'];
			if ($extShareFb == 'jpeg' || $extShareFb == 'JPEG' || $extShareFb == 'webp') {
				$extGetFb = substr($imageShareFb, -5);
				$filenameShareFb = substr($imageShareFb, 0, -5);
			} else
				$extGetFb = $extShareFb;
			move_uploaded_file($_FILES['imageShareFb']['tmp_name'], $path.stringImage($filenameShareFb).'-'.'productShareFB'.time().$extGetFb);
			$imgUploadShareFb = stringImage($filenameShareFb).'-'.'productShareFB'.time().$extGetFb;
		}
		$data['imageShareFb'] = $imgUploadShareFb;

		$olds = $_POST['old'];
		$array_old = array();
		if (count($olds) > 0) {
			$numberOldGet = count($olds) - $number_new;
			for ($i = 0; $i < $numberOldGet; $i++) {
				$old = explode("/", $olds[$i]);
				array_push($array_old, $old[count($old) - 1]);
			}
			$gallery_old = implode(";", $array_old);
		}
		$images = $_FILES['images']['name'];
		$number_new = count($images);
		$olds = $_POST['old'];
		$array_old = array();
		$gallery_old = '';
		if (count($olds) > 0) {
			$numberOldGet = count($olds) - $number_new;
			for ($i = 0; $i < $numberOldGet; $i++) {
				$old = explode("/", $olds[$i]);
				array_push($array_old, $old[count($old) - 1]);
			}
			$gallery_old = implode(";", $array_old);
		}
		$gallery_new = '';
		if (count($images) > 0) {
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
						$gallery_new .= stringImage($filenameDetail).'-'.'productDetail'.time().$extGetDetail.';';
				}
			}
		}
		$imgUploadDetail = '';
		if ($gallery_old != '') {
			if ($gallery_new != '') 
				$imgUploadDetail = $gallery_old.';'.substr($gallery_new, 0, -1);
			else
				$imgUploadDetail = $gallery_old;
		} else {
			if ($gallery_new != '')
				$imgUploadDetail = substr($gallery_new, 0, -1);
		}

		$data['imageDetail'] = $imgUploadDetail;
		
		$tags = $_POST['tags'];
		$data['tags'] = (count($tags) > 0) ? implode(",", $tags) : NULL;

		$table = $prefixTable.$def['tableProducts'];
		$result = $h->updateDataBy($data, $table, "where id = $id", $user_id);
		if ($result)
			_e('1;success');
		else
			_e('2;error');
	} else
		_e('5;error');
