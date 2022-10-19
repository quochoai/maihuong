<?php
  $tableCate = $prefixTable.$def['tableCategories'];
  $tableProduct = $prefixTable.$def['tableProduct'];
  $nco = count($mod);
  $ncoo = $nco - 1;
  $htm = substr($mod[$ncoo],-5);
  $checkProduct = $h->checkExist($tableProduct, "deleted_at is null and active = 1");
  $checkHas = 0;
  if ($checkProduct) {
    $products = $h->getAllSelect("id, cateID, titleProduct, priceProduct, oldPriceProduct, contentProduct, tags, numberViews, imageProduct, imageDetail", "$tableProduct as p", "deleted_at is null and active = 1", "sortOrder desc, created_at desc, id desc");
    foreach ($products as $product) {
      $titleProduct = $product['titleProduct'];
      $linkCompare = chuoilink($titleProduct).'.html';
      if ($linkCompare == $mod[$ncoo]) {
        $checkHas = 1;
        $id = $product['id'];
        $cateID = $product['cateID'];
        $titleProduct = $product['titleProduct'];
        $imageProduct = $product['imageProduct'];
        $imageDetail = $product['imageDetail'];
        $tags = $product['tags'];
        $priceProduct = $product['priceProduct'];
        $oldPriceProduct = $product['oldPriceProduct'];
        $numberView = $product['numberViews'];
        $contentProduct = $product['contentProduct'];
        $whereProduct = "deleted_at is null and active = 1 and cateID = $cateID and id != $id";
        break;
      }
    }
  }
  if ($checkHas == 1) {
    if ($priceProduct != 0) 
      $price = number_format($priceProduct, 0, ',', '.').'đ';
    else
      $price = $lang['contactText'];
    $oldPrice = '';
    if ($oldPriceProduct != 0 && !is_null($oldPriceProduct))
      $oldPrice = number_format($oldPriceProduct, 0, ',', '.');
    if ($imageDetail != '' && !is_null($imageDetail))
      $images = explode(';', $imageDetail);
    else
      $images = $imageProduct;
    if (is_array($images)) {
      $image_large = '';
      foreach ($images as $imgs) {
        if (file_exists($def['imgUploadProductRealPath'].$imgs)) {
          $image_large = $def['imgUploadProduct'].$imgs;
          break;
        }
      }
      if ($image_large == '')
        $image_large = _noImage;
    } else {
      if (file_exists($def['imgUploadProductRealPath'].$images))
        $image_large = $def['imgUploadProduct'].$images;
      else
        $image_large = _noImage;
    }     

    $sessionView = "sessionViewProduct".$id;
    if (!isset($_SESSION[$sessionView])) {
      $_SESSION[$sessionView] = $id;
      $data['numberViews'] = $numberView + 1;
      $resUpdate = $h->update($data, $tableProduct, " where id = $id");
    }     
    $cate = $h->getById($tableCate, $cateID);
    if ($cate['cateID'] != 0) {
      $cateMain = $h->getById($tableCate, $cate['cateID']);
      $linkCate = $def['actionProduct'].'/'.chuoilink($cateMain['titleCate']).'/'.chuoilink($cate['titleCate']);
    } else 
      $linkCate = $def['actionProduct'].'/'.chuoilink($cate['titleCate']);
    $cateShow = '<a href="'.$linkCate.'">'.$cate['titleCate'].'</a>';
    $arrayTag = [];
    if ($tags != '' && !is_null($tags)) {
      $arrayTag = explode(',', $tags);
    }
?>
<div class="header-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <span><?php _e($titleProduct) ?></span>
      </div>
    </div>
  </div>
</div>
<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul typeof="BreadcrumbList" vocab="http://schema.org/">
          <li class="home">
            <a href="<?php _e(_url) ?>" title="<?php _e($lang['homeText']) ?>"><span><?php _e($lang['homeText']) ?></span></a>
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
          </li>
          <li><strong><span><?php _e($titleProduct) ?></span></strong><li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div itemscope itemtype="http://schema.org/Product">
  <meta itemprop="url" content="<?php _e("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>">
  <meta itemprop="shop-currency" content="VND">
  <section class="product" id="product">
    <div class="container">
      <div class="col-main">
        <div class="row">
          <div class="product-view">
            <div class="product-essential">
              <div class="">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                  <div class="product-img-box col-sm-12 col-xs-12 col-lg-5 col-md-6">
                    <div class="large-image">
                      <img id="zoom_01" class="img-responsive" src="<?php _e($image_large) ?>" alt="<?php _e($titleProduct) ?>">
                    </div>
                    <div class="imgthumb-prolist">
                      <div id="gallery_01" class="">
                        <?php
                          if (is_array($images)) {
                            foreach ($images as $img) {
                              if (file_exists($def['imgUploadProductRealPath'].$img))
                                _e('<div class="item" style="margin-left: 5px; margin-right: 5px;"><img src="'.$def['imgUploadProduct'].$img.'" class="img-responsive cursorPointer" alt="'.$titleProduct.'" height="50"></div>');
                            }
                          }
                        ?>
                      </div>
                    </div>
                    <div class="clear"></div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7 right-tt details-pro">
                    <div class="product-name">
                      <h1 class="" itemprop="name"><?php _e($titleProduct) ?></h1>
                    </div>
                    <div class="price-box">
                      <span class="special-price">
                        <span class="price product-price"><?php _e($price) ?></span>
                      </span>
                      <!-- Giá Khuyến mại -->
                      <?php 
                        if ($oldPrice != '')
                          _e('<span class="old-price"><del class="price product-price-old">'.$oldPrice.'</del></span>');
                      ?>
                    </div>
                    <div class="tag-product" style="margin-top: 30px">
                      <label><?php _e($lang['category']) ?>:</label> <?php _e($cateShow) ?>
                    </div>
                    <?php 
                      $msgTag = '';
                      $tableTag = $prefixTable.$def['tableTags'];
                      if (count($arrayTag) > 0) {
                        $msgTag .= '<ul>';
                        foreach ($arrayTag as $tag) {
                          $tagGet = $h->getById($tableTag, $tag);
                          $linkTag = $def['actionTag'].'/'.chuoilink($tagGet['titleTag']).'.html';
                          $msgTag .= '<li><a href="'.$linkTag.'">'.$tagGet['titleTag'].'</a></li>';
                        }
                        $msgTag .= '</ul>';
                      }
                    ?>
                    <div class="tag-product" style="margin-top: 30px">
                      <label>Tag:</label>
                      <?php _e($msgTag) ?>
                    </div>
                  </div>
                  <div class="product-collateral">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-tab">
                      <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                        <li class="active">
                          <a href="#product_tabs_description" data-toggle="tab"><?php _e($lang['infoProduct']) ?></a>
                        </li>
                      </ul>
                      <div id="productTabContent" class="tab-content">
                        <div class="tab-pane fade in active" id="product_tabs_description">
                          <div class="std"><?php _e($contentProduct) ?></div>
                        </div>
                        
                        
                      </div>
                    </div>
                  </div>
                </div>
                <?php require_once _viewsRequire.'sidebar.php' ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
  let ww = $(window).width();
  if (ww >= 1200) {
    $(document).ready(function() {
      $('#zoom_01').elevateZoom({
        gallery: 'gallery_01',
        zoomWindowOffetx: 10,
        easing: true,
        scrollZoom: true,
        cursor: 'pointer',
        galleryActiveClass: 'active',
        imageCrossfade: true
      });
    });
  }
  $(document).on('click', '#gallery_01 img', function(e) {
    let current_click = $(this).attr('src');
    $('.zoomContainer').remove();
		$('#zoom_01').removeData('elevateZoom');
		$("#gallery_01 .item").removeClass('active');
		$(this).parents('div.item').addClass('active');
		$("#zoom_01").attr("src",$(this).attr("src"));
		if(ww > 1200){
			jQuery("#zoom_01").elevateZoom({
				scrollZoom : true,
				easing : true
			});
		}
  });
</script>
<?php } else { ?>
<div class="header-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <span><?php _e($$lang['pageNotFound']) ?></span>
      </div>
    </div>
  </div>
</div>
<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul typeof="BreadcrumbList" vocab="http://schema.org/">
          <li class="home">
            <a href="<?php _e(_url) ?>" title="<?php _e($lang['homeText']) ?>"><span><?php _e($lang['homeText']) ?></span></a>
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
          </li>
          <li><strong><span><?php _e($$lang['pageNotFound']) ?></span></strong><li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div itemscope itemtype="http://schema.org/Product">
  <meta itemprop="url" content="<?php _e(_url2.$_SERVER['REQUEST_URI']) ?>">
  <meta itemprop="shop-currency" content="VND">
  <section class="product" id="product">
    <div class="container">
      <div class="col-main">
        <div class="row text-center"><?php _e($$lang['pageNotFound']) ?></div>
      </div>
    </div>
  </section>
</div>
<?php } ?>