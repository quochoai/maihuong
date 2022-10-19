<?php
  $tableNews = $prefixTable.$def['tableNews'];
  $whereNews = "deleted_at is null and active = 1";
  $checkNews = $h->checkExist($tableNews, $whereNews);
  $checkHas = 0;
  if ($checkNews) {
    $newss = $h->getAllSelect("id, titleNews, postDate, created_at, numberViews, contentNews", $tableNews, $whereNews, "sortOrder desc, created_at desc, id desc");
    foreach ($newss as $news) {
      $titleNews = $news['titleNews'];
      $linkCompare = chuoilink($titleNews).'.html';
      if ($linkCompare == $mod[1]) {
        $checkHas = 1;
        $id = $news['id'];
        $titleNews = $news['titleNews'];
        $pd = $news['postDate'];
        $createAt = $news['created_at'];
        $numberView = $news['numberViews'];
        $contentNews = $news['contentNews'];
        $whereNews .= " and id != $id";
        break;
      }
    }
  }
  if ($checkHas == 1) {
    $sessionView = "sessionViewNews".$id;
    if (!isset($_SESSION[$sessionView])) {
      $_SESSION[$sessionView] = $id;
      $numberView = $numberView + 1;
      $data['numberViews'] = $numberView;
      $resUpdate = $h->update($data, $tableNews, " where id = $id");
    }                 
    if (!is_null($pd) && $pd != '')
      $postDate = date("d/m/Y", strtotime($pd));
    else
      $postDate = date("d/m/Y", strtotime($createdAt));
?>
<div class="header-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <span><?php _e($lang['newsText']) ?></span>
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
          <li>
            <a href="<?php _e($def['actionNews']) ?>"><span><?php _e($lang['newsText']) ?></span></a>
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
          </li>
          <li>
            <strong><?php _e($titleNews) ?></strong>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<section id="article" itemscope itemtype="http://schema.org/Article">
  <meta itemprop="mainEntityOfPage" content="<?php _e($_SERVER['REQUEST_URI']) ?>">
  <meta itemprop="description" content="<?php _e($titleNews) ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="article-detail">
          <h1 class="article-title"><?php _e($titleNews) ?></h1>
          <div class="article-info">
            <span>
              <i class="fa fa-clock-o" aria-hidden="true"></i> <?php _e($postDate) ?> </span> | <span>
              <i class="fa fa-eye" aria-hidden="true"></i> <?php _e($numberView) ?>  
          </div>
          <article class="article-content" itemprop="description"><?php _e($contentNews) ?></article>
          <div class="article-share">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs">
                <div class="article-share-title">
                  <p><?php _e($lang['shareArticle']) ?></p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="article-share-content pull-right">
                  <a target="_blank" href="//www.facebook.com/sharer.php?u=<?php _e(_url2.$_SERVER['REQUEST_URI']) ?>" class="share-facebook hv-txt-facebook btn-transition btn-border-hover" title="Chia sẻ lên Facebook">
                    <i class="fa fa-facebook-square"></i>
                  </a>
                  <a href="//twitter.com/share?text=<?php _e($titleNews) ?>&amp;url=<?php _e(_url2.$_SERVER['REQUEST_URI']) ?>" target="_blank" data-toggle="tooltip" title="Twitter">
                    <i class="fa fa-twitter-square"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- related news -->
          <h2 class="related-news"><?php _e($lang['relatedNews']) ?></h2>
          <?php require_once _viewRequireNews.'contentNewsDetail.php' ?>
          <!-- end related news -->
        </div>
      </div>
      <?php require_once _viewsRequire.'sidebar.php' ?>
    </div>
  </div>
</section>
<?php } else { ?>
  <div class="header-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <span><?php _e($lang['newsText']) ?></span>
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
          <li>
            <a href="<?php _e($def['actionNews']) ?>"><span><?php _e($lang['newsText']) ?></span></a>
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
          </li>
          <li>
            <strong><?php _e($lang['pageNotFound']) ?></strong>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<section id="article" itemscope itemtype="http://schema.org/Article">
  <meta itemprop="mainEntityOfPage" content="<?php _e($_SERVER['REQUEST_URI']) ?>">
  <meta itemprop="description" content="<?php _e($lang['pageNotFound']) ?>">
  <div class="container">
    <div class="row text-center"><?php _e($lang['pageNotFound']) ?></div>
  </div>
</section>
<?php } ?>
