<footer>
      <div class="footer_middle">
        <div class="container">
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="col1-footer">
                <a href="<?php _e(_url) ?>" class="logo_footer">
                <img alt="<?php _e($conf['title']) ?>" src="<?php _e($imgLogo) ?>" />
                </a>
                <div class="loigioithieu">
                  <p><?php _e($textFooter['content']) ?></p>
                </div>
                <div class="social-icons">
                  <ul class="">
                    <li>
                      <a href="#">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-google" aria-hidden="true"></i>
                      </a>
                    </li>
                    <li>
                      <a href="">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="col2-footer">
                <h4 class="title_footer"><?php _e($lang['aboutUs']) ?></h4>
                <ul class="links">
                  <li>
                    <a href="<?php _e($def['actionAbout']) ?>" title="<?php _e($lang['aboutText']) ?>"><?php _e($lang['aboutText']) ?></a>
                  </li>
                  <!--
                  <li>
                    <a href="#" title="Chính sách đầu tư">Chính sách đầu tư</a>
                  </li>
                  <li>
                    <a href="#" title="Dự án phát triển">Dự án phát triển</a>
                  </li>
                  -->
                  <li>
                    <a href="<?php _e($def['actionContact']) ?>" title="<?php _e($lang['contactText']) ?>"><?php _e($lang['contactText']) ?></a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="col3-footer">
                <h4 class="title_footer"><?php _e($lang['newsText']) ?></h4>
                <ul class="links">
                <?php
                  $newsFooter = $h->getAllSelect("titleNews, postDate", $tableNews, "deleted_at is null and active = 1", "sortOrder desc, id desc", "limit 0, 2");
                  $msgNewsFooter = '';
                  foreach ($newsFooter as $newsF) {
                    $titleNews = $newsF['titleNews'];
                    $postDate = date("d/m/Y", strtotime($newsF['postDate']));
                    $linkNews = $def['actionNews'].'/'.chuoilink($titleNews).'.html';
                    $msgNewsFooter .= '<li class="blog-item-link">';
                    $msgNewsFooter .= ' <div class="blog-item-name"><h3><a href="'.$linkNews.'" title="'.$titleNews.'">'.$titleNews.'</a></h3></div>';
                    $msgNewsFooter .= ' <div class="postby"><div class="pull-xs-left"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$postDate.'</div></div>';
                    $msgNewsFooter .= '</li>';
                  }
                  _e($msgNewsFooter);
                ?>
                </ul>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="col4-footer">
                <h4 class="title_footer"><?php _e($lang['contactText']) ?></h4>
                <ul class="links">
                  <li>
                    <i class="fa fa-map-marker" aria-hidden="true"></i><?php _e($addressFooter['content']) ?>
                  </li>
                  <li>
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <a href="tel:<?php _e($$phoneFooter['content']) ?>"><?php _e($$phoneFooter['content']) ?></a>
                  </li>
                  <li>
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    <?php 
                      $openHour = $h->getById($tableHtml, 3);
                      _e($openHour['content']);
                    ?>
                  </li>
                  <li>
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <a href="mailto:<?php _e($emailFooter['content']) ?>"><?php _e($emailFooter['content']) ?></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="copyRight">
        <div class="container">
          <div class="row"> © Bản quyền thuộc về Công ty</div>
        </div>
      </div>
    </footer>
    <a href="#" id="back-to-top" title="Lên đầu trang">
      <i class="fa fa-caret-up" aria-hidden="true"></i>
    </a>
    <script src="assets/js/common.js" type="text/javascript"></script>
    <script src="assets/plugins/flexslider/jquery.flexslider.js" type="text/javascript"></script>
    <script src="assets/plugins/zoom/jquery.elevatezoom.min.js" type="text/javascript"></script>
    <script src="assets/plugins/owlCarousel/owl.carousel.min.js" type="text/javascript"></script>
    <script src="assets/plugins/parallax/parallax.js" type="text/javascript"></script>
    <script src="assets/js/api.jquery.js" type="text/javascript"></script>
    <script src="assets/js/jgrowl.js" type="text/javascript"></script>
    <script src="assets/js/cs.script.js" type="text/javascript"></script>
    <script src="assets/js/waypoints.min.js" type="text/javascript"></script>
    <script src="assets/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script>
      /*@shinsenter/defer.js*/ ! function(e, r, t, n, i, c) {
        function o(e, t) {
          t = t || 80, c ? n(e, t) : i.push(e, t)
        }
        c = /p/.test(r.readyState), e.defer = o, e.deferscript = function(t, n, e, i) {
          o(function(e) {
            r.getElementById(n) || (e = r.createElement('SCRIPT'), n && (e.id = n), i && (e.onload = i), e.src = t, r.head.appendChild(e))
          }, e)
        }, e.addEventListener('on' + t in e ? t : 'load', function() {
          for (c = !0; i.length;) n(i.shift(), i.shift())
        })
      }(this, document, 'pageshow', setTimeout, []),
      function(s, u) {
        var e = 'jQuery',
          l = 'IntersectionObserver',
          h = 'data-',
          m = 'lazied',
          g = h + m,
          p = 'forEach',
          I = Function(),
          y = s.defer || I;

        function t(a, f) {
          return f || (f = ['srcset', 'src', 'data']),
            function(e, t, i, r, n, c, o) {
              function d(n) {
                !1 !== r.call(n, n) && f[p](function(e, t) {
                  (t = n.getAttribute(h + e)) && (n[e] = t)
                }), n.className += ' ' + i
              }
              i = i || m, r = r || I, o = l in s ? (c = new s[l](function(e) {
                e[p](function(e, t) {
                  e.isIntersecting && (t = e.target) && (c.unobserve(t), d(t))
                })
              }, n)).observe.bind(c) : d, y(function() {
                [].slice.call(u.querySelectorAll((e || a + '[data-src]') + ':not([' + g + '])'))[p](function(e) {
                  e.setAttribute(g, a), o(e)
                })
              }, t)
            }
        }
        s[e] || (s.$ = s[e] = y), s.deferstyle = function(t, n, e, i) {
          y(function(e) {
            u.getElementById(n) || ((e = u.createElement('LINK')).rel = 'stylesheet', n && (e.id = n), i && (e.onload = i), e.href = t, u.head.appendChild(e))
          }, e)
        }, s.deferimg = t('IMG'), s.deferiframe = t('IFRAME')
      }(this, document);
      jQuery(document).ready(function($) {
        $('.counter').counterUp({
          delay: 10,
          time: 1000
        });
      });
      deferimg('img.basic', 100);
    </script>
    
    <div id="myModal" class="modal fade" role="dialog"></div>
  </body>
</html>
