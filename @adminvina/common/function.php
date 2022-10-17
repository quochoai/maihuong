<?php
	function _e($string) {
		echo $string;
	}
// image resize
 function resizeImage($w, $h, $fileupload, $path, $name_field, $name_save) {
	$max_width = $w;
	$max_height = $h;
	$ext = getExt($fileupload);
    $path_image = $path.'/'.$fileupload;
	move_uploaded_file($_FILES[$name_field]['tmp_name'], $path_image);
	list($width, $height) = getimagesize($path_image);
	// kiem tra neu file upload nho hon kich thuoc quy dinh thi lay kich thuoc cu
	if ($width < $max_width && $height < $max_height) {
		$new_width = $width;
		$new_height = $height;
	} else {
		$sx = $width/$max_width;
		$sy = $height/$max_height;
		//resize theo ti le
		if ($width > $height) {
			$new_height = round($height/$sx, 0);
			$new_width = $max_width;
		} else {
			$new_width = round($width/$sy, 0);
			$new_height = $max_height;
		}
	}
	$image_thub = imagecreatetruecolor($new_width, $new_height);
	switch($ext){
		case 'jpg':
		case 'jpeg':
			$image = imagecreatefromjpeg($path_image);
		    break;	
		case 'png':
			$image = imagecreatefrompng($path_image);
		    break;
		case 'gif':
			$image = imagecreatefromgif($path_image);
		    break;
		default:
			$image = imagecreatefromjpeg($path_image);
		    break;
	}
	imagecopyresampled($image_thub, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	
    // luu anh
	imagejpeg($image_thub, $path.'/'.$name_save, 100);
    // xoa anh
    unlink($path_image);
    return $name_save;
	
}

// image resize2
 function resizeImage2($w, $h, $fileupload, $path, $name_field, $name_save) {
	$max_width = $w;
	$max_height = $h;
	$ext = getExt($fileupload);
  $path_image = $path.'/'.$fileupload;
	move_uploaded_file($name_field, $path_image);
	list($width, $height) = getimagesize($path_image);
	// kiem tra neu file upload nho hon kich thuoc quy dinh thi lay kich thuoc cu
	if ($width < $max_width && $height < $max_height) {
		$new_width = $width;
		$new_height = $height;
	} else {
		$sx = $width/$max_width;
		$sy = $height/$max_height;
		//resize theo ti le
		if ($width > $height) {
			$new_height = round($height/$sx, 0);
			$new_width = $max_width;
		} else {
			$new_width = round($width/$sy, 0);
			$new_height = $max_height;
		}
	}
	$image_thub = imagecreatetruecolor($new_width, $new_height);
	switch($ext){
		case 'jpg':
		case 'jpeg':
			$image = imagecreatefromjpeg($path_image);
		    break;	
		case 'png':
			$image = imagecreatefrompng($path_image);
		    break;
		case 'gif':
			$image = imagecreatefromgif($path_image);
		    break;
		default:
			$image = imagecreatefromjpeg($path_image);
		    break;
	}
	imagecopyresampled($image_thub, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	
    // luu anh
	imagejpeg($image_thub, $path.'/'.$name_save, 100);
    // xoa anh
    unlink($path_image);
    return $name_save;
	
}
function checkemail($email)
{
	if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) 
		return false;
	return true;
}
// check domain email exists
function checkemail_exist($email)
{
	list($userName, $mailDomain) = split("@", $email);
	if (checkdnsrr($mailDomain, "MX")) 
		return true;
	else 
		return false;
}

// chuyen chuoi ki tu co dau sang chuoi ki tu khong dau
function change($text) {   
  $chars = array("a","a","e","e","o","o","u","u","i","i","d","d","y","y","","-","-","","","","","","","","","","","","","","","","","","","","","-","","-",""," "," ");
	$uni[0] = array("á","à","ạ","ả","ã","â","ấ","ầ", "ậ","ẩ","ẫ","ă","ắ","ằ","ặ","ẳ","ẵ");
	$uni[1] = array("Á","À","Ạ","Ả","Ã","Â","Ấ","Ầ", "Ậ","Ẩ","Ẫ","Ă","Ắ","Ằ","Ặ","Ẳ","Ẵ");
	$uni[2] = array("é","è","ẹ","ẻ","ẽ","ê","ế","ề" ,"ệ","ể","ễ");
	$uni[3] = array("É","È","Ẹ","Ẻ","Ẽ","Ê","Ế","Ề" ,"Ệ","Ể","Ễ");
	$uni[4] = array("ó","ò","ọ","ỏ","õ","ô","ố","ồ", "ộ","ổ","ỗ","ơ","ớ","ờ","ợ","ở","ỡ");
	$uni[5] = array("Ó","Ò","Ọ","Ỏ","Õ","Ô","Ố","Ồ", "Ộ","Ổ","Ỗ","Ơ","Ớ","Ờ","Ợ","Ở","Ỡ");
	$uni[6] = array("ú","ù","ụ","ủ","ũ","ư","ứ","ừ", "ự","ử","ữ");
	$uni[7] = array("Ú","Ù","Ụ","Ủ","Ũ","Ư","Ứ","Ừ", "Ự","Ử","Ữ");
	$uni[8] = array("í","ì","ị","ỉ","ĩ");
	$uni[9] = array("Í","Ì","Ị","Ỉ","Ĩ");
	$uni[10] = array("đ");
	$uni[11] = array("Đ");
	$uni[12] = array("ý","ỳ","ỵ","ỷ","ỹ");
	$uni[13] = array("Ý","Ỳ","Ỵ","Ỷ","Ỹ");
	$uni[14] = array("%");
	$uni[15] = array("+");
	$uni[16] = array(",");
	$uni[17] = array(";");
	$uni[18] = array("'");
  $uni[19] = array('"');
	$uni[20] = array("!");
	$uni[21] = array("@");
	$uni[22] = array("#");
	$uni[23] = array("$");
	$uni[24] = array("^");
	$uni[25] = array("&");
	$uni[26] = array("*");
	$uni[27] = array("(");
	$uni[28] = array(")");
	$uni[29] = array("_");
	$uni[30] = array("-");
	$uni[31] = array("=");
	$uni[32] = array("|");
	$uni[33] = array("[");
	$uni[34] = array("]");
	$uni[35] = array("{");
	$uni[36] = array("}");
	$uni[37] = array(":");
	$uni[38] = array("<");
	$uni[39] = array(">");
	$uni[40] = array(".");
	$uni[41] = array("?");
	$uni[42] = array("  ");
	for($i=0; $i<=43; $i++) {
		$text = str_replace($uni[$i],$chars[$i],$text);
	}
	return $text;
}
// chuyen chuoi ki tu co dau sang chuoi ki tu khong dau
function changeTwo($text) {
  $chars = array("a","A","e","E","o","O","u","U","i","I","d","D","y","Y","","-","-","","","","","","","","","","","","","","","","","","","","","-","","-",""," "," ");
  $uni[0] = array("á","à","ạ","ả","ã","â","ấ","ầ", "ậ","ẩ","ẫ","ă","ắ","ằ","ặ","ẳ","ẵ");
	$uni[1] = array("Á","À","Ạ","Ả","Ã","Â","Ấ","Ầ", "Ậ","Ẩ","Ẫ","Ă","Ắ","Ằ","Ặ","Ẳ","Ẵ");
	$uni[2] = array("é","è","ẹ","ẻ","ẽ","ê","ế","ề" ,"ệ","ể","ễ");
	$uni[3] = array("É","È","Ẹ","Ẻ","Ẽ","Ê","Ế","Ề" ,"Ệ","Ể","Ễ");
	$uni[4] = array("ó","ò","ọ","ỏ","õ","ô","ố","ồ", "ộ","ổ","ỗ","ơ","ớ","ờ","ợ","ở","ỡ");
	$uni[5] = array("Ó","Ò","Ọ","Ỏ","Õ","Ô","Ố","Ồ", "Ộ","Ổ","Ỗ","Ơ","Ớ","Ờ","Ợ","Ở","Ỡ");
	$uni[6] = array("ú","ù","ụ","ủ","ũ","ư","ứ","ừ", "ự","ử","ữ");
	$uni[7] = array("Ú","Ù","Ụ","Ủ","Ũ","Ư","Ứ","Ừ", "Ự","Ử","Ữ");
	$uni[8] = array("í","ì","ị","ỉ","ĩ");
	$uni[9] = array("Í","Ì","Ị","Ỉ","Ĩ");
	$uni[10] = array("đ");
	$uni[11] = array("Đ");
	$uni[12] = array("ý","ỳ","ỵ","ỷ","ỹ");
	$uni[13] = array("Ý","Ỳ","Ỵ","Ỷ","Ỹ");
	$uni[14] = array("%");
	$uni[15] = array("+");
	$uni[16] = array(",");
	$uni[17] = array(";");
	$uni[18] = array("'");
  $uni[19] = array('"');
	$uni[20] = array("!");
	$uni[21] = array("@");
	$uni[22] = array("#");
	$uni[23] = array("$");
	$uni[24] = array("^");
	$uni[25] = array("&");
	$uni[26] = array("*");
	$uni[27] = array("(");
	$uni[28] = array(")");
	$uni[29] = array("_");
	$uni[30] = array("-");
	$uni[31] = array("=");
	$uni[32] = array("|");
	$uni[33] = array("[");
	$uni[34] = array("]");
	$uni[35] = array("{");
	$uni[36] = array("}");
	$uni[37] = array(":");
	$uni[38] = array("<");
	$uni[39] = array(">");
	$uni[40] = array(".");
	$uni[41] = array("?");
	$uni[42] = array("  ");
	for($i=0; $i<=43; $i++) {
		$text = str_replace($uni[$i],$chars[$i],$text);
	}
	return $text;
}
function thaykitu($tu,$kituthay) {
	for($i=0; $i<strlen($tu); $i++) {
		if($tu[$i] == $kituthay) {
			if($i > 0 && $i < strlen($tu)-1) {
				$tu1 = explode($kituthay,$tu[$i]);
				$roi .= $tu1[0]."-".$tu1[1];
			} else
				$roi .= "";
		} else
			$roi .= $tu[$i];
	}
	return $roi;
}
function chuoilink($text) {
	$text_chane = addslashes(change(trim($text)));
	$mang = explode(" ",$text_chane);
	$title = "";
	for($i=0; $i<count($mang); $i++) {
		if(!strpos($mang[$i],"/") && !strrchr($mang[$i],"/")) {
			if($i<count($mang)-1)
				$title .= $mang[$i]."-";
			else
				$title .= $mang[$i];
		} else {
			if($i<count($mang)-1)
				$title .= thaykitu($mang[$i],"/")."-";
			else
				$title .= thaykitu($mang[$i],"/");
		}
	}
	$title = strtolower($title);
	return $title;
}
// chuyen chuoi ki tu co dau sang chuoi ki tu khong dau
function change2($text) {
  $chars = array("a","a","e","e","o","o","u","u","i","i","d","d","y","y","","-","-","","","","","","","","","","","","","","","","","","","-","","-"," "," ");
	
	$uni[0] = array("á","à","ạ","ả","ã","â","ấ","ầ", "ậ","ẩ","ẫ","ă","ắ","ằ","ặ","ẳ","ẵ");
	$uni[1] = array("Á","À","Ạ","Ả","Ã","Â","Ấ","Ầ", "Ậ","Ẩ","Ẫ","Ă","Ắ","Ằ","Ặ","Ẳ","Ẵ");
	$uni[2] = array("é","è","ẹ","ẻ","ẽ","ê","ế","ề" ,"ệ","ể","ễ");
	$uni[3] = array("É","È","Ẹ","Ẻ","Ẽ","Ê","Ế","Ề" ,"Ệ","Ể","Ễ");
	$uni[4] = array("ó","ò","ọ","ỏ","õ","ô","ố","ồ", "ộ","ổ","ỗ","ơ","ớ","ờ","ợ","ở","ỡ");
	$uni[5] = array("Ó","Ò","Ọ","Ỏ","Õ","Ô","Ố","Ồ", "Ộ","Ổ","Ỗ","Ơ","Ớ","Ờ","Ợ","Ở","Ỡ");
	$uni[6] = array("ú","ù","ụ","ủ","ũ","ư","ứ","ừ", "ự","ử","ữ");
	$uni[7] = array("Ú","Ù","Ụ","Ủ","Ũ","Ư","Ứ","Ừ", "Ự","Ử","Ữ");
	$uni[8] = array("í","ì","ị","ỉ","ĩ");
	$uni[9] = array("Í","Ì","Ị","Ỉ","Ĩ");
	$uni[10] = array("đ");
	$uni[11] = array("Đ");
	$uni[12] = array("ý","ỳ","ỵ","ỷ","ỹ");
	$uni[13] = array("Ý","Ỳ","Ỵ","Ỷ","Ỹ");
	$uni[14] = array("%");
	$uni[15] = array("+");
	$uni[16] = array(",");
	$uni[17] = array(";");
	$uni[18] = array("'");
  $uni[19] = array('"');
	$uni[20] = array("!");
	$uni[21] = array("@");
	$uni[22] = array("#");
	$uni[23] = array("$");
	$uni[24] = array("^");
	$uni[25] = array("&");
	$uni[26] = array("*");
	$uni[27] = array("(");
	$uni[28] = array(")");
	$uni[29] = array("=");
	$uni[30] = array("|");
	$uni[31] = array("[");
	$uni[32] = array("]");
	$uni[33] = array("{");
	$uni[34] = array("}");
	$uni[35] = array(":");
	$uni[36] = array("<");
	$uni[37] = array(">");
	$uni[38] = array("?");
	$uni[39] = array("  ");
	for($i=0; $i<=40; $i++) {
		$text = str_replace($uni[$i],$chars[$i],$text);
	}
	return $text;
}
// chuoi anh
function stringImage($text) {
	$text_chane = addslashes(change2(trim($text)));
	$mang = explode(" ",$text_chane);
	$title = "";
	for($i=0; $i<count($mang); $i++) {
		if(!strpos($mang[$i],"/") && !strrchr($mang[$i],"/")) {
			if($i<count($mang)-1)
				$title .= $mang[$i]."-";
			else
				$title .= $mang[$i];
		} else {
			if($i<count($mang)-1)
				$title .= thaykitu($mang[$i],"/")."-";
			else
				$title .= thaykitu($mang[$i],"/");
		}
	}
	$title = strtolower($title);
	return $title;
}
// cat chuoi ki tu
function cutCharacter($chuoi, $gioihan){
    if (strlen($chuoi) <= $gioihan)
			return $chuoi;
		else {
			if(strpos($chuoi," ",$gioihan) > $gioihan){
				$new_gioihan=strpos($chuoi," ",$gioihan);
				//$new_chuoi = substr($chuoi,0,$new_gioihan)." ...";
        $new_chuoi = mb_substr($chuoi, 0, $new_gioihan, 'UTF-8');
				return $new_chuoi;
			}
			$new_chuoi = mb_substr($chuoi, 0, $gioihan, 'UTF-8');
			return strip_tags($new_chuoi);
		}
	}
//removes string from the end of other
function removeFromEnd($string, $stringToRemove) {
	$stringToRemoveLen = strlen($stringToRemove);
	$stringLen = strlen($string);
	$pos = $stringLen - $stringToRemoveLen;
	$out = substr($string, 0, $pos);
	return $out;
}
function redirect($url,$second) {
	if ($url)
		echo '<meta http-equiv="REFRESH" content="'.$second.';url='.$url.'" />';
}
function location($url) {
?>
<script type="text/javascript">
window.location = "<?=$url?>";
</script>
<?php }
function taotrang($sql,$link,$nitem,$itemcurrent)
{	
	$ret="";
	$result = mysql_query($sql) or die('Error' . mysql_error());
	$value = mysql_fetch_array($result);
	//$plus = (($value['cnt'] % $nitem)>0);
	for ($i=0;$i<($value[0] / $nitem);$i++)
	{
		if ($i<>$itemcurrent) $ret .= "<a href=\"".$link.$i."\" class=\"lslink\">".($i+1)."</a> ";
		else $ret .= ($i+1)." ";
	}
	return $ret;
}
function getExt($filename){
	return $ext = strtolower(substr(strrchr($filename,'.'),1));
}
// upload multiple images
function uploadMultipleImages($name_field, $path, $length, $width, $height) {
	$name_save = "";
	$array_name = array();
    
	$array_ext_image = array(".png", ".jpg", "jpeg", ".gif", ".bmp", ".PNG", ".JPG", ".JPEG", ".GIF", ".BMP");
	for ($i = 0; $i < $length; $i++) {
		$ext = substr($_FILES[$name_field]['name'][$i], -4);
		if (in_array($ext, $array_ext_image)) {
			$name_save_draft = time().'_'.$_FILES[$name_field]['name'][$i];
			$path_img = $path.$name_save_draft;
			//move_uploaded_file($_FILES[$name_field]['tmp_name'][$i], $path_img);
            $name_save .= resizeImage2($width, $height, chuoianh($_FILES[$name_field]['tmp_name'][$i]), $path, $_FILES[$name_field]['tmp_name'][$i], 'kyc_'.date("YmdHis").'_'.chuoianh($_FILES[$name_field]['tmp_name'][$i])).';';
			//array_push($array_name, $name_save_draft);
		}
	}
	if (strlen($name_save) > 0) {
		$name_save = substr($name_save, 0, -1);
	}
	return $name_save;
}
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

//HAM NAY LOAI BO CAC LENH INJECTION
function killInjection($str){
	$bad = array("'","\\","=",":");
	$good = str_replace($bad,"", $str);
	return $good;
}
