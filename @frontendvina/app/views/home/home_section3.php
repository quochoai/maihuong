<section class="blogIndex">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="news">
          <div class="new_title"><h2 class=""><?php _e($lang['newnews']) ?></h2></div>
          <div class="inner">
            <div class="row">
            <?php
              $checkNews = $h->checkExist($tableNews, "deleted_at is null and active = 1");
              $msgNews = '';
              $tableAdmin = $prefixTable.$def['tableAdmin'];
              if ($checkNews) {
                $allNews = $h->getAllSelect("titleNews, imageNews, shortContentNews, postDate, created_by", $tableNews, "deleted_at is null and active = 1", "sortOrder desc, created_at desc", "limit 0, 4");
                foreach ($allNews as $news) {
                  $titleNews = $news['titleNews'];
                  $imgNews = $news['imageNews'];
                  $shortContentNews = $news['shortContentNews'];
                  if (file_exists($def['imgUploadNewsRealPath'].$imgNews))
                    $imageNews = $def['imgUploadNews'].$imgNews;
                  else
                    $imageNews = _noImage;
                  $user = $h->getById($tableAdmin, $news['created_by']);
                  $userPost = $user['fullname'];
                  $postDate = date("d/m/Y", strtotime($news['postDate']));

                  $linkNews = $def['actionNews'].'/'.chuoilink($titleNews).'.html';
                  $msgNews .= '<div class="col-lg-6 col-md-6 col-sm-6 mb-4">';
                  $msgNews .= ' <div class="blog-thumb col-lg-4 col-md-4 col-sm-3 col-xs-12"><a href="'.$linkNews.'"><img src="'.$imageNews.'" alt="'.$titleNews.'" /></a></div>';
                  $msgNews .= ' <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12">';
                  $msgNews .= '   <div class="blog-content "><h3 class="article_title"><a href="'.$linkNews.'" title="'.$titleNews.'">'.$titleNews.'</a></h3><span><i class="fa fa-user" aria-hidden="true"></i> '.$userPost.'</span>, <span><i class="fa fa-calendar" aria-hidden="true"></i> '.$postDate.' </span></div>';
                  $msgNews .= '   <div class="post_content"><a href="'.$linkNews.'" title="'.$lang['viewMore'].'">'.$lang['viewMore'].'</a></div>';
                  $msgNews .= ' </div>';
                  $msgNews .= '</div>';
                }
              }
              _e($msgNews);
            ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
