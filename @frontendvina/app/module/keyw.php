<?php
  if (!isset($_REQUEST['pqh']))
    $keyw = $conf['keywordSeo'];
  else {
    switch ($mod[0]) {
      case $def['actionProduct']:
        $nco = count($mod);
        $ncoo = $nco - 1;
        $htm = substr($mod[$ncoo],-5);
        $tableCate = $prefixTable.$def['tableCategories'];
        $keywProduct = $h->getById($tableConfig, 2);
        if ($htm != '.html') {
          if ($mod[1] == '')
            $keyw = $keywProduct['keywordSeo'];
          elseif ($mod[1] != '' && $mod[2] == '') {
            $has = 0;
            $checkCateProduct = $h->checkExist($tableCate, "deleted_at is null and active = 1");
            if ($checkCateProduct) {
              $cateProduct = $h->getAllSelect("id, titleCate, keywordSeo", $tableCate, "deleted_at is null and active = 1");
              foreach ($cateProduct as $cate) {
                $linkCate = chuoilink($cate['titleCate']);
                if ($linkCate == $mod[1]) {
                  $has = 1;
                  $keywSeo = $cate['keywordSeo'];
                  if ($keywSeo != '' && !is_null($keywSeo))
                    $keyw = $keywSeo;
                  else
                    $keyw = $keywProduct['keywordSeo'];
                  break;
                }
              }
            }
            if ($has == 1)
              $keyw = $keyw;
            else
              $keyw = $lang['pageNotFound'];
          } elseif ($mod[2] != '') {
            $checkCateProduct = $h->checkExist($tableCate, "deleted_at is null and active = 1");
            $has2 = 0;
            if ($checkCateProduct) {
              $cateProduct = $h->getAllSelect("id, titleCate, keywordSeo", $tableCate, "deleted_at is null and active = 1");
              foreach ($cateProduct as $cate) {
                $linkCate = chuoilink($cate['titleCate']);
                if ($linkCate == $mod[2]) {
                  $has2 = 1;
                  $keywSeo = $cate['keywordSeo'];
                  if ($keywSeo != '' && !is_null($keywSeo))
                    $keyw = $keywSeo;
                  else
                  $keyw = $keywProduct['keywordSeo'];
                  break;
                }
              }
            }
            if ($has2 == 1)
              $keyw = $keyw;
            else
              $keyw = $lang['pageNotFound'];
          }
        } else {
          $tableProduct = $prefixTable.$def['tableProduct'];
          $has3 = 0;
          $checkProduct = $h->checkExist($tableProduct, "deleted_at is null and active = 1");
          if ($checkProduct) {
            $products = $h->getAllSelect("id, titleProduct, keywordSeo", $tableProduct, "deleted_at is null and active = 1", "sortOrder desc, created_at desc, id desc");
            foreach ($products as $product) {
              $titleProduct = $product['titleProduct'];
              $linkCompare = chuoilink($titleProduct).'.html';
              if ($linkCompare == $mod[$ncoo]) {
                $has3 = 1;
                $keywSeo = $product['keywordSeo'];
                if ($keywSeo != '' && !is_null($keywSeo))
                  $keyw = $keywSeo;
                else
                  $keyw = $keywProduct['keywordSeo'];
                break;
              }
            }
          }
          if ($has3 == 1)
            $keyw = $keyw;
          else
            $keyw = $lang['pageNotFound'];
        }       
        break;
      case $def['actionNews']:
        $keywNews = $h->getById($tableConfig, 3);
        if (!isset($mod[1]) && $mod[1] == '')
          $keyw = $keywNews['keywordSeo'];
        else {
          $tableNews = $prefixTable.$def['tableNews'];
          $has = 0;
          $checkNews = $h->checkExist($tableNews, "deleted_at is null and active = 1");
          if ($checkNews) {
            $newss = $h->getAllSelect("id, titleNews, keywordSeo", $tableNews, "deleted_at is null and active = 1", "sortOrder desc, created_at desc, id desc");
            foreach ($newss as $news) {
              $titleNews = $news['titleNews'];
              $linkCompare = chuoilink($titleNews).'.html';
              if ($linkCompare == $mod[1]) {
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
            $keyw = $lang['pageNotFound'];
        }
        break;
      case $def['actionAbout']:
        $info = $h->getById($tableInfo, 1);
        if ($info['keywordSeo'] != '' && !is_null($info['keywordSeo']))
          $keyw = $info['keywordSeo'];
        else
          $keyw = $conf['keywordSeo'];
        break;
      case $def['actionContact']:
        $contact = $h->getById($tableConfig, 7);
        if ($contact['keywordSeo'] != '' && !is_null($contact['keywordSeo']))
          $keyw = $contact['keywordSeo'];
        else
          $keyw = $conf['keywordSeo'];
        break;
      case $def['actionSearch']:
        $seachKeyw = $h->getById($tableConfig, 8);
        if ($seachKeyw['keywordSeo'] != '' && !is_null($seachKeyw['keywordSeo']))
          $keyw = $seachKeyw['keywordSeo'];
        else
          $keyw = $conf['keywordSeo'];
        break;  
      case $def['actionTag']:
        $tag = $h->getById($tableConfig, 9);
        if ($tag['keywordSeo'] != '' && !is_null($tag['keywordSeo']))
          $keyw = $tag['keywordSeo'];
        else
          $keyw = $conf['keywordSeo'];
        break;                         
    }
  }
  _e($keyw);
