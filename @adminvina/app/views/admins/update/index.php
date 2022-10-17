<?php
  require_once "../../../../library.php";
  $id = $_POST['id'];
  $table = $prefixTable.$def['tableAdmin'];
  $tableRole = $prefixTable.$def['tableAdminRoles'];
  $admin = $h->getById($table, $id);
  $fullname = $admin['fullname'];
  $username = $admin['username'];
  $roleAdmin = $admin['role'];
  $phone = $admin['phone'];
  $email = $admin['email'];
  $active = $admin['active'];

?>
<!-- select2 -->
<link rel="stylesheet" href="<?php _e($def['themePlugins']) ?>select2/css/select2.min.css" />
<link rel="stylesheet" href="<?php _e($def['themePlugins']) ?>select2-bootstrap4-theme/select2-bootstrap4.min.css" />
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-success">
      <h5 class="modal-title text-uppercase"><?php _e($lang['updateAdmin']) ?></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="text-white">&times;</span>
      </button>
    </div>
    <!--  -->
    <form method="post" action="<?php _e($def['adminUpdateProcess']) ?>" id="form_update" enctype="multipart/form-data">
      <input type="hidden" name="idAdmin" value="<?php _e($id) ?>" />
      <div class="modal-body container-fluid">
        <div class="row">
        <div class="col-md-5">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php _e($lang['adminFullname']) ?></label>
              <input type="text" class="form-control" name="data[fullname]" id="fullname_e" value="<?php _e($fullname) ?>" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label" for="username"><?php _e($lang['username']) ?></label><br />
              <input type="text" class="form-control" name="data[username]" id="username_e" value="<?php _e($username) ?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="col-form-label" for="role"><?php _e($lang['role']) ?></label><br />
              <div class="select2-success">
                <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" name="data[role]" id="role_e">
                <?php
                  $roles = $h->getAll($tableRole, "deleted_at is null and active = 1", "id asc"); //  and id NOT IN (1,2)                  
                  foreach ($roles as $role) {
                    if ($role['id'] == $roleAdmin)
                      $selected = ' selected';
                    else
                      $selected = '';
                      _e('<option value="'.$role['id'].'"'.$selected.'>'.$role['roleName'].'</option>');
                  }
                ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label class="col-form-label" for="password"><?php _e($lang['password']) ?></label>
              <input type="password" class="form-control" name="password" id="password_e" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label" for="confirmPassword"><?php _e($lang['confirmPassword']) ?></label>
              <input type="password" class="form-control" name="confirmPassword" id="confirmPassword_e" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="col-form-label" for="phone"><?php _e($lang['adminPhone']) ?></label>
              <input type="number" class="form-control" name="data[phone]" id="phone_e" value="<?php _e($phone) ?>" />
            </div>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <label class="col-form-label" for="phone"><?php _e('Email') ?></label>
              <input type="text" class="form-control" name="data[email]" id="email" value="<?php _e($email) ?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="col-form-label" for="active"><?php _e($lang['activeForm']) ?></label><br />
              <input type="checkbox" name="active" id="active"<?php echo ($active == 1) ? ' checked': '' ?> data-bootstrap-switch data-off-color="danger" data-on-color="success">
            </div>
          </div>
          
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="reset" class="btn btn-default"><?php _e($lang['reset']) ?> <i class="fas fa-undo"></i></button>
        <button type="submit" id="updateAdmin" class="btn btn-success"><?php _e($lang['updateText']) ?> <i class="fas fa-save"></i></button>
      </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- Bootstrap Switch -->
<script src="<?php _e($def['themePlugins']) ?>bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="<?php echo $def['themePlugins']; ?>select2/js/select2.full.min.js"></script>
<script type="text/javascript">
  $("input[data-bootstrap-switch]").each(function() {
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
    $('.select2').select2();
  }); 
</script>
