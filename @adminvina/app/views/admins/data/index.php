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
			$whh .= " and (fullname like '%$search_value%' or username like '%$search_value%')";
		$wh = "deleted_at is null".$whh;
		if ($options['limit'] != '-1')
			$lim = " limit ".$options['offset'].", ".$options['limit'];
		else
			$lim = "";
	}
	
	$table = $prefixTable.$def['tableAdmin'];
	$tableRole = $prefixTable.$def['tableAdminRoles'];
	$s = $h->query("select * from $table where $wh order by created_at desc, id desc");
	$no = 1;
	$totalData = $h->num_rows($s);
	if ($totalData > 0) {
		$totalFiltered = $totalData;
		$ss = $h->query("select * from $table where $wh order by created_at desc, id desc$lim");
		while ($admin = $h->fetch_array($ss)) {
			if ($admin['active'] == 1) {
				$textActive = $lang['deactiveForm'].' '.$lang['adminText'].' '.$lang['this'];
				$activeIcon = '<i class="fas fa-check-circle"></i>';
				$classActive = ' text-success';
				$act = 0;
			} else {
				$textActive = $lang['activeForm'].' '.$lang['adminText'].' '.$lang['this'];
				$activeIcon = '<i class="far fa-circle"></i>';
				$classActive = ' text-danger';
				$act = 1;
			}
			$active = '<a class="text-center'.$classActive.' active cursorPointer" rel="'.$admin['id'].'" title="'.$textActive.'" data-active="'.$act.'"><h4>'.$activeIcon.'</h4></a>';
			$fullname = $admin['fullname'];
			$username = $admin['username'];
			$getRole = $h->getById($tableRole, $admin['role']);
			$role = $getRole['roleName'];
			$phone = $admin['phone'];
			
			$actions = '<a class="btn btn-success btn-sm update cursorPointer" data-id="'.$admin['id'].'"  title="'.$lang['updateText'].' '.$lang['adminText'].' '.$lang['this'].'"><i class="fas fa-edit"></i></a> | <a class="btn btn-danger btn-sm delete cursorPointer" data-id="'.$admin['id'].'" title="'.$lang['deleteText'].' '.$lang['adminText'].' '.$lang['this'].'"><i class="fas fa-trash-alt"></i></a>';
			$a[] = array(
				"DT_RowId" => $admin['id'],
				"DT_RowClass" => "choose_this",
				"no" => $no,
				"fullname" => $fullname,
				'username' => $username,
				'role' => $role,
				'phone' => $phone,
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
