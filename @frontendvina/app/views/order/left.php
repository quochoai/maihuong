<div class="col-md-3 sidebar-dd">
  <div class="list-item-sidebar">
    <div class="item-dm">
      <p class="dm-tx-dd"><?php _e($lang['category']) ?></p>
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="sidenav">
          <?php
            $msgCateLeft = "";
            if (count($cateOrders) > 0) {
              foreach ($cateOrders as $cateO) {
                $linkCate = chuoilink($cateO['titleCate']);
                if (isset($mod[1]) && $mod[1] != '' && $mod[1] == $linkCate)
                  $active = ' class="active"';
                else
                  $active = '';
                $linkCateGet = $def['actionOrder'].'/'.$linkCate;
                $titleCateOrder = $cateO['titleCate'];
                $msgCateLeft .= '<div class="border-div"><p><a href="'.$linkCateGet.'"'.$active.'>'.$titleCateOrder.'</a></p></div>';
              }
              _e($msgCateLeft);
            }
          ?>                                                           
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>    
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }
</script>