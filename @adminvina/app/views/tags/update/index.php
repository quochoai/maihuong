<?php
  require_once "../../../../library.php";
  $id = $_POST['id'];
  $table = $prefixTable.$def['tableTags'];
  $tag = $h->getById($table, $id);
  $titleTag = $tag['titleTag'.$lngDefault];
  $active = $tag['active'];
?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-success">
      <h5 class="modal-title text-uppercase"><?php echo $lang['updateTagText'] ?></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="text-white">&times;</span>
      </button>
    </div>
    <!--  -->
    <form method="post" action="<?php echo $def['tagUpdateProcess'] ?>" id="form_update" enctype="multipart/form-data">
      <input type="hidden" name="idTag" value="<?php _e($id) ?>" />
      <div class="modal-body container-fluid">
        <div class="row">
          <div class="col-md-9">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['titleTag'].$lngDefaultText ?></label>
              <input type="text" class="form-control" name="data[titleTag<?php echo $lngDefault ?>]" id="titleTag<?php echo $lngDefault ?>_e" value="<?php _e($titleTag) ?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="col-form-label" for="active"><?php echo $lang['activeForm'] ?></label><br />
              <input type="checkbox" name="active" id="active"<?php echo ($active == 1) ? ' checked': '' ?> data-bootstrap-switch data-off-color="danger" data-on-color="success">
            </div>
          </div>
          
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="reset" class="btn btn-default"><?php echo $lang['reset'] ?> <i class="fas fa-undo"></i></button>
        <button type="submit" id="updateTag" class="btn btn-success"><?php echo $lang['updateText'] ?> <i class="fas fa-save"></i></button>
      </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- Bootstrap Switch -->
<script src="<?php echo $def['themePlugins']; ?>bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript">
  $("input[data-bootstrap-switch]").each(function() {
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  }); 
</script>
