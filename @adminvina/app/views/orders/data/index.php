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
	if ($search_value == '' && $cateID == 0) {
		$wh = "deleted_at is null";
		if ($options['limit'] != '-1')
			$lim = " limit ".$options['offset'].", ".$options['limit'];
		else
			$lim = "";
	} else {
		$whh = "";
		if ($search_value != '')
			$whh .= " and titleOrder like '%$search_value%'";
		if ($cateID != 0)
			$whh .= " and cateID = $cateID";
		$wh = "deleted_at is null".$whh;
		if ($options['limit'] != '-1')
			$lim = " limit ".$options['offset'].", ".$options['limit'];
		else
			$lim = "";
	}
	
	$table = $prefixTable.$def['tableOrders'];
	$tableCateOrders = $prefixTable.$def['tableCategoriesOrders'];

	$s = $h->query("select * from $table where $wh order by created_at desc, id desc");
	$no = 1;
	$totalData = $h->num_rows($s);
		if ($totalData > 0) {
		$totalFiltered = $totalData;
		$ss = $h->query("select * from $table where $wh order by created_at desc, id desc");
		while ($order = $h->fetch_array($ss)) {
			if ($order['active'] == 1) {
				$textActive = $lang['deactiveForm'].' '.$lang['orderText'].' '.$lang['this'];
				$activeIcon = '<i class="fas fa-check-circle"></i>';
				$classActive = ' text-success';
				$act = 0;
			} else {
				$textActive = $lang['activeForm'].' '.$lang['orderText'].' '.$lang['this'];
				$activeIcon = '<i class="far fa-circle"></i>';
				$classActive = ' text-danger';
				$act = 1;
			}
			$active = '<a class="text-center'.$classActive.' active cursorPointer" rel="'.$order['id'].'" title="'.$textActive.'" data-active="'.$act.'"><h4>'.$activeIcon.'</h4></a>';
			$orderCate = $h->getById($tableCateOrders, $order['cateID']);
			$titleCate = $orderCate['titleCate'];
			$titleOrder = $order['titleOrder'];
			$imgOrder = $order['imageOrder'];
			if (!is_null($imgOrder) && $imgOrder != '' && file_exists($def['imgUploadOrderRealPath'].$imgOrder))
				$img = '<img src="'.$def['imgUploadOrder'].$imgOrder.'" width="80" alt="'.$titleOrder.'" />';
			else
				$img = '';			
			
			$sortOrder = '<input type="number" class="sortUpdate text-center" id="'.$order['id'].'" value="'.$order['sortOrder'].'" style="width: 75px" />';

			$actions = '<a class="btn btn-success btn-sm update cursorPointer" data-id="'.$order['id'].'"  title="'.$lang['updateText'].' '.$lang['orderText'].' '.$lang['this'].'"><i class="fas fa-edit"></i></a> | <a class="btn btn-danger btn-sm delete cursorPointer" data-id="'.$order['id'].'" title="'.$lang['deleteText'].' '.$lang['orderText'].' '.$lang['this'].'"><i class="fas fa-trash-alt"></i></a></a>';

			$pd = $order['postDate'];
			if (!is_null($pd) && $pd != '')
				$postDate = date("d/m/Y H:i:s", strtotime($pd));
			else
				$postDate = '';

			$a[] = array(
				"DT_RowId" => $order['id'],
				"DT_RowClass" => "choose_this",
				"no" => $no,
				"titleOrder" => $titleOrder,  
				"titleCate" => $titleCate,
				"imageOrder" => $img, 
				"postDate" => $postDate,
				"active" => $active, 
				"sortOrder" => $sortOrder, 
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
