<?php
  require_once "../../../../library.php";
  $data['fullname'] = trim($_POST['fullname']);
  $data['email'] = trim($_POST['email']);
  $data['content'] = trim($_POST['content']);
  $data['created_at'] = date("Y-m-d H:i:s");
  $tableContact = $prefixTable.$def['tableContact'];
  $res = $h->insert($data, $tableContact);
  if ($res)
    _e('1');
  else
    _e('2');
