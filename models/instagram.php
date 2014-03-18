<?php

class Instagram {

	private $client_id = '349b9ec41183472cb59373dd2ce9b83a';
	
	function __construct($user_id, $count) { // pass user id
		$this->limit = $count;
		
		$this->url = 'https://api.instagram.com/v1/users/'.$user_id.'/media/recent?client_id='.$this->client_id.'&count=' . $this->limit;
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
		
	function getPosts($page) {
		
		// open curl connection
		$data = $this->doCurl($this->url);
        
        //SUPER EXPENSIVE FUNCTION, find a better way to do pagination.
        $i = 1;
        while($i <= $page) {
            
            if( $i == $page ){
                $max_id = isset($max_id) ? $max_id : "";	
                $this->url = $this->url . '&max_id=' . $max_id;
                $data = $this->doCurl($this->url);
                
		        foreach( $data['data'] as $instagram ) {	
					//parse id
					$first = explode('/p/', $instagram['link']);
					$id = $first[1];
				
			        $instagramArr[] = array('type' => 'instagram', 'id' => $id, 'handle' => $instagram['user']['username'], 'text' => '', 'img' => $instagram['images']['standard_resolution']['url'], 'time' => $instagram['created_time']);
                }
            } else {
                
                $max_id = isset($max_id) ? $max_id : "";
                $this->url = $this->url . '&max_id=' . $max_id;
                $data = $this->doCurl($this->url);
                
                $max_id = $data['pagination']['next_max_id'];
            }
            $i++;
		}
		
		//return $data;
		return $instagramArr;
	}
	
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
	
}







?>