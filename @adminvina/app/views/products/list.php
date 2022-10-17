<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header container-fluid">
            <div class="row">
              <h3 class="col-md-12 card-title">
                <?php echo $lang['manageProduct'] ?>
                <a class="float-right btn btn-success cursorPointer add"><?php echo $lang['addText'] ?></a>
              </h3>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="col-md-12 form-inline mb-2" role="form">
							<div class="form-group">
								<label><?php echo $lang['search'] ?>: </label>
								<input name="search_value" id="search_value" class="form-control w100 ml-2" type="text" placeholder="Tiêu đề" />
                <div class="select2-success ml-2">
                  <select class="form-control select2 select2-success ml-2" data-drop-css-class="select2-success" name="filterCateID" id="filterCateID">
                    <option value="0"><?php _e($lang['chooseCate']) ?></option>
                    <?php 
                      $tableCateProduct = $prefixTable.$def['tableCategories'];
                      $cateProduct = $h->getAll($tableCateProduct, "deleted_at is null and active = 1 and cateID = 0", "cateID asc, sortOrder asc, created_at asc");
                      foreach ($cateProduct as $cate) {
                        _e('<option value="'.$cate['id'].'">'.$cate['titleCate'].'</option>');
                        $subCate = $h->getAll($tableCateProduct, "deleted_at is null and active = 1 and cateID = ".$cate['id'], "cateID asc, sortOrder asc, created_at asc");
                        foreach ($subCate as $scate) {
                          _e('<option value="'.$scate['id'].'"> -- '.$scate['titleCate'].'</option>');
                        }
                      }
                    ?>
                  </select>
                </div>
							</div>

							<button id="ok" type="button" class="btn btn-success ml-1 mr-1"><?php echo $lang['search'] ?></button>
							<button id="btnReset" type="button" class="btn btn-success ml-1 mr-1"><?php echo $lang['all'] ?></button>
              <button id="delete_multi" type="button" class="btn btn-danger ml-1 mr-1"><?php echo $lang['deleteMultiText'] ?></button>
						</div>
            <!--<div id="passreset" class="text-center"></div>-->
            <table id="products" class="table table-bordered table-hover table-striped"> <!--  table-striped -->
              <thead>
                <tr>
                  <th width="5%" align="center"><?php echo $lang['no.'] ?></th>
                  <th width="31%" align="center"><?php echo $lang['titleForm'] ?></th>
                  <th width="15%" align="center"><?php echo $lang['cate'] ?></th>
                  <th width="15%" align="center"><?php echo $lang['imageForm'] ?></th>                
                  <th width="10%" align="center"><?php echo $lang['priceText'] ?></th>
                  <th width="5%" align="center"><?php echo $lang['sortForm'] ?></th>
                  <th width="10%" align="center"><?php echo $lang['activeForm'] ?></th>
                  <th width="9%" align="center"><?php echo $lang['actions'] ?></th>
                </tr>
              </thead>
              <tfoot>
								<tr>
                  <th width="5%" align="center"><?php echo $lang['no.'] ?></th>
                  <th width="31%" align="center"><?php echo $lang['titleForm'] ?></th>
                  <th width="15%" align="center"><?php echo $lang['cate'] ?></th>
                  <th width="15%" align="center"><?php echo $lang['imageForm'] ?></th>                
                  <th width="10%" align="center"><?php echo $lang['priceText'] ?></th>
                  <th width="5%" align="center"><?php echo $lang['sortForm'] ?></th>
                  <th width="10%" align="center"><?php echo $lang['activeForm'] ?></th>
                  <th width="9%" align="center"><?php echo $lang['actions'] ?></th>
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
    var backend_product_list = "<?php echo $def['listDataProduct'] ?>";
    var table_id = "#products";    
		var addLink = "<?php echo $def['productAdd'] ?>";
		var updateLink = "<?php echo $def['productUpdate'] ?>";
		var processDelete = "<?php echo $def['productDeleteProcess'] ?>";
    var processActive = "<?php echo $def['productActiveProcess'] ?>";
    var processSort = "<?php echo $def['productSortProcess'] ?>";
    var cateProductText = "<?php echo $lang['cateProductText'] ?>";
    var productText = "<?php echo $lang['productText'] ?>";
</script>
<script src="<?php echo $def['listDataProductJs'] ?>"></script>
