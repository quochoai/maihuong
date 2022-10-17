<?php
  require_once "../../../../library.php";
  $id = $_POST['id'];
  $table = $prefixTable.$def['tableCategoriesOrders'];
  $cateOrder = $h->getById($table, $id);
  $titleCate = $cateOrder['titleCate'.$lngDefault];
  $imgCate = $cateOrder['imageCate'];
  
  if (file_exists($def['imgUploadCateOrderRealPath'].$imgCate) && !is_null($imgCate) && $imgCate != '') {
    $imgCateShow = '<img src="'.$def['imgUploadCateOrder'].$imgCate.'" width="90" height="auto" />';
    $dImgCate = ' style="display: block"';
  } else {
    $imgCateShow = '';
    $dImgCate = '';
  }
    
  $imgShareFb = $cateOrder['imageShareFb'];
  if (file_exists($def['imgUploadCateOrderRealPath'].$imgShareFb) && !is_null($imgShareFb) && $imgShareFb != '') {
    $imgShareFbShow = '<img src="'.$def['imgUploadCateOrder'].$imgShareFb.'" width="90" height="auto" />';
    $dImgCateFb = ' style="display: block"';
  } else {
    $imgShareFbShow = '';
    $dImgCateFb = '';
  }
  $active = $cateOrder['active'];
  $sortOrder = $cateOrder['sortOrder'];
  $titleSeo = $cateOrder['titleSeo'];
  $descriptionSeo = $cateOrder['descriptionSeo'];
  $keywordSeo = $cateOrder['keywordSeo'];  
?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-success">
      <h5 class="modal-title text-uppercase"><?php echo $lang['updateCateOrderText'] ?></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="text-white">&times;</span>
      </button>
    </div>
    <!--  -->
    <form method="post" action="<?php echo $def['cateOrderUpdateProcess'] ?>" id="form_update" enctype="multipart/form-data">
      <div class="modal-body container-fluid">
        <div class="row">
          <input type="hidden" name="idCateOrder" value="<?php _e($id) ?>" />
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['titleForm'].$lngDefaultText ?></label>
              <input type="text" class="form-control" name="data[titleCate<?php echo $lngDefault ?>]" id="titleCateOrder<?php echo $lngDefault ?>_e" value="<?php _e($titleCate) ?>" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="imageCate_e"><?php echo $lang['imageForm'] ?></label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="imageCate_e" name="imageCate">
                  <label class="custom-file-label" for="imageCate_e"></label>
                </div>
              </div>
              <small class="text-danger"><i><?php echo $lang['sizeImageForm'].' '.$lang['ifNotReplaceBlank'] ?></i></small>
              <div id="display-image-e"<?php _e($dImgCate) ?>><?php echo $imgCateShow ?></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="imageShareFb_e"><?php echo $lang['imageShareFb'] ?></label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="imageShareFb_e" name="imageShareFb">
                  <label class="custom-file-label" for="imageShareFb_e"></label>
                </div>
              </div>
              <small class="text-danger"><i><?php echo $lang['sizeImageShareFb'].' '.$lang['ifNotReplaceBlank'] ?></i></small>
              <div id="display-image-sharefb-e"<?php _e($dImgCateFb) ?>><?php echo $imgShareFbShow ?></div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label" for="sortOrder"><?php echo $lang['sortForm'] ?></label>
              <input type="number" class="form-control" min="1" name="data[sortOrder]" id="sortOrder_e" value="<?php echo $sortOrder ?>" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label" for="active"><?php echo $lang['activeForm'] ?></label><br />
              <input type="checkbox" name="active" id="active_e"<?php echo ($active == 1) ? ' checked' : '' ?> data-bootstrap-switch data-off-color="danger" data-on-color="success">
            </div>
          </div>
          <div class="col-md-12 card card-success">
            <div class="card-header">
              <div class="card-title"><?php echo $lang['infoForSeo'] ?></div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['titleWebsite'].$lngDefaultText ?></label>
              <input type="text" class="form-control" name="data[titleSeo<?php echo $lngDefault ?>]" id="titleSeo<?php echo $lngDefault ?>_e" value="<?php echo $titleSeo ?>" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['descriptionSeo'].$lngDefaultText ?></label>
              <textarea class="form-control" name="data[descriptionSeo<?php echo $lngDefault ?>]" id="descriptionSeo<?php echo $lngDefault ?>_e" rows="3"><?php echo $descriptionSeo ?></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['keywordSeo'].$lngDefaultText ?></label>
              <textarea class="form-control" name="data[keywordSeo<?php echo $lngDefault ?>]" id="keywordSeo<?php echo $lngDefault ?>_e" rows="3"><?php echo $keywordSeo ?></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="reset" class="btn btn-default"><?php echo $lang['reset'] ?> <i class="fas fa-undo"></i></button>
        <button type="submit" id="updateCateOrder" class="btn btn-success"><?php echo $lang['updateText'] ?> <i class="fas fa-save"></i></button>
      </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<style type="text/css">
  #display-image-e, #display-image-sharefb-e {display: none;margin-top: 5px}
</style>
<script src="<?php echo $def['themePlugins']; ?>bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?php echo $def['themeJs'].'show_image_before_upload.js' ?>"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo $def['themePlugins']; ?>bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
  });
  // show image before upload
  showImageBeforeUpload('#imageCate_e', '#display-image-e', 90); 
  showImageBeforeUpload('#imageShareFb_e', '#display-image-sharefb_e', 90); 
  $("input[data-bootstrap-switch]").each(function() {
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  }); 
</script>
