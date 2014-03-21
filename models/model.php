<?php
class Model {
	
	public $mainUrl;
	public $subUrl;
	
    function __construct($url) {
		$this->mainUrl = $url[0];
        $this->subUrl = isset($url[1]) ? $url[1] : null;		
		
	}
	
	// URL Functions =======================================
	
	function page() {
		return $this->mainUrl;
	}
	
	function subpage() {
		if( isset($this->subUrl) ) {
			$subpage = $this->subUrl;
		} else {
			$subpage = null;
		}
		return $subpage;
	}
	
	// Page Variables ======================================
	//pass custom variables for home page
	function home() {

	}
	
	function coach() {
	
	}
	
	function program() {
	
	}
	
	function camps() {
	
	}
	
	function social() {
	
	}
	
	function japan() {
	
	}
	
	
				
}



?>
