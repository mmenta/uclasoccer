<?php
// include twitter library
require($_SERVER['DOCUMENT_ROOT'] . '/models/lib/facebook/facebook.php');

class Facebook {
	
	private $config;
	private $facebook;
	private $limit;
	
	function __construct($album_id, $count) {
	    
	    // limit
	    $this->limit = $count;
	    
		$this->albumId = $album_id;
		
		$this->config = array(
			'appId' => '402177503252344',
			'secret' => '084556793d4e0e9e27c44e88822bca23',
			'fileUpload' => false,
			'allowSignedRequest' => false, 
		);
		
		$this->facebook = new FacebookAuth($this->config);
	}

	function getPosts($page) {
	    if( $page == 1 ){
    	    $offset = 0;
	    } else {
    	    $offset = $page * $this->limit;
	    }
	
		$path = '/'.$this->albumId . '/photos?limit=' . $this->limit . '&offset=' . $offset;
		$photos = $this->facebook->api($path);
		
		foreach( $photos['data'] as $photo ) {
			$time = strtotime($photo['created_time']);
			$text = isset($photo['name']) ? $photo['name'] : "";	
			
			$facebookArr[] = array('type' => 'facebook', 'id' => $photo['id'], 'handle' => '', 'text' => $text, 'img' => $photo['source'], 'time' => $time);
		}
		
		return $facebookArr;
	}
	
	function getPost($id) {
		$path = '/' . $id;
		$facebook = $this->facebook->api($path);
		
		$time = strtotime($facebook['created_time']);
		
		$facebookArr = array(
						'type' => 'facebook',
						'id' => $facebook['id'],
						'name' => $facebook['from']['name'],
						'handle' => '',
						'date' => $time,
						'text' => $facebook['name'],
						'img' => $facebook['source']
					);
	
		return $facebookArr;
	}
}







?>