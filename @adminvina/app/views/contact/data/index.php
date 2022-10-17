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
			$whh .= "(fullname like '%$search_value%' or email like '%$search_value%')";
		$wh = $whh;
		if ($options['limit'] != '-1')
			$lim = " limit ".$options['offset'].", ".$options['limit'];
		else
			$lim = "";
	}
	
	$table = $prefixTable.$def['tableContact'];

	$s = $h->query("select * from $table where $wh order by created_at desc, id desc");
	$no = 1;
	$totalData = $h->num_rows($s);
		if ($totalData > 0) {
		$totalFiltered = $totalData;
		$ss = $h->query("select * from $table where $wh order by created_at asc, id asc");
		while ($contact = $h->fetch_array($ss)) {
			$fullname = $contact["fullname"];
			$email = $contact['email'];
			$content = $contact['content'];
			$time = date("d/m/Y H:i:s", strtotime($contact['created_at']));

			$a[] = array(
				"DT_RowId" => $contact['id'],
				"DT_RowClass" => "choose_this",
				"no" => $no,
				"fullname" => $fullname, 
				'email' => $email,
				'content' => $content,
				'contactTime' => $time,
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
