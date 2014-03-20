// load scripts

head.load(
    // load all dependencies
    
    "//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js",
	"//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js",
    "/scripts/lib/shared.js",
	
    function() {
        // load page specific scripts
        var home = document.getElementById("home");
		var camp = document.getElementById("camp");
		var social = document.getElementById("social");
		var program = document.getElementById("program");
		var coach = document.getElementById("coach");
		var japan = document.getElementById("japan");		
        
        if( home ) {
			head.load("/scripts/lib/jquery.slides.js");
			head.load("/scripts/lib/jquery.colorbox.js");
            head.load("/scripts/pages/home.js");
        }
		
		if( camp ) {
            head.load("/scripts/pages/camp.js");
        }
		
		if( social ) {
			head.load("/scripts/lib/jquery.colorbox.js");
			head.load("/scripts/pages/social.js");
		}
		
		if( program ) {
			head.load("/scripts/lib/jquery.colorbox.js");
			head.load("/scripts/pages/program.js");
		}
		
		if( coach ) {
			head.load("/scripts/pages/coach.js");
		}
		
		if( japan ) {
			head.load("/scripts/lib/jquery.colorbox.js");
			head.load("/scripts/lib/jquery.countdown.js");
			head.load("/scripts/lib/jquery.bxslider.min.js");			
			head.load("/scripts/pages/japan.js");			
		}		
		
		// roll overs
        $('.cta').hover(function() { 
			$(this).addClass('hoverstate');
			$(this).find('span').addClass('hoverstate');
		}, function() {
			$(this).removeClass('hoverstate');
			$(this).find('span').removeClass('hoverstate');
		});
    }

);