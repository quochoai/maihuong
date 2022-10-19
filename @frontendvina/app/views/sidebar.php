<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 hidden-xs hidden-sm">
  <div class="sidebar-collection">
    <div class="catalog">
      <div class="blog-title"><h2><?php _e($lang['category']) ?></h2></div>
      <div class="calalog-inner">
        <ul class="catalog-list">
          <li class="catalog-item">
            <a class="catalog-link" href="<?php _e(_url) ?>"><span><?php _e($lang['homeText']) ?></span></a>
          </li>
          <li class="catalog-item">
            <a class="catalog-link" href="<?php _e($def['actionAbout']) ?>"><span><?php _e($lang['aboutText']) ?></span></a>
          </li>
          <li class="catalog-item">
            <a class="catalog-link" href="<?php _e($def['actionProduct']) ?>"><span>Sản phẩm</span></a>
            <?php
              $tableCate = $prefixTable.$def['tableCategories'];
              $checkCateProduct3 = $h->checkExist($tableCate, "deleted_at is null and active = 1 and cateID = 0");
              $menuProduct3 = '';
              if ($checkCateProduct3) {
                $menuProduct3 .= '<span class="icon-sub-collection"><i class="fa fa-angle-down" aria-hidden="true"></i></span><ul class="sub1-list" style="display: none">';
                $cates = $h->getAllSelect("id, titleCate", $tableCate, "deleted_at is null and active = 1 and cateID = 0", "sortOrder asc, id asc");
                foreach ($cates as $cate) {
                  $cateID = $cate['id'];
                  $titleCate = $cate['titleCate'];
                  $linkCate = $def['actionProduct'].'/'.chuoilink($titleCate).'/';
                  $menuProduct3 .= '<li class="sub1-item"><a class="sub1-link" href="'.$linkCate.'" title="'.$titleCate.'"><span>'.$titleCate.'</span></a>';
                  $checkSubCateProduct = $h->checkExist($tableCate, "deleted_at is null and active = 1 and cateID = $cateID");
                  if ($checkSubCateProduct) {
                    $menuProduct3 .= '<span class="icon-sub-collection"><i class="fa fa-angle-down" aria-hidden="true"></i></span><ul style="display: none;" class="lv3">';
                    $cateSub = $h->getAllSelect("id, titleCate", $tableCate, "deleted_at is null and active = 1 and cateID = $cateID", "sortOrder asc, id asc");
                    foreach ($cateSub as $scate) {
                      $titleSubCate = $scate['titleCate'];
                      $linkSubCate = $linkCate.'/'.chuoilink($titleSubCate).'/';
                      $menuProduct3 .= '<li><a class="" href="'.$linkSubCate.'" title="'.$titleSubCate.'"><span>'.$titleSubCate.'</span></a></li>';
                    }

                    $menuProduct3 .= '</ul>';
                  }
                  $menuProduct3 .= '</li>';
                }
                $menuProduct3 .= '</ul>';
              }
              _e($menuProduct3);
            ?>
          </li>
          <li class="catalog-item">
            <a class="catalog-link" href="<?php _e($def['actionNews']) ?>"><span><?php _e($lang['newsText']) ?></span></a>
          </li>
          <li class="catalog-item">
            <a class="catalog-link" href="<?php _e($def['actionContact']) ?>">
              <span><?php _e($lang['contactText']) ?></span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <?php
      $tableTag = $prefixTable.$def['tableTags'];
      $checkTag = $h->checkExist($tableTag, "deleted_at is null and active = 1");
      if ($checkTag) {
    ?>
    <div class="blog-tag">
      <div class="blog-title"><h2>Tags</h2></div>
      <div class="blog-tag-content">
      <?php
        $allTags = $h->getAllSelect("titleTag", $tableTag, "deleted_at is null and active = 1", "created_at asc");
        $msgTag = '';
        foreach ($allTags as $tag) {
          $titleTag = $tag['titleTag'];
          $linkTag = $def['actionTag'].'/'.chuoilink($titleTag).'.html';
          $msgTag .= '<a href="'.$linkTag.'" title="'.$titleTag.'">'.$titleTag.'</a>';
        }
        _e($msgTag);
      ?>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
