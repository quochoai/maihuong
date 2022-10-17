<?php
  require_once "../../../../library.php";
?>
<!-- select2 -->
<link rel="stylesheet" href="<?php echo $def['themePlugins']; ?>select2/css/select2.min.css" />
<link rel="stylesheet" href="<?php echo $def['themePlugins']; ?>select2-bootstrap4-theme/select2-bootstrap4.min.css" />
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-success">
      <h5 class="modal-title text-uppercase"><?php echo $lang['addStaticInfo'] ?></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="text-white">&times;</span>
      </button>
    </div>
    <!--  -->
    <form method="post" action="<?php echo $def['htmlAddProcess'] ?>" id="form_add" enctype="multipart/form-data">
      <div class="modal-body container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['titleForm'] ?></label>
              <input type="text" class="form-control" name="data[title]" id="title" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['type'] ?></label>
              <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" name="data[type]" id="type">
              <?php
                  $types = ['Text', 'Image'];
                  foreach ($types as $k => $type) {
                      echo '<option value="'.$k.'">'.$type.'</option>';
                  }
              ?>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['contentArticle'].$lngDefaultText ?></label>
              <textarea type="text" class="form-control" name="data[content<?php echo $lngDefault ?>]" id="content<?php echo $lngDefault ?>"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="reset" class="btn btn-default"><?php echo $lang['reset'] ?> <i class="fas fa-undo"></i></button>
        <button type="submit" id="addHtml" class="btn btn-success"><?php echo $lang['save'] ?> <i class="fas fa-save"></i></button>
      </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- Select2 -->
<script src="<?php echo $def['themePlugins']; ?>select2/js/select2.full.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('.select2').select2();
  });
</script>
