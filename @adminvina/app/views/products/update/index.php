<?php
  require_once "../../../../library.php";
  $id = $_POST['id'];
  $tableCate = $prefixTable.$def['tableCategories'];
  $table = $prefixTable.$def['tableProducts'];
  $product = $h->getById($table, $id);
  $cateID = $product['cateID'];
  $titleProduct = $product['titleProduct'.$lngDefault];
  $imgProduct = $product['imageProduct'];
  
  if (file_exists($def['imgUploadProductRealPath'].$imgProduct) && !is_null($imgProduct) && $imgProduct != '') {
    $imgProductShow = '<img src="'.$def['imgUploadProduct'].$imgProduct.'" width="120" height="auto" />';
    $dimgProduct = ' style="display: block"';
  } else {
    $imgProductShow = '';
    $dimgProduct = '';
  }
    
  $imgShareFb = $product['imageShareFb'];
  if (file_exists($def['imgUploadProductRealPath'].$imgShareFb) && !is_null($imgShareFb) && $imgShareFb != '') {
    $imgShareFbShow = '<img src="'.$def['imgUploadProduct'].$imgShareFb.'" width="120" height="auto" />';
    $dimgProductFb = ' style="display: block"';
  } else {
    $imgShareFbShow = '';
    $dimgProductFb = '';
  }

  $imgDetail = $product['imageDetail'];
  $aImgDetail = [];
  if (!is_null($imgDetail) && $imgDetail != '')
    $aImgDetail = explode(";", $imgDetail);  

  $active = $product['active'];
  $sortOrder = $product['sortOrder'];
  $priceProduct = $product['priceProduct'];
  $oldPriceProduct = $product['oldPriceProduct'];
  if ($product['tags'] != '' && !is_null($product['tags']))
    $tagArray = explode(",", $product['tags']);
  else
    $tagArray = [];
  
  $content = $product['contentProduct'.$lngDefault];
  $titleSeo = $product['titleSeo'.$lngDefault];
  $descriptionSeo = $product['descriptionSeo'.$lngDefault];
  $keywordSeo = $product['keywordSeo'.$lngDefault];  
