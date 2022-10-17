<?php
  require_once "../../../../library.php";
  $id = $_POST['id'];
  $tableCateNews = $prefixTable.$def['tableCategoriesNews'];
  $table = $prefixTable.$def['tableNews'];
  $news = $h->getById($table, $id);
  $cateID = $news['cateID'];
  $titleNews = $news['titleNews'.$lngDefault];
  $imgNews = $news['imageNews'];
  
  if (file_exists($def['imgUploadNewsRealPath'].$imgNews) && !is_null($imgNews) && $imgNews != '') {
    $imgNewsShow = '<img src="'.$def['imgUploadNews'].$imgNews.'" width="120" height="auto" />';
    $dImgNews = ' style="display: block"';
  } else {
    $imgNewsShow = '';
    $dImgNews = '';
  }
    
  $imgShareFb = $news['imageShareFb'];
  if (file_exists($def['imgUploadNewsRealPath'].$imgShareFb) && !is_null($imgShareFb) && $imgShareFb != '') {
    $imgShareFbShow = '<img src="'.$def['imgUploadNews'].$imgShareFb.'" width="120" height="auto" />';
    $dImgNewsFb = ' style="display: block"';
  } else {
    $imgShareFbShow = '';
    $dImgNewsFb = '';
  }

  $active = $news['active'];
  $sortOrder = $news['sortOrder'];
  $pd = $news['postDate'];
  if ($pd != '' && !is_null($pd))
    $postDate = date("d/m/Y", strtotime($pd));
  else
    $postDate = '';
  if ($news['tags'] != '' && !is_null($news['tags']))
    $tagArray = explode(",", $news['tags']);
  else
    $tagArray = [];
  
  $shortContent = $news['shortContentNews'.$lngDefault];
  $content = $news['contentNews'.$lngDefault];
  $titleSeo = $news['titleSeo'.$lngDefault];
  $descriptionSeo = $news['descriptionSeo'.$lngDefault];
  $keywordSeo = $news['keywordSeo'.$lngDefault];  
?>
<!-- select2 -->
<link rel="stylesheet" href="<?php echo $def['themePlugins']; ?>select2/css/select2.min.css" />
<link rel="stylesheet" href="<?php echo $def['themePlugins']; ?>select2-bootstrap4-theme/select2-bootstrap4.min.css" />
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-success">
      <h5 class="modal-title text-uppercase"><?php echo $lang['updateNewsText'] ?></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="text-white">&times;</span>
      </button>
    </div>
    <!--  -->
    <form method="post" action="<?php echo $def['newsUpdateProcess'] ?>" id="form_update" enctype="multipart/form-data">
      <div class="modal-body container-fluid">
        <div class="row">
          <input type="hidden" name="idNews" value="<?php _e($id) ?>" />
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['titleForm'].$lngDefaultText ?></label>
              <input type="text" class="form-control" name="data[titleNews<?php echo $lngDefault ?>]" id="titleNews<?php echo $lngDefault ?>_e" value="<?php _e($titleNews) ?>" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['cate'] ?></label>
              <select class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" name="data[cateID]" id="cateID_e">
              <?php
                  $news = $h->getAll($tableCateNews, "deleted_at is null and active = 1", "sortOrder asc, id asc");                  
                  foreach ($news as $cate) {
                    if ($cate['id'] == $cateID)
                      $selected = ' selected';
                    else
                      $selected = '';
                    echo '<option value="'.$cate['id'].'"'.$selected.'>'.$cate['titleCate'].'</option>';
                  }
              ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label" for="imageNews_e"><?php echo $lang['imageForm'] ?></label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="imageNews_e" name="imageNews">
                  <label class="custom-file-label" for="imageNews_e"></label>
                </div>
              </div>
              <small class="text-danger"><i><?php echo $lang['sizeImageForm'] ?></i></small>
              <div id="display-image-e"<?php _e($dImgNews) ?>><?php _e($imgNewsShow) ?></div>
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
              <div id="display-image-sharefb-e"<?php _e($dImgNewsFb) ?>><?php _e($imgShareFbShow) ?></div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['shortContent'].$lngDefaultText ?></label>
              <textarea type="text" class="form-control" name="data[shortContentNews<?php echo $lngDefault ?>]" id="shortContentNews<?php echo $lngDefault ?>_e"><?php _e($shortContent) ?></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="name"><?php echo $lang['contentArticle'].$lngDefaultText ?></label>
              <textarea type="text" class="form-control" name="data[contentNews<?php echo $lngDefault ?>]" id="contentNews<?php echo $lngDefault ?>_e"><?php _e($content) ?></textarea>
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
              <label class="col-form-label" for="name"><?php echo $lang['postDate'] ?></label><br />
              <div class="input-group date" id="postDate_e" data-target-input="nearest">
                  <div class="input-group-prepend" data-target="#postDate_e" data-toggle="datetimepicker">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" name="data[postDate]" id="postDateGet_e" value="<?php _e($postDate) ?>" class="form-control datetimepicker-input" data-target="#postDate_e" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
              </div>
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
                    if (in_array($tag['id'], $tagArray))
                      $selected = ' selected';
                    else
                      $selected = '';
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
        <button type="submit" id="updateNews" class="btn btn-success"><?php echo $lang['save'] ?> <i class="fas fa-save"></i></button>
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
<!-- daterangepicker -->
<script src="<?php echo $def['themePlugins']; ?>moment/moment.min.js"></script>
<script src="<?php echo $def['themePlugins']; ?>inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?php echo $def['themePlugins']; ?>daterangepicker/daterangepicker.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
    $('.select2').select2();
    $('#postDateGet_e').inputmask('dd/mm/yyyy', {
      'placeholder': 'dd/mm/yyyy'
    });
    $('#postDate_e').datetimepicker({
      timePicker: false,
      format: 'DD/MM/YYYY'
    });
  });
  // show image before upload
  showImageBeforeUpload('#imageNews_e', '#display-image-e', 120); 
  showImageBeforeUpload('#imageShareFb_e', '#display-image-sharefb-e', 120); 
  $("input[data-bootstrap-switch]").each(function() {
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  }); 
</script>
<script type="text/javascript" src="<?php echo _tinymce ?>tinymce.min.js"></script>
<script type="text/javascript">
  tinymce.init({
    selector: "textarea#contentNews<?php echo $lngDefault ?>_e",
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
