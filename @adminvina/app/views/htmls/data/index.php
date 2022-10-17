<?php
	require_once "../../../../library.php";
	
	$options = [
		'draw' => $_REQUEST['draw'],
		'search_value' => trim($_REQUEST['search_value']),
		'limit' => $_REQUEST['length'],
		'offset' => $_REQUEST['start'],
		'order' => 0,
		'dir' => $_REQUEST['order.0.dir'],
	];
	$search_value = $options['search_value'];    
	if ($search_value == '') {
		$wh = "1=1";
		if ($options['limit'] != '-1')
			$lim = " limit ".$options['offset'].", ".$options['limit'];
		else
			$lim = "";
	} else {
		$whh = "";
		if ($search_value != '')
			$whh .= "title like '%$search_value%'";
		$wh = $whh;
		if ($options['limit'] != '-1')
			$lim = " limit ".$options['offset'].", ".$options['limit'];
		else
			$lim = "";
	}
	
	$table = $prefixTable.$def['tableHtmls'];

	$s = $h->query("select * from $table where $wh order by created_at desc, id desc");
	$no = 1;
	$totalData = $h->num_rows($s);
		if ($totalData > 0) {
		$totalFiltered = $totalData;
		$ss = $h->query("select * from $table where $wh order by created_at asc, id asc");
		while ($html = $h->fetch_array($ss)) {
			$titleHtml = $html["title$lngDefault"];
			$actions = '<a class="btn btn-success btn-sm update cursorPointer" data-id="'.$html['id'].'"  title="'.$lang['updateText'].' html '.$lang['this'].'"><i class="fas fa-edit"></i>';

			$a[] = array(
				"DT_RowId" => $html['id'],
				"DT_RowClass" => "choose_this",
				"no" => $no,
				"titleHtml" => $titleHtml, 
				'actions' => $actions
			);
			$no++;
		}
	} else {
		$totalFiltered = 0;
		$a = array();
	}
	$json_data = array(
		"draw"            => $options['draw'],
		"recordsTotal"    => $totalData,
		"recordsFiltered" => $totalFiltered,
		"data"            => $a
	);
	echo json_encode($json_data);
