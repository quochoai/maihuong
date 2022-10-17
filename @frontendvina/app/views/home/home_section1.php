<?php
  $tableProduct = $prefixTable.$def['tableProduct'];
  $checkProduct = $h->checkExist($tableProduct, "deleted_at is null and active = 1");
  if ($checkProduct) {
?>
<section class="productIndex">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="new_title">
          <h2 class=""><?php _e($lang['provideProduct']) ?></h2>
        </div>
        <div id="productIndex" class="" style="margin-right: -10px; margin-left: -10px;">
        <?php
          $products = $h->getAllSelect("id, cateID, titleProduct, imageProduct", $tableProduct, "deleted_at is null and active = 1 and imageProduct != '' ", "sortOrder desc, created_at desc, id desc", "limit 0, 12");
          $productProvide = '';
          foreach ($products as $product) {
            $imgProduct = $product['imageProduct'];
            $cateID = $product['cateID'];
            $titleProduct = $product['titleProduct'];
            $cateProduct = $h->getById($tableCate, $cateID);
            if ($cateProduct['cateID'] != 0) {
              $cateMain = $h->getById($tableCate, $cateProduct['cateID']);
              $linkProduct = $def['actionProduct'].'/'.chuoilink($cateMain['titleCate']).'/'.chuoilink($cateProduct['titleCate']).'/'.chuoilink($titleProduct).'.html';
            } else
              $linkProduct = $def['actionProduct'].'/'.chuoilink($cateProduct['titleCate']).'/'.chuoilink($titleProduct).'.html';
            if (file_exists($def['imgUploadProductRealPath'].$imgProduct))
              $imageProduct = $def['imgUploadProduct'].$imgProduct;
            else
              $imageProduct = _noImage;

            $productProvide .= '<div class="item"><div class="product-image">';
            $productProvide .= '  <a class="product-image-thumb" title="'.$titleProduct.'" href="'.$linkProduct.'"><img src="'.$imageProduct.'" alt="'.$titleProduct.'" /></a>';
            $productProvide .= '  <div class="info"><div class=""><a href="'.$linkProduct.'"><i class="fa fa-link" aria-hidden="true"></i></a></div><h3 class="product_name"><a title="'.$titleProduct.'" href="'.$linkProduct.'">'.$titleProduct.'</a></h3></div>';
            $productProvide .= '</div></div>';            
          }
          _e($productProvide);
        ?>
        </div>
        <div class="btn-nav-control">
          <a class="btn btn-nav prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
          </a>
          <a class="btn btn-nav next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
  }          
?>
