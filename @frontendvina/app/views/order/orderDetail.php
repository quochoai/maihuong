<?php
  $tableCateOrder = $prefixTable.$def['tableCategoriesOrders'];
  $tableOrder = $prefixTable.$def['tableOrders'];

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

  $checkOrder = $h->checkExist($tableOrder, "deleted_at is null and active = 1 and cateID = $cateID");
  $checkHas = 0;
  if ($checkOrder) {
    $orders = $h->getAllSelect("id, titleOrder, postDate, created_at, tags, numberViews, contentOrder", "$tableOrder as o", $whereOrder, "created_at desc, sortOrder desc, id desc");
    foreach ($orders as $order) {
      $titleOrder = $order['titleOrder'];
      $linkCompare = chuoilink($titleOrder).'.html';
      if ($linkCompare == $mod[2]) {
        $checkHas = 1;
        $id = $order['id'];
        $titleOrder = $order['titleOrder'];
        $pd = $order['postDate'];
        $createAt = $order['created_at'];
        $tags = $order['tags'];
        $numberView = $order['numberViews'];
        $contentOrder = $order['contentOrder'];
        $whereOrder .= " and o.id != $id";
        break;
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
      require_once "contentOrderDetail.php";
    ?>
    </div>
  </div>
</section>