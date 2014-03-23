<?php
// turn on error reporting
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require_once($_SERVER['DOCUMENT_ROOT'] . '/models/social.php');

$Model = new Social();

$page = isset($_GET['page']) ? $_GET['page'] : 1;	

$model = $Model->getTwitter($page, '4');

?>

<?php
foreach( $model as $post ) { ?>

<li>
	<img src="/images/tweet-avatar.png" class="avatar" />
	<p class="tweet">
		<?php echo $post['text']; ?>
		
		<span class="author">
			<img src="/images/icon-social-tw.png" /> @CromwellUCLA &bull; 
			<?php echo date('M d', $post['time']); ?>
		</span>
	</p>
</li>

<?php } ?>