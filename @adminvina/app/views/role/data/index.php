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
			$whh .= " and titleNews like '%$search_value%'";
		if ($cateID != 0)
			$whh .= " and cateID = $cateID";
		$wh = "deleted_at is null".$whh;
		if ($options['limit'] != '-1')
			$lim = " limit ".$options['offset'].", ".$options['limit'];
		else
			$lim = "";
	}
	
	$table = $prefixTable.$def['tableNews'];
	$tableCateNews = $prefixTable.$def['tableCategoriesNews'];

	$s = $h->query("select * from $table where $wh order by created_at desc, id desc");
	$no = 1;
	$totalData = $h->num_rows($s);
		if ($totalData > 0) {
		$totalFiltered = $totalData;
		$ss = $h->query("select * from $table where $wh order by created_at desc, id desc");
		while ($news = $h->fetch_array($ss)) {
			if ($news['active'] == 1) {
				$textActive = $lang['deactiveForm'].' '.$lang['newsText'].' '.$lang['this'];
				$activeIcon = '<i class="fas fa-check-circle"></i>';
				$classActive = ' text-success';
				$act = 0;
			} else {
				$textActive = $lang['activeForm'].' '.$lang['newsText'].' '.$lang['this'];
				$activeIcon = '<i class="far fa-circle"></i>';
				$classActive = ' text-danger';
				$act = 1;
			}
			$active = '<a class="text-center'.$classActive.' active cursorPointer" rel="'.$news['id'].'" title="'.$textActive.'" data-active="'.$act.'"><h4>'.$activeIcon.'</h4></a>';
			$newsCate = $h->getById($tableCateNews, $news['cateID']);
			$titleCate = $newsCate['titleCate'];
			$titleNews = $news['titleNews'];
			$imgNews = $news['imageNews'];
			if (!is_null($imgNews) && $imgNews != '' && file_exists($def['imgUploadNewsRealPath'].$imgNews))
				$img = '<img src="'.$def['imgUploadNews'].$imgNews.'" width="80" alt="'.$titleNews.'" />';
			else
				$img = '';			
			
			$sortOrder = '<input type="number" class="sortUpdate text-center" id="'.$news['id'].'" value="'.$news['sortOrder'].'" style="width: 75px" />';

			$actions = '<a class="btn btn-success btn-sm update cursorPointer" data-id="'.$news['id'].'"  title="'.$lang['updateText'].' '.$lang['newsText'].' '.$lang['this'].'"><i class="fas fa-edit"></i></a> | <a class="btn btn-danger btn-sm delete cursorPointer" data-id="'.$news['id'].'" title="'.$lang['deleteText'].' '.$lang['newsText'].' '.$lang['this'].'"><i class="fas fa-trash-alt"></i></a></a>';

			$pd = $news['postDate'];
			if (!is_null($pd) && $pd != '')
				$postDate = date("d/m/Y H:i:s", strtotime($pd));
			else
				$postDate = '';

			$a[] = array(
				"DT_RowId" => $news['id'],
				"DT_RowClass" => "choose_this",
				"no" => $no,
				"titleNews" => $titleNews,  
				"titleCate" => $titleCate,
				"imageNews" => $img, 
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
