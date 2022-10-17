<?php
  if (!isset($_REQUEST['pqh']))
    $title = $conf['title'];
  else {
    switch ($mod[0]) {
      case $def['actionOrder']:
        if (!isset($mod[1]) && $mod[1] == '') {
          $titleOrder = $h->getById($tableConfig, 2);
          $title = $titleOrder['title'];
        } elseif ($mod[1] != '' && !isset($mod[2]) && $mod[2] == '') {
          $tableCateOrder = $prefixTable.$def['tableCategoriesOrders'];
          $has = 0;
          $checkCateOrder = $h->checkExist($tableCateOrder, "deleted_at is null and active = 1");
          if ($checkCateOrder) {
            $cateOrders = $h->getAllSelect("id, titleCate, titleSeo", $tableCateOrder, "deleted_at is null and active = 1");
            foreach ($cateOrders as $cate) {
              $linkCate = chuoilink($cate['titleCate']);
              if ($linkCate == $mod[1]) {
                $has = 1;
                $titleSeo = $cate['titleSeo'];
                if ($titleSeo != '' && !is_null($titleSeo))
                  $title = $titleSeo;
                else
                  $title = $cate['titleCate'];
                break;
              }
            }
          }
          if ($has == 1)
            $title = $title;
          else
            $title = $lang['pageNotFound'];
        }
        elseif (isset($mod[2]) && $mod[2] != '') {
          $tableCateOrder = $prefixTable.$def['tableCategoriesOrders'];
          $tableOrder = $prefixTable.$def['tableOrders'];
          $checkCateOrder = $h->checkExist($tableCateOrder, "deleted_at is null and active = 1");
          if ($checkCateOrder) {
            $cateOrders = $h->getAllSelect("id, titleCate", $tableCateOrder, "deleted_at is null and active = 1");
            foreach ($cateOrders as $cate) {
              $linkCate = chuoilink($cate['titleCate']);
              if ($linkCate == $mod[1]) {
                $cateID = $cate['id'];
                break;
              }
            }
          }
          $has = 0;
          $checkOrder = $h->checkExist($tableOrder, "deleted_at is null and active = 1 and cateID = $cateID");
          if ($checkOrder) {
            $orders = $h->getAllSelect("id, titleOrder, titleSeo", "$tableOrder as o", "deleted_at is null and active = 1 and cateID = $cateID", "created_at desc, sortOrder desc, id desc");
            foreach ($orders as $order) {
              $titleOrder = $order['titleOrder'];
              $linkCompare = chuoilink($titleOrder).'.html';
              if ($linkCompare == $mod[2]) {
                $has = 1;
                $titleSeo = $order['titleSeo'];
                if ($titleSeo != '' && !is_null($titleSeo))
                  $title = $titleSeo;
                else
                  $title = $order['titleOrder'];
                break;
              }
            }
          }
          if ($has == 1)
            $title = $title;
          else
            $title = $lang['pageNotFound'];
        }
        break;
      case $def['actionNews']:
        if (!isset($mod[1]) && $mod[1] == '') {
          $titleNews = $h->getById($tableConfig, 3);
          $title = $titleNews['title'];
        } elseif ($mod[1] != '' && !isset($mod[2]) && $mod[2] == '') {
          $tableCateNews = $prefixTable.$def['tableCategoriesNews'];
          $has = 0;
          $checkCateNews = $h->checkExist($tableCateNews, "deleted_at is null and active = 1");
          if ($checkCateNews) {
            $cateNews = $h->getAllSelect("id, titleCate, titleSeo", $tableCateNews, "deleted_at is null and active = 1");
            foreach ($cateNews as $cate) {
              $linkCate = chuoilink($cate['titleCate']);
              if ($linkCate == $mod[1]) {
                $has = 1;
                $titleSeo = $cate['titleSeo'];
                if ($titleSeo != '' && !is_null($titleSeo))
                  $title = $titleSeo;
                else
                  $title = $cate['titleCate'];
                break;
              }
            }
          }
          if ($has == 1)
            $title = $title;
          else
            $title = $lang['pageNotFound'];
        }
        elseif (isset($mod[2]) && $mod[2] != '') {
          $tableCateNews = $prefixTable.$def['tableCategoriesNews'];
          $tableNews = $prefixTable.$def['tableNews'];
          $checkCateNews = $h->checkExist($tableCateNews, "deleted_at is null and active = 1");
          if ($checkCateNews) {
            $cateNews = $h->getAllSelect("id, titleCate", $tableCateNews, "deleted_at is null and active = 1");
            foreach ($cateNews as $cate) {
              $linkCate = chuoilink($cate['titleCate']);
              if ($linkCate == $mod[1]) {
                $cateID = $cate['id'];
                break;
              }
            }
          }
          $has = 0;
          $checkNews = $h->checkExist($tableNews, "deleted_at is null and active = 1 and cateID = $cateID");
          if ($checkNews) {
            $newss = $h->getAllSelect("id, titleNews, titleSeo", "$tableNews as n", "deleted_at is null and active = 1 and cateID = $cateID", "created_at desc, sortOrder desc, id desc");
            foreach ($newss as $news) {
              $titleNews = $news['titleNews'];
              $linkCompare = chuoilink($titleNews).'.html';
              if ($linkCompare == $mod[2]) {
                $has = 1;
                $titleSeo = $news['titleSeo'];
                if ($titleSeo != '' && !is_null($titleSeo))
                  $title = $titleSeo;
                else
                  $title = $news['titleNews'];
                break;
              }
            }
          }
          if ($has == 1)
            $title = $title;
          else
            $title = $lang['pageNotFound'];
        }
        break;
      case $def['actionAbout']:
        $info = $h->getById($tableInfo, 1);
        if ($info['titleSeo'] != '' && !is_null($info['titleSeo']))
          $title = $info['titleSeo'];
        else
          $title = $info['titleInfo'];
        break;
      case $def['actionPolicy']:
        $info = $h->getById($tableInfo, 2);
        if ($info['titleSeo'] != '' && !is_null($info['titleSeo']))
          $title = $info['titleSeo'];
        else
          $title = $info['titleInfo'];
        break;
      case $def['actionResolveComplain']:
        $info = $h->getById($tableInfo, 3);
        if ($info['titleSeo'] != '' && !is_null($info['titleSeo']))
          $title = $info['titleSeo'];
        else
          $title = $info['titleInfo'];
        break;
      case $def['actionSecure']:
        $info = $h->getById($tableInfo, 4);
        if ($info['titleSeo'] != '' && !is_null($info['titleSeo']))
          $title = $info['titleSeo'];
        else
          $title = $info['titleInfo'];
        break;
      /*
      case $def['actionAbout']:
        $info = $h->getById($tableInfo, 1);
        if ($info['titleSeo'] != '' && !is_null($info['titleSeo']))
          $title = $info['titleSeo'];
        else
          $title = $info['titleInfo'];
        break;
      case $def['actionContact']:
        $title = $lang[''];
        break;
      case $def['actionPolicy']:
        $title = $lang[''];
        break;
      case $def['actionResolveComplain']:
        $title = $lang[''];
        break;
      case $def['actionSecure']:
        $title = $lang[''];
        break;
      case $def['actionAbout']:
        $title = $lang[''];
        break;
      case $def['actionAbout']:
        $title = $lang[''];
        break;
      */                                      
    }
  }
  _e($title);
