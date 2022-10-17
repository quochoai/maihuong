<div class="loader-content" id="load-123">
    <div class="cssload-loader">
        <div class="cssload-inner cssload-one"></div>
        <div class="cssload-inner cssload-two"></div>
        <div class="cssload-inner cssload-three"></div>
    </div>
</div>
<section id="yt_slideshow" class="block" style="background: url('assets/images/bg-banner.jpg');">
  <div class="container">
    <div class="row">
      <div class="banner" >
        <div class="col-md-12 col-xs-12 div_slogan">
          <div class="slogan_taxigo">
            <h3 style="margin-bottom: 7px;">Nền tảng đặt xe trực tuyến thông minh hàng đầu Việt Nam</h3>
            <h1 style="color: #f69a38">"BIẾT TRƯỚC GIÁ THÀNH - LỘ TRÌNH DI CHUYỂN"</h1>            
          </div>
        </div>
        <div class="col-md-12 col-xs-12 div_datxe">
					<div class="row form-datxe">
					<div class="col-md-6 form-datxe-left">
						<img src="assets/images/main-car.png" />
					</div>
					<div class="col-md-6 form-datxe-right">
						<div id="content-booking">
              <div id="booking-car">
                <ul class="nav nav-tabs" id="label-booking" role="tablist">
                  <li class="nav-item active">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Đặt xe trực tuyến</a>
                  </li>
                  <div class="tab-content" id="myTabContentCar">
                    <div class="tab-pane fade in active" id="home" role="tabpanel" aria-labelledby="home-tab">
                      <form action="" method="POST" id="home_booking_form">
                        <input type="hidden" value="" id="km_input" name="km">
                        <input type="hidden" value="2" id="check_submit">
                        <div class="choose-add">
                          <div class="form-group col-md-12 ">
                          <!-- <label>Điểm đón</label> -->
                            <div class="input-group append_pick_address_here pick_start" >
                              <span class="input-group-addon getCurrentLocation"><i class="fa fa-dot-circle-o mpick" aria-hidden="true"></i></span>
                              <span class="custom-combobox" id="dat-xe-ngay">
                              <input value="" id="place_start_name"  title="Điểm đón" class="custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left ui-autocomplete-input ui-autocomplete-loading" autocomplete="off" data-original-title="" placeholder="Nhập điểm đón"   name="place_start_name" class="el-input"  autocomplete="off" required>
                              <span class="pick-icon-start" onclick="clearInputStart()"><i class="fa fa-times" aria-hidden="true"></i></span>
                              <input type="hidden" value="" id="lat_start" name="lat_start" class="lat_fill">
                              <input type="hidden" value="" id="long_start" name="long_start" class="long_fill">
                              <input type="hidden" value="" id="city_start" name="city_start" class="city_fill">
                              <input type="hidden" value="" id="district_start" name="district_start" class="district_fill">
                              <input type="hidden" value="taxigo.vn" id="name_host_book_car" name="name_host_book_car" class="name_host_book_car">
                              <div id="result_place_start" class="result-place-search"></div>
                              <style>
                                .ui-autocomplete {max-height: 200px; overflow-y: auto; overflow-x: hidden;}
                                #service_id, .ui-autocomplete-input {color: #666; font-size: 14px !important; background: #fff; font-family: 'Roboto', sans-serif;}
                                .ui-autocomplete-input:focus {outline-color: rgb(229, 151, 0);}
                                .ui-autocomplete.ui-widget {font-family: sans-serif !important; font-size: 13px !important; font-family: font_strong; margin: 2px;}
                              </style>
                              <script>
                                jQuery(document).ready(function($){
                                  $.datetimepicker.setLocale('vi');
                                  var tags = []
                                  if(window.localStorage.getItem('tx_location') != undefined ) {
                                    var location = jQuery.parseJSON(window.localStorage.getItem('tx_location'));
                                    console.log(location);
                                  } else {
                                    var location = [];
                                  }
                                  var sanbaynoibai = {
                                    'text' : "Sân bay Nội Bài, Hà Nội",
                                    'lat' : "21.2187149",
                                    'long' : "105.8041709",
                                    'city' : "Hà Nội",
                                    'district' : "Sóc Sơn",
                                    'id':1
                                  }
                                  var sanbaydanang = {
                                    'text' : "Sân bay Đà Nẵng, Đà Nẵng",
                                    'lat' : "16.0283895",
                                    'long' : "108.2513634",
                                    'city' : "Đà Nẵng",
                                    'district' : "Ngũ Hành Sơn",
                                    'id':2
                                  }
                                  var sanbaycamranh = {
                                    'text' : "Sân bay Cam Ranh, Khánh Hoà",
                                    'lat' : "12.0092133",
                                    'long' : "109.2136594",
                                    'city' : "Khánh Hoà",
                                    'district' : "Cam Ranh",
                                    'id':3
                                  }
                                  var sanbayphuquoc = {
                                    'text' : "Sân bay Phú Quốc, Kiên Giang",
                                    'lat' : "10.2251753",
                                    'long' : "103.9701664",
                                    'city' : "Kiên Giang",
                                    'district' : "Phú Quốc",
                                    'id':4
                                  }
                                  var sanbaytansonnhat = {
                                    'text' : "Sân bay Tân Sơn Nhất, HCM",
                                    'lat' : "10.8134125",
                                    'long' : "106.666407",
                                    'city' : "Hồ Chí Minh",
                                    'district' : "Tân Bình",
                                    'id':4
                                  }
                                  location.push(sanbaynoibai);
                                  location.push(sanbaydanang);
                                  location.push(sanbaycamranh);
                                  location.push(sanbayphuquoc);
                                  location.push(sanbaytansonnhat);

                                  $.each(location, function(index, item){
                                      tags.push(item.text);
                                  });

                                  jQuery( "#place_start_name" ).autocomplete({
                                    select: function(event, ui){
                                      $.each(location, function(index, item_data){
                                        if(ui.item.value == item_data.text){
                                          jQuery("#lat_start").val(item_data.lat);
                                          jQuery("#long_start").val(item_data.long);
                                          jQuery("#city_start").val(item_data.city);
                                          jQuery("#district_start").val(item_data.district);
                                        }
                                      });
                                    },
                                    source: function( request, response ) {
                                      if(request.term != '') {
                                        response([]);
                                      } else {
                                        var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
                                        response( $.grep( tags, function( item ){
                                            return matcher.test( item );
                                        }) );
                                      }
                                    },
                                    minLength: 0,
                                    open: function() {
                                      jQuery('.ui-menu').width(jQuery( "#place_start_name" ).outerWidth());
                                    },
                                  }).on( "click", function() {
                                    jQuery(this).trigger( "focus" );
                                    jQuery("body").addClass("hide_logo");
                                    // Pass empty string as value to search for, displaying all results
                                    jQuery(this).autocomplete( "search", "" );
                                  });

                                  jQuery( "#place_end_name" ).autocomplete({
                                    select: function(event, ui){
                                      $.each(location, function(index, item_data){
                                        if(ui.item.value == item_data.text){
                                          jQuery("#lat_end").val(item_data.lat);
                                          jQuery("#long_end").val(item_data.long);
                                          jQuery("#city_end").val(item_data.city);
                                          jQuery("#district_end").val(item_data.district);
                                        }
                                      });
                                    },
                                    source: function( request, response ) {
                                      var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
                                      response( $.grep( tags, function( item ){
                                        return matcher.test( item );
                                      }) );
                                    },
                                    minLength: 0,
                                    open: function() {
                                      // After menu has been opened, set width to 100px
                                      jQuery('.ui-menu').width(jQuery( "#place_end_name" ).outerWidth() + jQuery("span.swap-address").outerWidth());
                                    },
                                  }).on( "click", function() {
                                    jQuery(this).trigger( "focus" );
                                    jQuery("body").addClass("hide_logo");
                                    // Pass empty string as value to search for, displaying all results
                                    jQuery(this).autocomplete( "search", "" );
                                  });

                                  jQuery('#home_booking_form').on('submit', function(e){
                                    if(window.localStorage.getItem('tx_location') != undefined )
                                      var location = jQuery.parseJSON(window.localStorage.getItem('tx_location'));
                                    else
                                      var location = [];
                                    var newLocation1 = jQuery('#place_start_name').val();
                                    var latLocation1 = jQuery('#lat_start').val();
                                    var longLocation1 = jQuery('#long_start').val();
                                    var cityLocation1 = jQuery('#city_start').val();
                                    var districtLocation1 = jQuery('#district_start').val();

                                    var newLocation2 = jQuery('#place_end_name').val();
                                    var latLocation2 = jQuery('#lat_end').val();
                                    var longLocation2 = jQuery('#long_end').val();
                                    var cityLocation2 = jQuery('#city_end').val();
                                    var districtLocation2 = jQuery('#district_end').val();

                                    var newLocationText = [];
                                      if(location.length > 0) {
                                        var checkExistPlaceStart = 0;
                                        var checkExistPlaceEnd = 0;
                                        for( var i=0; i < location.length; i++ ) {
                                          if(location[i].text == newLocation1 )
                                            checkExistPlaceStart ++;
                                          
                                          if(location[i].text == newLocation2 )
                                            checkExistPlaceEnd ++;
                                        }
                                        var idStart = location[0]['id'] + 1;
                                        var idEnd = location[0]['id'] + 1;
                                        if(checkExistPlaceStart === 0) {
                                          idEnd += 1;
                                          var newLocation = {
                                            'text' : newLocation1,
                                            'lat' : latLocation1,
                                            'long' : longLocation1,
                                            'city' : cityLocation1,
                                            'district' : districtLocation1,
                                            'id':idStart
                                          }
                                          newLocationText.push(newLocation);
                                        }

                                        if(checkExistPlaceEnd === 0){
                                          var newLocation = {
                                            'text' : newLocation2,
                                            'lat' : latLocation2,
                                            'long' : longLocation2,
                                            'city' : cityLocation2,
                                            'district' : districtLocation2,
                                            'id':idEnd
                                          }
                                          newLocationText.push(newLocation);
                                        }

                                      } else {
                                        var newLocationObj1 = {
                                          'text' : newLocation1,
                                          'lat' : latLocation1,
                                          'long' : longLocation1,
                                          'city' : cityLocation1,
                                          'district' : districtLocation1,
                                          'id':1
                                        }
                                        newLocationText.push(newLocationObj1);
                                        var newLocationObj2 = {
                                          'text' : newLocation2,
                                          'lat' : latLocation2,
                                          'long' : longLocation2,
                                          'city' : cityLocation2,
                                          'district' : districtLocation2,
                                          'id':2
                                        }
                                        newLocationText.push(newLocationObj2);
                                      }
                                      location = $.merge(location, newLocationText);
                                      location = location.sort(function(a, b){
                                        var x = a['id']; var y = b['id'];
                                        return ((x > y) ? -1 : ((x < y) ? 1 : 0));
                                      });
                                      if(location.length > 0) {
                                        for(var j = 1; j < location.length; j++) {
                                          if(j > 4){
                                            location.splice(j, location.length - 5);
                                          }
                                        }
                                      }
                                      window.localStorage.setItem('tx_location',JSON.stringify(location));
                                });

                                jQuery(document).click(function(event) {
                                  var $target = jQuery(event.target);
                                  if(!$target.closest('.div_datxe').length && !$target.closest('.ui-autocomplete').length) {
                                  jQuery("body").removeClass("hide_logo");
                                  }
                                });
                              });
                            </script>
                          </span>
                        </div>
                      </div>

                      <div class="form-group col-md-12 edit-add">
                        <!-- <label>điểm đến</label> -->
                        <div class="input-group append_drop_address_here pick_end">
                          <span class="input-group-addon"><i class="fa fa-map-marker mdrop" aria-hidden="true"></i></span>
                          <span class="custom-combobox">
                            <input value="" id="place_end_name"  title="điểm đến" class="custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left ui-autocomplete-input" autocomplete="off" data-original-title="" placeholder="Nhập điểm đến" name="place_end_name" required>
                            <span class="pick-icon-end" onclick="clearInputEnd()"><i class="fa fa-times" aria-hidden="true"></i></span>
                            <input type="hidden" value="" id="lat_end" name="lat_end" class="lat_fill">
                            <input type="hidden" value="" id="long_end" name="long_end" class="long_fill">
                            <input type="hidden" value="" id="city_end" name="city_end" class="city_fill">
                            <input type="hidden" value="" id="district_end" name="district_end" class="district_fill">
                            <div id="result_place_end" class="result-place-search"></div>
                          </span>
                        </div>
                      </div>
                      <span class="input-group-addon swap-address">
                        <svg class="jss1 swap-icon" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation"><path d="M16 17.01V10h-2v7.01h-3L15 21l4-3.99h-3zM9 3L5 6.99h3V14h2V6.99h3L9 3z"></path><path fill="none" d="M0 0h24v24H0z"></path></svg>
                      </span>
                    </div>
                    <!--
                    <div class="form-group col-md-12 edit-service">
                        <div class="input-group append_pick_address_here">
                          <span class="input-group-addon"><i class="fa fa-retweet" aria-hidden="true"></i></span>
                          <span class="custom-combobox">
                            <select name="service_id" class="form-control" id="service_id">
                            <option value="1">1 chiều</option>
                            <option value="3">2 chiều xe ở lại phục vụ</option>
                            <option value="2">2 chiều đưa đi đón về</option>
                          </select>
                          </span>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12 edit-date" id="date_start_row">
												<div class="row">
													<div class="col-md-8 col-xs-8">
														<div class="input-group gender_datetimeinput_here">
															<div class="start_datetimeinput_here">
																<span class="input-group-calendar start_calendar" data-date="08/09/2022"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Đi</span>
																<div class="controls input-append date form_datetime" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
																	<span class="start_day">08</span>
																	<span class="right-day">
																		<span class="start_thu">Thứ 5</span><br>
																		<span class="start_month">Tháng 09</span>
																	</span>
																	<input size="16" name="date_start"  id="date_start"  type="hidden" value="08/09/2022 13:34"  class="form-control flatpickr-input flatpickr-input">
																</div>

																
																<div class="modal fade datetimeModal" id="startTimeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<label>Chọn thời gian</label>
																				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

																			</div>
																			<div class="modal-body">
																				<div class="controls input-append date form_datetime" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
																					<input size="16" name="date_start_tmp"  type="text" value="08/09/2022"  class="form-control flatpickr-input flatpickr-input">
																					<span class="add-on"><i class="icon-th"></i></span>
																				</div>
																			</div>

																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-4 col-xs-4 start_time">
                            <div class="start_time_inner inner">
    													<span class="input-group-addon start_time_icon" data-time="13:34"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
    													<div class="controls input-append date start_time_data" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">13:34</div>
                            </div>
													</div>
												</div>

                                            </div>
                                            <div class="form-group edit-date" id="date_end_row">
												<div class="row">
													<div class="col-md-8 col-xs-8">
														<div class="input-group gender_datetimeinput_here">
															<div class="end_datetimeinput_here">
																<span class="input-group-calendar end_calendar" data-date="08/09/2022"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i> Đến</span>
																<div class="controls input-append date form_datetime" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">

																	<span class="end_day">08</span>
																	<span class="right-day">
																		<span class="end_thu">Thứ 5</span><br>
																		<span class="end_month">Tháng 09</span>
																	</span>
																	<input size="16" name="date_end"  id="date_end"  type="hidden" value="08/09/2022 13:34"  class="form-control flatpickr-input flatpickr-input">
																</div>
																<div class="modal fade datetimeModal" id="endTimeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<label>Chọn thời gian</label>
																				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

																			</div>
																			<div class="modal-body">
																				<div class="controls input-append date form_datetime" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
																					<input size="16" name="date_start_tmp"  type="text" value="08/09/2022"  class="form-control flatpickr-input flatpickr-input" style="    border: 1px solid #bbb;">
																					<span class="add-on"><i class="icon-th"></i></span>
																				</div>
																			</div>

																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-4 col-xs-4 end_time">
                                                        <div class="end_time_inner inner">
    														<span class="input-group-addon end_time_icon" data-time="13:34"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
    														<div class="controls input-append date end_time_data" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
    															13:34    														</div>
                                                        </div>
													</div>
												</div>

                                            </div>
                                            -->
                                            <div class="form-group" id="send">
                                                
                                                    <a class="btn btn-primary" id="send-order">
                                                        <span id="xem-gia">ĐẶT XE</span>
                                                        <div class="sk-fading-circle" id="icon-xem-gia">
                                                            <div class="sk-circle1 sk-circle"></div>
                                                            <div class="sk-circle2 sk-circle"></div>
                                                            <div class="sk-circle3 sk-circle"></div>
                                                            <div class="sk-circle4 sk-circle"></div>
                                                            <div class="sk-circle5 sk-circle"></div>
                                                            <div class="sk-circle6 sk-circle"></div>
                                                            <div class="sk-circle7 sk-circle"></div>
                                                            <div class="sk-circle8 sk-circle"></div>
                                                            <div class="sk-circle9 sk-circle"></div>
                                                            <div class="sk-circle10 sk-circle"></div>
                                                            <div class="sk-circle11 sk-circle"></div>
                                                            <div class="sk-circle12 sk-circle"></div>
                                                        </div>
                                                    </a>
                                               
                                                    <!-- <a class="btn btn-primary" data-toggle="modal" data-target="#popup_search_5times" style="width: 100%; background: #f26000; color: #fff; border: none; height: 45px; line-height: 45px; font-size: 16px; font-weight: 600; border-radius: 5px; padding: 0;">
                                                            XEM GIÁ
                                                    </a> -->
                                                
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
					</div>
				  </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
  function clearInputStart() {
    jQuery('#place_start_name').val('')
  }
  function clearInputEnd() {
    jQuery('#place_end_name').val('')
  }
  jQuery("#cainput_date").click(function(){
    jQuery(".hotline").hide(1000);
  });
  jQuery(".swap-address").click(function(){
    console.log('abc');
    let place_start_name = jQuery("#place_start_name").val();
    let lat_start = jQuery("#lat_start").val();
    let long_start = jQuery("#long_start").val();

    let place_end_name = jQuery("#place_end_name").val();
    let lat_end = jQuery("#lat_end").val();
    let long_end = jQuery("#long_end").val();

    jQuery("#place_start_name").val(place_end_name);
    jQuery("#place_end_name").val(place_start_name);

    jQuery("#lat_start").val(lat_end);
    jQuery("#lat_end").val(lat_start);

    jQuery("#long_start").val(long_end);
    jQuery("#long_end").val(long_start);
  });

  document.getElementById("service_id").addEventListener("change", function(){
    var service_id = jQuery("#service_id").val();
    if(service_id !=1)
      jQuery("#date_end_row").css('display','block');
    else
      jQuery("#date_end_row").css('display','none');
  });
  document.getElementById("send-order").addEventListener("click", function(e){
    let countSearch = parseInt(sessionStorage.getItem('count_search'));
    sessionStorage.setItem('count_search', ++countSearch);
    console.log(sessionStorage.getItem('count_search'));
    

    if (sessionStorage.getItem('count_search') == 5){
      jQuery('#popup_search_5times').modal('show');
      return;
    }
		
		let arr_district28 = ["tây hồ", "cầu giấy", "ba đình", "hoàn kiếm", "đống đa", "bắc từ liêm", "đông anh"];
		let arr_district31 = ["thanh xuân", "hai bà trưng", "long biên", "nam từ liêm"];
		let newLocation1 = jQuery('#place_start_name').val().toLowerCase().trim();
		let cityLocation1 = jQuery('#city_start').val().toLowerCase().trim();
		let districtLocation1 = jQuery('#district_start').val().toLowerCase().trim();

		let newLocation2 = jQuery('#place_end_name').val().toLowerCase().trim();
		let cityLocation2 = jQuery('#city_end').val().toLowerCase().trim();
		let districtLocation2 = jQuery('#district_end').val().toLowerCase().trim();
		
    let checkPhuQuoc = false;

    if (cityLocation1 == 'kiên giang' && cityLocation2 == 'kiên giang'){
        if ( newLocation2.search('phú quốc') !== -1 || newLocation1.search('phú quốc') !== -1 )
    checkPhuQuoc = true;
    }
    var submit = jQuery("#check_submit").val();
    if(submit == 2){
      jQuery("#check_submit").val(1);
      var date_start = formatDateTime(jQuery("#date_start").val());
			var service_id = jQuery("#service_id").val();
			var date_end = formatDateTime(jQuery("#date_end").val());
      var now = new Date();
      now.setMinutes(now.getMinutes() + 5);
      now = new Date(now);
			console.log(date_start);
			if (service_id == 1 ) {
				if(date_start < now){
					jQuery("#check_submit").val(2);
					alert("Thời gian khởi hành phải lớn hơn thời gian hiện tại 5 phút");
					return false;
				}
			} else {
				if(date_start < now){
					jQuery("#check_submit").val(2);
					alert("Thời gian khởi hành phải lớn hơn thời gian hiện tại 5 phút");
					return false;
				}

				if (date_end < date_start) {
					jQuery("#check_submit").val(2);
					alert("Thời gian về phải lớn hơn thời gian đi 5 phút");
					return false;
				}
			}
			jQuery("#xem-gia").css("display","none");
			jQuery("#icon-xem-gia").css("display","block");
			var place_start_name = document.getElementById('place_start_name').value;
			var lat_start = document.getElementById('lat_start').value;
			var long_start = document.getElementById('long_start').value;

			var place_end_name = document.getElementById('place_end_name').value;
			var lat_end = document.getElementById('lat_end').value;
			var long_end = document.getElementById('long_end').value;
			var check = true;
			if(place_start_name == '' || lat_start == '' || long_start == '') {
				check = false;
				alert("Vui lòng nhập lại điểm đón");
			}

			if(place_end_name == '' || lat_end == '' || long_end == '') {
				check = false;
				alert("Vui lòng nhập lại điểm đến");
			}
			if(check) {
				var km_old = jQuery("#km_input").val();
				if(km_old == '') {
          if((newLocation1.search('nội bài') !== -1 || newLocation1.search('noi bai') !== -1) && districtLocation1 == "sóc sơn" && cityLocation1 == "hà nội" && cityLocation2 == "hà nội"){
            if(arr_district28.includes(districtLocation2)){
              jQuery("#km_input").val(28);
              jQuery("#home_booking_form").submit();
              return;
            }else if(arr_district31.includes(districtLocation2)){
              jQuery("#km_input").val(31);
              jQuery("#home_booking_form").submit();
              return;
            }
          }
          if((newLocation2.search('nội bài') !== -1 || newLocation2.search('noi bai') !== -1) && districtLocation2 == "sóc sơn" && cityLocation1 == "hà nội" && cityLocation2 == "hà nội"){
            if(arr_district28.includes(districtLocation1)){
              jQuery("#km_input").val(28);
              jQuery("#home_booking_form").submit();
              return;
            }else if(arr_district31.includes(districtLocation1)){
              jQuery("#km_input").val(31);
              jQuery("#home_booking_form").submit();
              return;
            }
          }       

					var origin1 = new google.maps.LatLng(lat_start,long_start);
					var origin2 = place_start_name;
					var destinationA = place_end_name;
					var destinationB = new google.maps.LatLng(lat_end, long_end);
					var service = new google.maps.DistanceMatrixService;
					service.getDistanceMatrix({
            origins: [origin1, origin2],
            destinations: [destinationA, destinationB],
            travelMode: 'DRIVING',
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false
          }, function(response, status) {
            console.log('Km : ' + status);
            if (status != 'OK') {
              jQuery("#check_submit").val(2);
              jQuery("#xem-gia").css("display","block");
              jQuery("#icon-xem-gia").css("display","none");
              jQuery("#load-123").css("display","none");
              alert('Hệ thống không tính được km, hãy liên hệ tổng đài 19000370 để đặt chuyến');
            } else {
              var dist='empty';
              if(response!=''){
                for (var i=0; i<response.rows.length; i++) {
                  for (var b=0;b<response.rows[i].elements.length;b++) {
                    if(response.rows[i].elements[b].status =='OK'){
                      dist = response.rows[i].elements[b].distance.text;
                      break;
                    }
                  }
                }
              }
              if (dist != 'empty') {
                var v_dist = dist.replace("km", "");
                v_dist = v_dist.replace(",", ".");
                v_dist = v_dist.trim();
                jQuery("#km_input").val(v_dist);
                km = document.getElementById('km_input').value;
                jQuery("#home_booking_form").submit();
              }else {
                jQuery("#check_submit").val(2);
                jQuery("#xem-gia").css("display","block");
                jQuery("#icon-xem-gia").css("display","none");
                jQuery("#load-123").css("display","none");
              }
            }
					}
				);
			} else {
				jQuery("#home_booking_form").submit();
			}
		} else {
      jQuery("#check_submit").val(2);
      jQuery("#xem-gia").css("display","block");
      jQuery("#icon-xem-gia").css("display","none");
      jQuery("#load-123").css("display","none");
		}
  }

    });
    function formatDateTime(dateObject) {
        var dateTime = dateObject.split(" ");
        var date = dateTime[0].split("/");
        var time = dateTime[1].split(":");
        var f = new Date(date[2], date[1]-1, date[0],time[0],time[1],0);
        return f;
    }
