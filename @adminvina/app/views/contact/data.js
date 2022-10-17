jQuery(document).ready(function($) {
  fill_datatable();
  function fill_datatable(search_value) {
		if (typeof search_value === 'undefined'){
			search_value = null;
		}
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
				"url": backend_tags_list,
				"dataType": "json",
				"type": "GET",
				"data":{search_value: search_value}
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
				{ data: 'titleTag', name: 'titleTag', className: "text-left text-nowrap small_text" },
				{ data: 'active', name: 'active', className: "text-center text-nowrap small_text" },
				{ data: 'actions', name: 'actions', className: "text-center text-nowrap" }
			]
		});
  }
  $(document).on('click', '#ok', function(){
		var search_value = $.trim($('#search_value').val());
		if (search_value != '') {
			$(table_id).DataTable().destroy();
			fill_datatable(search_value);
		}
  });
  $('input:not([type="submit"])').keypress(function (e) {
		if (e.which == 13) {
			var search_value = $.trim($('#search_value').val());
			if (search_value != '') {
				$(table_id).DataTable().destroy();
				fill_datatable(search_value);
			}
		}
  });
  $('#btnReset').click(function(){
		$(table_id).DataTable().state.clear();
		$(table_id).DataTable().destroy();
		fill_datatable('');
  });
	let multi_id = [];
	$('#tags tbody').on('click', 'tr', function() {
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
		if (multi_id.length < 1)
			alert(notChooseAny);
		else {
			let conf = "";
			if (multi_id.length == 1)
				conf = deleteConfirmText + tagText + ' ' + thisText + ' ?';
			else
				conf = deleteMultiConfirmText + tagText + ' ' + thisText + ' ?';
			if (confirm(conf)) {
				let search_value = $.trim($('#search_value').val());
				$('#delete_multi').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
				$.post(processDelete, {id: id}, function(data) {
					$('#delete_multi').html('<i class="fas fa-trash-alt"></i> ' + deleteMultiText);
					$(table_id).DataTable().destroy();
					fill_datatable(search_value);
				});
			}
		}
	});
	$(document).on('click', '.delete', function() {
		let id = $(this).attr('data-id');
		let conf = deleteConfirmText + tagText + ' ' + thisText + ' ?';
		if (confirm(conf)) {
			let search_value = $.trim($('#search_value').val());
			$(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
			$.post(processDelete, {id: id}, function(data) {
				$(this).html('<i class="fas fa-trash-alt"></i>');
				$(table_id).DataTable().destroy();
				fill_datatable(search_value);
			});
		}
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
	let addTag = '#addTag';
	let btnAddTag = $(addTag);
	$(document).on('click', addTag, function() {
		let titleTagElement = $('#titleTag'+lngDefault);		
		let titleTag = $.trim(titleTagElement.val());
		if (titleTag == '') {
			toastr.error(notFill + 'tên ' + tagText);
			titleTagElement.addClass('is-invalid');
			titleTagElement.focus();
			return false;
		} else {
			titleTagElement.removeClass('is-invalid');
			titleTagElement.addClass('is-valid');
		}
		let formAdd = $('#form_add');
		formAdd.ajaxForm({
			beforeSend: function() {
				btnAddTag.attr("disabled",true);
				btnAddTag.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + processing); 
			},
			uploadProgress: function(event, position, total, percentComplete) {
													
			},
			success: function() {
					
			},
			complete: function(xhr) {
			 	btnAddTag.html(saveText + ' <i class="fas fa-save">');
				btnAddTag.removeAttr('disabled');
				var text = xhr.responseText;
				var n = text.split(";");
				if(n[0] == '1'){
					toastr.success(addSuccessText);
					modalAdd.modal('hide');
					$(table_id).DataTable().state.clear();
					let search_value = '';
					$(table_id).DataTable().destroy();
					fill_datatable(search_value);
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
	let updateTag = '#updateTag';
	let btnUpdateTag = $(updateTag);
	$(document).on('click', updateTag, function() {
		let titleTagElement_e = $('#titleTag'+lngDefault+'_e');		
		let titleTag_e = $.trim(titleTagElement_e.val());
		if (titleTag_e == '') {
			toastr.error(notFill + 'tên ' + tagText);
			titleTagElement_e.addClass('is-invalid');
			titleTagElement_e.focus();
			return false;
		} else {
			titleTagElement_e.removeClass('is-invalid');
			titleTagElement_e.addClass('is-valid');
		}
		let formUpdate = $('#form_update');
		formUpdate.ajaxForm({
			beforeSend: function() {
				btnUpdateTag.attr("disabled",true);
				btnUpdateTag.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + processing); 
			},
			uploadProgress: function(event, position, total, percentComplete) {
													
			},
			success: function() {
					
			},
			complete: function(xhr) {
				btnUpdateTag.html(updateText + ' <i class="fas fa-edit">');
				btnUpdateTag.removeAttr('disabled');
				var text = xhr.responseText;
				var n = text.split(";");
				if(n[0] == '1'){
					toastr.success(updateSuccessText);
					modalUpdate.modal('hide');
					let search_value = $.trim($('#search_value').val());
					$(table_id).DataTable().destroy();
					fill_datatable(search_value);
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

