// scripts for homepage

(function() {
    
    var home = {
    
        carousel :  {
            
            slideshow : function() {
            
				$("#slides").slidesjs({
					width: 1340,
					height: 696,
					play: {
						interval: 5000,
						auto: true
					},
					navigation: {
						active: false
					}
				});
            
            }, //testing
            
            
            init : function() {
                
                this.slideshow();
                
            } //init
            
        }, //carousel
        
		social : {
			
			render : function(rend) {		
				var filter = $(".social-filter").val();
		
				$.ajax({
					type: "GET",
					url: "/views/partials/home/render-social.php",
					data: { 'page' : $(".social-page").val(), 
							'type': filter }
				}).done(function(data) {
					if(rend == 'html') {
						$(".social .box-wrap").html(data);
					} else if(rend == 'append') {
						$(".social .box-wrap").append(data);
					}
				});
			},
			
			listeners : function() {
				
				$(".social .cta").click(function(e) {
					e.preventDefault();
					$(".loading-more").show();
					
					//iterate page
					var current = $(".social-page").val();
					$(".social-page").val(parseInt(current) + 1);
					
					setTimeout(function() {
						home.social.render('append');
						$(".loading-more").hide();
					}, 2000);
				});
				
				$(".social-filter a").click(function(e) {
					e.preventDefault();
					//scroll to social
					var scrollPos = $(".social").offset().top;
					$('html, body').animate({
						scrollTop: scrollPos
					 }, 300, 'easeOutQuad');
					
					$(".loading").show();
					
					//change filter type
					var current = $(this).attr('class');
					$(".social-filter").val(current);
					//reset pagination
					$(".social-page").val('1');

					home.social.render('html');
					$(".loading").hide();
				});
			
			},

			init : function() {
				
				this.render('html');
				this.listeners();
			}
		
		}
		
		
        
    }; //home
    
    
    home.carousel.init();
    home.social.init();
    
}(window));
