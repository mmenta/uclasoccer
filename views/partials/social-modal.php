<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require_once($_SERVER['DOCUMENT_ROOT'] . '/models/model.php');

$url = array('home');
$Model = new Model($url);

$id = $_POST['id'];
$type = $_POST['type'];

switch($type) {
	case 'twitter':
		$model = $Model->getTwitterPost($id); break;
	case 'facebook':
		$model = $Model->getFacebookPost($id); break;
	case 'instagram':
		$model = $Model->getInstagramPost($id); break;
}

?>



<div class="social-modal">

	<div class="text-section">
		<h2>
			<?php
			$str_limit = '170';
			$text = (strlen($model['text']) > $str_limit) ? substr($model['text'], 0, $str_limit).'...' : $model['text'];
			echo $text; 
			?>
		</h2>
	</div>
	
	<div class="info-section">
		<!--<img class="avatar" src="http://placehold.it/40x40" />-->
		<hgroup>
			<p class="name"><?php echo $model['name']; ?></p>
			<p class="handle"><?php echo $model['handle']; ?></p>
			<?php if($model['date'] != '') { ?>
			<p class="date"><?php echo date('g:i A - d M Y', $model['date']); ?></p>
			<?php } ?>
		</hgroup>
		
		<div class="image-wrapper">
			<?php if($model['img']!="") { ?>
			<img src="<?php echo $model['img']; ?>" />
			<?php } ?>
		</div>
		
		<!--
		<h6>Share</h6>
		<ul class="social-icons">
			<li><a href="#"><img src="/images/icon-aside-fb.jpg" /></a></li>
			<li><a href="#"><img src="/images/icon-aside-tw.jpg" /></a></li>
			<li><a href="#"><img src="/images/icon-aside-gp.jpg" /></a></li>
			<li><a href="#"><img src="/images/icon-aside-add.jpg" /></a></li>
		</ul>
		-->
	</div>
	


</div>