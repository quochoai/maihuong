<?php
  require_once "../../../../library.php";
  if (isset($_SESSION['is_logined']) || isset($_COOKIE['islogined'])) {
    if (isset($_SESSION['is_logined'])) {
      $user = $_SESSION['is_logined'];
      $user_id = $user['id'];
    } else {
      $islogin = explode("kiecook", $_COOKIE['islogined']);
      $muser = explode("cookie", $islogin[0]);
      $user_id = $muser[1];
    }
    $table = $prefixTable.$def['tableAdmin'];
    $tableRole = $prefixTable.$def['tableAdminRoles'];
    $admin = $h->getById($table, $user_id);
    $fullname = $admin['fullname'];
    $username = $admin['username'];
    $roleAdmin = $admin['role'];
    $phone = $admin['phone'];
    $email = $admin['email'];
    $slogan = $admin['slogan'];
    $image = $admin['image'];
  
    if (file_exists($def['imgUploadAdminRealPath'].$image) && !is_null($image) && $image != '') {
      $imgAdminShow = '<img src="'.$def['imgUploadAdmin'].$image.'" width="120" height="auto" />';
      $dImgAdmin = ' style="display: block"';
    } else {
      $imgAdminShow = '';
      $dImgAdmin = '';
    }
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
    <form method="post" action="<?php _e($def['adminUpdateProcessSelf']) ?>" id="form_update_info_admin" enctype="multipart/form-data">
      <div class="modal-body container-fluid">
        <div class="row">
        <div class="col-md-5">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php _e($lang['adminFullname']) ?></label>
              <input type="text" class="form-control" name="data[fullname]" id="fullname_s" value="<?php _e($fullname) ?>" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label" for="username"><?php _e($lang['username']) ?></label><br />
              <input type="text" class="form-control" name="data[username]" id="username_s" value="<?php _e($username) ?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="col-form-label" for="role"><?php _e($lang['role']) ?></label><br />
              <div class="select2-success">
                <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" name="data[role]" id="role_s">
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
              <label class="col-form-label" for="slogan"><?php _e($lang['quoteLike']) ?></label>
              <input type="text" class="form-control" name="data[slogan]" id="slogan_s" value="<?php _e($slogan) ?>" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label" for="imageAdmin"><?php _e($lang['imagePerson']) ?></label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="imageAdmin" name="imageAdmin">
                  <label class="custom-file-label" for="imageAdmin"></label>
                </div>
              </div>
              <div id="display-image-admin"<?php _e($dImgAdmin) ?>><?php _e($imgAdminShow) ?></div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="col-form-label" for="phone"><?php _e($lang['adminPhone']) ?></label>
              <input type="number" class="form-control" name="data[phone]" id="phone_s" value="<?php _e($phone) ?>" />
            </div>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <label class="col-form-label" for="phone"><?php _e('Email') ?></label>
              <input type="text" class="form-control" name="data[email]" id="email_s" value="<?php _e($email) ?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="col-form-label" for="active"><?php _e($lang['activeForm']) ?></label><br />
              <input type="checkbox" name="active" id="active"<?php echo ($active == 1) ? ' checked' : '' ?> data-bootstrap-switch data-off-color="danger" data-on-color="success">
            </div>
          </div>
          
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="reset" class="btn btn-default"><?php _e($lang['reset']) ?> <i class="fas fa-undo"></i></button>
        <button type="submit" id="updateAdminSelf" class="btn btn-success"><?php _e($lang['updateText']) ?> <i class="fas fa-save"></i></button>
      </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<style type="text/css">
  #display-image-admin {display: none;margin-top: 5px}
</style>
<script src="<?php _e($def['themePlugins']) ?>bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?php _e($def['themeJs'].'show_image_before_upload.js') ?>"></script>
<!-- Bootstrap Switch -->
<script src="<?php _e($def['themePlugins']) ?>bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="<?php _e($def['themePlugins']) ?>select2/js/select2.full.min.js"></script>
<script type="text/javascript">
  // show image before upload
  showImageBeforeUpload('#imageAdmin', '#display-image-admin', 120); 
  $("input[data-bootstrap-switch]").each(function() {
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
    $('.select2').select2();
  }); 
  $(document).ready(function(){
    let updateAdminSelf = '#updateAdminSelf';
    let btnUpdateAdminSelf = $(updateAdminSelf);
    let modalSelf = $('#modal-change-infoSelf');
    $(document).on('click', updateAdminSelf, function() {
      let fullnameElement = $('#fullname_s');		
      let usernameElement = $('#username_s');
      let fullname = $.trim(fullnameElement.val());
      let username = $.trim(usernameElement.val());
      if (fullname == '') {
        toastr.error(notFill + fullnameText);
        fullnameElement.addClass('is-invalid');
        fullnameElement.focus();
        return false;
      } else {
        fullnameElement.removeClass('is-invalid');
        fullnameElement.addClass('is-valid');
      }
      if (username == '') {
        toastr.error(notFill + usernameText);
        usernameElement.addClass('is-invalid');
        usernameElement.focus();
        return false;
      } else {
        usernameElement.removeClass('is-invalid');
        usernameElement.addClass('is-valid');
      }
      let formUpdateSelf = $('#form_update_info_admin');
      formUpdateSelf.ajaxForm({
        beforeSend: function() {
          btnUpdateAdminSelf.attr("disabled",true);
          btnUpdateAdminSelf.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + processing); 
        },
        uploadProgress: function(event, position, total, percentComplete) {
                            
        },
        success: function() {
            
        },
        complete: function(xhr) {
          btnUpdateAdminSelf.html(updateText + ' <i class="fas fa-edit">');
          btnUpdateAdminSelf.removeAttr('disabled');
          let text = xhr.responseText;
          let n = text.split(";");
          if(n[0] == '1'){
            toastr.success(updateSuccessText);
            modalSelf.modal('hide');
          } else {   
            if (n[0] == '5') {
              toastr.error(sessionTimeout);
              setTimeout(function() {
                window.location.reload();
              }, 1000);
            } else {
              toastr.error(system_error);
              return false;
            }	
          }
        }
      });
    });
  });
</script>
<?php } else _e('5'); ?>
