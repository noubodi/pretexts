$(document).ready(function(){

  $('.slick-slider').slick({
    slidesToShow: 3,
	slidesToScroll: 1,
	variableWidth: true,
	arrows: true,
	dots: false,
	centerMode: true,
	focusOnSelect: true
	});

  $('#header ul li').on('click', function(e) {
  	e.preventDefault();
  	if ( $(this).children().length > 1 ) {
	     // show submenu
	     $(this).toggleClass('active-btn subnav');
	} else {
		//window.open($(this).attr('href'));
   		//return false;
   		window.location.href = $(this).children().attr('href');
	}

  });


  	var p=$('.card-text-wrapper p');
	var divh=$('.card-text-wrapper').height();
	while ($(p).outerHeight()>divh) {
	    $(p).text(function (index, text) {
	        return text.replace(/\W*\s(\S)*$/, '...');
	    });
	}


  	



});




