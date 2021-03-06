<?php

class Instagram {

	private $client_id = '349b9ec41183472cb59373dd2ce9b83a';
	
	function __construct($user_id) { // pass user id
		$this->user_id = $user_id;
	}
	
	function doCurl($url) {
    	
    	// open curl connection
		$curl_connection = curl_init($url);
		curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
		
		$data = json_decode(curl_exec($curl_connection), true);
		curl_close($curl_connection);
    	
    	return $data;
	}
	
	// pass page number for pagination and number of posts
	function getPosts($page, $count) {
		$url = 'https://api.instagram.com/v1/users/'.$this->user_id.'/media/recent?client_id='.$this->client_id.'&count=' . $count;
		
		// open curl connection
		$data = $this->doCurl($url);
        
        //SUPER EXPENSIVE FUNCTION, find a better way to do pagination for instagram.
        $i = 1;
        while($i <= $page) {
            
            if( $i == $page ){
                $max_id = isset($max_id) ? $max_id : "";	
                $url = $url . '&max_id=' . $max_id;
                $data = $this->doCurl($url);
                
		        foreach( $data['data'] as $instagram ) {	
					//parse id
					$first = explode('/p/', $instagram['link']);
					$id = $first[1];
				
			        $instagramArr[] = array('type' => 'instagram', 'id' => $id, 'handle' => $instagram['user']['username'], 'text' => '', 'img' => $instagram['images']['standard_resolution']['url'], 'time' => $instagram['created_time']);
                }
            } else {
                
                $max_id = isset($max_id) ? $max_id : "";
                $url = $url . '&max_id=' . $max_id;
                $data = $this->doCurl($url);
                
                $max_id = $data['pagination']['next_max_id'];
            }
            $i++;
		}
		
		return $instagramArr;
	}
	
	// pass post id
	function getPost($id) {
		$url = 'http://api.instagram.com/oembed?url=http://instagram.com/p/'. $id;
		
		// open curl connection
		$instagram = $this->doCurl($url);

		$instagramArr = array(
							'type' => 'instagram',
							'id' => $instagram['media_id'],
							'name' => '', 
							'handle' => '@' . $instagram['author_name'],
							'date' => '',
							'text' => $instagram['title'],
							'img' => $instagram['url']
						);
		
		return $instagramArr;
	}
	
	// specific function that grabs posts with hashtag from specific users 
	// pass hashtag and array of users
	function getPostHash($hash, $users) {
			
			$endpoint = 'https://api.instagram.com/v1/tags/'.$hash.'/media/recent?client_id='.$this->client_id.'&count=80';
            			
			for ( $i = 0; $i < 2; $i++ ) {
			
                $data = $this->doCurl($endpoint);
			
    			foreach( $data['data'] as $instagram ){	
    				if( in_array($instagram['user']['username'], $users) ) {
    				
    					$first = explode('/p/', $instagram['link']);
    					$id = $first[1];
    				
    					 $instagramArr[] = array('type' => 'instagram', 'id' => $id, 'handle' => $instagram['user']['username'], 'text' => '', 'img' => $instagram['images']['standard_resolution']['url'], 'time' => $instagram['created_time']);
    				}
    			}
    			
    			$endpoint = isset($data['pagination']['next_url']) ? $data['pagination']['next_url'] : NULL;    			
			}

		return $instagramArr;
	}	
	
	// modified function to brab posts with multiple hashtags. 
	// currently, first hashtag is hardcoded into function, we can change this to be more dynamic later.
	function getPostHashMultiple($hash, $users) {
    	
    	$hashBase = 'bruinsinjapan'; // hardcode first hashtag
    	
    	$endpoint = 'https://api.instagram.com/v1/tags/'.$hashBase.'/media/recent?client_id='.$this->client_id.'&count=80';
    	$data = $this->doCurl($endpoint);
    	
    	foreach( $data['data'] as $instagram ){	
			if( (in_array($instagram['user']['username'], $users)) && (in_array($hash, $instagram['tags'])) ) {
			
				$first = explode('/p/', $instagram['link']);
				$id = $first[1];
			
				 $instagramArr[] = array('type' => 'instagram', 'id' => $id, 'handle' => $instagram['user']['username'], 'text' => '', 'img' => $instagram['images']['standard_resolution']['url'], 'time' => $instagram['created_time']);
			}
		}

    	return $instagramArr;
	}
}







?>