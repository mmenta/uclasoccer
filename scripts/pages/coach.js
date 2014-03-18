// scripts for coach

(function() {
    
    var coach = {
        
		utils : {
			
			render : function() {
			
				$.ajax({
					type: "GET",
					url: "/views/partials/coach/render-social.php",
					data: { 'page' : $(".social-page").val() }
				}).done(function(data) {
					
					$(".tweets").append(data);
				});
			
			},
			
			listeners : function() {
				
				$("#coach").on("click", ".twitter-social .cta", function(e) {
					e.preventDefault();
					
					//iterate page
					var current = $(".social-page").val();
					var next = parseInt(current) + 1;
					$(".social-page").val(next);
					
					coach.utils.render();
				});
				
				$(".subnav a").click(function() {
					if( $(this).html() == 'Social' ){
						// scroll up, subtract height of subnav and menu
						var subtract = $(".title-bar").height() + $(".subnav").height() + 40 - 1;
						var scrollPos = $(".render").offset().top - subtract;
						$('html, body').animate({
							scrollTop: scrollPos
						 }, 300, 'easeOutExpo');
					
						$(".social-page").val(1);
						coach.utils.render();
					}
				});
				
				$("#coach").on("click", ".video-thumb", function(e) {
					e.preventDefault();
					
					console.log('test');
					
					var video_id = $(this).children(".video-id").val();
					var html = '<iframe width="960" height="535" src="//www.youtube.com/embed/'+video_id+'?rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe>';
					
					$(".main-frame").html(html);
				});
			},

			init : function() {
				
				this.listeners();
				this.render();
			}
		
		}
		
		
        
    }; //home
	
    coach.utils.init();
    
}(window));
