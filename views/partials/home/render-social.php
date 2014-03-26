<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require_once($_SERVER['DOCUMENT_ROOT'] . '/models/social.php');

$Model = new Social();
$page = isset($_GET['page']) ? $_GET['page'] : 1;		


switch($_GET['type']) {
	case 'all':
		$model = $Model->socialAll($page, '4'); break;
	case 'twitter':
		$model = $Model->getTwitter($page, '8'); break;
	case 'instagram':
		$model = $Model->getInstagram($page, '8'); break;
	case 'facebook':
		$model = $Model->getFacebook($page, '8'); break;
	default:
		$model = $Model->socialAll($page, '4');
}


foreach( $model as $post ) {

	if( $post['type'] == 'twitter' ) { ?>

	<li class="twitter">
	    <?php if( $post['img'] != "" ) { ?>
	        <img src="<?php echo $post['img']; ?>" class="bg-social" />
	    <?php } ?>
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
	} elseif ( $post['type'] == 'facebook' ) { ?>

	<li class="facebook">
		<div class="image-wrap">
			<img src="<?php echo $post['img']; ?>" class="bg-social" />
		</div>
		
		<div class="overlay">
			<p><?php echo $post['text']; ?></p>
		</div>
		
		<img class="icon" src="images/icon-social-fb.png" />
		<h4 class="handle">@UCLAWSoccer</h4>
		<input type="hidden" class="id" value="<?php echo $post['id']; ?>" />
	</li>
	
	<?php
	}
	
}

?>