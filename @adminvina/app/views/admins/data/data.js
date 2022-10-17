jQuery(document).ready(function($) {
  fill_datatable();
  function fill_datatable(search_value) {
		if (typeof search_value === 'undefined'){
			search_value = null;
		}
		$(table_id).DataTable({
			"aoColumnDefs": [ {"bSortable" : false, "bAutoWidth": true, "aTargets" : [5, 6] } ],
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
				"url": backend_admins_list,
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
				{ data: 'fullname', name: 'fullname', className: "text-left text-nowrap small_text" },
				{ data: 'username', name: 'username', className: "text-center text-nowrap small_text" },
				{ data: 'role', name: 'role', className: "text-center text-nowrap small_text" },
				{ data: 'phone', name: 'phone', className: "text-center text-nowrap small_text" },
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
	$('#admins tbody').on('click', 'tr', function() {
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
				conf = deleteConfirmText + adminText + ' ' + thisText + ' ?';
			else
				conf = deleteMultiConfirmText + adminText + ' ' + thisText + ' ?';
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
		let conf = deleteConfirmText + adminText + ' ' + thisText + ' ?';
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
	let addAdmin = '#addAdmin';
	let btnAddAdmin = $(addAdmin);
	$(document).on('click', addAdmin, function() {
		let fullnameElement = $('#fullname');		
		let usernameElement = $('#username');
		let passwordElement = $('#password');
		let confirmPasswordElement = $('#confirmPassword');
		let fullname = $.trim(fullnameElement.val());
		let username = $.trim(usernameElement.val());
		let password = $.trim(passwordElement.val());
		let confirmPassword = $.trim(confirmPasswordElement.val());
		if (fullname == '') {
			toastr.error(notFill + fullnameText);
			fullnameElement.addClass('is-invalid');
			fullnameElement.focus();
			return false;
		} else {
			fullnameElement.removeClass('is-invalid');
			fullnameElement.addClass('is-valid');
		}
		if (username == '') {
			toastr.error(notFill + usernameText);
			usernameElement.addClass('is-invalid');
			usernameElement.focus();
			return false;
		} else {
			usernameElement.removeClass('is-invalid');
			usernameElement.addClass('is-valid');
		}
		if (password == '') {
			toastr.error(notFill + passwordText);
			passwordElement.addClass('is-invalid');
			passwordElement.focus();
			return false;
		} else {
			passwordElement.removeClass('is-invalid');
			passwordElement.addClass('is-valid');
		}
		if (confirmPassword == '') {
			toastr.error(notFill + confirmPasswordText);
			confirmPasswordElement.addClass('is-invalid');
			confirmPasswordElement.focus();
			return false;
		} else {
			confirmPasswordElement.removeClass('is-invalid');
			confirmPasswordElement.addClass('is-valid');
		}
		if (confirmPassword != password) {
			toastr.error(notMatchPassword);
			confirmPasswordElement.addClass('is-invalid');
			confirmPasswordElement.focus();
			return false;
		} else {
			confirmPasswordElement.removeClass('is-invalid');
			confirmPasswordElement.addClass('is-valid');
		}
		let formAdd = $('#form_add');
		formAdd.ajaxForm({
			beforeSend: function() {
				btnAddAdmin.attr("disabled",true);
				btnAddAdmin.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + processing); 
			},
			uploadProgress: function(event, position, total, percentComplete) {
													
			},
			success: function() {
					
			},
			complete: function(xhr) {
				btnAddAdmin.html(saveText + ' <i class="fas fa-save">');
				btnAddAdmin.removeAttr('disabled');
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
	let updateAdmin = '#updateAdmin';
	let btnUpdateAdmin = $(updateAdmin);
	$(document).on('click', updateAdmin, function() {
		let fullnameElement = $('#fullname_e');		
		let usernameElement = $('#username_e');
		let passwordElement = $('#password_e');
		let confirmPasswordElement = $('#confirmPassword_e');
		let fullname = $.trim(fullnameElement.val());
		let username = $.trim(usernameElement.val());
		let password = $.trim(passwordElement.val());
		let confirmPassword = $.trim(confirmPasswordElement.val());
		if (fullname == '') {
			toastr.error(notFill + fullnameText);
			fullnameElement.addClass('is-invalid');
			fullnameElement.focus();
			return false;
		} else {
			fullnameElement.removeClass('is-invalid');
			fullnameElement.addClass('is-valid');
		}
		if (username == '') {
			toastr.error(notFill + usernameText);
			usernameElement.addClass('is-invalid');
			usernameElement.focus();
			return false;
		} else {
			usernameElement.removeClass('is-invalid');
			usernameElement.addClass('is-valid');
		}
		if (confirmPassword != password) {
			toastr.error(notMatchPassword);
			confirmPasswordElement.addClass('is-invalid');
			confirmPasswordElement.focus();
			return false;
		} else {
			confirmPasswordElement.removeClass('is-invalid');
			confirmPasswordElement.addClass('is-valid');
		}
		let formUpdate = $('#form_update');
		formUpdate.ajaxForm({
			beforeSend: function() {
				btnUpdateAdmin.attr("disabled",true);
				btnUpdateAdmin.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + processing); 
			},
			uploadProgress: function(event, position, total, percentComplete) {
													
			},
			success: function() {
					
			},
			complete: function(xhr) {
				btnUpdateAdmin.html(updateText + ' <i class="fas fa-edit">');
				btnUpdateAdmin.removeAttr('disabled');
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

