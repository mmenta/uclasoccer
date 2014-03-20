// scripts for japan

(function() {


	var japan = {
        
		social : {
			
			render : function(rend) {		
				var filter = $(".social-filter").val();
				
				$(".loading").show();
				
				var rend = 'html';
				var hashtag = $(".social-hashtag").val();
		
				$.ajax({
					type: "GET",
					url: "/views/partials/japan/render-social.php",
					data: { 'hashtag' : hashtag, 
							'type': filter }
				}).done(function(data) {
					if(rend == 'html') {
						$(".social .box-wrap").html(data);
					} else if(rend == 'append') {
						$(".social .box-wrap").append(data);
					}
					$(".loading").hide();
				});
			},
			
			listeners : function() {
				/*
				$(".social .cta").click(function(e) {
					e.preventDefault();
					$(".loading-more").show();
					
					//iterate page
					var current = $(".social-page").val();
					$(".social-page").val(parseInt(current) + 1);
					
					setTimeout(function() {
						japan.social.render('append');
						$(".loading-more").hide();
					}, 2000);
				});
				*/
				$(".social-filter a").click(function(e) {
					e.preventDefault();
					//scroll to social
					var scrollPos = $(".social").offset().top;
					$('html, body').animate({
						scrollTop: scrollPos - 60
					 }, 300, 'easeOutQuad');
					
					$(".loading").show();
					
					//change filter type
					var filter = $(this).attr('class');
					$(".social-filter").val(filter);
					//reset pagination
					$(".social-page").val('1');
					var hashtag = $(".social-hashtag").val();
					var rend = 'html';

					$.ajax({
						type: "GET",
						url: "/views/partials/japan/render-social.php",
						data: { 'hashtag': hashtag, 
								'type': filter }
					}).done(function(data) {
						if(rend == 'html') {
							$(".social .box-wrap").html(data);
						} else if(rend == 'append') {
							$(".social .box-wrap").append(data);
						}
						
						$(".loading").hide();
					});
					
				});
				
				$(".sociallinks a").click(function(e) {
					e.preventDefault();
					//scroll to social
					var scrollPos = $(".social").offset().top;
					$('html, body').animate({
						scrollTop: scrollPos - 60
					}, 300, 'easeOutQuad');
				
					$(".loading").show();
				
					var hashtag = $(this).children(".hashtag").val();
					var filter = 'all';
					$(".social-filter").val(filter);
					var rend = 'html';
					
					$(".social-hashtag").val(hashtag);
					
					//change title
					$(".hashtag-label").html("#" + hashtag);
					
					$.ajax({
						type: "GET",
						url: "/views/partials/japan/render-social.php",
						data: { 'hashtag': hashtag, 
								'type': filter }
					}).done(function(data) {
						if(rend == 'html') {
							$(".social .box-wrap").html(data);
						} else if(rend == 'append') {
							$(".social .box-wrap").append(data);
						}
						
						$(".loading").hide();
					});
				
				});
				
				$(".backtomap").click(function() {
					var scrollPos = 0;
					$('html, body').animate({
						scrollTop: scrollPos
					}, 300, 'easeOutQuad');
				
				});
				
				$("#japan").on("click", ".btn-close, .overlay, .btn-wrap a", function() {
					
					$(".boarding-pass-modal").fadeOut();
					$(".overlay").fadeOut();
				
				});
			
			},

			init : function() {
				
				this.render('html');
				this.listeners();
			}
		
		}
		
    }; // japan

	
	japan.social.init();
	
		  
/* countdown */
/*
	var endDate = "March 20, 2014 00:35:00";
	$('.countdown_timer').countdown({
	  date: endDate,
	  render: function(data) {
		$(this.el).html("<div class='days'>" + this.leadingZeros(data.days, 2) + "  &nbsp;: &nbsp;</div><div class='hrs'>" + this.leadingZeros(data.hours, 2) + " &nbsp;: &nbsp;</div><div class='min'>" + this.leadingZeros(data.min, 2) + "</div><div class='clear'></div>");
	  }
	});
*/
	
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

/* textarea counter */
	$("#message").counter({
		count: 'down',
		goal: 140
	});	 

}(window));
