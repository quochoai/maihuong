<?php
	require_once "../../../../library.php";
	
	$options = [
		'draw' => $_REQUEST['draw'],
		'search_value' => trim($_REQUEST['search_value']),
		'cateID' => trim($_REQUEST['cateID']),
		'limit' => $_REQUEST['length'],
		'offset' => $_REQUEST['start'],
		'order' => 0,
		'dir' => $_REQUEST['order.0.dir'],
	];
	$search_value = $options['search_value']; 
	$cateID = $options['cateID'];
	
	if ($search_value == '' && $cateID == '') {
		$wh = "deleted_at is null";
		if ($options['limit'] != '-1')
			$lim = " limit ".$options['offset'].", ".$options['limit'];
		else
			$lim = "";
	} else {
		$whh = "";
		if ($search_value != '')
			$whh .= " and titleCate like '%$search_value%'";
		if ($cateID != '')
			$whh .= " and cateID = $cateID";
		$wh = "deleted_at is null".$whh;
		if ($options['limit'] != '-1')
			$lim = " limit ".$options['offset'].", ".$options['limit'];
		else
			$lim = "";
	}
	
	$table = $prefixTable.$def['tableCategories'];
	$s = $h->query("select * from $table where $wh order by created_at desc, id desc");
	$no = 1;
	$totalData = $h->num_rows($s);
	if ($totalData > 0) {
		$totalFiltered = $totalData;
		$ss = $h->query("select * from $table where $wh order by created_at desc, id desc$lim");
		while ($cateProduct = $h->fetch_array($ss)) {
			if ($cateProduct['active'] == 1) {
				$textActive = $lang['deactiveForm'].' '.$lang['cateProductText'].' '.$lang['this'];
				$activeIcon = '<i class="fas fa-check-circle"></i>';
				$classActive = ' text-success';
				$act = 0;
			} else {
				$textActive = $lang['activeForm'].' '.$lang['cateProductText'].' '.$lang['this'];
				$activeIcon = '<i class="far fa-circle"></i>';
				$classActive = ' text-danger';
				$act = 1;
			}
			$active = '<a class="text-center'.$classActive.' active cursorPointer" rel="'.$cateProduct['id'].'" title="'.$textActive.'" data-active="'.$act.'"><h4>'.$activeIcon.'</h4></a>';
			$titleCate = $cateProduct['titleCate'];
			$subCate = "";
			if ($cateProduct['cateID'] != 0) {
				$subCateGet = $h->getById($table, $cateProduct['cateID']);
				$subCate = $subCateGet['titleCate'];
			}
			
			$sortOrder = '<input type="number" class="sortUpdate text-center" id="'.$cateProduct['id'].'" value="'.$cateProduct['sortOrder'].'" style="width: 75px" />';
			
			$actions = '<a class="btn btn-success btn-sm update cursorPointer" data-id="'.$cateProduct['id'].'"  title="'.$lang['updateText'].' '.$lang['cateProductText'].' '.$lang['this'].'"><i class="fas fa-edit"></i></a> | <a class="btn btn-danger btn-sm delete cursorPointer" data-id="'.$cateProduct['id'].'" title="'.$lang['deleteText'].' '.$lang['cateProductText'].' '.$lang['this'].'"><i class="fas fa-trash-alt"></i></a></a>';
			$a[] = array(
				"DT_RowId" => $cateProduct['id'],
				"DT_RowClass" => "choose_this",
				"no" => $no,
				"titleCate" => $titleCate,  
				"subCate" => $subCate, 
				"sortOrder" => $sortOrder, 
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
	_e(json_encode($json_data));
