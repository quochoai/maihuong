<?php
  include("../../../../library.php");
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
  $tableCateNews = $prefixTable.$def['tableCategoriesNews'];
  $tableNews = $prefixTable.$def['tableNews'];
  $newss = $h->getAllSelect("n.id, cateID, titleNews, imageNews, titleCate, shortContentNews, postDate, n.created_at as createdAt, numberViews", "$tableNews as n, $tableCateNews as c", $where." and n.cateID = c.id", "n.created_at desc, n.sortOrder desc, n.id desc", "limit $start,$per_page");
  $msg .= '<div class="itemList"><div id="itemListPrimary">';
  foreach ($newss as $news) {
    $titleNews = $news['titleNews'];
    $titleCate = $news['titleCate'];
    $linkCate = $def['actionNews'].'/'.chuoilink($titleCate);
    $linkNews = $linkCate.'/'.chuoilink($titleNews).'.html';
    $imageNews = $news['imageNews'];
    if (file_exists($def['imgUploadNewsRealPath'].$imageNews) && $imageNews != '')
      $imgNews = $def['imgUploadNews'].$imageNews;
    else
      $imgNews = _noImage;
    $pd = $news['postDate'];
    if (!is_null($pd) && $pd != '')
      $postDate = date("d/m/Y", strtotime($pd));
    else 
      $postDate = date("d/m/Y", strtotime($news['created_at']))  ;
    $numberView = $news['numberViews'];
    $shortContent = $news['shortContentNews'];
    
    
    $msg .= '<div class="itemContainer itemContainerLast" style="width:100.0%;">';
    $msg .= ' <div class="catItemView listing groupPrimary">';
    $msg .= '   <div class="catItemImageBlock col-sm-4 col-xs-12"><a class="img" href="'.$linkNews.'" title="'.$titleNews.'"><img src="'.$imgNews.'" alt="'.$titleNews.'"></a></div>';
    $msg .= '   <div class="main-item col-sm-8 col-xs-12">';
    $msg .= '     <div class="catItemHeader"><h3 class="catItemTitle"><a href="'.$linkNews.'">'.$titleNews.'</a></h3></div><div class="clr"></div>';
    $msg .= '     <ul class="catToolbar"><li class="catItemHits"><i class="fa fa-eye"></i> '.$numberView.'&nbsp;'.$lang['views'].'</li>
    <li><i class="fa fa-folder-open-o"></i> <a href="'.$linkCate.'" title="'.$titleCate.'">'.$titleCate.'</a></li><li class="catItemDateCreated"> '.$postDate.' </li></ul><div class="clr"></div>';
    $msg .= '     <div class="catItemBody"><div class="catItemIntroText"> '.$shortContent.'</div><div class="clr"></div><a class="read-more" href="'.$linkNews.'" title="'.$tableNews.'">'.$lang['viewDetail'].'</a>
    <div class="clr"></div></div><div class="clr"></div>';
    $msg .= '   </div><div class="clr"></div>';
  }
  $msg .= '</div></div>';

  /* --------------------------------------------- */
  $count = $h->checkExist("$tableNews as n, $tableCateNews as c", $where." and n.cateID = c.id", "n.id");
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
