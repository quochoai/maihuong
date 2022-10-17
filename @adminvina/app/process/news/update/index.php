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
				$width = 500;
				$height = 333;
				if ($ext == 'jpeg' || $ext == 'JPEG' || $ext == 'webp') {
						$extGet = '.'.$ext;
				} else {
						$extGet = $ext;
				}
				$imgUpload = resizeImage2($width, $height, stringImage($image), $path, $_FILES['imageNews']['tmp_name'], stringImage($filename).'-'.'news'.time().$extGet);
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
					//if (!file_exists($path.stringImage($image))) {
					$widthFb = 450;
					$heightFb = 235;
					if ($extShareFb == 'jpeg' || $extShareFb == 'JPEG' || $extShareFb == 'webp') {
							$extGetFb = '.'.$extShareFb;
					} else {
							$extGetFb = $extShareFb;
					}
					$imgUploadShareFb = resizeImage2($widthFb, $heightFb, stringImage($imageShareFb), $path, $_FILES['imageShareFb']['tmp_name'], stringImage($filenameShareFb).'-'.'newsShareFB'.time().$extGetFb);
					//}
			}
			$data['imageShareFb'] = $imgUploadShareFb;
		}
		/*$tagArray = [];
		$tableNewsTags = $prefixTable.$def['tableNewsTags'];
		$checkExistNewsTag = $h->checkExist($tableNewsTags, "deleted_at is null and active = 1 and newsID = $id");
		if ($checkExistNewsTag) {
			$tagse = $h->getAll($tableNewsTags, "deleted_at is null and active = 1 and newsID = $id", "sortOrder asc, id asc");
			foreach ($tagse as $tage) {
				$tagGet = [$tage['id'], $tage['tagID']];
				array_push($tagArray, $tagGet);
			}
		}
		$countTagTableNewsTag = count($tagArray);*/
		$tags = $_POST['tags'];
		if (count($tags) > 0) {
			$data['tags'] = implode(",", $tags);
		} else {
			$data['tags'] = NULL;
		}

		$table = $prefixTable.$def['tableNews'];
		$result = $h->updateDataBy($data, $table, "where id = $id", $user_id);
		if ($result) {
			/*if ($countTagPost > 0 && $countTagPost > $countTagTableNewsTag) {
				$n = $countTagPost - $countTagTableNewsTag;
				$tableNewsTags = $prefixTable.$def['tableNewsTags'];
				for ($i = 0; $i < $countTagTableNewsTag; $i++) {
					if ($tagArray[$i]['tagID'] != $tags[$i]) {
						$dataTag['tagID'] = $tags[$i];

					}

				}
				foreach ($tags as $k => $tag) {
					$dataTag['newsID'] = $idLast;
					$dataTag['tagID'] = $tag;
					$dataTag['sortOrder'] = $k + 1;
					$dataTag['active'] = 1;
					$insertTag = $h->insertDataBy($dataTag, $tableNewsTags, $user_id);
				}
			}*/
			echo '1;success';
		} else
			echo '2;error';
	} else
		echo '5;error';