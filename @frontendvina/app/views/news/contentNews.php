<div id="content_main" class="col-lg-9 col-md-8  col-xs-12">
  <div id="system-message-container"></div>
  <div id="yt_component">
    <div id="k2Container" class="itemListView ">
      <div class="itemListCategoriesBlock"></div>
      <?php
        $checkNews = $h->checkExist("$tableNews as n", $whereNews);
        if ($checkNews) {
      ?>
      <div id="contentNews"></div>
      <script type="text/javascript">
        var linkData = "<?php _e(_views.'news/') ?>";
        var whereNews = "<?php _e($whereNews) ?>";
      </script>
      <script type="text/javascript" src="<?php _e(_views.'news/') ?>data.js"></script>
      <?php } else _e('<div class="itemList"><div id="itemListPrimary" class="text-center">'.$lang['temporaryNotData'].'</div></div>') ?>
    </div>
  </div>
</div>
