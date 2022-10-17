<?php
  if (!isset($_REQUEST['pqh'])) {
    $imgFB = $h->getById($tableHtml, 1);
    if (file_exists(_ImgUploadRealPath.'htmls/'.$imgFB['content']) && $imgFB['content'] != '')
      $imgShare = _imgUpload.'htmls/'.$imgFB['content'];
    else
      $imgShare = _assets.'images/logo.png';
    $imageSeo = $imgShare;
  } else {
    switch ($mod[0]){
      case $def['actionOrder']:
        $imgFB = $h->getById($tableHtml, 9);
        if (file_exists(_ImgUploadRealPath.'htmls/'.$imgFB['content']) && $imgFB['content'] != '')
          $imgShare = _imgUpload.'htmls/'.$imgFB['content'];
        else
          $imgShare = _assets.'images/logo.png';
        if (!isset($mod[1]) && $mod[1] == '')
          $imageSeo = $imgFB['content'];
        elseif ($mod[1] != '' && !isset($mod[2]) && $mod[2] == '') {
          $tableCateOrder = $prefixTable.$def['tableCategoriesOrders'];
          $has = 0;
          $checkCateOrder = $h->checkExist($tableCateOrder, "deleted_at is null and active = 1");
          if ($checkCateOrder) {
            $cateOrders = $h->getAllSelect("id, titleCate, imageShareFb", $tableCateOrder, "deleted_at is null and active = 1");
            foreach ($cateOrders as $cate) {
              $linkCate = chuoilink($cate['titleCate']);
              if ($linkCate == $mod[1]) {
                $has = 1;
                $imageSeo = $cate['imageShareFb'];
                if ($imageSeo != '' && file_exists($def['imgUploadCateOrderRealPath'].$imageSeo))
                  $imageSeo = $def['imgUploadCateOrder'].$imageSeo;
                else
                  $imageSeo = $imgShare;
                break;
              }
            }
          }
          if ($has == 1)
            $imageSeo = $imageSeo;
          else
            $imageSeo = $imgShare;
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
            $orders = $h->getAllSelect("id, titleOrder, imageShareFb", "$tableOrder as o", "deleted_at is null and active = 1 and cateID = $cateID", "created_at desc, sortOrder desc, id desc");
            foreach ($orders as $order) {
              $imageSeoOrder = $order['titleOrder'];
              $linkCompare = chuoilink($imageSeoOrder).'.html';
              if ($linkCompare == $mod[2]) {
                $has = 1;
                $imageSeo = $order['imageShareFb'];
                if ($imageSeo != '' && !is_null($imageSeo) && file_exists($def['imgUploadOrderRealPath'].$imageSeo))
                  $imageSeo = $def['imgUploadOrder'].$imageSeo;
                else
                  $imageSeo = $imgShare;
                break;
              }
            }
          }
          if ($has == 1)
            $imageSeo = $imageSeo;
          else
            $imageSeo = $imgShare;
        }
        break;
      case $def['actionNews']:
        $imgFB = $h->getById($tableHtml, 10);
        if (file_exists(_ImgUploadRealPath.'htmls/'.$imgFB['content']) && $imgFB['content'] != '')
          $imgShare = _imgUpload.'htmls/'.$imgFB['content'];
        else
          $imgShare = _assets.'images/logo.png';
        if (!isset($mod[1]) && $mod[1] == '')
          $imageSeo = $imgShare;
        elseif ($mod[1] != '' && !isset($mod[2]) && $mod[2] == '') {
          $tableCateNews = $prefixTable.$def['tableCategoriesNews'];
          $has = 0;
          $checkCateNews = $h->checkExist($tableCateNews, "deleted_at is null and active = 1");
          if ($checkCateNews) {
            $cateNews = $h->getAllSelect("id, titleCate, imageShareFb", $tableCateNews, "deleted_at is null and active = 1");
            foreach ($cateNews as $cate) {
              $linkCate = chuoilink($cate['titleCate']);
              if ($linkCate == $mod[1]) {
                $has = 1;
                $imageSeo = $cate['imageShareFb'];
                if ($imageSeo != '' && file_exists($def['imgUploadCateNewsRealPath'].$imageSeo))
                  $imageSeo = $def['imgUploadCateNews'].$imageSeo;
                else
                  $imageSeo = $imgShare;
                break;
              }
            }
          }
          if ($has == 1)
            $imageSeo = $imageSeo;
          else
            $imageSeo = $imgShare;
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
            $newss = $h->getAllSelect("id, titleNews, imageShareFb", "$tableNews as o", "deleted_at is null and active = 1 and cateID = $cateID", "created_at desc, sortOrder desc, id desc");
            foreach ($newss as $news) {
              $imageSeoNews = $news['titleNews'];
              $linkCompare = chuoilink($imageSeoNews).'.html';
              if ($linkCompare == $mod[2]) {
                $has = 1;
                $imageSeo = $news['imageShareFb'];
                if ($imageSeo != '' && !is_null($imageSeo) && file_exists($def['imgUploadNewsRealPath'].$imageSeo))
                  $imageSeo = $def['imgUploadNews'].$imageSeo;
                else
                  $imageSeo = $imgShare;
                break;
              }
            }
          }
          if ($has == 1)
            $imageSeo = $imageSeo;
          else
            $imageSeo = $imgShare;
        }
        break;
    }
  }
  _e($imageSeo);
