<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header container-fluid">
            <div class="row">
                <h3 class="col-md-12 card-title">
                    <?php _e($lang['manageCategoryProduct']) ?>
										<a class="float-right btn btn-success cursorPointer add"><?php _e($lang['addText']) ?></a>
                </h3>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="col-md-12 form-inline mb-2" role="form">
							<div class="form-group">
								<label><?php _e($lang['search']) ?>: </label>
								<input name="search_value" id="search_value" class="form-control w100 ml-2" type="text" placeholder="Tiêu đề" />
                <div class="select2-success">
                  <select class="form-control select2 select2-success ml-2" data-drop-css-class="select2-success" name="filterCateID" id="filterCateID">
                    <option value=""><?php _e($lang['chooseCate']) ?></option>
                    <?php 
                      $tableCateProduct = $prefixTable.$def['tableCategories'];
                      $cateProduct = $h->getAll($tableCateProduct, "deleted_at is null and active = 1 and cateID = 0", "sortOrder asc, created_at asc");
                      foreach ($cateProduct as $cate) {
                        _e('<option value="'.$cate['id'].'">'.$cate['titleCate'].'</option>');
                      }
                    ?>
                  </select>
                </div>
							</div>
							<button id="ok" type="button" class="btn btn-success ml-1 mr-1"><?php _e($lang['search']) ?></button>
							<button id="btnReset" type="button" class="btn btn-success ml-1 mr-1"><?php _e($lang['all']) ?></button>
              <button id="delete_multi" type="button" class="btn btn-danger ml-1 mr-1"><?php _e($lang['deleteMultiText']) ?></button>
						</div>
            <div id="passreset" class="text-center"></div>
            <table id="categories" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th width="5%" align="center"><?php _e($lang['no.']) ?></th>
                  <th align="center"><?php _e($lang['titleForm']) ?></th>                
                  <th align="center"><?php _e($lang['subCate']) ?></th>
                  <th width="5%" align="center"><?php _e($lang['sortForm']) ?></th>
                  <th width="10%" align="center"><?php _e($lang['activeForm']) ?></th>
                  <th width="9%" align="center"><?php _e($lang['actions']) ?></th>
                </tr>
              </thead>
              <tfoot>
								<tr>
                  <th width="5%" align="center"><?php _e($lang['no.']) ?></th>
                  <th align="center"><?php _e($lang['titleForm']) ?></th>
                  <th align="center"><?php _e($lang['subCate']) ?></th>                
                  <th width="5%" align="center"><?php _e($lang['sortForm']) ?></th>
                  <th width="10%" align="center"><?php _e($lang['activeForm']) ?></th>
                  <th width="9%" align="center"><?php _e($lang['actions']) ?></th>
								</tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- add -->
<div class="modal fade" id="modal-add"></div>
<!-- update -->
<div class="modal fade" id="modal-update"></div>

<!-- /.content -->
<script type="text/javascript">
  var backend_cates_list = "<?php _e($def['listDataCateProduct']) ?>";
  var table_id = "#categories";    
  var addLink = "<?php _e($def['cateProductAdd']) ?>";
  var updateLink = "<?php _e($def['cateProductUpdate']) ?>";
  var processDelete = "<?php _e($def['cateProductDeleteProcess']) ?>";
  var processActive = "<?php _e($def['cateProductActiveProcess']) ?>";
  var processSort = "<?php _e($def['cateProductSortProcess']) ?>";
  var cateProductText = "<?php _e($lang['cateProductText']) ?>";
  var productText = "<?php _e($lang['productText']) ?>";
</script>
<script src="<?php _e($def['listDataCateProductJs']) ?>"></script>
