// scripts for program

(function() {
    
    var program = {
        
		utils : {
			
			render : function() {
			
				$.ajax({
					type: "GET",
					url: "/views/partials/program/render-media.php",
					data: { 'page' : $(".media-page").val() }
				}).done(function(data) {
					
					$(".media-wrap").append(data);
				});
			
			
			},
			
			listeners : function() {
				
				$(".media-wrap").on("click", "li", function() {
					
					var type = $(this).children(".media-type").val();
					var link = $(this).children(".media-link").val();
					
					$.colorbox({
						href: "/views/partials/modal-popup.php",
						data: { 'type': type,
								'link': link }
					});
				
				});
				
				$("#program .media .cta").click(function(e) {
					e.preventDefault();
					
					//iterate page
					var current = $(".media-page").val();
					var next = parseInt(current) + 1;
					$(".media-page").val(next);
					
					program.utils.render();
					
				
				});
			
			},

			init : function() {
				
				this.listeners();
				this.render();
			}
		
		}
		
		
        
    }; //home
	
    program.utils.init();
    
}(window));
