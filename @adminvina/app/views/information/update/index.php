<?php
  require_once "../../../../library.php";
  $id = $_POST['id'];
  $table = $prefixTable.$def['tableInformations'];
  $info = $h->getById($table, $id);
  $titleInfo = $info['titleInfo'.$lngDefault];
  $active = $info['active'];
  $content = $info['contentInfo'.$lngDefault];
  $titleSeo = $info['titleSeo'.$lngDefault];
  $descriptionSeo = $info['descriptionSeo'.$lngDefault];
  $keywordSeo = $info['keywordSeo'.$lngDefault];
  $imgShareFb = $info['imageShareFb'];
  
  if (file_exists($def['imgUploadInfoRealPath'].$imgShareFb) && !is_null($imgShareFb) && $imgShareFb != '') {
    $imgShareFbShow = '<img src="'.$def['imgUploadInfo'].$imgShareFb.'" width="90" height="auto" />';
    $dImgInfoFb = ' style="display: block"';
  } else {
    $imgShareFbShow = '';
    $dImgInfoFb = '';
  }
?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-success">
      <h5 class="modal-title text-uppercase"><?php echo $lang['updateInfoText'].$test ?></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="text-white">&times;</span>
      </button>
    </div>
    <!--  -->
    <form method="post" action="<?php echo $def['infoUpdateProcess'] ?>" id="form_update" enctype="multipart/form-data">
      <input type="hidden" name="idInfo" value="<?php _e($id) ?>" />
      <div class="modal-body container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['titleInfo'].$lngDefaultText ?></label>
              <input type="text" class="form-control" name="data[titleInfo<?php echo $lngDefault ?>]" id="titleInfo<?php echo $lngDefault ?>_e" value="<?php _e($titleInfo) ?>" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label" for="imageShareFb_e"><?php echo $lang['imageShareFb'] ?></label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="imageShareFb_e" name="imageShareFb">
                  <label class="custom-file-label" for="imageShareFb_e"></label>
                </div>
              </div>
              <small class="text-danger"><i><?php echo $lang['sizeImageShareFb'].' '.$lang['ifNotReplaceBlank'] ?></i></small>
              <div id="display-image-sharefb-e"<?php _e($dImgInfoFb) ?>><?php echo $imgShareFbShow ?></div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label class="col-form-label" for="active"><?php echo $lang['activeForm'] ?></label><br />
              <input type="checkbox" name="active" id="active"<?php echo ($active == 1) ? ' checked': '' ?> data-bootstrap-switch data-off-color="danger" data-on-color="success">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['contentArticle'].$lngDefaultText ?></label>
              <textarea type="text" class="form-control" name="data[contentInfo<?php echo $lngDefault ?>]" id="contentInfo<?php echo $lngDefault ?>_e"><?php _e($content) ?></textarea>
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
              <input type="text" class="form-control" name="data[titleSeo<?php echo $lngDefault ?>]" id="titleSeo<?php echo $lngDefault ?>_e" value="<?php _e($titleSeo) ?>" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['descriptionSeo'].$lngDefaultText ?></label>
              <textarea class="form-control" name="data[descriptionSeo<?php echo $lngDefault ?>]" id="descriptionSeo<?php echo $lngDefault ?>_e" rows="3"><?php _e($descriptionSeo) ?></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['keywordSeo'].$lngDefaultText ?></label>
              <textarea class="form-control" name="data[keywordSeo<?php echo $lngDefault ?>]" id="keywordSeo<?php echo $lngDefault ?>_e" rows="3"><?php _e($keywordSeo) ?></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="reset" class="btn btn-default"><?php echo $lang['reset'] ?> <i class="fas fa-undo"></i></button>
        <button type="submit" id="updateInfo" class="btn btn-success"><?php echo $lang['updateText'] ?> <i class="fas fa-save"></i></button>
      </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<style type="text/css">
  #display-image-sharefb-e {display: none;margin-top: 5px}
</style>
<script src="<?php echo $def['themePlugins']; ?>bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?php echo $def['themeJs'].'show_image_before_upload.js' ?>"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo $def['themePlugins']; ?>bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
    // show image before upload
    showImageBeforeUpload('#imageShareFb_e', '#display-image-sharefb-e', 90); 
    $("input[data-bootstrap-switch]").each(function() {
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    }); 
  });  
</script>
<script type="text/javascript" src="<?php echo _tinymce ?>tinymce.min.js"></script>
<script type="text/javascript">
  tinymce.init({
    selector: "textarea#contentInfo<?php echo $lngDefault ?>_e",
    theme: "modern",
    width: 750,
    height: 300,
    plugins: [
      "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
      "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
      "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
    ],
    image_advtab: true,
    //content_css: "css/content.css",
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons responsivefilemanager",
    external_filemanager_path: "<?php echo _filemanager ?>",
    filemanager_title: "Responsive Filemanager",
    external_plugins: {
      "filemanager": "<?php echo _filemanager ?>plugin.min.js"
    },
    style_formats: [{title: 'Bold text', inline: 'b'}, {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}}, {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}}, {title: 'Example 1', inline: 'span', classes: 'example1'}, {title: 'Example 2', inline: 'span', classes: 'example2'}, {title: 'Table styles'}, {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
  });
</script>
