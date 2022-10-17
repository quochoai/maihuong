jQuery(document).ready(function($) {
  fill_datatable();
  function fill_datatable() {
		$(table_id).DataTable({
			"aoColumnDefs": [ {"bSortable" : false, "bAutoWidth": true, "aTargets" : [2,3] } ],
			"paging": true,
			"lengthChange": true,
			"ordering": false,
			"info": true,
			"autoWidth": true,
			stateSave: true,
			
			//"responsive": true,
			"lengthMenu": [[20, 25, 30, 50, 100, -1], [20, 25, 30, 50, 100, all_page]],
			//scrollY: sy,
			scrollX:        true,
			scrollCollapse: true,
			fixedColumns:   {
				leftColumns: 0,
				rightColumns: 0
			},
			"language": {
				"url": lang_url
			},
			//pageLength: 2,
			"searching": false,
			processing: true,
			serverSide: true,
			ajax: {
				"url": backend_informations_list,
				"dataType": "json",
				"type": "GET"
			},
			"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api(), data;
			},
			"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				$(nRow).attr("data-id",aData[1]);
				return nRow;
			},
			columns: [
				{ data: 'no', name: 'no',className: "text-center text-nowrap small_text" },
				{ data: 'titleInfo', name: 'titleInfo', className: "text-left text-nowrap small_text" },
				{ data: 'active', name: 'active', className: "text-center text-nowrap small_text" },
				{ data: 'actions', name: 'actions', className: "text-center text-nowrap" }
			]
		});
  }
    $('#btnReset').click(function(){
		$(table_id).DataTable().state.clear();
		$(table_id).DataTable().destroy();
		fill_datatable();
  });
	
	// active
	$(document).on('click', '.active', function() {
		let id = $(this).attr('rel');
		let act = $(this).attr('data-active');
		let search_value = $.trim($('#search_value').val());
		$(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
		$.post(processActive, {id: id, active: act}, function(data) {
			$(table_id).DataTable().destroy();
			fill_datatable(search_value);
		});
	});
	// add
	let modalAdd = $('#modal-add');
  $(document).on('click', '.add', function(){
    $.post(addLink, function(dataResponse){
      modalAdd.html(dataResponse);
      modalAdd.modal('show');
    });    
  });
	let addInfo = '#addInfo';
	let btnAddInfo = $(addInfo);
	$(document).on('click', addInfo, function() {
		let titleInfoElement = $('#titleInfo'+lngDefault);		
		let titleInfo = $.trim(titleInfoElement.val());
		if (titleInfo == '') {
			toastr.error(notFill + 'tên ' + infoText);
			titleInfoElement.addClass('is-invalid');
			titleInfoElement.focus();
			return false;
		} else {
			titleInfoElement.removeClass('is-invalid');
			titleInfoElement.addClass('is-valid');
		}
		let formAdd = $('#form_add');
		formAdd.ajaxForm({
			beforeSend: function() {
				btnAddInfo.attr("disabled",true);
				btnAddInfo.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + processing); 
			},
			uploadProgress: function(event, position, total, percentComplete) {
													
			},
			success: function() {
					
			},
			complete: function(xhr) {
			 	btnAddInfo.html(saveText + ' <i class="fas fa-save">');
				btnAddInfo.removeAttr('disabled');
				var text = xhr.responseText;
				var n = text.split(";");
				if(n[0] == '1'){
					toastr.success(addSuccessText);
					modalAdd.modal('hide');
					$(table_id).DataTable().state.clear();
					$(table_id).DataTable().destroy();
					fill_datatable();
				} else {   
					if (n[0] == '5') {
						toastr.error(sessionTimeout);
						setTimeout(function() {
							window.location.reload();
						}, 1000);
					} else {
						toastr.error(system_error);
						return false;
					}	
				}
 			}
		});
	});
	// update
	let modalUpdate = $('#modal-update');
	$(document).on('click', '.update', function(){
		let id = $(this).attr('data-id');
    $.post(updateLink, {id: id}, function(dataResponse){
      modalUpdate.html(dataResponse);
      modalUpdate.modal('show');
    });    
  });
	let updateInfo = '#updateInfo';
	let btnUpdateInfo = $(updateInfo);
	$(document).on('click', updateInfo, function() {
		let titleInfoElement_e = $('#titleInfo'+lngDefault+'_e');		
		let titleInfo_e = $.trim(titleInfoElement_e.val());
		if (titleInfo_e == '') {
			toastr.error(notFill + 'tên ' + infoText);
			titleInfoElement_e.addClass('is-invalid');
			titleInfoElement_e.focus();
			return false;
		} else {
			titleInfoElement_e.removeClass('is-invalid');
			titleInfoElement_e.addClass('is-valid');
		}
		let formUpdate = $('#form_update');
		formUpdate.ajaxForm({
			beforeSend: function() {
				btnUpdateInfo.attr("disabled",true);
				btnUpdateInfo.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + processing); 
			},
			uploadProgress: function(event, position, total, percentComplete) {
													
			},
			success: function() {
					
			},
			complete: function(xhr) {
				btnUpdateInfo.html(updateText + ' <i class="fas fa-edit">');
				btnUpdateInfo.removeAttr('disabled');
				var text = xhr.responseText;
				var n = text.split(";");
				if(n[0] == '1'){
					toastr.success(updateSuccessText);
					modalUpdate.modal('hide');
					$(table_id).DataTable().destroy();
					fill_datatable();
				} else {   
					if (n[0] == '5') {
						toastr.error(sessionTimeout);
						setTimeout(function() {
							window.location.reload();
						}, 1000);
					} else {
						toastr.error(system_error);
						return false;
					}	
				}
 			}
		});
	});

});

