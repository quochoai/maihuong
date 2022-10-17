<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header container-fluid">
            <div class="row">
                <h3 class="col-md-12 card-title">
                    <?php echo $lang['manageNews'] ?>
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
                <select class="form-control select2 select2-success ml-2" data-drop-css-class="select2-success" name="filterCateID" id="filterCateID">
                  <option value="0"><?php _e($lang['chooseCate']) ?></option>
                  <?php 
                    $tableCateNews = $prefixTable.$def['tableCategoriesNews'];
                    $cateNews = $h->getAll($tableCateNews, "deleted_at is null and active = 1", "sortOrder asc, created_at asc");
                    foreach ($cateNews as $cate) {
                      _e('<option value="'.$cate['id'].'">'.$cate['titleCate'].'</option>');
                    }
                  ?>

                </select>
							</div>

							<button id="ok" type="button" class="btn btn-success ml-1 mr-1"><?php echo $lang['search'] ?></button>
							<button id="btnReset" type="button" class="btn btn-success ml-1 mr-1"><?php echo $lang['all'] ?></button>
              <button id="delete_multi" type="button" class="btn btn-danger ml-1 mr-1"><?php echo $lang['deleteMultiText'] ?></button>
						</div>
            <!--<div id="passreset" class="text-center"></div>-->
            <table id="news" class="table table-bordered table-hover table-striped"> <!--  table-striped -->
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
    var backend_news_list = "<?php echo $def['listDataNews'] ?>";
    var table_id = "#news";    
		var addLink = "<?php echo $def['newsAdd'] ?>";
		var processAdd = "<?php echo $def['newsAddProcess'] ?>";
		var updateLink = "<?php echo $def['newsUpdate'] ?>";
		var processUpdate = "<?php echo $def['newsUpdateProcess'] ?>";
		var processDelete = "<?php echo $def['newsDeleteProcess'] ?>";
    var processActive = "<?php echo $def['newsActiveProcess'] ?>";
    var processSort = "<?php echo $def['newsSortProcess'] ?>";
    var processShowHide = "<?php echo $def['newsShowHideProcess'] ?>";
    var processApprove = "<?php echo $def['newsApproveProcess'] ?>";
    var cateNewsText = "<?php echo $lang['cateNewsText'] ?>";
    var newsText = "<?php echo $lang['newsText'] ?>";
</script>
<script src="<?php echo $def['listDataNewsJs'] ?>"></script>
