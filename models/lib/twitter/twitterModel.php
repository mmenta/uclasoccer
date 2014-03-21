<?php
// include twitter library and db connection
require($_SERVER['DOCUMENT_ROOT'] . '/models/lib/twitter/TwitterOAuth.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/db.php');

class Twitter {

	// account info
	private $consumerkey = '6xTVXB5a0oie9eJXEoSTSw';
	private $consumersecret = 'Lpw4mfGpWL3ssXQrjHPkW6LRlQizaTDpU5dSpmKpyw';
	private $accesstoken = '26966016-vFC3tfGH34f8tqJv2vjI4mI8EjOGUvfGYljSrpGoL';
	private $accesstokensecret = 'BMkZgG4zg2Hi1Y0bKkZ4IHqc8L1x8ZzpUJwuwRb2XZGr3';

	private $twitter;
	
	function __construct($handle) { // pass twitter handle
		$this->handle = $handle;
		$this->twitter = new TwitterOAuth($this->consumerkey, $this->consumersecret, $this->accesstoken, $this->accesstokensecret);
		
		//open db connection
		$this->db = new DB();
	}
	
	// pass page number for pagination and number of posts
	function getPosts($page, $count) {
		$tweets = $this->twitter->get('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$this->handle.'&count='.$count.'&include_rts=true&page='.$page);
		
		foreach( $tweets as $tweet ) {
			$time = strtotime($tweet->created_at);
			
			$twitterArr[] = array( 'type' => 'twitter', 'id' => $tweet->id_str, 'handle' => $tweet->user->screen_name, 'text' => $tweet->text, 'img' => '', 'time' => $time );
		}
		return $twitterArr;
	}
	
	// pass post id
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
	
	// specific function that grabs posts with hashtag from specific users 
	// pass hashtag and array of users
	function getPostHash($hash, $users) {
		//EXPENSIVE FUNCTION, try to find a better way to do this

		// IGNORE USERS and pull everything with BruinsInJapan or Cleatsup hashtags
		//foreach( $users as $user ) {
			//$from = urlencode('?'.$hash.'+AND+from:@'.$user.'+exclude:retweets');
			$from = urlencode('#'.$hash);
			$query = 'https://api.twitter.com/1.1/search/tweets.json?q='.$from.'+exclude:retweets&count=100';

			$tweets = $this->twitter->get($query);

			foreach( $tweets->statuses as $tweet ) {
				$date = strtotime($tweet->created_at);
				
				//check for image
				$img = isset( $tweet->entities->media[0]->media_url) ?  $tweet->entities->media[0]->media_url : "";
				
				$tweetArr[] = array( 'type' => 'twitter', 'id' => $tweet->id_str, 'handle' => $tweet->user->name, 'text' => $tweet->text, 'img' => $img, 'time' => $date );
			}
		//}
		
		return $tweetArr;
	}
	
	function getPostHashDB($hash, $users) {
	
		$cnn = $this->db->openConn();
		
		//HONG, write query here to pull twitter posts with the hashtag that's being passed into this function from the db, you can ignore the $users for now if you want, but eventually we'll have to only show posts from these users. Have the results match the array below and return it.
	
	
		$tweetArr[] = array( 'type' => 'twitter', 'id' => $tweet->id_str, 'handle' => $tweet->user->name, 'text' => $tweet->text, 'img' => $img, 'time' => $date );
	
		
		$this->db->closeConn($cnn);
		
		return $tweetArr;
	}
	
	
}
?>


















