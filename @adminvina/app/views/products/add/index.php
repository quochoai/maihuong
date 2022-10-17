<?php
  require_once "../../../../library.php";
  $tableCate = $prefixTable.$def['tableCategories'];
  $table = $prefixTable.$def['tableProducts'];
  $max = $h->getMax($table, 'sortOrder', 'maxSortOrder');
  if ($max == 0)
    $sortOrder = 1;
  else
    $sortOrder = $max + 1;
?>
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link type="text/css" rel="stylesheet" href="<?php _e($def['themePlugins']) ?>image-uploader/image-uploader.min.css">
<!-- select2 -->
<link rel="stylesheet" href="<?php echo $def['themePlugins']; ?>select2/css/select2.min.css" />
<link rel="stylesheet" href="<?php echo $def['themePlugins']; ?>select2-bootstrap4-theme/select2-bootstrap4.min.css" />
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-success">
      <h5 class="modal-title text-uppercase"><?php echo $lang['addProductText'] ?></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="text-white">&times;</span>
      </button>
    </div>
    <!--  -->
    <form method="post" action="<?php echo $def['productAddProcess'] ?>" id="form_add" enctype="multipart/form-data">
      <div class="modal-body container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['titleForm'].$lngDefaultText ?></label>
              <input type="text" class="form-control" name="data[titleProduct<?php echo $lngDefault ?>]" id="titleProduct<?php echo $lngDefault ?>" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['cate'] ?></label>
              <div class="select2-success">
                <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" name="data[cateID]" id="cateID">
                <?php
                  $cateProduct = $h->getAll($tableCate, "deleted_at is null and active = 1 and cateID = 0", "sortOrder asc, id asc");                  
                  foreach ($cateProduct as $cate) {
                    _e('<option value="'.$cate['id'].'">'.$cate['titleCate'].'</option>');
                    $subCate = $h->getAll($tableCate, "deleted_at is null and active = 1 and cateID = ".$cate['id'], "cateID asc, sortOrder asc, created_at asc");
                    foreach ($subCate as $scate) {
                      _e('<option value="'.$scate['id'].'"> -- '.$scate['titleCate'].'</option>');
                    }
                  }
                ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="imageProduct"><?php echo $lang['imageForm'] ?></label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="imageProduct" name="imageProduct">
                  <label class="custom-file-label" for="imageProduct"></label>
                </div>
              </div>
              <small class="text-danger"><i><?php echo $lang['sizeImageForm'] ?></i></small>
              <div id="display-image"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="imageShareFb"><?php echo $lang['imageShareFb'] ?></label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="imageShareFb" name="imageShareFb">
                  <label class="custom-file-label" for="imageShareFb"></label>
                </div>
              </div>
              <small class="text-danger"><i><?php echo $lang['sizeImageShareFb'] ?></i></small>
              <div id="display-image-sharefb"></div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="imageDetail"><?php _e($lang['imageDetail']) ?></label>
              <div class="gallery-image p-1"></div>
              <small class="text-danger"><?php _e($lang['size_image_gallery']) ?></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="priceProduct"><?php echo $lang['priceText'] ?></label>
              <input type="number" name="data[priceProduct]" id="priceProduct" class="form-control" min="0" /> 
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="oldPriceProduct"><?php echo $lang['oldPriceText'] ?></label>
              <input type="number" name="data[oldPriceProduct]" id="oldPriceProduct" class="form-control" min="0" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['descProduct'].$lngDefaultText ?></label>
              <textarea class="form-control" name="data[contentProduct<?php echo $lngDefault ?>]" id="contentProduct<?php echo $lngDefault ?>"></textarea>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label" for="sortOrder"><?php echo $lang['sortForm'] ?></label>
              <input type="number" class="form-control" min="1" name="data[sortOrder]" id="sortOrder" value="<?php echo $sortOrder ?>" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label" for="active"><?php echo $lang['activeForm'] ?></label><br />
              <input type="checkbox" name="active" id="active" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['tags'] ?></label>
              <div class="select2-success">
                <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" name="tags[]" id="tags" multiple data-placeholder="<?php echo $lang['chooseTag'] ?>">
                <?php
                  $tableTags = $prefixTable.$def['tableTags'];
                  $tags = $h->getAll($tableTags, "deleted_at is null and active = 1", "id asc");                  
                  foreach ($tags as $tag) {
                      echo '<option value="'.$tag['id'].'">'.$tag['titleTag'].'</option>';
                  }
                ?>
                </select>
              </div>
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
              <input type="text" class="form-control" name="data[titleSeo<?php echo $lngDefault ?>]" id="titleSeo<?php echo $lngDefault ?>" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['descriptionSeo'].$lngDefaultText ?></label>
              <textarea class="form-control" name="data[descriptionSeo<?php echo $lngDefault ?>]" id="descriptionSeo<?php echo $lngDefault ?>" rows="3"></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['keywordSeo'].$lngDefaultText ?></label>
              <textarea class="form-control" name="data[keywordSeo<?php echo $lngDefault ?>]" id="keywordSeo<?php echo $lngDefault ?>" rows="3"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="reset" class="btn btn-default"><?php echo $lang['reset'] ?> <i class="fas fa-undo"></i></button>
        <button type="submit" id="addProduct" class="btn btn-success"><?php echo $lang['save'] ?> <i class="fas fa-save"></i></button>
      </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<style type="text/css">
  #display-image, #display-image-sharefb {display: none;margin-top: 5px}
</style>
<script src="<?php echo $def['themePlugins']; ?>bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?php echo $def['themeJs'].'show_image_before_upload.js' ?>"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo $def['themePlugins']; ?>bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- Select2 -->
<script src="<?php echo $def['themePlugins']; ?>select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="<?php _e($def['themePlugins']) ?>image-uploader/image-uploader.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
    $('.select2').select2();
    showImageBeforeUpload('#imageProduct', '#display-image', 120); 
    showImageBeforeUpload('#imageShareFb', '#display-image-sharefb', 120); 
    $("input[data-bootstrap-switch]").each(function() {
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    }); 
    $('.gallery-image').imageUploader();
  });
</script>
<script type="text/javascript" src="<?php echo _tinymce ?>tinymce.min.js"></script>
<script type="text/javascript">
  tinymce.init({
    selector: "textarea#contentProduct<?php echo $lngDefault ?>",
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
    style_formats: [{title: 'H1', block: 'h1'}, {title: 'H2', block: 'h2'}, {title: 'H3', block: 'h3'}, {title: 'H4', block: 'h4'}, {title: 'Bold text', inline: 'strong'}, {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}}, {title: 'Example 1', inline: 'span', classes: 'example1'}, {title: 'Example 2', inline: 'span', classes: 'example2'}, {title: 'Table styles'}, {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
  });
</script>
