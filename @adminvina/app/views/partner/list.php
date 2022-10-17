<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header container-fluid">
            <div class="row">
                <h3 class="col-md-12 card-title">
                    <?php echo $lang['managePartner'] ?>
										<a class="float-right btn btn-success cursorPointer add"><?php echo $lang['addText'] ?></a>
                </h3>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="col-md-12 form-inline mb-2" role="form">
							<div class="form-group">
								<label><?php echo $lang['search'] ?>: </label>
								<input name="search_value" id="search_value" class="form-control w100 ml-2" type="text" placeholder="<?php _e($lang['partnerName']) ?>" />
							</div>

							<button id="ok" type="button" class="btn btn-success ml-1 mr-1"><?php echo $lang['search'] ?></button>
							<button id="btnReset" type="button" class="btn btn-success ml-1 mr-1"><?php echo $lang['all'] ?></button>
						</div>
            <table id="partners" class="table table-bordered table-hover table-striped"> <!--  table-striped -->
              <thead>
                <tr>
                  <th width="5%" align="center"><?php echo $lang['no.'] ?></th>
                  <th align="center"><?php echo $lang['partnerName'] ?></th>
                  <th width="15%" align="center"><?php echo $lang['partnerLogo'] ?></th>                
                  <th width="5%" align="center"><?php echo $lang['sortForm'] ?></th>
                  <th width="10%" align="center"><?php echo $lang['activeForm'] ?></th>
                  <th width="9%" align="center"><?php echo $lang['actions'] ?></th>
                </tr>
              </thead>
              <tfoot>
								<tr>
                  <th width="5%" align="center"><?php echo $lang['no.'] ?></th>
                  <th align="center"><?php echo $lang['partnerName'] ?></th>
                  <th width="15%" align="center"><?php echo $lang['partnerLogo'] ?></th>
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
    var backend_partner_list = "<?php echo $def['listDataPartner'] ?>";
    var table_id = "#partners";    
		var addLink = "<?php echo $def['partnerAdd'] ?>";
		var updateLink = "<?php echo $def['partnerUpdate'] ?>";
		var processDelete = "<?php echo $def['partnerDeleteProcess'] ?>";
    var processActive = "<?php echo $def['partnerActiveProcess'] ?>";
    var processSort = "<?php echo $def['partnerSortProcess'] ?>";
    var partnerText = "<?php echo $lang['partnerText'] ?>";
    var partnerLogo = "<?php _e($lang['partnerLogo']) ?>";
</script>
<script src="<?php echo $def['listDataPartnerJs'] ?>"></script>
