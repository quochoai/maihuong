<?php
  if (!isset($_REQUEST['pqh']))
    require_once $def['requireHome'];
  else {
    switch ($mod[0]) {
      case $def['actionContact']:
        require_once $def['requireContact'];
        break;
      case $def['actionSearch']:
        require_once $def['requireSearch'];
        break;
      case $def['actionNews']:
        $nco = count($mod);
        $ncoo = $nco - 1;
        $htm = substr($mod[$ncoo],-5);
        if($htm != '.html')
          require_once $def['requireNews'];
        else
          require_once $def['requireNewsDetail'];
        break;
      case $def['actionProduct']:
        $nco = count($mod);
        $ncoo = $nco - 1;
        $htm = substr($mod[$ncoo],-5);
        if($htm != '.html')
          require_once $def['requireProduct'];
        else
          require_once $def['requireProductDetail'];
        break;
      case $def['actionAbout']:
        require_once $def['requirePage'];
        break;
      case $def['actionTag']:
        require_once $def['requireTag'];
        break;      
    }
  }
