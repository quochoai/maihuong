<?php
  if (!isset($_REQUEST['pqh']))
    $keyw = $conf['keywordSeo'];
  else {
    switch ($mod[0]){
      case $def['actionOrder']:
        $keywOrder = $h->getById($tableConfig, 2);
        if (!isset($mod[1]) && $mod[1] == '')
          $keyw = $keywOrder['keywordSeo'];
        elseif ($mod[1] != '' && !isset($mod[2]) && $mod[2] == '') {
          $tableCateOrder = $prefixTable.$def['tableCategoriesOrders'];
          $has = 0;
          $checkCateOrder = $h->checkExist($tableCateOrder, "deleted_at is null and active = 1");
          if ($checkCateOrder) {
            $cateOrders = $h->getAllSelect("id, titleCate, keywordSeo", $tableCateOrder, "deleted_at is null and active = 1");
            foreach ($cateOrders as $cate) {
              $linkCate = chuoilink($cate['titleCate']);
              if ($linkCate == $mod[1]) {
                $has = 1;
                $keywSeo = $cate['keywordSeo'];
                if ($keywSeo != '' && !is_null($keywSeo))
                  $keyw = $keywSeo;
                else
                  $keyw = $keywOrder['keywordSeo'];
                break;
              }
            }
          }
          if ($has == 1)
            $keyw = $keyw;
          else
            $keyw = $keywOrder['keywordSeo'];
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
            $orders = $h->getAllSelect("id, titleOrder, keywordSeo", "$tableOrder as o", "deleted_at is null and active = 1 and cateID = $cateID", "created_at desc, sortOrder desc, id desc");
            foreach ($orders as $order) {
              $keywOrder = $order['titleOrder'];
              $linkCompare = chuoilink($keywOrder).'.html';
              if ($linkCompare == $mod[2]) {
                $has = 1;
                $keywSeo = $order['keywordSeo'];
                if ($keywSeo != '' && !is_null($keywSeo))
                  $keyw = $keywSeo;
                else
                  $keyw = $keywOrder['keywordSeo'];
                break;
              }
            }
          }
          if ($has == 1)
            $keyw = $keyw;
          else
            $keyw = $keywOrder['keywordSeo'];
        }
        break;
      case $def['actionNews']:
        $keywNews = $h->getById($tableConfig, 2);
        if (!isset($mod[1]) && $mod[1] == '')
          $keyw = $keywNews['keywordSeo'];
        elseif ($mod[1] != '' && !isset($mod[2]) && $mod[2] == '') {
          $tableCateNews = $prefixTable.$def['tableCategoriesNews'];
          $has = 0;
          $checkCateNews = $h->checkExist($tableCateNews, "deleted_at is null and active = 1");
          if ($checkCateNews) {
            $cateNews = $h->getAllSelect("id, titleCate, keywordSeo", $tableCateNews, "deleted_at is null and active = 1");
            foreach ($cateNews as $cate) {
              $linkCate = chuoilink($cate['titleCate']);
              if ($linkCate == $mod[1]) {
                $has = 1;
                $keywSeo = $cate['keywordSeo'];
                if ($keywSeo != '' && !is_null($keywSeo))
                  $keyw = $keywSeo;
                else
                  $keyw = $keywNews['keywordSeo'];
                break;
              }
            }
          }
          if ($has == 1)
            $keyw = $keyw;
          else
            $keyw = $keywNews['keywordSeo'];
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
            $newss = $h->getAllSelect("id, titleNews, keywordSeo", "$tableNews as n", "deleted_at is null and active = 1 and cateID = $cateID", "created_at desc, sortOrder desc, id desc");
            foreach ($newss as $news) {
              $titleNews = $news['titleNews'];
              $linkCompare = chuoilink($titleNews).'.html';
              if ($linkCompare == $mod[2]) {
                $has = 1;
                $keywSeo = $news['keywordSeo'];
                if ($keywSeo != '' && !is_null($keywSeo))
                  $keyw = $keywSeo;
                else
                  $keyw = $keywNews['keywordSeo'];
                break;
              }
            }
          }
          if ($has == 1)
            $keyw = $keyw;
          else
            $keyw = $keywNews['keywordSeo'];
        }
        break;
      case $def['actionAbout']:
        $info = $h->getById($tableInfo, 1);
        if ($info['keywordSeo'] != '' && !is_null($info['keywordSeo']))
          $keyw = $info['keywordSeo'];
        else
          $keyw = $conf['keywordSeo'];
        break;
      case $def['actionPolicy']:
        $info = $h->getById($tableInfo, 2);
        if ($info['keywordSeo'] != '' && !is_null($info['keywordSeo']))
          $keyw = $info['keywordSeo'];
        else
          $keyw = $conf['keywordSeo'];
        break;
      case $def['actionResolveComplain']:
        $info = $h->getById($tableInfo, 3);
        if ($info['keywordSeo'] != '' && !is_null($info['keywordSeo']))
          $keyw = $info['keywordSeo'];
        else
          $keyw = $conf['keywordSeo'];
        break;
      case $def['actionSecure']:
        $info = $h->getById($tableInfo, 4);
        if ($info['keywordSeo'] != '' && !is_null($info['keywordSeo']))
          $keyw = $info['keywordSeo'];
        else
          $keyw = $conf['keywordSeo'];
        break;
    }
  }
  _e($keyw);