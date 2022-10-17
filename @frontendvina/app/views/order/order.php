<?php
  $tableCateOrder = $prefixTable.$def['tableCategoriesOrders'];
  $tableOrder = $prefixTable.$def['tableOrders'];
  if (!isset($mod[1]) || $mod[1] == '') {
    $titleGroup = $lang['orderTaxi'];
    $whereOrder = "o.deleted_at is null and o.active = 1";
    $checkCateOrder = $h->checkExist($tableCateOrder, "deleted_at is null and active = 1");
    if ($checkCateOrder)
      $cateOrders = $h->getAllSelect("id, titleCate", $tableCateOrder, "deleted_at is null and active = 1");
  } else {
    $checkCateOrder = $h->checkExist($tableCateOrder, "deleted_at is null and active = 1");
    $cateOrders = [];
    if ($checkCateOrder) {
      $cateOrders = $h->getAllSelect("id, titleCate", $tableCateOrder, "deleted_at is null and active = 1");
      foreach ($cateOrders as $cate) {
        $linkCate = chuoilink($cate['titleCate']);
        if ($linkCate == $mod[1]) {
          $titleGroup = $cate['titleCate'];
          $cateID = $cate['id'];
          $whereOrder = "o.deleted_at is null and o.active = 1 and cateID = $cateID";
          break;
        }
      }
    }
  }
?>
<section  class="no-left no-right  block com_k2" style="margin-top: 20px;padding: 20px 20px;">
  <div class="container">
    <div class="row">
      <div class="title-dd text-uppercase"><h2 style="padding-bottom: 10px;" ><?php _e($titleGroup) ?></h2></div>
    </div>
    <div class="row" id="content">
    <?php
      require_once "left.php";
      require_once "contentOrder.php";
    ?>
    </div>
  </div>
</section>