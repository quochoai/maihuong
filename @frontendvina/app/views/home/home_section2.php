<section class="trichdan">
  <h3><?php $quote = $h->getById($tableHtml, 14); _e($quote['content']) ?></h3>
</section>
<section class="aboutIndex">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
        <div class="new_title">
          <h2 class=""><?php _e($lang['aboutText']) ?></h2>
        </div>
        <div class="content">
          <p><?php $aboutHome = $h->getById($tableHtml, 15); _e($aboutHome['content']) ?></p>
          <div class="button">
            <a class="hover-button" href="<?php _e($def['actionAbout']) ?>"><span><?php _e($lang['viewMore']) ?></span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="numberIndex" style="background: url(assets/images/bgnumber.webp)">
  <div class="container">
    <div class="row">
      <div class="titleNumber">
        <h2><?php _e($lang['achievement']) ?></h2>
      </div>
      <div class="item">
      <?php
        $achievements = $h->getAllSelect("title, content", $tableHtml, "id IN (10, 11, 12, 13)", "id asc");
        $msgAchievement = '';
        foreach ($achievements as $achie) {
          $msgAchievement .= '<div class="col-md-3 col-sm-6"><div class="inner">';
          $msgAchievement .= '  <div class="counter" style="display: inline-block; width: 32%">'.$achie['content'].'</div>';
          $msgAchievement .= '  <div class="text-box text-uppercase"><p>'.$achie['title'].'</p></div>';
          $msgAchievement .= '</div></div>';
        }
        _e($msgAchievement);
      ?>
      </div>
    </div>
  </div>
</section>
