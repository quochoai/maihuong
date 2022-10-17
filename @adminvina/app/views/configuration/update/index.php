<?php
  require_once "../../../../library.php";
  $id = $_POST['id'];
  $table = $prefixTable.$def['tableConfigurations'];
  $config = $h->getById($table, $id);
  $title = $config['title'];
  $desc = $config['descriptionSeo'.$lngDefault];
  $keyw = $config['keywordSeo'.$lngDefault];
  if ($id == 4)
    $gAnalytics = $config['gAnalytics'];
  if ($id == 5)
    $gTags = $config['gTags'];
  if ($id == 6)
    $fPixel = $config['fPixel'];
?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-success">
      <h5 class="modal-title text-uppercase"><?php echo $lang['updateConfig'] ?></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="text-white">&times;</span>
      </button>
    </div>
    <!--  -->
    <form method="post" action="<?php echo $def['configUpdateProcess'] ?>" id="form_update" enctype="multipart/form-data">
      <div class="modal-body container-fluid">
        <div class="row">
          <input type="hidden" name="idConfig" value="<?php _e($id) ?>" />
          <?php if ($id == 4) { ?>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="gAnylytics"><?php _e($title) ?></label>
              <textarea type="text" class="form-control" name="data[gAnalytics]" id="gAnalytics" rows="7" placeholder="Code google analytics"><?php _e($gAnalytics) ?></textarea>
            </div>
          </div>
          <?php } elseif ($id == 5) { ?>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="gTags"><?php _e($title) ?></label>
              <textarea type="text" class="form-control" name="data[gTags]" id="gTags" rows="7" placeholder="Code google tag manager"><?php _e($gTags) ?></textarea>
            </div>
          </div>
          <?php } elseif ($id == 6) { ?>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="fPixel"><?php _e($title) ?></label>
              <textarea type="text" class="form-control" name="data[fPixel]" id="fPixel" rows="7" placeholder="Code Pixel Facebook"><?php _e($fPixel) ?></textarea>
            </div>
          </div>
          <?php } else { ?>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['titleForm'] ?></label>
              <input type="text" class="form-control" name="data[title<?php echo $lngDefault ?>]" id="title<?php echo $lngDefault ?>_e" value="<?php _e($title) ?>" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['descriptionSeo'].$lngDefaultText ?></label>
              <textarea class="form-control" name="data[descriptionSeo<?php echo $lngDefault ?>]" id="descriptionSeo<?php echo $lngDefault ?>_e" rows="5"><?php _e($desc) ?></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['keywordSeo'].$lngDefaultText ?></label>
              <textarea class="form-control" name="data[keywordSeo<?php echo $lngDefault ?>]" id="keywordSeo<?php echo $lngDefault ?>_e" rows="5"><?php _e($keyw) ?></textarea>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="reset" class="btn btn-default"><?php echo $lang['reset'] ?> <i class="fas fa-undo"></i></button>
        <button type="submit" id="updateConfig" class="btn btn-success"><?php echo $lang['save'] ?> <i class="fas fa-save"></i></button>
      </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
