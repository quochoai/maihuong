<?php
  define("_url", "http://maihuong.com/");
  define("_url2", "http://maihuong.com");
  define("_assets", _url.'assets/');
  define("_theme", _assets."themes/");
  define("_app", _url.'@frontendvina/app/');
  define("_process", _app."process/");
  define("_processNews", _process.'news/');
  define("_processContact", _process.'contact/');
  define("_processTag", _process.'tags/');
  define("_processInfo", _process.'information/');
  define("_views", _app."views/");
  define("_viewsRequire", '@frontendvina/app/views/');
  define("_viewNews", _views.'news/');
  define("_viewRequireNews", _viewsRequire."news/");
  define("_viewRequireTags", _viewsRequire.'tags/');
  define("_viewTags", _views.'tags/');
  define("_viewRequireInfo", _viewsRequire.'information/');
  define("_viewInfo", _views.'information/');
  define("_viewController", 'app/module/');
  define('_imgUpload', _url.'imgUpload/');
  define('_ImgUploadRealPath', _dir_root_."/imgUpload/");
  define('_noImage', _assets.'images/no-image.jpg');
  
  $def = [
    "app" => "app/controllers/app.php",
    'requireTitle' => _viewController.'title.php',
    'requireContent' => _viewController.'content.php',
    'requireDesc' => _viewController.'desc.php',
    'requireKeyw' => _viewController.'keyw.php',
    'requireImage' => _viewController.'image.php',

    // action
    'actionNews' => 'tin-tuc',
    'actionProduct' => 'san-pham',
    'actionAbout' => 've-chung-toi.html',
    'actionContact' => 'lien-he.html',
    'actionPolicy' => 'dieu-khoan-su-dung.html',
    'actionResolveComplain' => 'giai-quyet-khieu-nai.html',
    'actionSecure' => 'chinh-sach-bao-mat.html',
    'actionChangePassword' => 'change-password',
    'actionTag' => 'tag',
    'actionSearch' => 'tim-kiem',
    
    // require_once
    'requireHome' => _viewsRequire.'home/home.php',
    'requireProduct' => _viewsRequire.'product/product.php',
    'requireProductDetail' => _viewsRequire.'product/productDetail.php',
    'requireNews' => _viewsRequire.'news/news.php',
    'requireNewsDetail' => _viewsRequire.'news/newsDetail.php',
    'requireContact' => _viewsRequire.'contact/contact.php',
    'requirePage' => _viewsRequire.'page/contentPage.php',
    'requireTag' => _viewsRequire.'tag/tag.php',
    'requireSearch' => _viewsRequire.'search/search.php',
    

    // news
    'imgUploadNews' => _imgUpload.'news/',
    'imgUploadNewsRealPath' => _ImgUploadRealPath.'news/',

    // partner
    'imgUploadPartner' => _imgUpload.'partner/',
    'imgUploadPartnerRealPath' => _ImgUploadRealPath.'partner/',

    // product
    'imgUploadProductRealPath' => _ImgUploadRealPath.'products/',
    'imgUploadProduct' => _imgUpload.'products/',
    'imgUploadCateProductRealPath' => _ImgUploadRealPath.'cateProducts/',
    'imgUploadCateProduct' => _imgUpload.'cateProducts/',
    
    'idConfig' => 1,
    'perPageProduct' => 12,
    'perPageNews' => 7,
    
    // theme
    "themeDist" => _theme.'dist/',
    "themeJs" => _theme.'js/',
    'themePlugins' => _theme.'plugins/',

    // table in database
    "tableAdmin" => "admins",
    "tableAdminRoles" => "admin_roles",
    "tableCategories" => "categories",
    'tableConfigurations' => 'configurations',
    'tableHtmls' => 'htmls',
    'tableInformations' => 'informations',
    'tableNews' => 'news',
    'tableTags' => 'tags',
    'tableProduct' => 'products',
    'tableContact' => 'contacts',
    'tablePartner' => 'partners',

    // logout
    "logout" => "logout",
  ];
