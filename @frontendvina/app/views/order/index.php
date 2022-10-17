<?php
  include("../../../../library.php");
  $page = $_POST['page'];
  $where = $_POST['whereOrder'];
  $cur_page = $page;
  $page -= 1;
  $previous_btn = true;
  $next_btn = true;
  $first_btn = true;
  $last_btn = true;
  $per_page = $def['perPageOrder'];
  $start = $page * $per_page;
  $tableCateOrder = $prefixTable.$def['tableCategoriesOrders'];
  $tableOrder = $prefixTable.$def['tableOrders'];
  $orders = $h->getAllSelect("o.id, cateID, titleOrder, imageOrder, titleCate", "$tableOrder as o, $tableCateOrder as c", $where." and o.cateID = c.id", "o.created_at desc, o.sortOrder desc, o.id desc", "limit $start,$per_page");
  $msg .= '<div class="row">';
  foreach ($orders as $order) {
    $titleOrder = $order['titleOrder'];
    $linkOrder = $def['actionOrder'].'/'.chuoilink($order['titleCate']).'/'.chuoilink($titleOrder).'.html';
    $imageOrder = $order['imageOrder'];
    if (file_exists($def['imgUploadOrderRealPath'].$imageOrder) && $imageOrder != '')
      $imgOrder = $def['imgUploadOrder'].$imageOrder;
    else
      $imgOrder = _noImage;
    $msg .= '<div class="col-md-4 col-xs-12"><div class="box"><div class="content">';
    $msg .= ' <img src="'.$imgOrder.'" alt="'.$titleOrder.'">';
    $msg .= ' <div class="opacity"><p>'.$titleOrder.'</p><div class="clearfix"></div></div>';
    $msg .= ' <div class="hover"><a class="btn btn-default" href="'.$linkOrder.'" title="'.$titleOrder.'">'.$lang['viewDetail'].'</a></div>';
    $msg .= '</div><span class="footer"></span></div></div></div>';
  }
  $msg .= '</div><div class="clearfix"></div>';

  /* --------------------------------------------- */
  $count = $h->checkExist("$tableOrder as o, $tableCateOrder as c", $where." and o.cateID = c.id", "o.id");
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

  $msg .= '<div class="k2_Pagination global_pagination"><ul class="pagination">';
  if($cur_page == 1) {
    $msg .= '<li class="active"><span><i class="fa fa-long-arrow-left"></i></span></li>';
  }
  // FOR ENABLING THE PREVIOUS BUTTON
  if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= '<li><a class="pagenav linkRef" rel="'.$pre.'"><i class="fa fa-long-arrow-left"></i></a></li>';
  }
  for ($i = $start_loop; $i <= $end_loop; $i++) {
    if ($cur_page == $i)
      $msg .= '<li class="active"><span>'.$i.'<span></li>';
    else
      $msg .= '<li><a class="pagenav linkRef" rel="'.$i.'">'.$i.'</a></li>';
  }
  // TO ENABLE THE NEXT BUTTON
  if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= '<li><a class="pagenav linkRef" rel="'.$nex.'"><i class="fa fa-long-arrow-right"></i></a></li>';
  } else if ($next_btn)
    $msg .= '<li><a class="pagenav"><i class="fa fa-chevron-right"></i></a></li>';

  $msg .= "</ul></div>";  // Content for pagination
  }
  _e($msg);
