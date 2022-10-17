<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header container-fluid">
            <div class="row">
                <h3 class="col-md-12 card-title">
                    <?php _e($lang['manageAdmin']) ?>
										<a class="float-right btn btn-success cursorPointer add"><?php _e($lang['addText']) ?></a>
                </h3>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="col-md-12 form-inline mb-2" role="form">
							<div class="form-group">
								<label><?php _e($lang['search']) ?>: </label>
								<input name="search_value" id="search_value" class="form-control w100 ml-2" type="text" placeholder="<?php _e($lang['adminSearchText']) ?>" />
							</div>
							<button id="ok" type="button" class="btn btn-success ml-1 mr-1"><?php _e($lang['search']) ?></button>
							<button id="btnReset" type="button" class="btn btn-success ml-1 mr-1"><?php _e($lang['all']) ?></button>
              <button id="delete_multi" type="button" class="btn btn-danger ml-1 mr-1"><?php _e($lang['deleteMultiText']) ?></button>
						</div>
            <div id="passreset" class="text-center"></div>
            <table id="admins" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th width="5%" align="center"><?php _e($lang['no.']) ?></th>
                  <th align="center"><?php _e($lang['adminFullname']) ?></th>
                  <th align="center"><?php _e($lang['username']) ?></th>
                  <th align="center"><?php _e($lang['role']) ?></th>
                  <th align="center"><?php _e($lang['adminPhone']) ?></th>
                  <th width="10%" align="center"><?php _e($lang['activeForm']) ?></th>
                  <th width="9%" align="center"><?php _e($lang['actions']) ?></th>
                </tr>
              </thead>
              <tfoot>
								<tr>
                  <th width="5%" align="center"><?php _e($lang['no.']) ?></th>
                  <th align="center"><?php _e($lang['adminFullname']) ?></th>
                  <th align="center"><?php _e($lang['username']) ?></th>
                  <th align="center"><?php _e($lang['role']) ?></th>
                  <th align="center"><?php _e($lang['adminPhone']) ?></th>
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
    var backend_admins_list = "<?php _e($def['listDataAdmin']) ?>";
    var table_id = "#admins";    
		var addLink = "<?php _e($def['adminAdd']) ?>";
		var updateLink = "<?php _e($def['adminUpdate']) ?>";
		var processDelete = "<?php _e($def['adminDeleteProcess']) ?>";
    var processActive = "<?php _e($def['adminActiveProcess']) ?>";
    var adminText = "<?php _e($lang['adminText']) ?>";
    var fullnameText = "<?php _e($lang['adminFullname']) ?>";
    var usernameText = "<?php _e($lang['username']) ?>";
    var passwordText = "<?php _e($lang['password']) ?>";
    var confirmPasswordText = "<?php _e($lang['confirmPassword']) ?>";
</script>
<script src="<?php _e($def['listDataAdminJs']) ?>"></script>
