jQuery(document).ready(function($) {
  fill_datatable();
  function fill_datatable(search_value) {
		if (typeof search_value === 'undefined')
			search_value = null;
		$(table_id).DataTable({
			"aoColumnDefs": [ {"bSortable" : false, "bAutoWidth": true, "aTargets" : [2] } ],
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
				"url": backend_contact_list,
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
				{ data: 'email', name: 'email', className: "text-left text-nowrap small_text" },
				{ data: 'content', name: 'content', className: "text-left small_text" },
				{ data: 'contactTime', name: 'contactTime', className: "text-center text-nowrap small_text" }
			]
		});
  }
  $(document).on('click', '#ok', function(){
		let search_value = $.trim($('#search_value').val());
		if (search_value != '') {
			$(table_id).DataTable().destroy();
			fill_datatable(search_value);
		}
  });
  $('input:not([type="submit"])').keypress(function (e) {
		if (e.which == 13) {
			let search_value = $.trim($('#search_value').val());
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
});
