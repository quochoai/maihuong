<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header container-fluid">
            <div class="row">
                <h3 class="col-md-12 card-title">
                    <?php echo $lang['manageInformation'] ?>
                    <?php 
                      if ($role == 1) 
                        _e('<a class="float-right btn btn-success cursorPointer add">'.$lang['addText'].'</a>');
                    ?>
										<a id="btnReset" class="float-right btn btn-success cursorPointer ml-1 mr-1"><?php echo $lang['reload'] ?></a>
                </h3>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="col-md-12 form-inline mb-2" role="form">
							
						</div>
            <div id="passreset" class="text-center"></div>
            <table id="informations" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th width="5%" align="center"><?php echo $lang['no.'] ?></th>
                  <th width="75%" align="center"><?php echo $lang['titleForm'] ?></th>
                  <th width="10%" align="center"><?php echo $lang['activeForm'] ?></th>
                  <th width="9%" align="center"><?php echo $lang['actions'] ?></th>
                </tr>
              </thead>
              <tfoot>
								<tr>
                  <th width="5%" align="center"><?php echo $lang['no.'] ?></th>
                  <th width="75%" align="center"><?php echo $lang['titleForm'] ?></th>
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
    var backend_informations_list = "<?php echo $def['listDataInfo'] ?>";
    var table_id = "#informations";    
		var addLink = "<?php echo $def['infoAdd'] ?>";
		var processAdd = "<?php echo $def['infoAddProcess'] ?>";
		var updateLink = "<?php echo $def['infoUpdate'] ?>";
		var processUpdate = "<?php echo $def['infoUpdateProcess'] ?>";
    var processActive = "<?php echo $def['infoActiveProcess'] ?>";
    var infoText = "<?php echo $lang['infoText'] ?>";
</script>
<script src="<?php echo $def['listDataInfoJs'] ?>"></script>
