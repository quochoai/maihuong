<?php
  if (isset($_REQUEST['pqh'])) {
    $module = trim($_REQUEST['pqh']);
    $mod = explode("/", $module);
    $type_website = 'article';
  } else {
    $module = "";
    $mod = [];
    $type_website = 'website';
  }
  $tableHtml = $prefixTable.$def['tableHtmls'];
  $tableConfig = $prefixTable.$def['tableConfigurations'];
  $tableInfo = $prefixTable.$def['tableInformations'];
  $tableNews = $prefixTable.$def['tableNews'];
  $conf = $h->getById($tableConfig, $def['idConfig']);
  $logo = $h->getById($tableHtml, 1);
  $addressFooter = $h->getById($tableHtml, 4);
  $phoneFooter = $h->getById($tableHtml, 5);
  $emailFooter = $h->getById($tableHtml, 6);
  $fanpage = $h->getById($tableHtml, 7);
  $textFooter = $h->getById($tableHtml, 8);
  if (file_exists(_ImgUploadRealPath.'htmls/'.$logo['content']) && $logo['content'] != '')
    $imgLogo = _imgUpload.'htmls/'.$logo['content'];
  else
    $imgLogo = _assets.'images/logo.png';
?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#"  lang="vi-vn">
<head>
  <base href="<?php _e(_url) ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
  <title><?php require "@frontendvina/app/module/title.php" ?></title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta charset="UTF-8">
  <meta name="keywords" content="<?php require_once "@frontendvina/app/module/keyw.php" ?>" />
  <meta name="author" content="Taxi3s" />
  <meta name="description" content="<?php require "@frontendvina/app/module/desc.php" ?>" />
  <meta name="HandheldFriendly" content="true"/>
  <meta name="format-detection" content="telephone=no">
  <meta name="apple-mobile-web-app-capable" content="YES" />
  <meta rel="canonical" href="<?php _e(_url) ?>"/>
  <link href="assets/images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
  <meta property="og:locale" content="vi_VN" />
  <meta property="og:type" content="<?php _e($type_website) ?>" />
  <meta property="og:title" content="<?php require "@frontendvina/app/module/title.php" ?>" />
  <meta property="og:description" content="<?php require "@frontendvina/app/module/desc.php" ?>" />
  <meta property="og:image" content="<?php require_once "@frontendvina/app/module/image.php" ?>" />
  <meta property="og:url" content="<?php _e("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>" />
  <meta name="twitter:title" content="<?php require "@frontendvina/app/module/title.php" ?>" />
  <meta name="twitter:description" content="<?php require "@frontendvina/app/module/desc.php" ?>" />
  <meta name="twitter:url" content="<?php _e("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>" />
  <meta name="twitter:card" content="summary">
  <!-- Styles -->
  <link href="assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/flexslider/flexslider.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/base.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/main.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/zoom/zoom.scss.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/owlCarousel/owl.carousel.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link href="assets/css/jgrowl.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/update.scss.css" rel="stylesheet" type="text/css" />  

  <!-- Scripts -->
  <script src="assets/js/jquery.min.js" type="text/javascript"></script>
  <script src="assets/plugins/bootstrap/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/js/option-selectors.js" type="text/javascript"></script>
</head>
<body id="gioi-thieu-cong-ty" class="  cms-index-index cms-home-page">
  <?php require_once _viewsRequire.'menu.php' ?>
