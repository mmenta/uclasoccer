<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/lib/facebook/facebookModel.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/lib/twitter/twitterModel.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/lib/instagram/instagramModel.php');

class Social {

	function __construct() {	
		$this->docroot = $_SERVER['DOCUMENT_ROOT'];
		
		//social info
		$this->instagramId = '407937791'; //id
		$this->facebookId = '260680503972775'; //album-id
		$this->twitterId = 'UCLAWSoccer'; //twitter handle 
	}

	// Social Functions ===================================
	
	// TWITTER ==========
	// Gets posts from single user
	function getTwitter($page, $count) {
		$Twitter = new Twitter($this->twitterId);
		$tweets = $Twitter->getPosts($page, $count);
		
		return $tweets;
	}
	
	// Gets single post, just pass post id
	function getTwitterPost($id) {
		$Twitter = new Twitter($this->twitterId);
		$tweet = $Twitter->getPost($id);
		
		return $tweet;
	}
	
	// Gets all posts with specific hashtag
	function getTwitterHash($hash, $users) {
		$Twitter = new Twitter($this->twitterId);
		$tweets = $Twitter->getPostHash($hash, $users);
		
		return $tweets;
	}
	
	// Gets posts from DB instead of twitter
	function getTwitterHashDB($hash, $users) {
		$Twitter = new Twitter($this->twitterId);
		$tweets = $Twitter->getPostHashDB($hash, $users);
		
		return $tweets;
	}
	
	// INSTAGRAM ========
	// Get instagram posts from single user
	function getInstagram($page, $count) {		
		$Instagram  = new Instagram($this->instagramId);
		$instagrams = $Instagram->getPosts($page, $count);
		
		return $instagrams;
	}
	
	// Get single post, pass post id
	function getInstagramPost($id) {
		$Instagram  = new Instagram($this->instagramId);
		$instagrams = $Instagram->getPost($id);
		
		return $instagrams;
	}
	
	// Gets all posts with specific hashtag
	function getInstagramHash($hash, $users) {
		$Instagram  = new Instagram($this->instagramId);
		$instagrams = $Instagram->getPostHash($hash, $users);
		
		return $instagrams;
	}
	
	// FACEBOOK ========
	
	function getFacebook($page, $count) {
		$Facebook   = new Facebook($this->facebookId, $count);
		$facebooks = $Facebook->getPosts($page);
		
		return $facebooks;
	}
	
	function getFacebookPost($id) {
		$Facebook = new Facebook($this->facebookId, '1');
		$facebook = $Facebook->getPost($id);
		
		return $facebook;
	}
	
	
	
	function socialAll($page, $count) {
	
		$socialArray = array_merge(
			(array)$this->getTwitter($page, $count), 
			(array)$this->getInstagram($page, $count), 
			(array)$this->getFacebook($page, $count)
		);
		
		shuffle($socialArray);
		
		return $socialArray;
	}
	





}

?>