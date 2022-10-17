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
    $id = $_POST['idCateOrder'];
    $data = $_POST['data'];
    if (isset($_POST['active'])) {
        $data['active'] = 1;
    } else {
        $data['active'] = 0;
    }
    
    $array_ext_image = array(".png", ".jpg", "jpeg", ".gif", ".bmp", ".PNG", ".JPG", "JPEG", ".GIF", ".BMP", "webp");

    $image = $_FILES['imageCate']['name'];
		if ($image != '') {
			$ext = substr($image, -4);
			$filename = substr($image, 0, -4);
			$imgUpload = '';
			if (in_array($ext, $array_ext_image)) {
				$path = $def['imgUploadCateOrderRealPath'];
				$width = 500;
				$height = 333;
				if ($ext == 'jpeg' || $ext == 'JPEG' || $ext == 'webp') {
						$extGet = '.'.$ext;
				} else {
						$extGet = $ext;
				}
				$imgUpload = resizeImage2($width, $height, stringImage($image), $path, $_FILES['imageCate']['tmp_name'], stringImage($filename).'-'.'cate'.time().$extGet);
			}
			$data['imageCate'] = $imgUpload;
		}

		$imageShareFb = $_FILES['imageShareFb']['name'];
		if ($imageShareFb != '') {
			$extShareFb = substr($imageShareFb, -4);
			$filenameShareFb = substr($imageShareFb, 0, -4);
			$imgUploadShareFb = '';
			if (in_array($extShareFb, $array_ext_image)) {
					$path = $def['imgUploadCateOrderRealPath'];
					//if (!file_exists($path.stringImage($image))) {
					$widthFb = 450;
					$heightFb = 235;
					if ($extShareFb == 'jpeg' || $extShareFb == 'JPEG' || $extShareFb == 'webp') {
							$extGetFb = '.'.$extShareFb;
					} else {
							$extGetFb = $extShareFb;
					}
					$imgUploadShareFb = resizeImage2($widthFb, $heightFb, stringImage($imageShareFb), $path, $_FILES['imageShareFb']['tmp_name'], stringImage($filenameShareFb).'-'.'cateShareFB'.time().$extGetFb);
					//}
			}
			$data['imageShareFb'] = $imgUploadShareFb;
		}

		$table = $prefixTable.$def['tableCategoriesOrders'];
		$result = $h->updateDataBy($data, $table, "where id = $id", $user_id);
		if ($result)
			echo '1;success';
		else
			echo '2;error';
	} else
		echo '5;error';