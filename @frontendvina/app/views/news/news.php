<?php
  $tableNews = $prefixTable.$def['tableNews'];
  $whereNews = "deleted_at is null and active = 1";
  $titleNews = $h->getById($tableConfig, 3);
  $titleGroup = $titleNews['title'];
  
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
<section class="blog">
  <div class="container">
    <div class="row">
      <div class="col-lg-9">
        <div class="row">
          <div class="col-lg-12 page-title">
            <h1 class="title-head"><?php _e($titleGroup) ?></h1>
          </div>
        </div>
        <div class="row">
          <div class="clearfix">
          <?php require_once _viewRequireNews.'contentNews.php' ?>            
          </div>
        </div>
      </div>
      <?php require_once _viewsRequire.'sidebar.php' ?>
    </div>
  </div>
</section>