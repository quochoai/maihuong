<?php
  $checkOtherNews = $h->checkExist($tableNews, $whereNews);
  $msgNewsDetail = '';
  if ($checkOtherNews) {
    $msgNewsDetail .= '<div id="dataOtherNews"></div>';
?>
<script type="text/javascript">
  var linkData = "<?php _e(_views.'news/detail/') ?>";
  var whereNews = "<?php _e($whereNews) ?>";
</script>
<script type="text/javascript" src="<?php _e(_viewNews.'dataOtherDetail.js') ?>"></script>
<?php
  }
  _e($msgNewsDetail);
