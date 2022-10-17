<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header container-fluid">
            <div class="row">
              <h3 class="col-md-12 card-title"><?php _e($lang['manageContact']) ?></h3>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          <div class="col-md-12 form-inline mb-2" role="form">
							<div class="form-group">
								<label><?php echo $lang['search'] ?>: </label>
								<input name="search_value" id="search_value" class="form-control w100 ml-2" type="text" placeholder="<?php _e($lang['contactName'].', email') ?>" />
							</div>

							<button id="ok" type="button" class="btn btn-success ml-1 mr-1"><?php echo $lang['search'] ?></button>
							<button id="btnReset" type="button" class="btn btn-success ml-1 mr-1"><?php echo $lang['all'] ?></button>
						</div>
            <table id="contacts" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th width="5%" align="center"><?php _e($lang['no.']) ?></th>
                  <th align="center"><?php _e($lang['contactName']) ?></th>
                  <th align="center"><?php _e('Email') ?></th>
                  <th align="center"><?php _e($lang['contactContent']) ?></th>
                  <th align="center"><?php _e($lang['contactTime']) ?></th>
                </tr>
              </thead>
              <tfoot>
								<tr>
                  <th width="5%" align="center"><?php _e($lang['no.']) ?></th>
                  <th align="center"><?php _e($lang['contactName']) ?></th>
                  <th align="center"><?php _e('Email') ?></th>
                  <th align="center"><?php _e($lang['contactContent']) ?></th>
                  <th align="center"><?php _e($lang['contactTime']) ?></th>
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
<!-- /.content -->
<script type="text/javascript">
    var backend_contact_list = "<?php echo $def['listDataContact'] ?>";
    var table_id = "#contacts";    
</script>
<script src="<?php echo $def['listDataContactJs'] ?>"></script>
