<?php
  $checkNews = $h->checkExist($tableNews, $whereNews);
  if ($checkNews) {
?>
<div id="contentNews"></div>
<script type="text/javascript">
  var linkData = "<?php _e(_views.'news/') ?>";
  var whereNews = "<?php _e($whereNews) ?>";
</script>
<script type="text/javascript" src="<?php _e(_views.'news/') ?>data.js"></script>
<?php } else _e('<div class="itemList"><div id="itemListPrimary" class="text-center">'.$lang['temporaryNotData'].'</div></div>') ?>
