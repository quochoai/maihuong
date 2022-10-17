<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header container-fluid">
            <div class="row">
                <h3 class="col-md-12 card-title">
                    <?php echo $lang['manageOrders'] ?>
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
                <div class="select2-success">
                  <select class="form-control select2 select2-success ml-2" data-drop-css-class="select2-success" name="filterCateID" id="filterCateID">
                    <option value="0"><?php _e($lang['chooseCate']) ?></option>
                    <?php 
                      $tableCateOrder = $prefixTable.$def['tableCategoriesOrders'];
                      $cateOrder = $h->getAll($tableCateOrder, "deleted_at is null and active = 1", "sortOrder asc, created_at asc");
                      foreach ($cateOrder as $cate) {
                        _e('<option value="'.$cate['id'].'">'.$cate['titleCate'].'</option>');
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
            <table id="orders" class="table table-bordered table-hover table-striped"> <!--  table-striped -->
              <thead>
                <tr>
                  <th width="5%" align="center"><?php echo $lang['no.'] ?></th>
                  <th align="center"><?php echo $lang['titleForm'] ?></th>
                  <th align="center"><?php echo $lang['cate'] ?></th>
                  <th width="15%" align="center"><?php echo $lang['imageForm'] ?></th>                
                  <th width="10%" align="center"><?php echo $lang['postDate'] ?></th>
                  <th width="5%" align="center"><?php echo $lang['sortForm'] ?></th>
                  <th width="10%" align="center"><?php echo $lang['activeForm'] ?></th>
                  <th width="9%" align="center"><?php echo $lang['actions'] ?></th>
                </tr>
              </thead>
              <tfoot>
								<tr>
                  <th width="5%" align="center"><?php echo $lang['no.'] ?></th>
                  <th align="center"><?php echo $lang['titleForm'] ?></th>
                  <th align="center"><?php echo $lang['cate'] ?></th>
                  <th width="15%" align="center"><?php echo $lang['imageForm'] ?></th>                
                  <th width="10%" align="center"><?php echo $lang['postDate'] ?></th>
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
    var backend_orders_list = "<?php echo $def['listDataOrder'] ?>";
    var table_id = "#orders";    
		var addLink = "<?php echo $def['orderAdd'] ?>";
		var processAdd = "<?php echo $def['orderAddProcess'] ?>";
		var updateLink = "<?php echo $def['orderUpdate'] ?>";
		var processUpdate = "<?php echo $def['orderUpdateProcess'] ?>";
		var processDelete = "<?php echo $def['orderDeleteProcess'] ?>";
    var processActive = "<?php echo $def['orderActiveProcess'] ?>";
    var processSort = "<?php echo $def['orderSortProcess'] ?>";
    var cateOrderText = "<?php echo $lang['cateOrderText'] ?>";
    var orderText = "<?php echo $lang['orderText'] ?>";
</script>
<script src="<?php echo $def['listDataOrderJs'] ?>"></script>
