<?php
  include("../../../../library.php");
  $page = $_POST['page'];
  $where = $_POST['whereProduct'];
  $cur_page = $page;
  $page -= 1;
  $previous_btn = true;
  $next_btn = true;
  $first_btn = true;
  $last_btn = true;
  $per_page = $def['perPageProduct'];
  $start = $page * $per_page;
  $tableCate = $prefixTable.$def['tableCategories'];
  $tableProduct = $prefixTable.$def['tableProduct'];
  $products = $h->getAllSelect("p.id, p.cateID as pcateID, titleProduct, imageProduct, titleCate, priceProduct, oldPriceProduct", "$tableProduct as p, $tableCate as c", $where." and p.cateID = c.id", "p.sortOrder desc, p.created_at desc, p.id desc", "limit $start,$per_page");
  $msg .= '<div class="product-grid clearfix"><div class="row">';
  foreach ($products as $product) {
    $titleProduct = $product['titleProduct'];
    $titleCate = $product['titleCate'];
    $cateID = $product['pcateID'];
    $cate = $h->getById($tableCate, $cateID);
    if ($cate['cateID'] != 0) {
      $cateMain = $h->getById($tableCate, $cate['cateID']);
      $linkProduct = $def['actionProduct'].'/'.chuoilink($cateMain['titleCate']).'/'.chuoilink($cate['titleCate']).'/'.chuoilink($titleProduct).'.html';
    } else
      $linkProduct = $def['actionProduct'].'/'.chuoilink($cate['titleCate']).'/'.chuoilink($titleProduct).'.html';
    
    $imageProduct = $product['imageProduct'];
    if (file_exists($def['imgUploadProductRealPath'].$imageProduct))
      $imgProduct = $def['imgUploadProduct'].$imageProduct;
    else
      $imgProduct = _noImage;
    $pPrice = $product['priceProduct'];
    $oPPrice = $product['oldPriceProduct'];
    if ($pPrice != 0)
      $productPrice = number_format($pPrice, 0, ',', '.').'đ';
    else
      $productPrice = $lang['contactText'];
    $oldProductPrice = '';
    $sale = '';
    if (!is_null($oPPrice) && $oPPrice != 0) {
      $oldProductPrice = number_format($oPPrice, 0, ',', '.').'đ';
      $sale = '<div class="sale-label sale-top-right">Sale</div>';
    }
    $msg .= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 item">';
    $msg .= ' <div class="col-item">'.$sale;
    $msg .= '   <div class="item-inner">';
    $msg .= '     <div class="product-wrapper"><div class="thumb-wrapper"><a href="'.$linkProduct.'" title="'.$titleProduct.'"><picture class="dp-flex"><img class="img-responsive" src="'.$imgProduct.'" alt="'.$titleProduct.'" /></picture></a></div></div>';
    $msg .= '     <div class="item-info"><div class="info-inner">';
    $msg .= '       <div class="item-title"><h3 class="text1line"><a href="'.$linkProduct.'" title="'.$titleProduct.'">'.$titleProduct.'</a></h3></div>';
    $msg .= '       <div class="item-content"><div class="price-box price-loop-style"><span class="special-price"><span class="price">'.$productPrice.'</span></span><span class="old-price"><span class="price sale">'.$oldProductPrice.'</span></span></div></div>';
    $msg .= '     </div></div>';
    $msg .= '   </div>';
    $msg .= ' </div>';
    $msg .= '</div>';
  }
  $msg .= '</div></div>';

  /* --------------------------------------------- */
  $count = $h->checkExist("$tableProduct as p, $tableCate as c", $where." and p.cateID = c.id", "p.id");
  $no_of_paginations = ceil($count / $per_page);

  if($count >= ($per_page+1)) {
  /* ---------------Calculating the starting and endign values for the loop----------------------------------- */
  if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
      $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
      $start_loop = $no_of_paginations - 6;
      $end_loop = $no_of_paginations;
    } else
      $end_loop = $no_of_paginations;
  } else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
      $end_loop = 7;
    else
      $end_loop = $no_of_paginations;
  }

  /* ----------------------------------------------------------------------------------------------------------- */

  $msg .= '<div class="pager clearfix"><div class="pages clearfix"><ul class="pagination">';
  if($cur_page == 1) {
    $msg .= '<li class="active"><a style="pointer-events:none"><i class="fa fa-long-arrow-left"></i></a></li>';
  }
  // FOR ENABLING THE PREVIOUS BUTTON
  if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= '<li><a class="pagenav linkRef cursorPointer" rel="'.$pre.'"><i class="fa fa-long-arrow-left"></i></a></li>';
  }
  for ($i = $start_loop; $i <= $end_loop; $i++) {
    if ($cur_page == $i)
      $msg .= '<li class="active"><a style="pointer-events:none">'.$i.'</a></li>';
    else
      $msg .= '<li><a class="pagenav linkRef cursorPointer" rel="'.$i.'">'.$i.'</a></li>';
  }
  // TO ENABLE THE NEXT BUTTON
  if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= '<li><a class="pagenav linkRef cursorPointer" rel="'.$nex.'"><i class="fa fa-long-arrow-right"></i></a></li>';
  } else if ($next_btn)
    $msg .= '<li><a class="pagenav"><i class="fa fa-chevron-right"></i></a></li>';

  $msg .= "</ul></div></div>";  // Content for pagination
  }
  _e($msg);
