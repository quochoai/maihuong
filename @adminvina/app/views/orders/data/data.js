jQuery(document).ready(function($) {
  fill_datatable();
  function fill_datatable(search_value, cateID) {
		if (typeof search_value === 'undefined')
			search_value = null;
		if (typeof cateID === 'undefined')
			cateID = 0;
		$(table_id).DataTable({
			"aoColumnDefs": [ {"bSortable" : false, "bAutoWidth": true, "aTargets" : [5] } ],
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
				"url": backend_orders_list,
				"dataType": "json",
				"type": "GET",
				"data":{search_value: search_value, cateID: cateID}
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
				{ data: 'titleOrder', name: 'titleOrder', className: "text-left text-nowrap small_text" },
				{ data: 'titleCate', name: 'titleCate', className: "text-left text-nowrap small_text" },
				{ data: 'imageOrder', name: 'imageOrder',className: "text-center text-nowrap small_text" },
				{ data: 'postDate', name: 'postDate',className: "text-center text-nowrap small_text" },
				{ data: 'sortOrder', name: 'sortOrder',className: "text-center text-nowrap small_text" },
				{ data: 'active', name: 'active', className: "text-center text-nowrap small_text" },
				{ data: 'actions', name: 'actions', className: "text-center text-nowrap" }
			]
		});
  }
  $(document).on('click', '#ok', function(){
		let search_value = $.trim($('#search_value').val());
		let cateID = $('#filterCateID').val();
		if (search_value != '' || cateID != 0) {
			$(table_id).DataTable().destroy();
			fill_datatable(search_value, cateID);
		}
  });
  $('input:not([type="submit"])').keypress(function (e) {
		if (e.which == 13) {
			let search_value = $.trim($('#search_value').val());
			let cateID = $('#filterCateID').val();
			if (search_value != '' || cateID != 0) {
				$(table_id).DataTable().destroy();
				fill_datatable(search_value, cateID);
			}
		}
  });
  $('#btnReset').click(function(){
		$(table_id).DataTable().state.clear();
		$(table_id).DataTable().destroy();
		fill_datatable('', 0);
  });
	let multi_id = [];
	$('#news tbody').on('click', 'tr', function() {
		let id = this.id;
		let index = $.inArray(id, multi_id);
		if (index === -1)
			multi_id.push(id);
		else
			multi_id.splice(index, 1);
		$(this).toggleClass('bg-gradient-warning');
	});
	// delete
	$(document).on('click', '#delete_multi', function() {
		let id = multi_id;
		let search_value = $.trim($('#search_value').val());
		let cateID = $('#filterCateID').val();
		if (multi_id.length < 1)
			alert(notChooseAny);
		else {
			let conf = "";
			if (multi_id.length == 1)
				conf = deleteConfirmText + orderText + ' ' + thisText + ' ?';
			else
				conf = deleteMultiConfirmText + orderText + ' ' + thisText + ' ?';
			if (confirm(conf)) {
				$('#delete_multi').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
				$.post(processDelete, {id: id}, function(data) {
					$('#delete_multi').html('<i class="fas fa-trash-alt"></i> ' + deleteMultiText);
					$(table_id).DataTable().destroy();
					fill_datatable(search_value, cateID);
				});
			}
		}
	});
	$(document).on('click', '.delete', function() {
		let id = $(this).attr('data-id');
		let search_value = $.trim($('#search_value').val());
		let cateID = $('#filterCateID').val();
		let conf = deleteConfirmText + orderText + ' ' + thisText + ' ?';
		if (confirm(conf)) {
			$(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
			$.post(processDelete, {id: id}, function(data) {
				$(this).html('<i class="fas fa-trash-alt"></i>');
				$(table_id).DataTable().destroy();
				fill_datatable(search_value, cateID);
			});
		}
	});
	// active
	$(document).on('click', '.active', function() {
		let id = $(this).attr('rel');
		let act = $(this).attr('data-active');
		let search_value = $.trim($('#search_value').val());
		let cateID = $('#filterCateID').val();
		
		$(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
		$.post(processActive, {id: id, active: act}, function(data) {
			$(table_id).DataTable().destroy();
			fill_datatable(search_value, cateID);
		});
	});
	// sort
	$(document).on('change', '.sortUpdate', function() {
		let id = $(this).attr('id');
		let sortOrder = $(this).val();
		let search_value = $.trim($('#search_value').val());
		let cateID = $('#filterCateID').val();
		$(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
		$.post(processSort, {id: id, sortOrder: sortOrder}, function(data) {
			$(table_id).DataTable().destroy();
			fill_datatable(search_value, cateID);
		});
	}).change();
	// add
	let modalAdd = $('#modal-add');
  $(document).on('click', '.add', function(){
    $.post(addLink, function(dataResponse){
      modalAdd.html(dataResponse);
      modalAdd.modal('show');
    });    
  });
	let addOrder = '#addOrder';
	let btnAddOrder = $(addOrder);
	$(document).on('click', addOrder, function() {
		let titleOrderElement = $('#titleOrder'+lngDefault);		
		let titleOrder = $.trim(titleOrderElement.val());
		if (titleOrder == '') {
			toastr.error(notFill + 'tiêu đề ' + orderText);
			titleOrderElement.addClass('is-invalid');
			titleOrderElement.focus();
			return false;
		} else {
			titleOrderElement.removeClass('is-invalid');
			titleOrderElement.addClass('is-valid');
		}
		let formAdd = $('#form_add');
		formAdd.ajaxForm({
			beforeSend: function() {
				btnAddOrder.attr("disabled",true);
				btnAddOrder.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + processing); 
			},
			uploadProgress: function(event, position, total, percentComplete) {
													
			},
			success: function() {
					
			},
			complete: function(xhr) {
				btnAddOrder.html(saveText + ' <i class="fas fa-save">');
				btnAddOrder.removeAttr('disabled');
				var text = xhr.responseText;
				var n = text.split(";");
				if(n[0] == '1'){
					toastr.success(addSuccessText);
					modalAdd.modal('hide');
					$(table_id).DataTable().state.clear();
					let search_value = $.trim($('#search_value').val());
					let cateID = $('#filterCateID').val();
					$(table_id).DataTable().destroy();
					fill_datatable(search_value, cateID);
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
	let updateOrder = '#updateOrder';
	let btnUpdateOrder = $(updateOrder);
	$(document).on('click', updateOrder, function() {
		let titleOrderElement_e = $('#titleOrder'+lngDefault+'_e');		
		let titleOrder_e = $.trim(titleOrderElement_e.val());
		if (titleOrder_e == '') {
			toastr.error(notFill + 'tiêu đề ' + orderText);
			titleOrderElement_e.addClass('is-invalid');
			titleOrderElement_e.focus();
			return false;
		} else {
			titleOrderElement_e.removeClass('is-invalid');
			titleOrderElement_e.addClass('is-valid');
		}
		let formUpdate = $('#form_update');
		formUpdate.ajaxForm({
			beforeSend: function() {
				btnUpdateOrder.attr("disabled",true);
				btnUpdateOrder.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + processing); 
			},
			uploadProgress: function(event, position, total, percentComplete) {
													
			},
			success: function() {
					
			},
			complete: function(xhr) {
			 	btnUpdateOrder.html(updateText + ' <i class="fas fa-edit">');
				btnUpdateOrder.removeAttr('disabled');
				var text = xhr.responseText;
				var n = text.split(";");
				if(n[0] == '1'){
					toastr.success(updateSuccessText);
					modalUpdate.modal('hide');
					let search_value = $.trim($('#search_value').val());
					let cateID = $('#filterCateID').val();
					$(table_id).DataTable().destroy();
					fill_datatable(search_value, cateID);
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