?>
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link type="text/css" rel="stylesheet" href="<?php _e($def['themePlugins']) ?>image-uploader/image-uploader.min.css">
<!-- select2 -->
<link rel="stylesheet" href="<?php echo $def['themePlugins']; ?>select2/css/select2.min.css" />
<link rel="stylesheet" href="<?php echo $def['themePlugins']; ?>select2-bootstrap4-theme/select2-bootstrap4.min.css" />
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-success">
      <h5 class="modal-title text-uppercase"><?php echo $lang['updateProductText'] ?></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="text-white">&times;</span>
      </button>
    </div>
    <!--  -->
    <form method="post" action="<?php echo $def['productUpdateProcess'] ?>" id="form_update" enctype="multipart/form-data">
      <div class="modal-body container-fluid">
        <div class="row">
          <input type="hidden" name="idProduct" value="<?php _e($id) ?>" />
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['titleForm'].$lngDefaultText ?></label>
              <input type="text" class="form-control" name="data[titleProduct<?php echo $lngDefault ?>]" id="titleProduct<?php echo $lngDefault ?>_e" value="<?php _e($titleProduct) ?>" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['cate'] ?></label>
              <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" name="data[cateID]" id="cateID_e">
              <?php
                  $product = $h->getAll($tableCate, "deleted_at is null and active = 1", "sortOrder asc, id asc");                  
                  foreach ($product as $cate) {
                    $selected = ($cate['id'] == $cateID) ? ' selected': '';
                    _e('<option value="'.$cate['id'].'"'.$selected.'>'.$cate['titleCate'].'</option>');
                    $subCate = $h->getAll($tableCate, "deleted_at is null and active = 1 and cateID = ".$cate['id'], "cateID asc, sortOrder asc, created_at asc");
                    foreach ($subCate as $scate) {
                      $subSelected = ($scate['id'] == $cateID) ? ' selected': '';
                      _e('<option value="'.$scate['id'].'"'.$subSelected.'> -- '.$scate['titleCate'].'</option>');
                    }
                  }
              ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="imageProduct_e"><?php echo $lang['imageForm'] ?></label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="imageProduct_e" name="imageProduct">
                  <label class="custom-file-label" for="imageProduct_e"></label>
                </div>
              </div>
              <small class="text-danger"><i><?php echo $lang['sizeImageForm'] ?></i></small>
              <div id="display-image-e"<?php _e($dimgProduct) ?>><?php _e($imgProductShow) ?></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="imageShareFb_e"><?php echo $lang['imageShareFb'] ?></label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="imageShareFb_e" name="imageShareFb">
                  <label class="custom-file-label" for="imageShareFb_e"></label>
                </div>
              </div>
              <small class="text-danger"><i><?php echo $lang['sizeImageShareFb'] ?></i></small>
              <div id="display-image-sharefb-e"<?php _e($dimgProductFb) ?>><?php _e($imgShareFbShow) ?></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="priceProduct_e"><?php echo $lang['priceText'] ?></label>
              <input type="number" name="data[priceProduct]" id="priceProduct_e" class="form-control" value="<?php _e($priceProduct) ?>" min="0" /> 
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="oldPriceProduct_e"><?php echo $lang['oldPriceText'] ?></label>
              <input type="number" name="data[oldPriceProduct]" id="oldPriceProduct_e" class="form-control" min="0" value="<?php _e($oldPriceProduct) ?>" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php _e($lang['imageDetail']) ?></label>
              <div class="gallery-image p-1"></div>
              <small class="text-danger"><?php _e($lang['size_image_gallery']) ?></small>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['descProduct'].$lngDefaultText ?></label>
              <textarea type="text" class="form-control" name="data[contentProduct<?php echo $lngDefault ?>]" id="contentProduct<?php echo $lngDefault ?>_e"><?php _e($content) ?></textarea>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label" for="sortOrder"><?php echo $lang['sortForm'] ?></label>
              <input type="number" class="form-control" min="1" name="data[sortOrder]" id="sortOrder_e" value="<?php echo $sortOrder ?>" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="col-form-label" for="active"><?php echo $lang['activeForm'] ?></label><br />
              <input type="checkbox" name="active" id="active_e"<?php echo ($active == 1) ? ' checked' : '' ?> data-bootstrap-switch data-off-color="danger" data-on-color="success">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['tags'] ?></label>
              <div class="select2-success">
                <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" name="tags[]" id="tags_e" multiple data-placeholder="<?php echo $lang['chooseTag'] ?>">
                <?php
                  $tableTags = $prefixTable.$def['tableTags'];
                  $tags = $h->getAll($tableTags, "deleted_at is null and active = 1", "id asc");                  
                  foreach ($tags as $tag) {
                    $selected = (in_array($tag['id'], $tagArray)) ? ' selected': '';
                    echo '<option value="'.$tag['id'].'"'.$selected.'>'.$tag['titleTag'].'</option>';
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
        <button type="submit" id="updateProduct" class="btn btn-success"><?php echo $lang['updateText'] ?> <i class="fas fa-save"></i></button>
      </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<style type="text/css">
  #display-image-e, #display-image-sharefb-e {display: none;margin-top: 5px}
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
    showImageBeforeUpload('#imageProduct_e', '#display-image-e', 120); 
    showImageBeforeUpload('#imageShareFb_e', '#display-image-sharefb-e', 120); 
    $("input[data-bootstrap-switch]").each(function() {
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
  }); 
  <?php
		if (count($aImgDetail) > 0) {
      _e("var preloaded = [");
      foreach ($aImgDetail as $k => $g) {
        if (file_exists($def['imgUploadProductRealPath'].$g)) {
          $imgg = $def['imgUploadProduct'].$g;
          _e("{id: $k, src: '$imgg'},");
        }
      }
      _e("];");
	?>
	$('.gallery-image').imageUploader({
		preloaded: preloaded,
		imagesInputName: 'images',
		preloadedInputName: 'old'
	});
	<?php
		} 
	?>
</script>
<script type="text/javascript" src="<?php echo _tinymce ?>tinymce.min.js"></script>
<script type="text/javascript">
  tinymce.init({
    selector: "textarea#contentProduct<?php echo $lngDefault ?>_e",
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
