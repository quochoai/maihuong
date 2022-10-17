<script type="text/javascript">
        $(document).ready(function(){
            function login(){
               var <?php echo $def['id_profile_code'] ?> = $('#<?php echo $def['id_profile_code'] ?>').val();
               var <?php echo $def['id_password'] ?> = $('#<?php echo $def['id_password'] ?>').val(); 
               if(<?php echo $def['id_profile_code'] ?> == <?php echo $def['empty_input'] ?>) {
                    toastr.error('<?php echo $lang['not_input_profile_code'] ?>');
                    $('#<?php echo $def['id_profile_code'] ?>').addClass('<?php echo $def['class_is_invalid'] ?>');
                    $('#<?php echo $def['id_profile_code'] ?>').focus();
                    return false;
               } else {
                    $('#<?php echo $def['id_profile_code'] ?>').addClass('<?php echo $def['class_is_valid'] ?>');
                    $('#<?php echo $def['id_profile_code'] ?>').removeClass('<?php echo $def['class_is_invalid'] ?>');
               }
               if(<?php echo $def['id_password'] ?> == <?php echo $def['empty_input'] ?>) {
                    toastr.error('<?php echo $lang['not_input_password'] ?>');
                    $('#<?php echo $def['id_password'] ?>').addClass('<?php echo $def['class_is_invalid'] ?>');
                    $('#<?php echo $def['id_password'] ?>').focus();
                    return false;
               } else {
                    $('#<?php echo $def['id_password'] ?>').addClass('<?php echo $def['class_is_valid'] ?>');
                    $('#<?php echo $def['id_password'] ?>').removeClass('<?php echo $def['class_is_invalid'] ?>');
               }
               $('button#<?php echo $def['id_button_login'] ?>').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <?php echo $lang['processing'] ?>');
               $.post("<?php echo $def['link_process_login']; ?>", {
                    profile_code: <?php echo $def['id_profile_code'] ?>,
                    password: <?php echo $def['id_password'] ?>,
               }, function(response){
                    $('button#<?php echo $def['id_button_login'] ?>').html('<?php echo $lang['sign_in']; ?>');
                    if(response == '2'){
                        toastr.error('<?php echo $lang['invalid_profile_code'] ?>');
                        $('#<?php echo $def['id_profile_code'] ?>').addClass('<?php echo $def['class_is_invalid'] ?>');
                        $('#<?php echo $def['id_profile_code'] ?>').focus();
                        return false;
                    } else {
                        $('#<?php echo $def['id_profile_code'] ?>').addClass('<?php echo $def['class_is_valid'] ?>');
                        $('#<?php echo $def['id_profile_code'] ?>').removeClass('<?php echo $def['class_is_invalid'] ?>');
                        if(response == '3') {
                            toastr.error('<?php echo $lang['password_wrong'] ?>');
                            $('#<?php echo $def['id_password'] ?>').addClass('<?php echo $def['class_is_invalid'] ?>');
                            $('#<?php echo $def['id_password'] ?>').focus();
                            return false;
                        } else {
                            if(response == '1') {
                                $('#<?php echo $def['id_password'] ?>').addClass('<?php echo $def['class_is_valid'] ?>');
                                $('#<?php echo $def['id_password'] ?>').removeClass('<?php echo $def['class_is_invalid'] ?>');
                                toastr.success('<?php echo $lang['login_successful'] ?>');
                                window.loation = '<?php echo URL; ?>';
                            } else {
                                toastr.success('<?php echo $lang['system_error'] ?>');
                            }
                        }
                    }
               })
            }
            $('#<?php echo $def['id_button_login'] ?>').click(function(){
               login();
            });
        });
    </script>