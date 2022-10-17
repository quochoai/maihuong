<?php
  require_once "../../../../library.php";
  $id = $_POST['id'];
  $table = $prefixTable.$def['tableHtmls'];
  $html = $h->getById($table, $id);
  $type = $html['type'];
  $title = $html['title'];
  $content = $html['content'.$lngDefault];
  if ($type == 1) {
    if (file_exists($def['imgUploadHtmlRealPath'].$content) && !is_null($content) && $content != '') {
        $imgHtmlShow = '<img src="'.$def['imgUploadHtml'].$content.'" width="120" height="auto" />';
        $dImgHtml = ' style="display: block"';
    } else {
        $imgHtmlShow = '';
        $dImgHtml = '';
    }
  }
?>
<!-- select2 -->
<link rel="stylesheet" href="<?php echo $def['themePlugins']; ?>select2/css/select2.min.css" />
<link rel="stylesheet" href="<?php echo $def['themePlugins']; ?>select2-bootstrap4-theme/select2-bootstrap4.min.css" />
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-success">
      <h5 class="modal-title text-uppercase"><?php echo $lang['updateStaticInfo'] ?></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="text-white">&times;</span>
      </button>
    </div>
    <!--  -->
    <form method="post" action="<?php echo $def['htmlUpdateProcess'] ?>" id="form_update" enctype="multipart/form-data">
      <div class="modal-body container-fluid">
        <div class="row">
          <input type="hidden" name="idHtml" value="<?php _e($id) ?>" />
          <input type="hidden" name="type" value="<?php _e($type) ?>" />
          <?php if ($type == 1) { ?>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="imageHtml_e"><?php _e($title) ?></label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="imageHtml_e" name="imageHtml">
                  <label class="custom-file-label" for="imageHtml_e"></label>
                </div>
              </div>
              <div id="display-image-e"<?php _e($dImgHtml) ?>><?php _e($imgHtmlShow) ?></div>
            </div>
          </div>
          <?php } else { ?>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $title ?></label>
              <textarea type="text" class="form-control" name="data[content<?php echo $lngDefault ?>]" id="content<?php echo $lngDefault ?>_e"><?php _e($content) ?></textarea>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="reset" class="btn btn-default"><?php echo $lang['reset'] ?> <i class="fas fa-undo"></i></button>
        <button type="submit" id="updateHtml" class="btn btn-success"><?php echo $lang['save'] ?> <i class="fas fa-save"></i></button>
      </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<?php if ($type == 1) { ?>
<style type="text/css">
  #display-image-e {display: none;margin-top: 5px}
</style>
<script src="<?php echo $def['themePlugins']; ?>bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?php echo $def['themeJs'].'show_image_before_upload.js' ?>"></script>
<script type="text/javascript">
  bsCustomFileInput.init();
  showImageBeforeUpload('#imageHtml_e', '#display-image-e', 120); 
</script>
<?php } ?>
