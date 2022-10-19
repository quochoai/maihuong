<header>
  <div class="header-main">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"><a class="logo" title="<?php _e($conf['title']) ?>" href="<?php _e(_url) ?>"><img alt="<?php _e($conf['title']) ?>" src="<?php _e($imgLogo) ?>" /></a></div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mg-top-10">
          <div class="thongtin hidden-xs">
            <ul>
              <li>
                <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                <div class="text">
                  <p>Hotline</p>
                  <span><a href="tel:<?php _e($phoneFooter['content']) ?>"><?php _e($phoneFooter['content']) ?></a></span>
                </div>
              </li>
              <li>
                <div class="icon">
                  <i class="fa fa-envelope-o" aria-hidden="true"></i>
                </div>
                <div class="text">
                  <p>Email</p>
                  <span>
                    <a href="mailto:<?php _e($emailFooter['content']) ?>"><?php _e($emailFooter['content']) ?></a>
                  </span>
                </div>
              </li>
              <li>
                <div class="icon">
                  <i class="fa fa-certificate" aria-hidden="true"></i>
                </div>
                <div class="text">
                  <p><?php _e($lang['cerificate']) ?></p>
                  <span><?php _e($fanpage['content']) ?></span>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--.headerMain-->
</header>
<nav class="hidden-xs hidden-sm hidden-md">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-10">
        <ul id="nav" class="menu_list">
          <li class="menu_item"><a href="<?php _e(_url) ?>"><span><?php _e($lang['homeText']) ?></span></a></li>
          <li class="menu_item"><a href="<?php _e($def['actionAbout']) ?>"><span><?php _e($lang['aboutText']) ?></span></a></li>
          <li class="menu_item dropmenu">
            <a class="menu_link" href="<?php _e($def['actionProduct']) ?>"><span><?php _e($lang['productText']) ?></span></a>
            <?php
              $tableCate = $prefixTable.$def['tableCategories'];
              $checkCateProduct = $h->checkExist($tableCate, "deleted_at is null and active = 1 and cateID = 0");
              $menuProduct = '';
              if ($checkCateProduct) {
                $menuProduct .= '<span class="icon-sub"><i class="fa fa-angle-down" aria-hidden="true"></i></span><ul class="menu_sub">';
                $cates = $h->getAllSelect("id, titleCate", $tableCate, "deleted_at is null and active = 1 and cateID = 0", "sortOrder asc, id asc");
                foreach ($cates as $cate) {
                  $cateID = $cate['id'];
                  $titleCate = $cate['titleCate'];
                  $linkCate = $def['actionProduct'].'/'.chuoilink($titleCate).'/';
                  $menuProduct .= '<li class="menu_sub_item dropmenu2"><a class="menu_sub_link" href="'.$linkCate.'"><span>'.$titleCate.'</span></a>';
                  $checkSubCateProduct = $h->checkExist($tableCate, "deleted_at is null and active = 1 and cateID = $cateID");
                  if ($checkSubCateProduct) {
                    $menuProduct .= '<span class="icon-sub"><i class="fa fa-angle-right" aria-hidden="true"></i></span><ul class="menu_sub2">';
                    $cateSub = $h->getAllSelect("id, titleCate", $tableCate, "deleted_at is null and active = 1 and cateID = $cateID", "sortOrder asc, id asc");
                    foreach ($cateSub as $scate) {
                      $titleSubCate = $scate['titleCate'];
                      $linkSubCate = $linkCate.chuoilink($titleSubCate).'/';
                      $menuProduct .= '<li class="menu_item2"><a class="menu_sub2_link" href="'.$linkSubCate.'"><span>'.$titleSubCate.'</span></a></li>';
                    }

                    $menuProduct .= '</ul>';
                  }
                  $menuProduct .= '</li>';
                }
                $menuProduct .= '</ul>';
              }
              _e($menuProduct);
            ?>
          </li>
          <li class="menu_item"><a href="<?php _e($def['actionNews']) ?>"><span><?php _e($lang['newsText']) ?></span></a></li>
          <li class="menu_item"><a href="<?php _e($def['actionContact']) ?>"><span><?php _e($lang['contactText']) ?></span></a></li>
        </ul>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-2">
        <div class="search pull-right">
          <span class="icon-search cursorPointer">
            <i class="fa fa-search" aria-hidden="true"></i>
          </span>
          <form style="display:none" action="" method="post" id="search_mini_form" class="search_mini_form">
            <input type="text" placeholder="<?php _e($lang['keywordEnter']) ?>" value="" maxlength="70" class="" name="txtSearch" id="txtSearch">
          </form>
        </div>
      </div>
    </div>
  </div>