</script>
<script type="text/javascript">
    var d = new Date();

    var month = d.getMonth()+1;
    var day = d.getDate();
    var h = d.getHours();
    var m = d.getMinutes();

    var output = (day<10 ? '0' : '') + day + '/' + (month<10 ? '0' : '') + month + '/' + d.getFullYear() + ' ' +(h<10 ? '0' : '') + h + ':'+ (m<10 ? '0' : '') + m;

	function getCurrentLocation() {
		// Try HTML5 geolocation.
		if (navigator.geolocation) {
		  navigator.geolocation.getCurrentPosition(
			(position) => {
			  const pos = {
				lat: position.coords.latitude,
				lng: position.coords.longitude,
			  };

			  initializeCurrent(pos.lat, pos.lng);


			},
			() => {
				//alert("Error: The Geolocation service failed");
			}
		  );
		} else {
		  //alert("Error: The Geolocation service failed");
		}
	}

	//Check value is present or
	function initializeCurrent(latcurr, longcurr) {
		currgeocoder = new google.maps.Geocoder();
		jQuery("#lat_start").val(latcurr);
		jQuery("#long_start").val(longcurr);
		console.log(latcurr + "-- ######## --" + longcurr);

		if (latcurr != '' && longcurr != '') {
			//call google api function
			var myLatlng = new google.maps.LatLng(latcurr, longcurr);
			return getCurrentAddress(myLatlng);
		}
	}

	//Get current address
	function getCurrentAddress(location) {
		currgeocoder.geocode({
			'location': location
		}, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				console.log(results[0]);
				jQuery("#place_start_name").val(results[0].formatted_address);
			} else {
				alert('Geocode was not successful for the following reason: ' + status);
			}
		});
	}


    jQuery(document).ready(function($) {
        jQuery(window).ready(function($) {
            var viewport = jQuery(window).width();
            if ( viewport <= 900 ) {
                jsProcess('mobile');
            } else {
                jsProcess('pc');
            }
        });

        function jsProcess(screen) {

            if( screen == 'pc') {
                jQuery('#booking-car').show();
                jQuery('.form_datetime input').datetimepicker({
                    lang:'vi',
                    onChangeDateTime:function(dp,$input){
                    },
                    //format: 'dd/mm/yyyy hh:ii',
                    format: 'd/m/Y',
                    startDate: output,
                    minuteStep: 10,
                    //minTime:0,
                    minDate:0,
                    step:15,
                    //inline:true
                    debug: true
                });
            } else {
                jQuery('#home_booking_form label').hide();
                jQuery('#sp-title').show();
                jQuery('div.input-group').css('margin-bottom', "10px");
                jQuery('#booking-car').show();

                jQuery('#startTimeModal .form_datetime input').datetimepicker({
                    lang:'vi',
                    onChangeDateTime:function(dp,$input){
                    },
                    onSelectTime:function(current_time,$input){
                        jQuery('.modal-header button').trigger('click');
                    },
                    //format: 'dd/mm/yyyy hh:ii',
                    format: 'd/m/Y',
                    startDate: output,
                    minuteStep: 10,
                    //minTime:0,
                    minDate:0,
                    step:15,
                    inline:true,
                    timepickerScrollbar: true,
					touchMovedThreshold: 10,
                    debug: true,
                    // timeFormat:'18:00'
                });
                jQuery('.form_datetime #date_start').click(function(e) {
                    jQuery('#startTimeModal').modal("show");
                });
                jQuery("#startTimeModal").on('hide.bs.modal', function(){
                    jQuery('.form_datetime #date_start').val(jQuery('#startTimeModal .form_datetime input').val())
                });

                //date_end
                jQuery('#endTimeModal .form_datetime input').datetimepicker({
                    lang:'vi',
                    onChangeDateTime:function(dp,$input){
                    },
                    onSelectTime:function(current_time,$input){
                        jQuery('.modal-header button').trigger('click');
                    },
                    //format: 'dd/mm/yyyy hh:ii',
                    format: 'd/m/Y H:i',
                    startDate: output,
                    minuteStep: 10,
                    //minTime:0,
                    minDate:0,
                    step:30,
                    inline:true,
                    timepickerScrollbar: false
                });
                jQuery('.form_datetime #date_end').click(function(e) {
                    jQuery('#endTimeModal').modal("show");
                });
                jQuery("#endTimeModal").on('hide.bs.modal', function(){
                    jQuery('.form_datetime #date_end').val(jQuery('#endTimeModal .form_datetime input').val())
                });
            }
        }

        // jQuery(window).resize(
        //     viewport.changed(function(){
        //         jQuery('.form_datetime input').unbind();
        //         jsProcess();
        //         // console.log('Current breakpoint:', viewport.current());
        //     })
        // );


		jQuery('.start_datetimeinput_here').datetimepicker({
		  timepicker:false,
		  format: 'd/m/Y',
		  onChangeDateTime:function(dp,$input){
			var dateObject = $input.val();
			var dateTime = dateObject.split("/");
			var day = dp.getDay();

			var day_name = '';


			switch (day) {
			case 0:
				day_name = "Chủ nhật";
				break;
			case 1:
				day_name = "Thứ 2";
				break;
			case 2:
				day_name = "Thứ 3";
				break;
			case 3:
				day_name = "Thứ 4";
				break;
			case 4:
				day_name = "Thứ 5";
				break;
			case 5:
				day_name = "Thứ 6";
				break;
			case 6:
				day_name = "Thứ 7";
			}

			console.log("Date");

			jQuery(".start_day").html(dateTime[0]);
			jQuery(".start_thu").html(day_name);
			jQuery(".start_month").html("Tháng " + dateTime[1]);
			jQuery(".start_calendar").attr("data-date", $input.val());
			console.log(jQuery('.start_calendar').attr("data-date") + " " + jQuery('.start_time_icon').attr("data-time"));
			jQuery("#date_start").val(jQuery('.start_calendar').attr("data-date") + " " + jQuery('.start_time_icon').attr("data-time"));
		  }
		});

		jQuery('.start_time_inner').datetimepicker({
		  datepicker:false,
		  minuteStep: 15,
		  format: 'H:i',
		  lazyInit: true,
		  step:15,
		  timepickerScrollbar: false,
		  onChangeDateTime:function(dp,$input){
			console.log("time");
			jQuery(".start_time_data").html($input.val());
			jQuery(".start_time_icon").attr("data-time", $input.val());
			jQuery("#date_start").val(jQuery('.start_calendar').attr("data-date") + " " + jQuery('.start_time_icon').attr("data-time"));
		  }
		});

		jQuery('.end_datetimeinput_here').datetimepicker({
		  timepicker:false,
		  format: 'd/m/Y',
		  onChangeDateTime:function(dp,$input){
			var dateObject = $input.val();
			var dateTime = dateObject.split("/");
			var day = dp.getDay();

			var day_name = '';


			switch (day) {
			case 0:
				day_name = "Chủ nhật";
				break;
			case 1:
				day_name = "Thứ 2";
				break;
			case 2:
				day_name = "Thứ 3";
				break;
			case 3:
				day_name = "Thứ 4";
				break;
			case 4:
				day_name = "Thứ 5";
				break;
			case 5:
				day_name = "Thứ 6";
				break;
			case 6:
				day_name = "Thứ 7";
			}

			jQuery(".end_day").html(dateTime[0]);
			jQuery(".end_thu").html(day_name);
			jQuery(".end_month").html("Tháng " + dateTime[1]);
			jQuery(".end_calendar").attr("data-date", $input.val());
			jQuery("#date_end").val(jQuery('.end_calendar').attr("data-date") + " " + jQuery('.end_time_icon').attr("data-time"));
		  }
		});

		jQuery('.end_time_inner').datetimepicker({
		  datepicker:false,
		  minuteStep: 15,
		  format: 'H:i',
		  lazyInit: true,
		  step:15,
		  timepickerScrollbar: false,
		  onChangeDateTime:function(dp,$input){

			jQuery(".end_time_data").html($input.val());
			jQuery(".end_time_icon").attr("data-time", $input.val());
			jQuery("#date_end").val(jQuery('.end_calendar').attr("data-date") + " " + jQuery('.end_time_icon').attr("data-time"));
		  }
		});



		jQuery(".getCurrentLocation").on("click", function(){
			getCurrentLocation();
		});
    });
</script>
<script>
    initAutocompleteService('#place_start_name','#result_place_start');
    initAutocompleteService('#place_end_name','#result_place_end');
</script>