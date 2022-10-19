<?php
  if (!isset($_REQUEST['pqh']))
    $desc = $conf['descriptionSeo'];
  else {
    switch ($mod[0]) {
      case $def['actionProduct']:
        $nco = count($mod);
        $ncoo = $nco - 1;
        $htm = substr($mod[$ncoo],-5);
        $tableCate = $prefixTable.$def['tableCategories'];
        $descProduct = $h->getById($tableConfig, 2);
        if ($htm != '.html') {
          if ($mod[1] == '')
            $desc = $descProduct['descriptionSeo'];
          elseif ($mod[1] != '' && $mod[2] == '') {
            $has = 0;
            $checkCateProduct = $h->checkExist($tableCate, "deleted_at is null and active = 1");
            if ($checkCateProduct) {
              $cateProduct = $h->getAllSelect("id, titleCate, descriptionSeo", $tableCate, "deleted_at is null and active = 1");
              foreach ($cateProduct as $cate) {
                $linkCate = chuoilink($cate['titleCate']);
                if ($linkCate == $mod[1]) {
                  $has = 1;
                  $descSeo = $cate['descriptionSeo'];
                  if ($descSeo != '' && !is_null($descSeo))
                    $desc = $descSeo;
                  else
                    $desc = $descProduct['descriptionSeo'];
                  break;
                }
              }
            }
            if ($has == 1)
              $desc = $desc;
            else
              $desc = $lang['pageNotFound'];
          } elseif ($mod[2] != '') {
            $checkCateProduct = $h->checkExist($tableCate, "deleted_at is null and active = 1");
            $has2 = 0;
            if ($checkCateProduct) {
              $cateProduct = $h->getAllSelect("id, titleCate, descriptionSeo", $tableCate, "deleted_at is null and active = 1");
              foreach ($cateProduct as $cate) {
                $linkCate = chuoilink($cate['titleCate']);
                if ($linkCate == $mod[2]) {
                  $has2 = 1;
                  $descSeo = $cate['descriptionSeo'];
                  if ($descSeo != '' && !is_null($descSeo))
                    $desc = $descSeo;
                  else
                  $desc = $descProduct['descriptionSeo'];
                  break;
                }
              }
            }
            if ($has2 == 1)
              $desc = $desc;
            else
              $desc = $lang['pageNotFound'];
          }
        } else {
          $tableProduct = $prefixTable.$def['tableProduct'];
          $has3 = 0;
          $checkProduct = $h->checkExist($tableProduct, "deleted_at is null and active = 1");
          if ($checkProduct) {
            $products = $h->getAllSelect("id, titleProduct, descriptionSeo", $tableProduct, "deleted_at is null and active = 1", "sortOrder desc, created_at desc, id desc");
            foreach ($products as $product) {
              $titleProduct = $product['titleProduct'];
              $linkCompare = chuoilink($titleProduct).'.html';
              if ($linkCompare == $mod[$ncoo]) {
                $has3 = 1;
                $descSeo = $product['descriptionSeo'];
                if ($descSeo != '' && !is_null($descSeo))
                  $desc = $descSeo;
                else
                  $desc = $descProduct['descriptionSeo'];
                break;
              }
            }
          }
          if ($has3 == 1)
            $desc = $desc;
          else
            $desc = $lang['pageNotFound'];
        }       
        break;
      case $def['actionNews']:
        $descNews = $h->getById($tableConfig, 3);
        if (!isset($mod[1]) && $mod[1] == '')
          $desc = $descNews['descriptionSeo'];
        else {
          $tableNews = $prefixTable.$def['tableNews'];
          $has = 0;
          $checkNews = $h->checkExist($tableNews, "deleted_at is null and active = 1");
          if ($checkNews) {
            $newss = $h->getAllSelect("id, titleNews, descriptionSeo", $tableNews, "deleted_at is null and active = 1", "sortOrder desc, created_at desc, id desc");
            foreach ($newss as $news) {
              $titleNews = $news['titleNews'];
              $linkCompare = chuoilink($titleNews).'.html';
              if ($linkCompare == $mod[1]) {
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
            $desc = $lang['pageNotFound'];
        }
        break;
      case $def['actionAbout']:
        $info = $h->getById($tableInfo, 1);
        if ($info['descriptionSeo'] != '' && !is_null($info['descriptionSeo']))
          $desc = $info['descriptionSeo'];
        else
          $desc = $conf['descriptionSeo'];
        break;
      case $def['actionContact']:
        $contact = $h->getById($tableConfig, 7);
        if ($contact['descriptionSeo'] != '' && !is_null($contact['descriptionSeo']))
          $desc = $contact['descriptionSeo'];
        else
          $desc = $conf['descriptionSeo'];
        break;
      case $def['actionSearch']:
        $descSearch = $h->getById($tableConfig, 8);
        if ($descSearch['descriptionSeo'] != '' && !is_null($descSearch['descriptionSeo']))
          $desc = $descSearch['descriptionSeo'];
        else
          $desc = $conf['descriptionSeo'];
        break; 
      case $def['actionTag']:
        $tag = $h->getById($tableConfig, 9);
        if ($tag['descriptionSeo'] != '' && !is_null($tag['descriptionSeo']))
          $desc = $tag['descriptionSeo'];
        else
          $desc = $conf['descriptionSeo'];
        break;                         
    }
  }
  _e($desc);
