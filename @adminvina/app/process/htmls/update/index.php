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
    $id = $_POST['idHtml'];
		$type = $_POST['type'];
    if ($type == 0)
			$data = $_POST['data'];
		else {
			$image = $_FILES['imageHtml']['name'];
			$ext = substr($image, -4);
			$array_ext_image = array(".png", ".jpg", "jpeg", ".gif", ".bmp", ".PNG", ".JPG", "JPEG", ".GIF", ".BMP", "webp");
			if ( $image != '' && in_array($ext, $array_ext_image)) {
				$path_image = $def['imgUploadHtmlRealPath'].$image;
				move_uploaded_file($_FILES['imageHtml']['tmp_name'], $path_image);
				$data['content'] = $image;
			} else 
				$data['content'] = '';
		}
		$table = $prefixTable.$def['tableHtmls'];
		$result = $h->updateDataBy($data, $table, "where id = $id", $user_id);
		if ($result)
			_e('1;success');
		else
			_e('2;error');
	} else
		_e('5;error');