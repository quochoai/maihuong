<?php
  if (!isset($_REQUEST['pqh']))
    require_once $def['requireHome'];
  else {
    switch ($mod[0]) {
      case $def['actionOrder']:
        if (!isset($mod[2]) && $mod[2] == '')
          require_once $def['requireOrder'];
        else
          require_once $def['requireOrderDetail'];
        break;
      case $def['actionNews']:
        if (!isset($mod[2]) && $mod[2] == '')
          require_once $def['requireNews'];
        else
          require_once $def['requireNewsDetail'];
        break;
      case $def['actionAbout']:
      case $def['actionPolicy']:
      case $def['actionResolveComplain']:
      case $def['actionSecure']:
        require_once $def['requirePage'];
        break;
      
    }
  }
