<?php
// turn on error reporting
//error_reporting(E_ALL);
//ini_set('display_errors', 1);


// DB SETTIGNGS AND MYSQL CODE

# database setup
if (strpos($_SERVER['HTTP_HOST'], "local") === false) {
	//server
	$dbserver = "mysql51-054.wc2.dfw1.stabletransit.com";	
} else {
	//local server
	$dbserver = "72.32.40.35";	
}

$dbusername = "512772_uclasoc";
$dbpassword = "J@pan2014$";
$dbname = "512772_uclasoccer";

	// TIME AGO FUNCTION
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


<!-- all html for page goes here -->

<section class="map">
	
	<!--
	<div class="countdown">
    	<div class="counter">
            <div class="countdown_timer"></div>
            <div class="countlabels">
                <div class="text1">Days</div>
                <div class="text2">Hours</div>
                <div class="text3">Min</div>
                <div class="clear"></div>
            </div>        
        </div>
    	<h2>UNTIL</h2>
        <h1># CLEATS UP</h1>
    
    </div>
	-->
	
	<!--<img src="/images/static-map.jpg" />-->
	
	<div class="container sociallinks">
		<img src="images/current-location.png" class="current-location" />
		<a href="#">
			<img src="images/marker-cleatsup.png" class="marker-cleatsup" />
			<input type="hidden" class="hashtag" value="cleatsup" />
		</a>
		<a href="#">
			<img src="images/marker-okinawa.png" class="marker-okinawa" />
			<input type="hidden" class="hashtag" value="okinawa" />
		</a>
		<a href="#">
			<img src="images/marker-tokyo.png" class="marker-tokyo" />
			<input type="hidden" class="hashtag" value="tokyo" />
		</a>
		<a href="#">
			<img src="images/marker-shizuoka.png" class="marker-shizuoka" />
			<input type="hidden" class="hashtag" value="shizuoka" />
		</a>
	
	
	</div>

</section>


<section class="letters">

	<div class="content">
		<div class="letter-wrap">
        	<div class="controls">
                <span class="top">LETTERS</span><span class="bottom">from Home</span>        
			</div>   
            
            <div class="items-wrap">
                <ul id="items">
					<?
					
						$cnn = mysql_connect($dbserver, $dbusername, $dbpassword);
						$cmd = mysql_select_db($dbname, $cnn);							
						
                        $strSQL = "select full_name, city, message, UNIX_TIMESTAMP(timestamp) as utimestamp from texts order by timestamp desc";
                        $rst = mysql_query($strSQL);
                        
                        while ($row = mysql_fetch_array($rst, MYSQL_ASSOC)) {
                            $full_name = $row["full_name"];
                            $city = $row["city"];
                            $message = $row["message"];	
                            $timestamp = $row["utimestamp"];								
							
							$timeago = ago($timestamp);
					?>
                            <!-- TWITTER POST -->
<!--                             <li>
                                <div class="overlay"></div>
                                <div class="info">
                                    <div class="photo"><img src="http://placehold.it/58x58" /></div>
                                    <div class="profile">
                                        16 min ago<br />
                                        <strong>Amanda Cromwell</strong><br />
                                        @CromwellUCLA
                                    </div>
                                    <div class="message">Excited to watch @UVAMensHoops beat the Cuse to win the #ACC  #proudalumni #Wahoowa</div>
                                </div>                        
                            </li>  -->                                               
                            
                            <!-- TEXT SUBMISSION -->
                            <li>
                                <div class="overlay"></div>
                                <div class="info">
                                    <div class="profile">
                                        <?= $timeago ?><br />
                                        <strong><?= $full_name ?></strong><br />
                                        <?= $city ?>
                                    </div>
                                    <div class="message"><?= $message ?></div>
                                </div>                        
                            </li>                             
                    <?
                        }
						
						mysql_close($cnn);
						
                    ?>                                
                </ul>
			</div>
                         
        </div>   
    	<div class="btn_send">SEND POSTCARD TO THE TEAM</div>
	</div>        


<div style="display:none">
    <div id="postcard">
    	<div class="success">
            <h1>TEXT SENT!</h1>
            <p>Thanks for your message! Your #BruinsInJapan postcard has been sent to the team and will be displayed on the site shortly.</p>
		</div>
        
        <div class="compose">
            <h1>SEND A POSTCARD<br />TO THE TEAM</h1>
            <div class="btn_tweet" onclick="window.open('http://twitter.com/home?status=[Insert text] %23BruinsInJapan %23Postcard http://bit.ly/1ihDkUB')"><img src="/images/icon-footer-tw.png"> SEND A TWEET TO THE TEAM</a></div>           
            
            <div class="note">Note: Tweet must include #BruinsInJapan and<br />#Postcard to be displayed on site.</div>
            
            <div id="tweet_form">   
                <form> 
                    <input type="hidden" name="action" value="save" />
    
                    <h3>Don't have a twitter account?<br />Send a text...</h3> 
                    <p>Fill out the form below with a text 140 characters or<br />less and we will send it to the team.</p>
                
                    <input id="full_name" maxlength="50" name="full_name" size="20" type="text" placeholder="Your Name" />
                    <input id="city" maxlength="50" name="city" size="20" type="text" placeholder="Your City" />               
                    <textarea id="message" name="message" id="wordDown" placeholder="Your Message..."></textarea>             
                                    
                    <div class="cta" onclick="$('#tweet_form > form').submit();">
                        <span class="top">SEND</span><span class="bottom">Text</span>
                    </div>
                </form>
            </div> 
        </div>            
    </div>
</div>	

</section>


<section class="social">

	<div class="container">
		
		<p class="backtomap">Back to map</p>
		
		<p class="sub-text">Posts from the team</p>
		<h1 class="hashtag-label">#CLEATSUP</h1>
		<img class="loading" src="images/icon-loader.gif" />
		
		<ul class="social-filter">
			<li><a href="#" class="all"><img src="images/btn-filter-all.png" /></a></li>
			<!--<li><a href="#" class="facebook"><img src="images/btn-filter-fb.png" /></a></li>-->
			<li><a href="#" class="twitter"><img src="images/btn-filter-tw.png" /></a></li>
			<li><a href="#" class="instagram"><img src="images/btn-filter-ig.png" /></a></li>
		</ul>
		
		<ul class="box-wrap">
			<!--rendered-->
			
		</ul>
		
		<input type="hidden" class="social-page" value="1" autocomplete="off" />
		<input type="hidden" class="social-filter" value="all" autocomplete="off" />
		<input type="hidden" class="social-hashtag" value="cleatsup" autocomplete="off" />
		
		<img class="loading-more" src="images/icon-loader.gif" />
		<!--
		<a href="#" class="cta">
			<span class="top">Show</span><span class="bottom">More</span>
		</a>
		-->
	</div> <!--/container-->


</section>

<?php if( !isset($_SESSION['view']) ) {?>
<div class="boarding-pass-modal">
	<p>Choose one of the following to get your boarding pass for</p>
	<h1>#Bruinsinjapan</h1>
	
	<div class="btn-wrap">
		<a href="https://www.facebook.com/UCLAWSoccer" target="_blank"><img src="../images/btn-like-fb.png" /></a>
		<a href="https://twitter.com/UCLAWSoccer" target="_blank"><img src="../images/btn-like-tw.png" /></a>
		<a href="http://instagram.com/uclawsoccer" target="_blank"><img src="../images/btn-like-ig.png" /></a>
	</div>
	
	<a href="#" class="btn-close"><img src="../images/btn-close.jpg" /></a>
</div>

<div class="overlay"></div>
<?php $_SESSION['view'] = 1; } ?>






