<?php
// include twitter library
require($_SERVER['DOCUMENT_ROOT'] . '/models/lib/twitter/TwitterOAuth.php');

class Twitter {

	// account info
	private $consumerkey = 'hawwNQL85O4BdKfHQTNOrg';
	private $consumersecret = 'jz4gaWQo5CnyfDPKEkV7JOPi6lyHDVkxvqcuHuRTg';
	private $accesstoken = '32669431-c6PvItHSeYi7pWLtuqHAqnzH4OFIC4IUbRg9YZm8i';
	private $accesstokensecret = 'zvoArGbc7izpm56lLssM5rZPP0dUphX66R1EBkHDNJ5nw';	
	private $twitter;
	
	//NEEDS WORK, fix so that handle doesn't need to be passed
	function __construct($handle, $count) { // pass twitter handle
		$this->limit = $count;
		$this->handle = $handle;
		$this->twitter = new TwitterOAuth($this->consumerkey, $this->consumersecret, $this->accesstoken, $this->accesstokensecret);
	}
	
	function getPosts($page) {
		$tweets = $this->twitter->get('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$this->handle.'&count='.$this->limit.'&include_rts=true&page='.$page);
		
		foreach( $tweets as $tweet ) {
			$time = strtotime($tweet->created_at);
			
			$twitterArr[] = array( 'type' => 'twitter', 'id' => $tweet->id_str, 'handle' => $tweet->user->screen_name, 'text' => $tweet->text, 'img' => '', 'time' => $time );
		}
		
		return $twitterArr;
	}
	
	function getPost($id) {
		$tweet = $this->twitter->get('https://api.twitter.com/1.1/statuses/show.json?id='.$id);
	
		$time = strtotime($tweet->created_at);
		$img = isset( $tweet->entities->media[0]->media_url) ?  $tweet->entities->media[0]->media_url : "";
		
		$tweetArr = array(
						'type' => 'twitter',
						'id' => $tweet->id,
						'name' => $tweet->user->name,
						'handle' => '@' . $tweet->user->screen_name,
						'date' => $time,
						'text' => $tweet->text,
						'img' => $img
					);
		
		return $tweetArr;
	}
	
	function getPostHash($hash, $users) {
		//EXPENSIVE FUNCTION, try to find a better way to do this
		foreach( $users as $user ) {
			$from = urlencode('?'.$hash.'+AND+from:@'.$user.'+exclude:retweets');
			$query = 'https://api.twitter.com/1.1/search/tweets.json?q='.$from.'&result_type=recent';
			$tweets = $this->twitter->get($query);
			
			foreach( $tweets->statuses as $tweet ) {
				$date = strtotime($tweet->created_at);
				
				//check for image
				$img = isset( $tweet->entities->media[0]->media_url) ?  $tweet->entities->media[0]->media_url : "";
				
				$tweetArr[] = array( 'type' => 'twitter', 'id' => $tweet->id_str, 'handle' => $tweet->user->name, 'text' => $tweet->text, 'img' => $img, 'time' => $date );
			}
			
			
		}
		
		return $tweetArr;
	}
}


?>



















