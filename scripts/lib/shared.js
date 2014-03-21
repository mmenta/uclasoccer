// shared scripts

(function() {
	var home = document.getElementById("home");
	var social = document.getElementById("social");
	var program = document.getElementById("program");
    var camps = document.getElementById("camps");
	var coach = document.getElementById("coach");
    
    var shared = {
        
        utils :  {
            
            listeners : function() {
				
				$(".box-wrap").on("click", ".twitter, .facebook, .instagram", function() {
					
					var id = $(this).children(".id").val();
					var type = $(this).attr("class");
					
					$.colorbox({
						href: "/views/partials/social-modal.php",
						data: { "id" : id, "type" : type }
					});
				
				});
				
				$(".scroll-arrow").click(function() {
					// get height of parent
					var scrollPos = $(this).parents("section").height();
					shared.utils.scroll(scrollPos, 800, "easeOutBack");
				});
				
				$(".subnav a").click(function(e) {
					e.preventDefault();
					var link = $(this).attr("href");
					history.pushState("", "", link);
					
					// set animation time
					var t = 300;
					
					// scroll up, subtract height of subnav and menu
					var subtract = $(".title-bar").height() + $(".subnav").height() + 40 - 1;
					var scrollPos = $(".render").offset().top - subtract;					
					
					// animate
					shared.utils.scroll(scrollPos, t);
					
					setTimeout(function() {
						// render
						shared.renders.render();
					
					}, t - 100);

					//change active state
					$(".subnav li").removeClass("active");
					$(this).parent("li").addClass("active");
				});
			
            }, //listeners
            
			scroll : function(scrollPos, t, effect) {
				
				t = typeof t !== 'undefined' ? t : 500;
				effect = typeof effect !== 'undefined' ? effect : "easeOutExpo";
				
				$('html, body').animate({
					scrollTop: scrollPos
				 }, t, effect);
			
			},
			
            init : function() {
                
                this.listeners();
                
            } //init
            
        }, //utils
        
        nav : {
            
            openMenu : function() {
				var $el;
				
				$(".btn-menu").click(function(e) {
					$el = $(this).siblings(".menu");
					e.preventDefault();
					
					if( $el.is(":visible") ) {
						$el.hide();
					} else {
						$el.show();
					}
				});
            }, //openMenu
			
			subnavStick : function() {
				
				//get position of subnav
				var headingHeight = 100, 
					subnavHeight = $(".subnav").height() + 40;
					currentPos = 0,
					$el = $(".subnav"),
					$next = $el.next("section");
					subnavPos = $el.offset().top,
				
				stickMenu = function() {
					if( !$el.hasClass("stick") ) {
						$el.css({
							"position": "fixed",
							"top": "100px"
						});
						$next.css("margin-top", subnavHeight + "px");
						$el.addClass("stick");
					}
				}
				
				unstickMenu = function() {
					if( $el.hasClass("stick") ) {
						$el.css({
							"position": "relative",
							"top": "0"
						});
						$next.css("margin-top", "0");
						$el.removeClass("stick");
					}
				}
				
				$(window).scroll(function() {
					currentPos = $(document).scrollTop() + headingHeight;
					if( currentPos >= subnavPos ) {
						stickMenu();
					} else {
						unstickMenu();
					}
				});
			
			}, //subnavStick
			
            init : function() {
                this.openMenu();
				
				// load selectively
				if( camps || coach ) {
					this.subnavStick();
                }
				
            } //init
            
        }, //nav
		
		renders :  {
		
			render: function() {
				
				var currentPath = window.location.pathname;
				// break up url
				var url =  currentPath.split("/");
				
				if( url[2] != undefined ) {
					// render subpage
					$.ajax({
						url: "/views/partials/" + url[1] + "/" + url[2] + ".php"
					}).done(function(data) {
						$(".render").html(data);
					});
				} else {
					// render default
					currentPath = $(".active a").attr("href");
					url =  currentPath.split("/");
					$.ajax({
						url: "/views/partials/" + url[1] + "/" + url[2] + ".php"
					}).done(function(data) {
						$(".render").html(data);
					});
				}
			},
            
            init : function() {
				
				// load selectively
				if( camps || coach ) {
					this.render();
				}
                
            } // init
			
        } // renders
        
    }; //shared
    
    shared.utils.init();
    shared.nav.init();
	shared.renders.init();
    
}(window));