<?php
// turn on error reporting
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

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

$cnn = mysql_connect($dbserver, $dbusername, $dbpassword);
$cmd = mysql_select_db($dbname, $cnn);	

///-----------

require_once($_SERVER['DOCUMENT_ROOT'] . '/models/social.php');

$Model = new Social();
$page = isset($_GET['page']) ? $_GET['page'] : 1;		
$hash = isset($_GET['hashtag']) ? $_GET['hashtag'] : "cleatsup";	


// these are now ignored even though they're passed
$usersTwitter = array('uclasoccer', 'cromwellucla', 'joshwalterssr', 'louisek06', 'sammaysosa29', 'cwinter16', 'sammymewy', 'capricedydasco', 'rosiewhite13', 'abbydahlkemper', 'laurenrod8', 'tsmitty_14', 'skillion16', 'crystalshaffie', 'meganoyster', 'darian_jenks', 't_drag119', 'katelyn_rowland', 'laurenkaskie', 'annie_alvarad0', 'courtneyucla77', 'alyssa_alarab', 'kodilarusky', 'bellong5', 'madtye19', 'zoeygoralski', 'gabbimiranda14', 'mikkaay', 'casper_6'); 
$usersInstagram = array('jwfutbol24', 'alininha89', 'samgreene29', 'cwint16', 'capricedydasco', 'rosiewhite', 'abbydahlkemper', 'lrod8', '_taylorsmith14_', 'skillion16', 'crystalshaffie', 'meganoyster', 'darian_jenks', 'tdrag_119', 'katelyn_rowland', 'laurenkaskie', 'anniealvarado', 'cproctor77', 'aalarab10', 'kodijo', 'kyliemmccarthy', 'bellong5', 'kristianakm', 'teebrooke12', 'madtye19', 'zoeygoralski26', 'gabbimirandaa', 'mikaelaa_elisabeth', 'csternbach', 'allycourtnall');



switch($_GET['type']) {
	case 'all':
		$modelTwitter = $Model->getTwitterHash($hash, $usersTwitter);
		$modelInstagram = $Model->getInstagramHash($hash, $usersInstagram);

		$model = array_merge(
					(array)$modelTwitter,
					(array)$modelInstagram
				);		
		break;
	case 'twitter':
		$modelTwitter = $Model->getTwitterHash($hash, $usersTwitter); break;
		$model = $modelTwitter;
	case 'instagram':
		$modelInstagram = $Model->getInstagramHash($hash, $usersInstagram); break;
		$model = $modelInstagram;
	default:
		$modelTwitter = $Model->getTwitterHash($hash, $usersTwitter);
		$modelInstagram = $Model->getInstagramHash($hash, $usersInstagram);

		$model = array_merge(
					(array)$modelTwitter,
					(array)$modelInstagram
				);
		
}
	
//shuffle($model);

foreach( $model as $post ) {
	$type = $post['type'];
	$post_id = $post['id'];
	$name = $post['name'];
	$handle = $post['handle'];
	$date = $post['date'];
	$img = $post['img'];
	$profile_photo = $post['profile_photo'];

	$handle = str_replace("'", "\'", $post['handle']);
	$text = str_replace("'", "\'", $post['text']);

	//if (strstr($text, "bruinsinjapan") || strstr($text, "cleatsup")) {
		$strSQL = "SELECT id FROM texts WHERE post_id = '".$post_id."' LIMIT 1";
		$query_check = mysql_query($strSQL)or die(mysql_error());

		if (mysql_num_rows($query_check)==0) {
			$strSQL = "insert into texts (type, post_id, full_name, handle, date, message, img, profile_photo) values ('".$type."','".$post_id."','".$name."','".$handle."','".$time."','".$text."','".$img."','".$profile_photo."');";
			echo $strSQL."<br />";
			$query_insert = mysql_query($strSQL)or die(mysql_error());								
			echo mysql_error();				
		}
	//}	
}

mysql_close($cnn);

?>