<div id="content_main" class="col-lg-9 col-md-8  col-xs-12">
  <div id="system-message-container"></div>
  <div id="yt_component">
    <div id="k2Container" class="itemView ">      
      <div class="content-box">
      <?php
        $msgNewsDetail = "";
        if ($checkHas == 1) {
          $sessionView = "sessionViewNews".$id;
          if (!isset($_SESSION[$sessionView])) {
            $_SESSION[$sessionView] = $id;
            $data['numberViews'] = $numberView + 1;
            $resUpdate = $h->update($data, $tableNews, " where id = $id");
          }                 
          if (!is_null($pd) && $pd != '')
            $postDate = date("d/m/Y", strtotime($pd));
          else
            $postDate = date("d/m/Y", strtotime($createdAt));
          $num = $h->getById($tableNews, $id);
          $msgNewsDetail .= '<div class="itemHeader">';
          $msgNewsDetail .= '  <h1 class="itemTitle">'.$titleNews.'</h1>';
          $msgNewsDetail .= '  <div class="itemTagsBlock">';
          $msgNewsDetail .= '    <i class="fa fa-calendar" aria-hidden="true"></i> '.$postDate.'&nbsp;&nbsp;&nbsp;&nbsp;';
          $msgNewsDetail .= '    <i class="fa fa-eye" aria-hidden="true"></i> '.$num['numberViews'];
          $msgNewsDetail .= '  </div>';
          $msgNewsDetail .= '  <div class="clearfix"></div>';
          $msgNewsDetail .= '</div>';
          $msgNewsDetail .= '  <article class="main-item">'.$contentNews.'</article>';
          if ($tags != '' && !is_null($tags)) {
            $msgNewsDetail .= '  <div class="itemTagsBlock">';
            $msgNewsDetail .= '    <span>Tags: </span>';
            $msgNewsDetail .= '    <ul class="itemTags">';
            $tagArray = explode(",", $tags);
            $tableTag = $prefixTable.$def['tableTags'];
            foreach  ($tagArray as $tag) {
              $tagNews = $h->getById($tableTag, $tag);
              $titleTag = $tagNews['titleTag'];
              $linkTag = $def['actionTag'].'/'.$def['actionNews'].'/'.chuoilink($titleTag).'.html';
              $msgNewsDetail .= '<li><a href="'.$linkTag.'">'.$titleTag.'</a></li>';
            }
            $msgNewsDetail .= '    </ul>';
            $msgNewsDetail .= '    <div class="clr"></div>';
            $msgNewsDetail .= '  </div>';
          }
          $checkOtherNews = $h->checkExist("$tableNews as n", $whereNews, "n.id");
          if ($checkOtherNews) {
            $msgNewsDetail .= '<div id="dataOtherNews"></div>';
        ?>
            <script type="text/javascript">
              var linkData = "<?php _e(_views.'news/detail/') ?>";
              var whereNews = "<?php _e($whereNews) ?>";
            </script>
            <script type="text/javascript" src="<?php _e(_viewNews.'dataOtherDetail.js') ?>"></script>
        <?php
          }
          $msgNewsDetail .= '</div>';
          _e($msgNewsDetail);
        } else { 
        ?>
          <div class="itemHeader">
            <article class="main-item text-center"><?php _e($lang['pageNotFound']) ?></article>
          </div>
        <?php } ?>                
        </div>
      </div>
  </div>
