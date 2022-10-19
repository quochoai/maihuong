<div class="header-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <span><?php _e($lang['contactText']) ?></span>
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
          <li>
            <strong><?php _e($lang['contactText']) ?></strong>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="mainContact">
  <div class="main container">
    <div class="row">
      <section class="col-main col-lg-8 col-sm-12 col-md-8 col-xs-12">
        <div class="page-title">
          <h1><?php _e($lang['contactText']) ?></h1>
          <p><?php 
            $textContact = $h->getById($tableHtml, 9);
            _e($textContact['content']);
          ?>
          </p>
        </div>
        <div class="static-contain">
          <form accept-charset="utf-8" method="post">
            <fieldset>
              <div class="row">
                <div class="customer-name">
                  <div class="col-lg-6">
                    <div class="input-box">
                      <label><?php _e($lang['contactName']) ?> <span class="required">*</span></label><br>
                      <input type="text" size="35" class="input-text" value="" name="fullname" id="fullname">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="input-box">
                      <label>Email <span class="required">*</span></label><br>
                      <input type="email" size="35" id="email" value="" class="input-text" name="email">
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <label><?php _e($lang['contactContent']) ?> <span class="required">*</span></label><br>
                  <textarea name="content" id="content" title="<?php _e($lang['contactContent']) ?>" class="input-text" cols="150" rows="3"></textarea>
                </div>
              </div>
            </fieldset>
            <span class="require" style="margin-bottom: 10px;display: inline-block;">
              <em class="required">* </em><?php _e($lang['contactRequire']) ?> </span>
            <div class="buttons-set">
              <button type="button" id="send" title="<?php _e($lang['contactSend']) ?>" class="button submit hover-button">
                <span> <?php _e($lang['contactSend']) ?> </span>
              </button>
            </div>
          </form>
        </div>
      </section>
      <aside class="col-lg-4 col-sm-12 col-md-4 col-xs-12">
        <div class="contact-info" style="float: left; width: 100%">
          <div class="page-title"><h2><?php _e($lang['contactInfo']) ?></h2></div>
          <ul class="links">
            <li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php _e($addressFooter['content']) ?></li>
            <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:<?php _e($phoneFooter['content']) ?>"><?php _e($phoneFooter['content']) ?></a></li>
            <li><i class="fa fa-clock-o" aria-hidden="true"></i> <?php 
                $openHour = $h->getById($tableHtml, 3);
                _e($openHour['content']);
              ?>
            </li>
            <li><i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:<?php _e($emailFooter['content']) ?>"><?php _e($emailFooter['content']) ?></a></li>
          </ul>
        </div>
      </aside>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php _e(_theme.'plugins/toastr/toastr.min.css') ?>"></script>
<script type="text/javascript" src="<?php _e(_theme.'plugins/toastr/toastr.min.js') ?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click', '#send', function(){
      let fullnameElement = $('#fullname');
      let emailElement = $('#email');
      let contentElement = $('#content');
      let fullname = $.trim(fullnameElement.val());
      let email = $.trim(emailElement.val());
      let content = $.trim(contentElement.val());

      if (fullname == '') {
        alert("<?php _e($lang['notInputContactName']) ?>");
        fullnameElement.focus();
        return false;
      }
      if (email == '') {
        alert("<?php _e($lang['notInputContactEmail']) ?>");
        emailElement.focus();
        return false;
      } else {
        let filter = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!filter.test(email)) {
          alert("<?php _e($lang['emailInvalid']) ?>");
          emailElement.focus();
          return false;
        }
      }
      if (content == '') {
        alert("<?php _e($lang['notInputContactContent']) ?>");
        contentElement.focus();
        return false;
      }
      let processContact = "<?php _e(_processContact) ?>";
      $.post(processContact, {fullname: fullname, email: email, content: content}, function(dataResponse){
        if (dataResponse == '1') {
          alert("<?php _e($lang['contactSuccess']) ?>");
          fullnameElement.val('');
          emailElement.val('');
          contentElement.val('');
        } else {
          alert("<?php _e($lang['contactError']) ?>");
          return false;
        }
      });
    });
  });
</script>