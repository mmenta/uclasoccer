// scripts for japan

(function() {
		  
/* countdown */
	var endDate = "March 20, 2014 00:35:00";
	$('.countdown_timer').countdown({
	  date: endDate,
	  render: function(data) {
		$(this.el).html("<div class='days'>" + this.leadingZeros(data.days, 2) + "  &nbsp;: &nbsp;</div><div class='hrs'>" + this.leadingZeros(data.hours, 2) + " &nbsp;: &nbsp;</div><div class='min'>" + this.leadingZeros(data.min, 2) + "</div><div class='clear'></div>");
	  }
	});
	
/* letters modal */	
	$(".btn_send").click(function(){
		$('form').find("input[type=text], textarea").val("");											  
		$('.success').hide();											  			
		$('.compose').show();
								  
		$.colorbox({
			inline:true, 			   
			href: '#postcard',
			width: 433,
			opacity: 0.90
		});			
	});		

/* letters submit */	
	$("#tweet_form > form").submit(function(){			
		var fields = $(this).serialize();
		var error = 0;
		var full_name = $('#full_name').val();
		var city = $('#city').val();
		var message = $('#message').val();		

		if (full_name == "" || message == "") {
			error = 1;
		}

		if (error == 0) {
			$.ajax({
				type: "GET",
				url: "/views/partials/japan/submit-text.php",
				data: fields
			}).done(function(data) {
				$('.compose').hide();
				$('.success').fadeIn();			
				$.colorbox.resize();
			});
		}
		return false;			
	});
	
/* letters slider */	
	$('ul#items').bxSlider({
		slideWidth: 398,		
		minSlides: 1,
		maxSlides: 3,
		slideMargin: 10,
		pager: false,
		infiniteLoop: false,
		hideControlOnEnd: true,					
		preloadImages: false
	});
}(window));
