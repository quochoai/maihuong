<?php
  require_once "../../../../library.php";
?>
<!-- select2 -->
<link rel="stylesheet" href="<?php _e($def['themePlugins']) ?>select2/css/select2.min.css" />
<link rel="stylesheet" href="<?php _e($def['themePlugins']) ?>select2-bootstrap4-theme/select2-bootstrap4.min.css" />
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-success">
      <h5 class="modal-title text-uppercase"><?php _e($lang['addAdmin']) ?></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="text-white">&times;</span>
      </button>
    </div>
    <form method="post" action="<?php _e($def['adminAddProcess']) ?>" id="form_add" enctype="multipart/form-data">
      <div class="modal-body container-fluid">
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php _e($lang['adminFullname']) ?></label>
              <input type="text" class="form-control" name="data[fullname]" id="fullname" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label" for="username"><?php _e($lang['username']) ?></label><br />
              <input type="text" class="form-control" name="data[username]" id="username" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="col-form-label" for="role"><?php _e($lang['role']) ?></label><br />
              <div class="select2-success">
                <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" name="data[role]" id="role">
                <?php
                  $tableRole = $prefixTable.$def['tableAdminRoles'];
                  $roles = $h->getAll($tableRole, "deleted_at is null and active = 1", "id asc"); //  and id NOT IN (1,2)                  
                  foreach ($roles as $role) {
                     _e('<option value="'.$role['id'].'">'.$role['roleName'].'</option>');
                  }
                ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label class="col-form-label" for="password"><?php _e($lang['password']) ?></label>
              <input type="password" class="form-control" name="password" id="password" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label" for="confirmPassword"><?php _e($lang['confirmPassword']) ?></label>
              <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="col-form-label" for="phone"><?php _e($lang['adminPhone']) ?></label>
              <input type="number" class="form-control" name="data[phone]" id="phone" />
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="reset" class="btn btn-default"><?php _e($lang['reset']) ?> <i class="fas fa-undo"></i></button>
        <button type="submit" id="addAdmin" class="btn btn-success"><?php _e($lang['save']) ?> <i class="fas fa-save"></i></button>
      </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- Select2 -->
<script src="<?php _e($def['themePlugins']) ?>select2/js/select2.full.min.js"></script>
<script type="text/javascript">
  $('.select2').select2();
</script>
