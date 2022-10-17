<?php
  if (!isset($_REQUEST['pqh']))
    $desc = $conf['descriptionSeo'];
  else {
    switch ($mod[0]) {
      case $def['actionOrder']:
        $descOrder = $h->getById($tableConfig, 2);
        if (!isset($mod[1]) && $mod[1] == '')
          $desc = $descOrder['descriptionSeo'];
        elseif ($mod[1] != '' && !isset($mod[2]) && $mod[2] == '') {
          $tableCateOrder = $prefixTable.$def['tableCategoriesOrders'];
          $has = 0;
          $checkCateOrder = $h->checkExist($tableCateOrder, "deleted_at is null and active = 1");
          if ($checkCateOrder) {
            $cateOrders = $h->getAllSelect("id, titleCate, descriptionSeo", $tableCateOrder, "deleted_at is null and active = 1");
            foreach ($cateOrders as $cate) {
              $linkCate = chuoilink($cate['titleCate']);
              if ($linkCate == $mod[1]) {
                $has = 1;
                $descSeo = $cate['descriptionSeo'];
                if ($descSeo != '' && !is_null($descSeo))
                  $desc = $descSeo;
                else
                  $desc = $descOrder['descriptionSeo'];
                break;
              }
            }
          }
          if ($has == 1)
            $desc = $desc;
          else
            $desc = $descOrder['descriptionSeo'];
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
            $orders = $h->getAllSelect("id, titleOrder, descriptionSeo", "$tableOrder as o", "deleted_at is null and active = 1 and cateID = $cateID", "created_at desc, sortOrder desc, id desc");
            foreach ($orders as $order) {
              $descOrder = $order['titleOrder'];
              $linkCompare = chuoilink($descOrder).'.html';
              if ($linkCompare == $mod[2]) {
                $has = 1;
                $descSeo = $order['descriptionSeo'];
                if ($descSeo != '' && !is_null($descSeo))
                  $desc = $descSeo;
                else
                  $desc = $descOrder['descriptionSeo'];
                break;
              }
            }
          }
          if ($has == 1)
            $desc = $desc;
          else
            $desc = $descOrder['descriptionSeo'];
        }
        break;
      case $def['actionNews']:
        $descNews = $h->getById($tableConfig, 3);
        if (!isset($mod[1]) && $mod[1] == '')
          $desc = $descNews['descriptionSeo'];
        elseif ($mod[1] != '' && !isset($mod[2]) && $mod[2] == '') {
          $tableCateNews = $prefixTable.$def['tableCategoriesNews'];
          $has = 0;
          $checkCateNews = $h->checkExist($tableCateNews, "deleted_at is null and active = 1");
          if ($checkCateNews) {
            $cateNews = $h->getAllSelect("id, titleCate, descriptionSeo", $tableCateNews, "deleted_at is null and active = 1");
            foreach ($cateNews as $cate) {
              $linkCate = chuoilink($cate['titleCate']);
              if ($linkCate == $mod[1]) {
                $has = 1;
                $descSeo = $cate['descriptionSeo'];
                if ($descSeo != '' && !is_null($descSeo))
                  $desc = $descSeo;
                else
                  $desc = $descNews['descriptionSeo'];
                break;
              }
            }
          }
          if ($has == 1)
            $desc = $desc;
          else
            $desc = $descNews['descriptionSeo'];
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
            $newss = $h->getAllSelect("id, titleNews, descriptionSeo", "$tableNews as n", "deleted_at is null and active = 1 and cateID = $cateID", "created_at desc, sortOrder desc, id desc");
            foreach ($newss as $news) {
              $titleNews = $news['titleNews'];
              $linkCompare = chuoilink($titleNews).'.html';
              if ($linkCompare == $mod[2]) {
                $has = 1;
                $descSeo = $news['descriptionSeo'];
                if ($descSeo != '' && !is_null($descSeo))
                  $desc = $descSeo;
                else
                  $desc = $descNews['descriptionSeo'];
                break;
              }
            }
          }
          if ($has == 1)
            $desc = $desc;
          else
            $desc = $descNews['descriptionSeo'];
        }
        break;
      case $def['actionAbout']:
        $info = $h->getById($tableInfo, 1);
        if ($info['descriptionSeo'] != '' && !is_null($info['descriptionSeo']))
          $desc = $info['descriptionSeo'];
        else
          $desc = $conf['descriptionSeo'];
        break;
      case $def['actionPolicy']:
        $info = $h->getById($tableInfo, 2);
        if ($info['descriptionSeo'] != '' && !is_null($info['descriptionSeo']))
          $desc = $info['descriptionSeo'];
        else
          $desc = $conf['descriptionSeo'];
        break;
      case $def['actionResolveComplain']:
        $info = $h->getById($tableInfo, 3);
        if ($info['descriptionSeo'] != '' && !is_null($info['descriptionSeo']))
          $desc = $info['descriptionSeo'];
        else
          $desc = $conf['descriptionSeo'];
        break;
      case $def['actionSecure']:
        $info = $h->getById($tableInfo, 4);
        if ($info['descriptionSeo'] != '' && !is_null($info['descriptionSeo']))
          $desc = $info['descriptionSeo'];
        else
          $desc = $conf['descriptionSeo'];
        break;
    }
  }
  _e($desc);
