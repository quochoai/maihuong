<div class="module  k2-tags ">
  <h3 class="modtitle">
    <span class="title">
      <span class="title-color">Tags</span>
    </span>
  </h3>
  <div class="modcontent clearfix">
    <div id="k2ModuleBox164" class="k2TagCloudBlock">
      <strong class="title-tag">Popular Tags:</strong>
      <?php
        $tableTag = $prefixTable.$def['tableTags'];
        $tagRight = $h->getAllSelect("titleTag", $tableTag, "deleted_at is null and active = 1", "created_at desc, id desc", "limit 0, 7");
        $msgTag = "";
        foreach ($tagRight as $tag) {
          $titleTag = $tag['titleTag'];
          $linkTagRight = $def['actionTag'].'/'.$def['actionNews'].'/'.chuoilink($titleTag).'.html';
          $msgTag .= '<span class="items-tag"><a class="item-tag" href="'.$linkTagRight.'" title="'.$titleTag.'"><span class="name-tag"> '.$titleTag.'</span></a></span>';
        }
        _e($msgTag);
      ?>
    </div>
  </div>
</div>
