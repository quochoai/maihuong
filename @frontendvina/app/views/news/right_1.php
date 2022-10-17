<div class="module  list-cate ">
  <h3 class="modtitle">
    <span class="title">
      <span class="title-color"><?php _e($lang['category']) ?></span>
    </span>
  </h3>
  <div class="modcontent clearfix">
    <div id="sj_k2_categories_4785745141514449003" class="sj_k2_categories preset01-1 preset02-1 preset03-1 preset04-1 preset05-1">
      <div class="cat-wrap theme1">
        <div class="content-box">
          <div class="child-cat">
            <?php
            $msgCateRight = "";
            if (count($cateNews) > 0) {
              foreach ($cateNews as $cateN) {
                $linkCate = chuoilink($cateN['titleCate']);
                if (isset($mod[1]) && $mod[1] != '' && $mod[1] == $linkCate)
                  $active = ' class="active"';
                else
                  $active = '';
                $linkCateGet = $def['actionNews'].'/'.$linkCate;
                $titleCateNews = $cateN['titleCate'];
                $msgCateRight .= '<div class="child-cat-title"><a href="'.$linkCateGet.'"'.$active.'>'.$titleCateNews.'</a></div>';
              }
              _e($msgCateRight);
            }
          ?> 
          </div>
        </div>
        <!-- END sub_content -->
        <div class="clr1"></div>
      </div>
    </div>
  </div>
</div>