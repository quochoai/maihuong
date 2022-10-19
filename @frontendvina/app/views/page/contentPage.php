<?php
  if ($mod[0] == $def['actionAbout'])
    $id = 1;
  $page = $h->getById($tableInfo, $id);
  $titleInfo = $page['titleInfo'];
  $contentInfo = $page['contentInfo'];
?>
<div class="header-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <span><?php _e($titleInfo) ?></span>
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
          <li><strong><?php _e($titleInfo) ?></strong></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="main-container col2-left-layout">
  <div class="container">
    <div class="row">
      <div class="rte">
        <?php require_once _viewsRequire."sidebar.php"; ?>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="page-title">
            <h1 style="margin-top: 0"><?php _e($titleInfo) ?></h1>
          </div>
          <article class="content"><?php _e($contentInfo) ?></article>
        </div>
      </div>
    </div>
  </div>
</div>
