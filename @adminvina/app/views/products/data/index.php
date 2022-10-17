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
			$whh .= " and titleProduct like '%$search_value%'";
		if ($cateID != 0)
			$whh .= " and cateID = $cateID";
		$wh = "deleted_at is null".$whh;
		if ($options['limit'] != '-1')
			$lim = " limit ".$options['offset'].", ".$options['limit'];
		else
			$lim = "";
	}
	
	$table = $prefixTable.$def['tableProducts'];
	$tableCategories = $prefixTable.$def['tableCategories'];

	$s = $h->query("select * from $table where $wh order by created_at desc, id desc");
	$no = 1;
	$totalData = $h->num_rows($s);
		if ($totalData > 0) {
		$totalFiltered = $totalData;
		$ss = $h->query("select * from $table where $wh order by created_at desc, id desc");
		while ($product = $h->fetch_array($ss)) {
			if ($product['active'] == 1) {
				$textActive = $lang['deactiveForm'].' '.$lang['productText'].' '.$lang['this'];
				$activeIcon = '<i class="fas fa-check-circle"></i>';
				$classActive = ' text-success';
				$act = 0;
			} else {
				$textActive = $lang['activeForm'].' '.$lang['productText'].' '.$lang['this'];
				$activeIcon = '<i class="far fa-circle"></i>';
				$classActive = ' text-danger';
				$act = 1;
			}
			$active = '<a class="text-center'.$classActive.' active cursorPointer" rel="'.$product['id'].'" title="'.$textActive.'" data-active="'.$act.'"><h4>'.$activeIcon.'</h4></a>';
			$productCate = $h->getById($tableCategories, $product['cateID']);
			$titleCate = $productCate['titleCate'];
			$titleProduct = $product['titleProduct'];
			$imgProduct = $product['imageProduct'];
			if (!is_null($imgProduct) && $imgProduct != '' && file_exists($def['imgUploadProductRealPath'].$imgProduct))
				$img = '<img src="'.$def['imgUploadProduct'].$imgProduct.'" width="80" alt="'.$titleProduct.'" />';
			else
				$img = '';			
			
			$sortOrder = '<input type="number" class="sortUpdate text-center" id="'.$product['id'].'" value="'.$product['sortOrder'].'" style="width: 75px" />';

			$actions = '<a class="btn btn-success btn-sm update cursorPointer" data-id="'.$product['id'].'"  title="'.$lang['updateText'].' '.$lang['productText'].' '.$lang['this'].'"><i class="fas fa-edit"></i></a> | <a class="btn btn-danger btn-sm delete cursorPointer" data-id="'.$product['id'].'" title="'.$lang['deleteText'].' '.$lang['productText'].' '.$lang['this'].'"><i class="fas fa-trash-alt"></i></a></a>';

			$priceProduct = ($product['priceProduct'] == 0) ? $lang['contact'] : number_format($product['priceProduct'], 0, ',', '.');
			$a[] = array(
				"DT_RowId" => $product['id'],
				"DT_RowClass" => "choose_this",
				"no" => $no,
				"titleProduct" => $titleProduct,  
				"titleCate" => $titleCate,
				"imageProduct" => $img, 
				"price" => $priceProduct,
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
