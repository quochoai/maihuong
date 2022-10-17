<?php
  define("_url", "http://maihuong.com/");
  define("_assets", _url.'assets/');
  define("_theme", _assets."themes/");
  define("_tinymce", _url."tinymce/");
  define("_filemanager", _url.'filemanager/');
  define("_urladmin", "http://maihuong.com/@adminvina/");
  define("_app", _urladmin.'app/');
  define("_process", _app."process/");
  define("_processNews", _process.'news/');
  define("_processProduct", _process.'products/');
  define("_processCateProduct", _process.'categoriesProduct/');
  define("_processLogin", _process.'login/');
  define("_processTag", _process.'tags/');
  define("_processInfo", _process.'information/');
  define("_processAdmin", _process.'admins/');
  define("_processRole", _process.'role/');
  define("_processFunctionRole", _process.'frole/');
  define("_processHtml", _process.'htmls/');
  define("_processConfig", _process.'configuration/');
  define("_views", _app."views/");
  define("_viewsRequire", 'app/views/');
  define("_viewNews", _views.'news/');
  define("_viewRequireNews", _viewsRequire."news/");
  define("_viewProduct", _views.'products/');
  define("_viewRequireProduct", _viewsRequire."products/");
  define("_viewCateProduct", _views.'categoriesProduct/');
  define("_viewRequireCateProduct", _viewsRequire.'categoriesProduct/');
  define("_viewLogin", _viewsRequire."login/");
  define("_viewRequireTags", _viewsRequire.'tags/');
  define("_viewTags", _views.'tags/');
  define("_viewRequireInfo", _viewsRequire.'information/');
  define("_viewInfo", _views.'information/');
  define("_viewRequireAdmin", _viewsRequire.'admins/');
  define("_viewAdmin", _views.'admins/');
  define("_viewRequireHtml", _viewsRequire.'htmls/');
  define("_viewHtml", _views.'htmls/');
  define("_viewRequireConfiguration", _viewsRequire.'configuration/');
  define("_viewConfiguration", _views.'configuration/');
  define("_viewRequireRole", _viewsRequire.'role/');
  define("_viewRole", _views.'role/');
  define("_viewRequireFunctionRole", _viewsRequire.'frole/');
  define("_viewFunctionRole", _views.'frole/');
  define("_viewRequireContact", _viewsRequire.'contact/');
  define("_viewContact", _views.'contact/');
  define("_viewController", 'app/controllers/');
  define('_imgUpload', _url.'imgUpload/');
  define('_ImgUploadRealPath', substr(_dir_root_, 0, -10)."imgUpload/");
  
  $def = [
    "loginView" => _viewLogin.'index.php',
    "loginProcess" => _processLogin,
    "app" => "app/controllers/app.php",
    'requireTitle' => _viewController.'title.php',
    'requireContent' => _viewController.'content.php',
    'dashboard' => _viewsRequire.'dashboard.php',
    // action
    'actionNews' => 'news',
    'actionProduct' => 'products',
    'actionCategoriesProduct' => 'categories-products',
    'actionTags' => 'tags',
    'actionInfo' => 'information',
    'actionChangePassword' => 'change-password',
    'actionHtml' => 'htmls',
    'actionConfig' => 'configurations',
    'actionAdmin' => 'admin',
    'actionRole' => 'role',
    'actionRoleFunction' => 'function-role',
    'actionContact' => 'contact',
    // product category
    'listCateProduct' => _viewRequireCateProduct.'list.php',
    "listDataCateProduct" => _viewRequireCateProduct.'data/',
    "listDataCateProductJs" => _viewRequireCateProduct.'data/data.js',
    "listCateProductDeleted" => _viewRequireCateProduct.'listDeleted.php',
    "listDataCateProductDeleted" => _viewRequireCateProduct.'dataDeleted/',
    "listDataCateProductDeletedJs" => _viewRequireCateProduct.'dataDeleted/dataDeleted.js',
    'imgUploadCateProduct' => _imgUpload.'cateProducts/',
    'imgUploadCateProductRealPath' => _ImgUploadRealPath.'cateProducts/',
    // Product category add
    "cateProductAdd" => _viewCateProduct.'add/',
    "cateProductAddProcess" => _processCateProduct.'add/',
    // Product category update
    "cateProductUpdate" => _viewCateProduct.'update/',
    'cateProductUpdateProcess' => _processCateProduct.'update/',
    // Product category delete
    "cateProductDeleteProcess" => _processCateProduct.'delete/',
    // Product category active
    "cateProductActiveProcess" => _processCateProduct.'active/',
    // Product category sort
    "cateProductSortProcess" => _processCateProduct.'sort/',
    // Product list
    "listProduct" => _viewRequireProduct.'list.php',
    "listDataProduct" => _viewProduct.'data/',
    "listDataProductJs" => _viewProduct.'data/data.js',
    "listProductDeleted" => _viewRequireProduct.'listDeleted.php',
    "listDataProductDeleted" => _viewProduct.'dataDeleted.php',
    "listDataProductDeletedJs" => _viewProduct.'dataDeleted.js',
    'imgUploadProduct' => _imgUpload.'products/',
    'imgUploadProductRealPath' => _ImgUploadRealPath.'products/',
    // Product add
    "productAdd" => _viewProduct.'add/',
    "productAddProcess" => _processProduct.'add/',
    // Product update
    "productUpdate" => _viewProduct.'update/',
    'productUpdateProcess' => _processProduct.'update/',
    // Product delete
    "productDeleteProcess" => _processProduct.'delete/',
    // Product approve
    "productApproveProcess" => _processProduct.'approve/',
    // Product active
    "productActiveProcess" => _processProduct.'active/',
    // Product sort
    "productSortProcess" => _processProduct.'sort/',

    // news list
    "listNews" => _viewRequireNews.'list.php',
    "listDataNews" => _viewNews.'data/',
    "listDataNewsJs" => _viewNews.'data/data.js',
    "listNewsDeleted" => _viewRequireNews.'listDeleted.php',
    "listDataNewsDeleted" => _viewNews.'dataDeleted.php',
    "listDataNewsDeletedJs" => _viewNews.'dataDeleted.js',
    'imgUploadNews' => _imgUpload.'news/',
    'imgUploadNewsRealPath' => _ImgUploadRealPath.'news/',
    // news add
    "newsAdd" => _viewNews.'add/',
    "newsAddProcess" => _processNews.'add/',
    // news update
    "newsUpdate" => _viewNews.'update/',
    'newsUpdateProcess' => _processNews.'update/',
    // news delete
    "newsDeleteProcess" => _processNews.'delete/',
    // news approve
    "newsApproveProcess" => _processNews.'approve/',
    // news active
    "newsActiveProcess" => _processNews.'active/',
    // news sort
    "newsSortProcess" => _processNews.'sort/',

    
    // tags list
    "listTags" => _viewRequireTags.'list.php',
    "listDataTags" => _viewTags.'data/',
    "listDataTagsJs" => _viewTags.'data/data.js',
    "listTagsDeleted" => _viewRequireTags.'listDeleted.php',
    "listDataTagsDeleted" => _viewTags.'dataDeleted.php',
    "listDataTagsDeletedJs" => _viewTags.'dataDeleted.js',
    // tag add
    "tagAdd" => _viewTags.'add/',
    "tagAddProcess" => _processTag.'add/',
    // tag update
    "tagUpdate" => _viewTags.'update/',
    'tagUpdateProcess' => _processTag.'update/',
    // tag delete
    "tagDeleteProcess" => _processTag.'delete/',
    // tag active
    "tagActiveProcess" => _processTag.'active/',

    // admin list
    "listAdmin" => _viewRequireAdmin.'list.php',
    "listDataAdmin" => _viewAdmin.'data/',
    "listDataAdminJs" => _viewAdmin.'data/data.js',
    "listAdminDeleted" => _viewRequireAdmin.'listDeleted.php',
    "listDataAdminDeleted" => _viewAdmin.'dataDeleted.php',
    "listDataAdminDeletedJs" => _viewAdmin.'dataDeleted.js',
    'imgUploadAdmin' => _imgUpload.'admins/',
    'imgUploadAdminRealPath' => _ImgUploadRealPath.'admins/',
    // admin add
    "adminAdd" => _viewAdmin.'add/',
    "adminAddProcess" => _processAdmin.'add/',
    // admin update
    "adminUpdate" => _viewAdmin.'update/',
    'adminUpdateProcess' => _processAdmin.'update/',
    'adminUpdateProcessSelf' => _processAdmin.'updateself/',
    // admin delete
    "adminDeleteProcess" => _processAdmin.'delete/',
    // admin active
    "adminActiveProcess" => _processAdmin.'active/',
    // admin change password
    "adminChangePassword" => _viewAdmin.'changePassword/',
    'adminChangePasswordProcess' => _processAdmin.'changePassword/',
    // admin change info self
    'adminChangeInfoSelf' => _viewAdmin.'updateself/',
    'adminUpdateProcessSelf' => _processAdmin.'updateself/',

    // Role list
    "listRole" => _viewRequireRole.'list.php',
    "listDataRole" => _viewRole.'data/',
    "listDataRoleJs" => _viewRole.'data/data.js',
    "listRoleDeleted" => _viewRequireRole.'listDeleted.php',
    "listDataRoleDeleted" => _viewRole.'dataDeleted.php',
    "listDataRoleDeletedJs" => _viewRole.'dataDeleted.js',
    // Role add
    "roleAdd" => _viewRole.'add/',
    "roleAddProcess" => _processRole.'add/',
    // Role update
    "roleUpdate" => _viewRole.'update/',
    'roleUpdateProcess' => _processRole.'update/',
    // Role delete
    "roleDeleteProcess" => _processRole.'delete/',

    // Role function list
    "listFunctionRole" => _viewRequireFunctionRole.'list.php',
    "listDataFunctionRole" => _viewFunctionRole.'data/',
    "listDataFunctionRoleJs" => _viewFunctionRole.'data/data.js',
    "listFunctionRoleDeleted" => _viewRequireFunctionRole.'listDeleted.php',
    "listDataFunctionRoleDeleted" => _viewFunctionRole.'dataDeleted.php',
    "listDataFunctionRoleDeletedJs" => _viewFunctionRole.'dataDeleted.js',
    // Role function add
    "functionRoleAdd" => _viewFunctionRole.'add/',
    "functionRoleAddProcess" => _processFunctionRole.'add/',
    // Role function update
    "functionRoleUpdate" => _viewFunctionRole.'update/',
    'functionRoleUpdateProcess' => _processFunctionRole.'update/',
    // Role function delete
    "functionRoleDeleteProcess" => _processFunctionRole.'delete/',

    // Html list
    "listHtml" => _viewRequireHtml.'list.php',
    'listDataHtml' => _viewHtml.'data/',
    'listDataHtmlJs' => _viewHtml.'data/data.js',
    'imgUploadHtml' => _imgUpload.'htmls/',
    'imgUploadHtmlRealPath' => _ImgUploadRealPath.'htmls/',
    // Html add
    "htmlAdd" => _viewHtml.'add/',
    "htmlAddProcess" => _processHtml.'add/',
    // Html update
    "htmlUpdate" => _viewHtml.'update/',
    'htmlUpdateProcess' => _processHtml.'update/',

    // Config list
    "listConfig" => _viewRequireConfiguration.'list.php',
    'listDataConfig' => _viewConfiguration.'data/',
    'listDataConfigJs' => _viewConfiguration.'data/data.js',
    // Config add
    "configAdd" => _viewConfiguration.'add/',
    "configAddProcess" => _processConfig.'add/',
    // Config update
    "configUpdate" => _viewConfiguration.'update/',
    'configUpdateProcess' => _processConfig.'update/',

    // information list
    "listInfo" => _viewRequireInfo.'list.php',
    "listDataInfo" => _viewInfo.'data/',
    "listDataInfoJs" => _viewInfo.'data/data.js',
    // information add
    "infoAdd" => _viewInfo.'add/',
    "infoAddProcess" => _processInfo.'add/',
    // information update
    "infoUpdate" => _viewInfo.'update/',
    'infoUpdateProcess' => _processInfo.'update/',
    // information active
    "infoActiveProcess" => _processInfo.'active/',
    'imgUploadInfo' => _imgUpload.'info/',
    'imgUploadInfoRealPath' => _ImgUploadRealPath.'info/',
    
    // Contact list
    "listContact" => _viewRequireContact.'list.php',
    'listDataContact' => _viewContact.'data/',
    'listDataContactJs' => _viewContact.'data/data.js',

    // theme
    "themeDist" => _theme.'dist/',
    "themeJs" => _theme.'js/',
    'themePlugins' => _theme.'plugins/',

    // sidebar
    'sidebar' => _viewsRequire.'sidebar.php',
    'navbar' => _viewsRequire.'navbar.php',

    // table in database
    "tableAdmin" => "admins",
    "tableAdminRoles" => "admin_roles",
    "tableCategories" => "categories",
    'tableConfigurations' => 'configurations',
    'tableFunctionRoles' => 'function_roles',
    'tableHtmls' => 'htmls',
    'tableInformations' => 'informations',
    'tableProducts' => 'products',
    'tableNews' => 'news',
    'tableNewsTags' => 'news_tags',
    'tableTags' => 'tags',
    'tableContact' => 'contacts',

    // logout
    "logout" => "logout",
  ];
