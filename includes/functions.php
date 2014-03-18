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










?>