<?php
  include("../../../../../library.php");
  $page = $_POST['page'];
  $where = $_POST['whereNews'];
  $cur_page = $page;
  $page -= 1;
  $previous_btn = true;
  $next_btn = true;
  $first_btn = true;
  $last_btn = true;
  $per_page = $def['perPageNews'];
  $start = $page * $per_page;
  $tableNews = $prefixTable.$def['tableNews'];
  $newss = $h->getAllSelect("id, titleNews, postDate, created_at as createdAt", $tableNews, $where, "sortOrder desc, created_at desc, id desc", "limit $start,$per_page");
  $msg = '<ul>';
  foreach ($newss as $news) {
    $titleNews = $news['titleNews'];
    $linkNews = $def['actionNews'].'/'.chuoilink($titleNews).'.html';
    $pd = $news['postDate'];
    if (!is_null($pd) && $pd != '')
      $postDate = date("d/m/Y", strtotime($pd));
    else {
      $createdAt = $news['created_at'];
      $postDate = date("d/m/Y", strtotime($createdAt));
    }
      
    $msg .= '<li style="margin-bottom: 7px"><a href="'.$linkNews.'"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> '.$titleNews.' <i>('.$postDate.')</i></a></li>';
  }
  $msg .= '</ul>';
  /* --------------------------------------------- */
  $count = $h->checkExist($tableNews, $where);
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
