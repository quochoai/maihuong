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
    $id = $user_id;
    $data = $_POST['data'];
    if (isset($_POST['active']))
      $data['active'] = 1;
    else
      $data['active'] = 0;
    
    $array_ext_image = array(".png", ".jpg", "jpeg", ".gif", ".bmp", ".PNG", ".JPG", "JPEG", ".GIF", ".BMP", "webp");

    $image = $_FILES['imageAdmin']['name'];
    if ($image != '') {
			$ext = substr($image, -4);
			$filename = substr($image, 0, -4);
			$imgUpload = '';
			if (in_array($ext, $array_ext_image)) {
				if ($ext == 'jpeg' || $ext == 'JPEG' || $ext == 'webp')
					$extGet = '.'.$ext;
				else
					$extGet = $ext;
        $path = $def['imgUploadAdminRealPath'].stringImage($filename).'-'.'admin'.time().$extGet;
        move_uploaded_file($_FILES['imageAdmin']['tmp_name'], $path);
        $data['image'] = stringImage($filename).'-'.'admin'.time().$extGet;
			}
		}
		$table = $prefixTable.$def['tableAdmin'];
		$result = $h->updateDataBy($data, $table, "where id = $id", $user_id);
		if ($result)
			_e('1;success');
		else
			_e('2;error');
	} else
		_e('5;error');

