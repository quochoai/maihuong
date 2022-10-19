<?php
  $tableProduct = $prefixTable.$def['tableProduct'];
  $tk = $mod[1];
  $keyword = str_replace("+"," ", $tk);
  $whereProduct = "p.deleted_at is null and p.active = 1 and titleProduct like '%$keyword%'";
  $titleGroup = $lang['searchResultWithKeyword'].$tk;
?>
<div class="header-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <span><?php _e($titleGroup) ?></span>
      </div>
    </div>
  </div>
</div>
<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul typeof="BreadcrumbList" vocab="http://schema.org/">
          <li class="home">
            <a href="<?php _e(_url) ?>" title="<?php _e($lang['homeText']) ?>">
              <span><?php _e($lang['homeText']) ?></span>
            </a>
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
          </li>
          <li><strong><span><?php _e($titleGroup) ?></span></strong></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<section class="collection" id="collection">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="category-products clearfix">
          <div class="category-title" id="titleCategory">
            <div class="col-lg-12">
              <h1 class="hidden-xs"><?php _e($titleGroup) ?></h1>
            </div>
          </div>
          <?php
                $checkProduct = $h->checkExist("$tableProduct as p", $whereProduct);
    if ($checkProduct) {
        ?>
          <div id="contentProduct"></div>
          <script type="text/javascript">
            var linkData = "<?php _e(_views.'search/') ?>";
            var whereProduct = "<?php _e($whereProduct) ?>";
          </script>
          <script type="text/javascript" src="<?php _e(_views.'search/') ?>data.js"></script>
          <?php } else {
              _e('<div class="product-grid clearfix text-center">'.$lang['temporaryNotData'].'</div>');
          } ?>
        </div>
      </div>
      <?php require_once _viewsRequire."sidebar.php" ?>
    </div>
  </div>
</section>
