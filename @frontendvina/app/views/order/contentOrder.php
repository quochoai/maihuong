<div class="orderTaxi col-md-9">
  <div class="list-item-dd">
    <p class="dm-tx-dd"><?php _e($titleGroup) ?></p>
    <?php
      $checkOrder = $h->checkExist("$tableOrder as o", $whereOrder);
      if ($checkOrder) {
    ?>
    <div id="contentOrder"></div>
    <script type="text/javascript">
      var linkData = "<?php _e(_views.'order/') ?>";
      var whereOrder = "<?php _e($whereOrder) ?>";
    </script>
    <script type="text/javascript" src="<?php _e(_viewOrders) ?>data.js"></script>
    <?php } else _e('<div class="col-md-4 col-xs-12"><div class="box"><div class="content text-center">'.$lang['temporaryNotData'].'</div></div></div>') ?>
  </div>
</div>