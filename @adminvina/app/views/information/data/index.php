<?php
	require_once "../../../../library.php";
	
	$options = [
		'draw' => $_REQUEST['draw'],
		'limit' => $_REQUEST['length'],
		'offset' => $_REQUEST['start'],
		'order' => 0,
		'dir' => $_REQUEST['order.0.dir'],
	];
	
	$wh = "deleted_at is null";
	if ($options['limit'] != '-1')
		$lim = " limit ".$options['offset'].", ".$options['limit'];
	else
		$lim = "";	
	
	$table = $prefixTable.$def['tableInformations'];
	$s = $h->query("select * from $table where $wh order by created_at desc, id desc");
	$no = 1;
	$totalData = $h->num_rows($s);
	if ($totalData > 0) {
		$totalFiltered = $totalData;
		$ss = $h->query("select * from $table where $wh order by created_at desc, id desc$lim");
		while ($info = $h->fetch_array($ss)) {
			if ($info['active'] == 1) {
				$textActive = $lang['deactiveForm'].' '.$lang['infoText'].' '.$lang['this'];
				$activeIcon = '<i class="fas fa-check-circle"></i>';
				$classActive = ' text-success';
				$act = 0;
			} else {
				$textActive = $lang['activeForm'].' '.$lang['infoText'].' '.$lang['this'];
				$activeIcon = '<i class="far fa-circle"></i>';
				$classActive = ' text-danger';
				$act = 1;
			}
			$active = '<a class="text-center'.$classActive.' active cursorPointer" rel="'.$info['id'].'" title="'.$textActive.'" data-active="'.$act.'"><h4>'.$activeIcon.'</h4></a>';
			$titleInfo = $info['titleInfo'];
			
			$actions = '<a class="btn btn-success btn-sm update cursorPointer" data-id="'.$info['id'].'"  title="'.$lang['updateText'].' '.$lang['infoText'].' '.$lang['this'].'"><i class="fas fa-edit"></i></a>';
			$a[] = array(
				"DT_RowId" => $info['id'],
				"DT_RowClass" => "choose_this",
				"no" => $no,
				"titleInfo" => $titleInfo,
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
