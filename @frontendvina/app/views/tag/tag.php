<?php
  $tableCate = $prefixTable.$def['tableCategories'];
  $tableProduct = $prefixTable.$def['tableProduct'];
  $tableTag = $prefixTable.$def['tableTags'];

  $where = "p.deleted_at is null and p.active = 1";
  $titleGroup = $lang['tag'];
  $allTags = $h->getAllSelect("id, titleTag", $tableTag, "deleted_at is null and active = 1");
  $checkHas = 0;
  foreach ($allTags as $tag) {
    $titleTag = $tag['titleTag'];
    $linkTag = chuoilink($titleTag).'.html';
    if ($linkTag == $mod[1]) {
      $idTag = $tag['id'];
      $titleTag = $titleTag;
      $checkHas = 1;
      break;
    }
  }
if ($checkHas) {
    $whereProduct = $where." and tags like '%$idTag%'";
    $titleGroup .= ': '.$titleTag;

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
            var linkData = "<?php _e(_views.'tag/') ?>";
            var whereProduct = "<?php _e($whereProduct) ?>";
          </script>
          <script type="text/javascript" src="<?php _e(_views.'tag/') ?>data.js"></script>
          <?php } else {
              _e('<div class="product-grid clearfix text-center">'.$lang['temporaryNotData'].'</div>');
          } ?>
        </div>
      </div>
      <?php require_once _viewsRequire."sidebar.php" ?>
    </div>
  </div>
</section>
<?php } else { ?>
  <div class="header-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <span><?php _e($$lang['pageNotFound']) ?></span>
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
            <a href="<?php _e(_url) ?>" title="<?php _e($lang['homeText']) ?>"><span><?php _e($lang['homeText']) ?></span></a>
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
          </li>
          <li><strong><span><?php _e($$lang['pageNotFound']) ?></span></strong><li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div itemscope itemtype="http://schema.org/Product">
  <meta itemprop="url" content="<?php _e("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>">
  <meta itemprop="shop-currency" content="VND">
  <section class="product" id="product">
    <div class="container">
      <div class="col-main">
        <div class="row text-center"><?php _e($$lang['pageNotFound']) ?></div>
      </div>
    </div>
  </section>
</div>
<?php } ?>