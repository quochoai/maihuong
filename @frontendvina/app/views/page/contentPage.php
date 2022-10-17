<?php
  if ($mod[0] == $def['actionAbout'])
    $id = 1;
  elseif ($mod[0] == $def['actionPolicy'])
    $id = 2;
  elseif ($mod[0] == $def['actionResolveComplain'])
    $id = 3;
  elseif ($mod[0] == $def['actionSecure'])
    $id = 4;
  $tableInfo = $prefixTable.$def['tableInformations'];
  $page = $h->getById($tableInfo, $id);
  $titleInfo = $page['titleInfo'];
  $contentInfo = $page['contentInfo'];

  $tableCateNews = $prefixTable.$def['tableCategoriesNews'];
  $tableNews = $prefixTable.$def['tableNews'];
  $checkCateNews = $h->checkExist($tableCateNews, "deleted_at is null and active = 1");
  if ($checkCateNews)
    $cateNews = $h->getAllSelect("id, titleCate", $tableCateNews, "deleted_at is null and active = 1", "id asc");
  

?>
<div id="content_main" class="col-lg-9 col-md-8  col-xs-12">
  <div id="system-message-container"></div>
  <div id="yt_component">
    <div id="k2Container" class="itemView ">      
      <div class="content-box">
      <?php
        $msgPage = "";
          $msgPage .= '<div class="itemHeader">';
          $msgPage .= '  <h1 class="itemTitle">'.$titleInfo.'</h1>';
          $msgPage .= '  <div class="clearfix"></div>';
          $msgPage .= '<article class="main-item">'.$contentInfo.'</article>';          
          $msgPage .= '</div>';
          _e($msgPage);
        ?>
        </div>
      </div>
  </div>
</div>
