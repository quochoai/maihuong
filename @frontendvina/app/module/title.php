<?php
  if (!isset($_REQUEST['pqh']))
    $title = $conf['title'];
  else {
    switch ($mod[0]) {
      case $def['actionProduct']:
        $nco = count($mod);
        $ncoo = $nco - 1;
        $htm = substr($mod[$ncoo],-5);
        if ($htm != '.html') {
          $tableCate = $prefixTable.$def['tableCategories'];
          if (!isset($mod[1]) && $mod[1] == '') {
            $titleProduct = $h->getById($tableConfig, 2);
            $title = $titleProduct['title'];
          } elseif ($mod[1] != '' && $mod[2] == '') {
            $has = 0;
            $checkCateProduct = $h->checkExist($tableCate, "deleted_at is null and active = 1");
            if ($checkCateProduct) {
              $cateProduct = $h->getAllSelect("id, titleCate, titleSeo", $tableCate, "deleted_at is null and active = 1");
              foreach ($cateProduct as $cate) {
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
          } elseif ($mod[2] != '') {
            $checkCateProduct = $h->checkExist($tableCate, "deleted_at is null and active = 1");
            $has2 = 0;
            if ($checkCateProduct) {
              $cateProduct = $h->getAllSelect("id, titleCate, titleSeo", $tableCate, "deleted_at is null and active = 1");
              foreach ($cateProduct as $cate) {
                $linkCate = chuoilink($cate['titleCate']);
                if ($linkCate == $mod[2]) {
                  $has2 = 1;
                  $titleSeo = $cate['titleSeo'];
                  if ($titleSeo != '' && !is_null($titleSeo))
                    $title = $titleSeo;
                  else
                    $title = $cate['titleCate'];
                  break;
                }
              }
            }
            if ($has2 == 1)
              $title = $title.'-2';
            else
              $title = $lang['pageNotFound'];
          }
        } else {
          $tableProduct = $prefixTable.$def['tableProduct'];
          $has3 = 0;
          $checkProduct = $h->checkExist($tableProduct, "deleted_at is null and active = 1");
          if ($checkProduct) {
            $products = $h->getAllSelect("id, titleProduct, titleSeo", $tableProduct, "deleted_at is null and active = 1", "sortOrder desc, created_at desc, id desc");
            foreach ($products as $product) {
              $titleProduct = $product['titleProduct'];
              $linkCompare = chuoilink($titleProduct).'.html';
              if ($linkCompare == $mod[$ncoo]) {
                $has3 = 1;
                $titleSeo = $product['titleSeo'];
                if ($titleSeo != '' && !is_null($titleSeo))
                  $title = $titleSeo;
                else
                  $title = $product['titleProduct'];
                break;
              }
            }
          }
          if ($has3 == 1)
            $title = $title;
          else
            $title = $lang['pageNotFound'];
        }       
        break;
      case $def['actionNews']:
        if (!isset($mod[1]) && $mod[1] == '') {
          $titleNews = $h->getById($tableConfig, 3);
          $title = $titleNews['title'];
        } else {
          $tableNews = $prefixTable.$def['tableNews'];
          $has = 0;
          $checkNews = $h->checkExist($tableNews, "deleted_at is null and active = 1");
          if ($checkNews) {
            $newss = $h->getAllSelect("id, titleNews, titleSeo", $tableNews, "deleted_at is null and active = 1", "sortOrder desc, created_at desc, id desc");
            foreach ($newss as $news) {
              $titleNews = $news['titleNews'];
              $linkCompare = chuoilink($titleNews).'.html';
              if ($linkCompare == $mod[1]) {
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
      case $def['actionContact']:
        $contact = $h->getById($tableConfig, 7);
        if ($contact['title'] != '' && !is_null($contact['title']))
          $title = $contact['title'];
        else
          $title = $conf['title'];
        break;
      case $def['actionSearch']:
        $contact = $h->getById($tableConfig, 8);
        if ($contact['title'] != '' && !is_null($contact['title']))
          $title = $contact['title'];
        else
          $title = $conf['title'];
        break;   
      case $def['actionTag']:
        $tag = $h->getById($tableConfig, 9);
        if ($tag['title'] != '' && !is_null($tag['title']))
          $title = $tag['title'];
        else
          $title = $conf['title'];
        $tableTag = $prefixTable.$def['tableTags'];
        $allTags = $h->getAllSelect("id, titleTag", $tableTag, "deleted_at is null and active = 1");
        $checkHas = 0;
        foreach ($allTags as $tags) {
          $titleTag = $tags['titleTag'];
          $linkTag = chuoilink($titleTag).'.html';
          if ($linkTag == $mod[1]) {
            $idTag = $tags['id'];
            $titleTag = $titleTag;
            $checkHas = 1;
            break;
          }
        }
        if ($checkHas == 1) 
          $title .= ' - '.$titleTag;
        else
          $title = $lang['pageNotFound'];
        break;                              
    }
  }
  _e($title);
