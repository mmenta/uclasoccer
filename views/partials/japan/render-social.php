<?php
// turn on error reporting
#error_reporting(E_ALL);
#ini_set('display_errors', 1);

require_once($_SERVER['DOCUMENT_ROOT'] . '/models/social.php');

$Model = new Social();
$page = isset($_GET['page']) ? $_GET['page'] : 1;		
$hash = isset($_GET['hashtag']) ? $_GET['hashtag'] : "cleatsup";	

$usersTwitter = array('uclasoccer', 'cromwellucla', 'joshwalterssr', 'louisek06', 'sammaysosa29', 'cwinter16', 'sammymewy', 'capricedydasco', 'rosiewhite13', 'abbydahlkemper', 'laurenrod8', 'tsmitty_14', 'skillion16', 'crystalshaffie', 'meganoyster', 'darian_jenks', 't_drag119', 'katelyn_rowland', 'laurenkaskie', 'annie_alvarad0', 'courtneyucla77', 'alyssa_alarab', 'kodilarusky', 'bellong5', 'madtye19', 'zoeygoralski', 'gabbimiranda14', 'mikkaay', 'casper_6'); 

$usersInstagram = array('jwfutbol24', 'alininha89', 'samgreene29', 'cwint16', 'capricedydasco', 'rosiewhite', 'abbydahlkemper', 'lrod8', '_taylorsmith14_', 'skillion16', 'crystalshaffie', 'meganoyster', 'darian_jenks', 'tdrag_119', 'katelyn_rowland', 'laurenkaskie', 'anniealvarado', 'cproctor77', 'aalarab10', 'kodijo', 'kyliemmccarthy', 'bellong5', 'kristianakm', 'teebrooke12', 'madtye19', 'zoeygoralski26', 'gabbimirandaa', 'mikaelaa_elisabeth', 'csternbach', 'allycourtnall');


switch($_GET['type']) {
	case 'all':
		$modelTwitter = $Model->getTwitterHashDB($hash, $usersTwitter);
		$modelInstagram = $Model->getInstagramHash($hash, $usersInstagram);

		$model = array_merge(
					(array)$modelTwitter,
					(array)$modelInstagram
				);
				
		break;
	case 'twitter':
		$model = $Model->getTwitterHashDB($hash, $usersTwitter); break;
	case 'instagram':
		$model = $Model->getInstagramHash($hash, $usersInstagram); break;
	default:
		$modelTwitter = $Model->getTwitterHashDB($hash, $usersTwitter);
		$modelInstagram = $Model->getInstagramHash($hash, $usersInstagram);

		$model = array_merge(
					(array)$modelTwitter,
					(array)$modelInstagram
				);
}

		
shuffle($model);

/*
echo '<pre>';
print_r($model);
echo '</pre>';
*/


if (count($model) > 0) {

	foreach( $model as $post ) {

	if( $post['type'] == 'twitter' ) { ?>

		<li class="twitter">
			<p class="box-text"><?php echo $post['text']; ?></p>
			<img class="icon" src="images/icon-social-tw.png" />
			<h4 class="handle">@<?php echo $post['handle']; ?></h4>
			<input type="hidden" class="id" value="<?php echo $post['id']; ?>" />
		</li>
	
	<?php
	} elseif ( $post['type'] == 'instagram' ) { ?>
		<li class="instagram">
			<img src="<?php echo $post['img']; ?>" class="bg-social" />
			<img class="icon" src="images/icon-social-ig.png" />
			<h4 class="handle">@<?php echo $post['handle']; ?></h4>
			<input type="hidden" class="id" value="<?php echo $post['id']; ?>" />
		</li>
	
	<?php
	} 
	}
} else {

	if ($hash == "tokyo") {
		echo "<h1>Launching March 28</h1>";
	} else if ($hash == "shizuoka") {
		echo "<h1>Launching March 26</h1>";
	}
}


?>