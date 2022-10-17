<?php
if (!defined('INDEX')) exit;
///////////////////////////////////////////////////////////////////////////
// COMPRESS PAGE
///////////////////////////////////////////////////////////////////////////
function print_gzipped_page() {
    global $HTTP_ACCEPT_ENCODING;
    if( headers_sent() ){
        $encoding = false;
    } elseif ( strpos($HTTP_ACCEPT_ENCODING, 'x-gzip') !== false ){
        $encoding = 'x-gzip';
    } elseif ( strpos($HTTP_ACCEPT_ENCODING,'gzip') !== false ){
        $encoding = 'gzip';
    } else {
        $encoding = false;
    }
    if ( $encoding ) {
        $contents = ob_get_contents();
        ob_end_clean();
        header('Content-Encoding: '.$encoding);
        print("\x1f\x8b\x08\x00\x00\x00\x00\x00");
        $size = strlen($contents);
        $contents = gzcompress($contents, 9);
        $contents = substr($contents, 0, $size);
        print($contents);
        exit();
    } else {
        ob_end_flush();
        exit();
    }
}
///////////////////////////////////////////////////////////////////////////
// RANDOM STRING
// Format: ?=lowerstring, $=upperstring, #=number, *=special_char
///////////////////////////////////////////////////////////////////////////
function random($num_char,$format='')
{
		$random = '';
		//$a = 'a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z';
		$b = 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,';
		$c = '0,1,2,3,4,5,6,7,8,9';
		//$d = '~,!,@,#,$,%,^,&,*,(,),[,],<,>,?,+,=';
		$char[1] = explode(",",$b); // ?
		$char[2] = explode(",",$b); // $
		$char[3] = explode(",",$c); // #
		$char[4] = explode(",",$c); // *
		if ($format) {
			for($x=0;$x<strlen($format);$x++) {
				switch ($format[$x])
				{
					case "?":
						$char_index = 1;
					break;
					case "$":
						$char_index = 2;
					break;
					case "#":
						$char_index = 3;
					break;
					case "*":
						$char_index = 4;
					break;
				}
				$random .= $char[$char_index][rand(0,count($char[$char_index]) - 1)];
			}
		} else {
			$char_no = 0;
			for($x=1;$x<=$num_char;$x++) {
				if($x>count($char) && ($x%count($char))>0) $char_no = ($x%count($char));
				else $char_no += 1;
				$array_len = count($char[$char_no]) - 1;
				$random_index = rand(0,$array_len);
				$random .= $char[$char_no][$random_index];
				//$random .= $char_no;
			}
		}	
	return $random;
}
function randomNumber($num_char) {
	$random = '';
	$c = '0,1,2,3,4,5,6,7,8,9';
	$char = explode(",",$c);
	
	$char_no = 0;
	for($x=1; $x <= $num_char; $x++) {
		$random_index = rand(0,9);
		$random .= $char[$random_index];
	}
	return $random;
}
///////////////////////////////////////////////////////////////////////////
// SHOW IMAGE AND FLASH
///////////////////////////////////////////////////////////////////////////
function show_image($file_name,$thumb_standard=0,$suffix='')
{
	$file_ext = substr($file_name,-3);
	$size = @getimagesize($file_name);
	if ($size) {
		$sw = $size[0]; // show image width
		$sh = $size[1]; // show image height
		if ($thumb_standard > 0) {
			if ($size[0] > $thumb_standard && $size[1] > $thumb_standard) 
				$percent = $size[0]/$thumb_standard;
			else {
				if ($size[0] > $thumb_standard) $percent = $size[0]/$thumb_standard;
				elseif ($size[1] > $thumb_standard) $percent = $size[1]/$thumb_standard;
				else $percent = 1;
			}
			$sw = round($size[0]/$percent);
			$sh = round($size[1]/$percent);
		}
		if($file_ext == "swf")
			return '<embed src="'.$file_name.'" menu=false quality=high width="'.$sw.'" height="'.$sh.'" '.$suffix.'></embed>';
		else
			return '<img src="'.$file_name.'" border=0 '.$suffix.' width="'.$sw.'" height="'.$sh.'" align="left"/>';
	} else 
        return false;
}
///////////////////////////////////////////////////////////////////////////
// CUT STRING
///////////////////////////////////////////////////////////////////////////
function cut_string($string,$char)
{
	if (strlen($string) > $char) {
		for($x=$char;$x>$char-15;$x--) {
			if($string[$x]==" ") break;
		} 
		return substr($string,0,$x).'...';
	} else 
        return $string;
}
///////////////////////////////////////////////////////////////////////////
// SHOW DATE
///////////////////////////////////////////////////////////////////////////
function show_date($format,$time)
{
	global $cfg;
	return gmdate($format, $time + (3600 * $cfg["default_timezone"]));
}
///////////////////////////////////////////////////////////////////////////
// REPLACE BAD HTML
///////////////////////////////////////////////////////////////////////////
function data($string)
{
	$string = trim($string);
	$string = str_replace ('&','&amp;',$string);
	$string = str_replace ('"',"&quot;",$string);
	$string = str_replace ('<','&lt;',$string);
	$string = str_replace ('>','&gt;',$string);
	$string = stripslashes ($string);
	return $string;
}
///////////////////////////////////////////////////////////////////////////
// $_GET
///////////////////////////////////////////////////////////////////////////
function get($string)
{
	return data($_GET[$string]);
}
///////////////////////////////////////////////////////////////////////////
// $_POST
///////////////////////////////////////////////////////////////////////////
function post($string)
{
	return data($_POST[$string]);
}
///////////////////////////////////////////////////////////////////////////
// REDIRECT BROWSER
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
// VALIDATE USING JAVASCRIPT
///////////////////////////////////////////////////////////////////////////
function js_validate($string,$form)
{
	global $lang;
	$result = '
		<script language="javascript">
		function validate_'.$form.'(){
	';
	$element_array = explode(",",str_replace(" ","",trim($string)));
	foreach ($element_array as $element) {
		$item = $form.'.'.$element;
		$result .= '
			if ('.$item.'.value == "")
			{	alert(\''.$lang['js_required_field'].'\');
				'.$item.'.focus();
				return false;}';
	}
	$result .= '
		else return true;
		}
		</script>';
	return $result;
}
///////////////////////////////////////////////////////////////////////////
// SHOW PAGE NUMBER
///////////////////////////////////////////////////////////////////////////
function show_pages($num_records,$rows_per_page,$page)
{
	global $lang;
	if ($num_records && $rows_per_page && $page) {
		$num_pages = @ceil($num_records/$rows_per_page);
		$result = "";
		if ($num_pages > 1) {
  			// Display previous button
			if (get('pg') > 1) 
			{
				$result .= '<a href="'.$page.'&pg='.(get('pg')-1).'" class="red f12">&laquo; '.$lang['previous_page'].'</a> ';
			}
			// Current page
			$result .= '<font class="f12">'.sprintf($lang['page_s_of_s_pages'],get('pg'),$num_pages).'</font>';
			// Display next button
			if (get('pg') < $num_pages) 
			{
				$result .= ' <a href="'.$page.'&pg='.(get('pg')+1).'" class="red f12">'.$lang['next_page'].' &raquo;</a>';
			}
			return $result;
		}
	} else 
        return false;
}
/////////////////////////////////////////////////////////////////////////
// SHOW POSITION LINK
///////////////////////////////////////////////////////////////////////////
function show_position($page,$page_l2='',$cat='')
{
	global $lang;
	if($page){
		if($page == 'home'){
    		$result = '<a href="index.php" title="'.$lang['menu_home'].'" class="position_class">'.$lang['menu_home'].'</a>';
    		return $result;
		} else {
		  if ($page_l2 && $cat) {
                $result = '<a href="index.php" title="'.$lang['menu_home'].'" class="position_class">'.$lang['menu_home'].'</a> &raquo; <a href="'.$page.'.php" title="'.$lang["menu_$page"].'" class="position_class">'.$lang["menu_$page"].'</a> &raquo; <a href="'.$page.'.php?cat='.$cat.'" title="$page_l2" class="position_class">'.$page_l2.'</a>';
    		return $result;
            } else {
    				$result = '<a href="index.php" title="'.$lang['menu_home'].'" class="position_class">'.$lang['menu_home'].'</a> &raquo; <a href="'.$page.'.php" title="'.$lang["menu_$page"].'" class="position_class">'.$lang["menu_$page"].'</a>';
    				return $result;
    		}
    	}
	}
	else return false;
}
///////////////////////////////////////////////////////////////////////////
// CHECK REQUIRED FIELD IN POST METHOD
///////////////////////////////////////////////////////////////////////////
function check_post($value)
{
	global $lang;
	if($value)
	{
		$check_post = true;
		$value_array = explode(",",$value);
		foreach ($value_array as $value_id => $value_data)
		{
			if(!$_POST[$value_data]) 
			{
				$check_post = false;
				break;
			}
		}
	}
	if(!$check_post) echo message($lang['js_required_field'],'error');
	return $check_post;
}
///////////////////////////////////////////////////////////////////////////
// SHOW SECURITY CODE IMAGE
///////////////////////////////////////////////////////////////////////////
function show_code_image($code_session)
{
	$_SESSION[$code_session] = rand(111111,999999);
	return '<img src="include/code.img.php?code_id='.$code_session.'" />';
}
///////////////////////////////////////////////////////////////////////////
// CHECK SECURITY CODE
///////////////////////////////////////////////////////////////////////////
function check_code($code_name)
{
	global $lang;
	if($_POST[$code_name] && $_POST[$code_name] == $_SESSION[$code_name])
		return true;
	else 
	{
		echo message($lang['incorrect_code'],'error');
		return false;
	}
}
///////////////////////////////////////////////////////////////////////////
// CHECK FLOOD (SESSION)
///////////////////////////////////////////////////////////////////////////
function check_flood($session_name,$flood_time)
{
	global $lang;
	if($_SESSION[$session_name])
	{
		if((time() - $_SESSION[$session_name]) < $flood_time)
		{
			echo message(sprintf($lang['wait_s_between_2_submissions'],$flood_time),'error');
			return false;
		}
		else
			return true;
	}
	else return true;
}
//////////////////////////////////////////////////////////////////////////
// REPLACE LINK, EMAIL, URL IN STRING (AUTO CONVERT TO URL)
///////////////////////////////////////////////////////////////////////////
function replace_link($string)
{
	if ($string)
	{
		$string = eregi_replace("([[:space:]])((f|ht)tps?:\/\/[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_-]+)", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $string); //http 
		$string = eregi_replace("^((f|ht)tp:\/\/[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_-]+)", "<a href=\"\\1\" target=\"_blank\">\\1</a>", $string); //http 
		$string = eregi_replace("([[:space:]])(www\.[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_-]+)", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $string); // www. 
		$string = eregi_replace("^(www\.[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_-]+)", "<a href=\"http://\\1\" target=\"_blank\">\\1</a>", $string); // www. 
		$string = eregi_replace("([[:space:]])([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4})","\\1<a href=\"mailto:\\2\">\\2</a>", $string); // mail 
		$string = eregi_replace("^([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4})","<a href=\"mailto:\\1\">\\1</a>", $string); // mail 
	}
	return $string;
}
