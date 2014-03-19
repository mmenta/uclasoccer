<?php
// turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

//$usersTwitter = array('uclasoccer', 'cromwellucla', 'joshwalterssr', 'louisek06', 'sammaysosa29', 'cwinter16', 'sammymewy'); 
//$hashTwitter = '#bruinsinJapan';

$hash = 'cleatsup';

$model = $Model->getInstagramHash($hash, '');






?>


<!-- all html for page goes here -->

<section class="map">

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

	<img src="/images/static-map.jpg" />

</section>


<section class="letters">



</section>


<section class="social">
<?php
echo '<pre>';
print_r($model);
echo '</pre>';
?>


</section>