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
      case $def['actionProduct']:
        $imgFB = $h->getById($tableHtml, 16);
        if (file_exists(_ImgUploadRealPath.'htmls/'.$imgFB['content']) && $imgFB['content'] != '')
          $imgShare = _imgUpload.'htmls/'.$imgFB['content'];
        else
          $imgShare = _assets.'images/logo.png';
        $nco = count($mod);
        $ncoo = $nco - 1;
        $htm = substr($mod[$ncoo],-5);
        $tableCate = $prefixTable.$def['tableCategories'];
        if ($htm != '.html') {
          if ($mod[1] == '')
            $imageSeo = $imgShare;
          elseif ($mod[1] != '' && $mod[2] == '') {
            $has = 0;
            $checkCate = $h->checkExist($tableCate, "deleted_at is null and active = 1");
            if ($checkCate) {
              $cateProduct = $h->getAllSelect("id, titleCate, imageShareFb", $tableCate, "deleted_at is null and active = 1");
              foreach ($cateProduct as $cate) {
                $linkCate = chuoilink($cate['titleCate']);
                if ($linkCate == $mod[1]) {
                  $has = 1;
                  $imageSeo = $cate['imageShareFb'];
                  if ($imageSeo != '' && file_exists($def['imgUploadCateProductRealPath'].$imageSeo))
                    $imageSeo = $def['imgUploadCateProduct'].$imageSeo;
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
          } elseif ($mod[2] != '') {
            $has = 0;
            $checkCate = $h->checkExist($tableCate, "deleted_at is null and active = 1");
            if ($checkCate) {
              $cateProduct = $h->getAllSelect("id, titleCate, imageShareFb", $tableCate, "deleted_at is null and active = 1");
              foreach ($cateProduct as $cate) {
                $linkCate = chuoilink($cate['titleCate']);
                if ($linkCate == $mod[2]) {
                  $has = 1;
                  $imageSeo = $cate['imageShareFb'];
                  if ($imageSeo != '' && file_exists($def['imgUploadCateProductRealPath'].$imageSeo))
                    $imageSeo = $def['imgUploadCateProduct'].$imageSeo;
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
        } else {
          $has = 0;
          $tableProduct = $prefixTable.$def['tableProduct'];
          $checkProduct = $h->checkExist($tableProduct, "deleted_at is null and active = 1");
          if ($checkProduct) {
            $products = $h->getAllSelect("id, titleProduct, imageShareFb", $tableProduct, "deleted_at is null and active = 1", "sortOrder desc, created_at desc, id desc");
            foreach ($products as $product) {
              $titleProduct = $product['titleProduct'];
              $linkCompare = chuoilink($titleProduct).'.html';
              if ($linkCompare == $mod[$ncoo]) {
                $has = 1;
                $imageSeo = $product['imageShareFb'];
                if (file_exists($def['imgUploadProductRealPath'].$imageSeo))
                  $imageSeo = $def['imgUploadProduct'].$imageSeo;
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
        $imgFB = $h->getById($tableHtml, 17);
        if (file_exists(_ImgUploadRealPath.'htmls/'.$imgFB['content']))
          $imgShare = _imgUpload.'htmls/'.$imgFB['content'];
        else
          $imgShare = _assets.'images/logo.png';
        if (!isset($mod[1]) && $mod[1] == '')
          $imageSeo = $imgShare;
        else {
          $tableNews = $prefixTable.$def['tableNews'];
          $has = 0;
          $checkNews = $h->checkExist($tableNews, "deleted_at is null and active = 1");
          if ($checkNews) {
            $newss = $h->getAllSelect("id, titleNews, imageShareFb", $tableNews, "deleted_at is null and active = 1");
            foreach ($newss as $news) {
              $linkNews = chuoilink($news['titleNews']);
              if ($linkCate == $mod[1]) {
                $has = 1;
                $imageSeo = $cate['imageShareFb'];
                if (file_exists($def['imgUploadNewsRealPath'].$imageSeo))
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
      case $def['actionAbout']:
        $imgFB = $h->getById($tableHtml, 1);
        if (file_exists(_ImgUploadRealPath.'htmls/'.$imgFB['content']) && $imgFB['content'] != '')
          $imgShare = _imgUpload.'htmls/'.$imgFB['content'];
        else
          $imgShare = _assets.'images/logo.png';
        $imgInfo = $h->getById($tableInfo, 1);
        if (file_exists(_ImgUploadRealPath.'info/'.$imgInfo['imageShareFb']))
          $imageSeo = _imgUpload.'info/'.$imgInfo['imageShareFb'];
        else
          $imageSeo = $imgShare;
        break;
      case $def['actionContact']:
        $imgFB = $h->getById($tableHtml, 18);
        if (file_exists(_ImgUploadRealPath.'htmls/'.$imgFB['content']) && $imgFB['content'] != '')
          $imgShare = _imgUpload.'htmls/'.$imgFB['content'];
        else
          $imgShare = _assets.'images/logo.png';
        $imageSeo = $imgShare;
        break;
      case $def['actionSearch']:
        $imgFB = $h->getById($tableHtml, 19);
        if (file_exists(_ImgUploadRealPath.'htmls/'.$imgFB['content']) && $imgFB['content'] != '')
          $imgShare = _imgUpload.'htmls/'.$imgFB['content'];
        else
          $imgShare = _assets.'images/logo.png';
        $imageSeo = $imgShare;
        break;
    }
  }
  _e($imageSeo);
