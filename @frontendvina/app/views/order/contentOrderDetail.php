<div class="orderTaxi col-md-9">
  <div class="list-item-dd">
    <p class="dm-tx-dd"><?php _e($titleGroup) ?></p>
    <div class="row">
      <div id="k2Container" class="itemView col-md-12" style="padding: 2em !important">
        <div class="content-box">
          <div class="main-item">
          <?php
            $msgOrderDetail = "";
            if ($checkHas == 1) {
              $sessionView = "sessionViewOrder".$id;
              if (!isset($_SESSION[$sessionView])) {
                $_SESSION[$sessionView] = $id;
                $data['numberViews'] = $numberView + 1;
                $resUpdate = $h->update($data, $tableOrder, " where id = $id");
              }                 
              if (!is_null($pd) && $pd != '')
                $postDate = date("d/m/Y", strtotime($pd));
              else
                $postDate = date("d/m/Y", strtotime($createdAt));
              $num = $h->getById($tableOrder, $id);
              $msgOrderDetail .= '<div class="itemHead">';
              $msgOrderDetail .= '  <h1 class="itemTitle">'.$titleOrder.'</h1>';
              $msgOrderDetail .= '  <div class="itemTagsBlock">';
              $msgOrderDetail .= '    <i class="fa fa-calendar" aria-hidden="true"></i> '.$postDate.'&nbsp;&nbsp;&nbsp;&nbsp;';
              $msgOrderDetail .= '    <i class="fa fa-eye" aria-hidden="true"></i> '.$num['numberViews'];
              $msgOrderDetail .= '  </div>';
              
              $msgOrderDetail .= '  <article class="itemBody">'.$contentOrder.'</article>';
              if ($tags != '' && !is_null($tags)) {
                $msgOrderDetail .= '  <div class="itemTagsBlock">';
                $msgOrderDetail .= '    <span>Tags: </span>';
                $msgOrderDetail .= '    <ul class="itemTags">';
                $tagArray = explode(",", $tags);
                $tableTag = $prefixTable.$def['tableTags'];
                foreach  ($tagArray as $tag) {
                  $tagOrder = $h->getById($tableTag, $tag);
                  $titleTag = $tagOrder['titleTag'];
                  $linkTag = 'tag/'.$def['actionOrder'].'/'.chuoilink($titleTag).'.html';
                  $msgOrderDetail .= '<li><a href="'.$linkTag.'">'.$titleTag.'</a></li>';

                }
                $msgOrderDetail .= '    </ul>';
                $msgOrderDetail .= '    <div class="clr"></div>';
                $msgOrderDetail .= '  </div>';
              }
              $checkOtherOrder = $h->checkExist("$tableOrder as o", $whereOrder);
              if ($checkOtherOrder) {
                $msgOrderDetail .= '<div id="dataOtherOrder"></div>';
            ?>
                <script type="text/javascript">
                  var linkData = "<?php _e(_views.'order/detail/') ?>";
                  var whereOrder = "<?php _e($whereOrder) ?>";
                </script>
                <script type="text/javascript" src="<?php _e(_viewOrders.'dataOtherDetail.js') ?>"></script>
            <?php
              }
              $msgOrderDetail .= '</div></div>';
              _e($msgOrderDetail);
            } else { 
            ?>
              <div class="itemHead">
                <article class="itemBody text-center"><?php _e($lang['pageNotFound']) ?></article>
              </div>
            <?php } ?>
          </div>
          <div class="clr"></div>
        </div>
        <div class="clr"></div>
      </div>
    </div>
  </div>
</div>