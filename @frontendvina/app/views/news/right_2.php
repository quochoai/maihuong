<div class="module  tinnoibat ">
  <h3 class="modtitle">
    <span class="title">
      <span class="title-color"><?php _e($lang['home_newsest']) ?></span>
    </span>
  </h3>
  <div class="modcontent clearfix">
    <div id="k2ModuleBox159" class="k2ItemsBlock  tinnoibat">
      <ul>
      <?php
        $newsest = $h->getAllSelect("n.id, cateID, titleNews, imageNews, titleCate", "$tableNews as n, $tableCateNews as c", "n.deleted_at is null and n.active = 1 and n.cateID = c.id", "n.created_at desc, n.sortOrder desc, n.id desc", "limit 0, 5");
        $msgNewsest = "";
        foreach ($newsest as $news) {
          $titleNews = $news['titleNews'];
          $linkNews = $def['actionNews'].'/'.chuoilink($news['titleCate']).'/'.chuoilink($titleNews).'.html';
          $imageNews = $news['imageNews'];
          if (file_exists($def['imgUploadNewsRealPath'].$imageNews) && $imageNews != '')
            $imgNews = $def['imgUploadNews'].$imageNews;
          else
            $imgNews = _noImage;
          $msgNewsest .= '<li class="even">';
          $msgNewsest .= '  <div class="image"><a class="moduleItemImage" href="'.$linkNews.'" title="'.$titleNews.'"><img src="'.$imgNews.'" alt="'.$titleNews.'" /></a></div>';
          $msgNewsest .= '  <div class="item-content"><a class="moduleItemTitle" href="'.$linkNews.'">'.$titleNews.'</a></div>';
          $msgNewsest .= '  <div class="clr"></div>';
          $msgNewsest .= '</li>';
          $msgNewsest .= '<li class="clearList"></li>';
        }
        _e($msgNewsest);
      ?>
      </ul>
    </div>
  </div>
</div>
