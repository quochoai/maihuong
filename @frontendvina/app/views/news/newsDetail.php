<?php
  $tableCateNews = $prefixTable.$def['tableCategoriesNews'];
  $tableNews = $prefixTable.$def['tableNews'];

  $checkCateNews = $h->checkExist($tableCateNews, "deleted_at is null and active = 1");
  $cateNews = [];
  if ($checkCateNews) {
    $cateNews = $h->getAllSelect("id, titleCate", $tableCateNews, "deleted_at is null and active = 1");
    foreach ($cateNews as $cate) {
      $linkCate = chuoilink($cate['titleCate']);
      if ($linkCate == $mod[1]) {
        $titleGroup = $cate['titleCate'];
        $cateID = $cate['id'];
        $whereNews = "n.deleted_at is null and n.active = 1 and cateID = $cateID";
        break;
      }
    }
  }

  $checkNews = $h->checkExist($tableNews, "deleted_at is null and active = 1 and cateID = $cateID");
  $checkHas = 0;
  if ($checkNews) {
    $newss = $h->getAllSelect("id, titleNews, postDate, created_at, tags, numberViews, contentNews", "$tableNews as n", $whereNews, "created_at desc, sortOrder desc, id desc");
    foreach ($newss as $news) {
      $titleNews = $news['titleNews'];
      $linkCompare = chuoilink($titleNews).'.html';
      if ($linkCompare == $mod[2]) {
        $checkHas = 1;
        $id = $news['id'];
        $titleNews = $news['titleNews'];
        $pd = $news['postDate'];
        $createAt = $news['created_at'];
        $tags = $news['tags'];
        $numberView = $news['numberViews'];
        $contentNews = $news['contentNews'];
        $whereNews .= " and n.id != $id";
        break;
      }
    }
  }
?>
<section id="content" class="no-left  block com_k2" style="margin-top: 30px;">
  <div class="container">
    <div class="row">
    <?php
      require_once "contentNewsDetail.php";
      require_once "right.php";
    ?>
    </div>
  </div>
</section>
