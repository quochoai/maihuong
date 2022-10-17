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
		$wh = "deleted_at is null";
		if ($options['limit'] != '-1')
			$lim = " limit ".$options['offset'].", ".$options['limit'];
		else
			$lim = "";
	} else {
		$whh = "";
		if ($search_value != '')
			$whh .= " and titleTag like '%$search_value%'";
		$wh = "deleted_at is null".$whh;
		if ($options['limit'] != '-1')
			$lim = " limit ".$options['offset'].", ".$options['limit'];
		else
			$lim = "";
	}
	
	$table = $prefixTable.$def['tableTags'];
	$s = $h->query("select * from $table where $wh order by created_at desc, id desc");
	$no = 1;
	$totalData = $h->num_rows($s);
	if ($totalData > 0) {
		$totalFiltered = $totalData;
		$ss = $h->query("select * from $table where $wh order by created_at desc, id desc$lim");
		while ($tag = $h->fetch_array($ss)) {
			if ($tag['active'] == 1) {
				$textActive = $lang['deactiveForm'].' '.$lang['tagText'].' '.$lang['this'];
				$activeIcon = '<i class="fas fa-check-circle"></i>';
				$classActive = ' text-success';
				$act = 0;
			} else {
				$textActive = $lang['activeForm'].' '.$lang['tagText'].' '.$lang['this'];
				$activeIcon = '<i class="far fa-circle"></i>';
				$classActive = ' text-danger';
				$act = 1;
			}
			$active = '<a class="text-center'.$classActive.' active cursorPointer" rel="'.$tag['id'].'" title="'.$textActive.'" data-active="'.$act.'"><h4>'.$activeIcon.'</h4></a>';
			$titleTag = $tag['titleTag'];
			
			$actions = '<a class="btn btn-success btn-sm update cursorPointer" data-id="'.$tag['id'].'"  title="'.$lang['updateText'].' '.$lang['tagText'].' '.$lang['this'].'"><i class="fas fa-edit"></i></a> | <a class="btn btn-danger btn-sm delete cursorPointer" data-id="'.$tag['id'].'" title="'.$lang['deleteText'].' '.$lang['tagText'].' '.$lang['this'].'"><i class="fas fa-trash-alt"></i></a></a>';
			$a[] = array(
				"DT_RowId" => $tag['id'],
				"DT_RowClass" => "choose_this",
				"no" => $no,
				"titleTag" => $titleTag,
				"active" => $active, 
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
