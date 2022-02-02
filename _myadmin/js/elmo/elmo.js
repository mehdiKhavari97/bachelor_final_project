$(window).load(function(){

	// +++++++++++++++++++++ defualt +++++++++++++++


	// height
	// height
	if ($(window).width() > 800) {
		var menu_height = $('#elmo_menu').height();
		var leftbar_height = $('#mainbox').height();
		if(menu_height>leftbar_height){ main_height = menu_height; } else { main_height = leftbar_height; }

		$('#elmo_menu').css('height',main_height);
		$('#mainbox').css('height',main_height);
	}
	else
	{
		$('#elmo_menu').css('position','fixed');
		$('#elmo_menu').css('height','100vh');
	}
	// height
	// height

	// width
	// width
	var menu_width = 170;
	$('#elmo_menu').css('width',menu_width);

	var leftbar_width = $('#left_bar').width()-menu_width;
	if ($(window).width() < 800) {
		var leftbar_width = '100%';
	}
	$('#left_bar').css('width',leftbar_width);
	// width
	// width
	// +++++++++++++++++++++ defualt +++++++++++++++


	// +++++++++++++++++++++ open & close +++++++++++++++
	$('.elmo_menu_open').css('display','none');

			// Close function
			$.fn.Close = function() {
				$('#elmo_menu').css('width',0);
				$('#left_bar').css('width','100%');

				$('.elmo_menu_open').css('display','inline-block');
				$('.elmo_menu_close').css('display','none');
			}
			// Open function
			$.fn.Open = function() {
				$('#elmo_menu').css('width',menu_width);
				$('#left_bar').css('width',leftbar_width);

				$('.elmo_menu_open').css('display','none');
				$('.elmo_menu_close').css('display','inline-block');
		    	event.stopPropagation();
			}

	// close
	if ($(window).width() < 800) {
		$(document).click(function(){
			$.fn.Close();
		});
	}

	// close 
	$(".elmo_menu_close").click(function(){
		$.fn.Close();
	});
	$("#elmo_menu").click(function(){
    	event.stopPropagation();		
	});
	// open 
	$(".elmo_menu_open").click(function(){
		$.fn.Open();
	});
	// close 
	// +++++++++++++++++++++ open & close +++++++++++++++


	if ($(window).width() < 800) {
		$('#elmo_menu').css('width',0);
		$('#left_bar').css('width','100%');

		$('.elmo_menu_open').css('display','inline-block');
		$('.elmo_menu_close').css('display','none');
	}

});