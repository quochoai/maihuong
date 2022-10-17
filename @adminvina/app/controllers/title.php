<?php
  if (!isset($_REQUEST['action']))
    $title = $lang['admin_title'];
  else {
    $action = trim($_REQUEST['action']);
    switch ($action) {
      case $def['actionProduct']:
        $title = $lang['manageProduct'];
        break;
      case $def['actionCategoriesProduct']:
        $title = $lang['manageCategoryProduct'];
        break;
      case $def['actionNews']:
        $title = $lang['manageNews'];
        break;
      case $def['actionTags']:
        $title = $lang['manageTags'];
        break;
      case $def['actionInfo']:
        $title = $lang['manageInformation'];
        break;
      case $def['actionAdmin']:
        $title = $lang['manageAdmin'];
        break;
      case $def['actionRole']:
        $title = $lang['manageRole'];
        break;
      case $def['actionRoleFunction']:
        $title = $lang['manageFunctionRoles'];
        break;
      case $def['actionHtml']:
        $title = $lang['manageStaticInfo'];
        break;
      case $def['actionConfig']:
        $title = $lang['manageConfig'];
        break;
      case $def['actionContact']:
        $title = $lang['manageContact'];
        break;
      default:
        $title = $lang['admin_title'];
        break;
    }
  }
  echo $title;