</nav>
<nav class="menu-mobile hidden-lg">
  <div class="container">
    <div class="search2 pull-right">
      <span class="icon-search2 cursorPointer">
        <i class="fa fa-search" aria-hidden="true"></i>
      </span>
      <form style="display:none" action="" method="post" id="search_mini_form2">
        <input type="text" placeholder="<?php _e($lang['keywordEnter']) ?>" value="" maxlength="70" class="" name="txtSearch" id="txtSearch">
      </form>
    </div>
    <span class="bars">
      <i class="fa fa-bars" aria-hidden="true"></i>
    </span>
    <ul id="nav-mobile" class="menu-mb-list" style="display: none">
      <li class="menu-item-mb"><a href="<?php _e(_url) ?>"><span><?php _e($lang['homeText']) ?></span></a></li>
      <li class="menu-item-mb"><a href="<?php _e($def['actionAbout']) ?>"><span><?php _e($lang['aboutText']) ?></span></a></li>
      <li class="menu-item-mb">
        <a class="menu-link-mb" href="<?php _e($def['actionProduct']) ?>"><span><?php _e($lang['productText']) ?></span></a>
        <?php
          $menuProduct2 = '';
          if ($checkCateProduct) {
            $menuProduct2 .= '<span class="open-close"><i class="fa fa-angle-down" aria-hidden="true"></i></span><ul class="menu-sub-mb" style="display: none">';
            $cates2 = $h->getAllSelect("id, titleCate", $tableCate, "deleted_at is null and active = 1 and cateID = 0", "sortOrder asc, id asc");
            foreach ($cates2 as $cate2) {
              $cateID = $cate2['id'];
              $titleCate = $cate2['titleCate'];
              $linkCate = $def['actionProduct'].'/'.chuoilink($titleCate).'/';
              $menuProduct2 .= '<li class="menu-item-sub-mb"><a class="menu-link-sub-mb" href="'.$linkCate.'"><span>'.$titleCate.'</span></a>';
              $checkSubCateProduct = $h->checkExist($tableCate, "deleted_at is null and active = 1 and cateID = $cateID");
              if ($checkSubCateProduct) {
                $menuProduct2 .= '<span class="open-close"><i class="fa fa-angle-down" aria-hidden="true"></i>
              </span><ul class="menu-sub-mb-2" style="display: none">';
                $cateSub = $h->getAllSelect("id, titleCate", $tableCate, "deleted_at is null and active = 1 and cateID = $cateID", "sortOrder asc, id asc");
                foreach ($cateSub as $scate) {
                  $titleSubCate = $scate['titleCate'];
                  $linkSubCate = $linkCate.chuoilink($titleSubCate).'/';
                  $menuProduct2 .= '<li class="menu-item-sub-mb-2"><a class="menu-link-sub-mb-2" href="'.$linkSubCate.'"><span>'.$titleSubCate.'</span></a></li>';
                }

                $menuProduct2 .= '</ul>';
              }
              $menuProduct2 .= '</li>';
            }
            $menuProduct2 .= '</ul>';
          }
          _e($menuProduct2);
        ?>
      </li>
      <li class="menu-item-mb"><a href="<?php _e($def['actionNews']) ?>"><span><?php _e($lang['newsText']) ?></span></a></li>
      <li class="menu-item-mb"><a href="<?php _e($def['actionContact']) ?>"><span><?php _e($lang['contactText']) ?></span></a></li>
    </ul>
  </div>
</nav>
