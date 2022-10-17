<?php
  if (!isset($_REQUEST['action']))
    require_once $def['dashboard'];
  else {
    $action = trim($_REQUEST['action']);
    switch ($action) {
      case $def['actionProduct']:
        require_once $def['listProduct'];
        break;
      case $def['actionCategoriesProduct']:
        require_once $def['listCateProduct'];
        break;
      case $def['actionNews']:
        require_once $def['listNews'];
        break;
      case $def['actionTags']:
        require_once $def['listTags'];
        break;
      case $def['actionInfo']:
        require_once $def['listInfo'];
        break;
      case $def['actionAdmin']:
        require_once $def['listAdmin'];
        break;
      case $def['actionRole']:
        require_once $def['listRole'];
        break;
      case $def['actionRoleFunction']:
        require_once $def['listFunctionRole'];
        break;
      case $def['actionHtml']:
        require_once $def['listHtml'];
        break;
      case $def['actionConfig']:
        require_once $def['listConfig'];
        break;
      case $def['actionContact']:
        require_once $def['listContact'];
        break;
      default:
        require_once $def['dashboard'];
        break;
    }
  }
