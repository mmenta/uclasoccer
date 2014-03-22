<?php

// Routing Fuctions ===============================

function parseUrl($currentPage) {
    
    // parse url 
    $parsedUrl = explode('/', $currentPage);

    foreach( $parsedUrl as $parsed ) {
    	if( trim($parsed) != '' ) {
    		$url[] = trim($parsed);
    	}
    }
    
    if( empty($url) ) {
        $url[] = 'home';  
    }
    
    return $url;
}

// Time ago ===============================

function ago($time) {
   $periods = array("sec", "min", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "s";
   }

   return "$difference $periods[$j] ago";
}









?>