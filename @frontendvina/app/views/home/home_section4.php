<?php
  $tablePartner = $prefixTable.$def['tablePartner'];
  $checkPartner = $h->checkExist($tablePartner, "deleted_at is null and active = 1");
if ($checkPartner) {
    ?>
<div class="brand-logo">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="new_title">
          <h2><?php _e($lang['partnerText']) ?></h2>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="" id="brand">
        <?php 
          $allPartner = $h->getAllSelect("partnerName, partnerLogo, partnerWebsite", $tablePartner, "deleted_at is null and active = 1 and partnerLogo != ''", "sortOrder asc, id asc");
          $msgPartner = '';
          foreach ($allPartner as $partner) {
            $imgPartner = $partner['partnerLogo'];
            if (file_exists($def['imgUploadPartnerRealPath'].$imgPartner)) {
              $imagePartner = $def['imgUploadPartner'].$imgPartner;
              if ($partner['partnerWebsite'] != '' && !is_null($partner['partnerWebsite'])) 
                $msgPartner .= '<div class="item"><a href="'.$partner['partnerWebsite'].'" target="_blank"><img src="'.$imagePartner.'" alt="'.$partner['partnerName'].'" /></a></div>';
              else
                $msgPartner .= '<div class="item"><img src="'.$imagePartner.'" alt="'.$partner['partnerName'].'" /></div>';
            }
          }
          _e($msgPartner);
        ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
