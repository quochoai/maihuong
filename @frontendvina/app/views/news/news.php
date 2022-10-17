<?php
  $tableCateNews = $prefixTable.$def['tableCategoriesNews'];
  $tableNews = $prefixTable.$def['tableNews'];
  if (!isset($mod[1]) || $mod[1] == '') {
    $whereNews = "n.deleted_at is null and n.active = 1";
    $checkCateNews = $h->checkExist($tableCateNews, "deleted_at is null and active = 1");
    if ($checkCateNews)
      $cateNews = $h->getAllSelect("id, titleCate", $tableCateNews, "deleted_at is null and active = 1", "id asc");
  } else {
    $checkCateNews = $h->checkExist($tableCateNews, "deleted_at is null and active = 1");
    if ($checkCateNews) {
      $cateNews = $h->getAllSelect("id, titleCate", $tableCateNews, "deleted_at is null and active = 1", "id asc");
      foreach ($cateNews as $cate) {
        $linkCate = chuoilink($cate['titleCate']);
        if ($linkCate == $mod[1]) {
          $cateID = $cate['id'];
          $whereNews = "n.deleted_at is null and n.active = 1 and cateID = $cateID";
          break;
        }
      }
    }
  }
?>
<section id="content" class="no-left  block com_k2" style="margin-top: 30px;">
  <div class="container">
    <div class="row">
    <?php
      require_once "contentNews.php";
      require_once "right.php";
    ?>
    </div>
  </div>
</section>