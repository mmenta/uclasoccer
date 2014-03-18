<?php
class Model {
	
	public $mainUrl;
	public $subUrl;
	//public $docRoot = $_SERVER['DOCUMENT_ROOT'];
	
    function __construct($url) {
		$this->mainUrl = $url[0];
        $this->subUrl = isset($url[1]) ? $url[1] : null;		
		$this->docroot = $_SERVER['DOCUMENT_ROOT'];
		
		//social info
		$this->twitterHandle = 'UCLAWSoccer'; //handle
		$this->instagramId = '407937791'; //id
		$this-> facebookId = '260680503972775'; //album-id
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
	
	// Social Functions ===================================
	function getTwitter($page, $count) {
		require_once($this->docroot . '/models/twitter.php');
		
		$Twitter = new Twitter($this->twitterHandle, $count);
		$tweets = $Twitter->getPosts($page);
		
		return $tweets;
	}
	
	function getTwitterPost($id) {
		require_once($this->docroot . '/models/twitter.php');
		
		$Twitter = new Twitter($this->twitterHandle, '1');
		$tweet = $Twitter->getPost($id);
		
		return $tweet;
	}
	
	function getInstagram($page, $count) {
		require_once($this->docroot . '/models/instagram.php');
		
		$Instagram  = new Instagram($this->instagramId, $count);
		$instagrams = $Instagram->getPosts($page);
		
		return $instagrams;
	}
	
	function getInstagramPost($id) {
		require_once($this->docroot . '/models/instagram.php');
		
		$Instagram  = new Instagram($this->instagramId, '1');
		$instagrams = $Instagram->getPost($id);
		
		return $instagrams;
	}
	
	function getFacebook($page, $count) {
		require_once($this->docroot . '/models/facebook.php');
		
		$Facebook   = new Facebook($this->facebookId, $count);
		$facebooks = $Facebook->getPosts($page);
		
		return $facebooks;
	}
	
	function getFacebookPost($id) {
		require_once($this->docroot . '/models/facebook.php');
		
		$Facebook = new Facebook($this->twitterHandle, '1');
		$facebook = $Facebook->getPost($id);
		
		return $facebook;
	}
	
	function socialAll($page, $count) {
	
		$socialArray = array_merge((array)$this->getTwitter($page, $count), (array)$this->getInstagram($page, $count), (array)$this->getFacebook($page, $count));
		
		shuffle($socialArray);
		
		return $socialArray;
	}
				
}



?>
