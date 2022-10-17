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

?>
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header bg-success">
      <h5 class="modal-title text-uppercase"><?php echo $lang['changePassword'] ?></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="text-white">&times;</span>
      </button>
    </div>
    <!--  -->
    <form method="post" action="<?php echo $def['adminChangePasswordProcess'] ?>" id="form_change_password" enctype="multipart/form-data">
      <div class="modal-body container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="oldPassword"><?php echo $lang['oldPassword'] ?></label>
              <input type="password" class="form-control" name="oldPassword" id="oldPassword" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="newPassword"><?php echo $lang['newPassword'] ?></label><br />
              <input type="password" class="form-control" name="newPassword" id="newPassword" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="newPasswordConfirm"><?php echo $lang['newPasswordConfirm'] ?></label><br />
              <input type="password" class="form-control" name="newPasswordConfirm" id="newPasswordConfirm" />
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="reset" class="btn btn-default"><?php echo $lang['reset'] ?> <i class="fas fa-undo"></i></button>
        <button type="submit" id="changePassword" class="btn btn-success"><?php echo $lang['change'] ?> <i class="fas fa-save"></i></button>
      </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<script type="text/javascript">
  $(document).ready(function(){
    let changePassword = '#changePassword';
    let btnChangePassword = $(changePassword);
    $(document).on('click', changePassword, function() {
      let oldPasswordElement = $('#oldPassword');
      let newPasswordElement = $('#newPassword');
      let newPasswordConfirmElement = $('#newPasswordConfirm');
      let oldPassword = $.trim($(oldPasswordElement).val());
      let newPassword = $.trim($(newPasswordElement).val());
      let newPasswordConfirm = $.trim($(newPasswordConfirmElement).val());

      if (oldPassword == '') {
        toastr.error(notFill + ' ' + oldPasswordText);
        oldPasswordElement.addClass('is-invalid');
        oldPasswordElement.focus();
        return false;
      } else {
        oldPasswordElement.removeClass('is-invalid');
        oldPasswordElement.addClass('is-valid');
      }
      if (newPassword == '') {
        toastr.error(notFill + ' ' + newPasswordText);
        newPasswordElement.addClass('is-invalid');
        newPasswordElement.focus();
        return false;
      } else {
        newPasswordElement.removeClass('is-invalid');
        newPasswordElement.addClass('is-valid');
      }
      if (newPasswordConfirm == '') {
        toastr.error(notFill + ' ' + newPasswordConfirmText);
        newPasswordConfirmElement.addClass('is-invalid');
        newPasswordConfirmElement.focus();
        return false;
      } else {
        newPasswordConfirmElement.removeClass('is-invalid');
        newPasswordConfirmElement.addClass('is-valid');
      }
      if (newPassword != newPasswordConfirm) {
        toastr.error(notMatchPassword);
        newPasswordConfirmElement.addClass('is-invalid');
        newPasswordConfirmElement.focus();
        return false;
      } else {
        newPasswordConfirmElement.removeClass('is-invalid');
        newPasswordConfirmElement.addClass('is-valid');
      }
      let formChangePassword = $('#form_change_password');
      formChangePassword.ajaxForm({
        beforeSend: function() {
          btnChangePassword.attr("disabled",true);
          btnChangePassword.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + processing); 
        },
        uploadProgress: function(event, position, total, percentComplete) {
                            
        },
        success: function() {
            
        },
        complete: function(xhr) {
          btnChangePassword.html(saveText + ' <i class="fas fa-save">');
          btnChangePassword.removeAttr('disabled');
          let text = xhr.responseText;
          let n = text.split(";");
          if(n[0] == '1'){
            toastr.success("<?php _e($lang['changePasswordSuccess']) ?>");
            $('#modal-change-password').modal('hide');
          } else {   
            if (n[0] == '5') {
              toastr.error(sessionTimeout);
              setTimeout(function() {
                window.location.reload();
              }, 1000);
            } else {
              if (n[0] == '3') {
                toastr.error("<?php _e($lang['invalidOldPassword']) ?>");
                oldPasswordElement.focus();
                return false;
              } else {
                toastr.error(system_error);
                return false;
              }
            }	
          }
        }
      });
    });
  });
</script>
<?php } else _e('5'); ?>