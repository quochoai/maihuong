jQuery(document).ready(function($){function loadData(page){$.post(linkData,{page:page,whereNews:whereNews},function(dataResponse){$('.loader-content').hide();$('#contentNews').html(dataResponse);});}loadData(1);$('body').on('click','a.linkRef',function(){var page=$(this).attr('rel');loadData(page);$('html, body').animate({scrollTop: $("h1.title-head").offset().top}, 2000);});});