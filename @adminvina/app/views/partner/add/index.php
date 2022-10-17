<?php
  require_once "../../../../library.php";
  $table = $prefixTable.$def['tablePartner'];
  $max = $h->getMax($table, 'sortOrder', 'maxSortOrder');
  if ($max == 0)
    $sortOrder = 1;
  else
    $sortOrder = $max + 1;
?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-success">
      <h5 class="modal-title text-uppercase"><?php echo $lang['addPartnerText'] ?></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="text-white">&times;</span>
      </button>
    </div>
    <!--  -->
    <form method="post" action="<?php echo $def['partnerAddProcess'] ?>" id="form_add" enctype="multipart/form-data">
      <div class="modal-body container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['partnerName'].$lngDefaultText ?></label>
              <input type="text" class="form-control" name="data[partnerName<?php echo $lngDefault ?>]" id="partnerName<?php echo $lngDefault ?>" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="partnerLogo"><?php echo $lang['partnerLogo'] ?></label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="partnerLogo" name="partnerLogo">
                  <label class="custom-file-label" for="partnerLogo"></label>
                </div>
              </div>
              <small class="text-danger"><i><?php echo $lang['sizeImageForm'] ?></i></small>
              <div id="display-image"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['partnerWebsite'].$lngDefaultText ?></label>
              <input type="text" class="form-control" name="data[partnerWebsite<?php echo $lngDefault ?>]" id="partnerWebsite<?php echo $lngDefault ?>" placeholder="https://vinaforest.vn" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label" for="sortOrder"><?php echo $lang['sortForm'] ?></label>
              <input type="number" class="form-control" min="1" name="data[sortOrder]" id="sortOrder" value="<?php echo $sortOrder ?>" />
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label class="col-form-label" for="active"><?php echo $lang['activeForm'] ?></label><br />
              <input type="checkbox" name="active" id="active" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="reset" class="btn btn-default"><?php echo $lang['reset'] ?> <i class="fas fa-undo"></i></button>
        <button type="submit" id="addPartner" class="btn btn-success"><?php echo $lang['save'] ?> <i class="fas fa-save"></i></button>
      </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<style type="text/css">
  #display-image {display: none;margin-top: 5px}
</style>
<script src="<?php echo $def['themePlugins']; ?>bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?php echo $def['themeJs'].'show_image_before_upload.js' ?>"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo $def['themePlugins']; ?>bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
    // show image before upload
    showImageBeforeUpload('#partnerLogo', '#display-image', 120); 
    $("input[data-bootstrap-switch]").each(function() {
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
  }); 
</script>
