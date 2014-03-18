<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

//get images in programs directory

// CLEAN UP AND PUT IN MODEL ==========================
$directory = '../../../images/program/';
$images = glob($directory . '*.*');


$page = $_REQUEST['page'];
$limit = 7;
$begin = $page * $limit;

$images = array_slice($images, $begin, $limit);

foreach($images as $image) {
	$imageArr[] = array('type' => 'image', 'src' => $image);
}

if($page == 0) {
	$videos = array(
					'Odq_OinVFb0',
					'-Tg8N0fnT8k',
					'VAm9T9PJ-TA',
					'txMK8Kw7-d0',
					'3CnBONOAPbw'
				);

	foreach($videos as $video) {
		$videoArr[] = array('type' => 'video', 'src' => $video);
	}

	$combinedArr = array_merge($videoArr, $imageArr);

	shuffle($combinedArr);
} else {
	$combinedArr = $imageArr;
}

?>


<?php
foreach($combinedArr as $post) {
if($post['type'] == 'image') { ?>

<li style="width: 280px; height: 280px; overflow: hidden; background-image: url('<?php echo $post['src']; ?>'); background-position: top center; background-size: auto 280px;">
	<input type="hidden" class="media-type" value="<?php echo $post['type']; ?>" />
	<input type="hidden" class="media-link" value="<?php echo $post['src']; ?>" />
</li>

<?php } else { ?>

<li style="width: 280px; height: 280px; overflow: hidden; background-image: url(http://i.ytimg.com/vi/<?php echo $post['src']; ?>/mqdefault.jpg); background-position: top center; background-size: auto 280px;">
	<img src="/images/btn-play.png" class="btn-play" />
	<input type="hidden" class="media-type" value="<?php echo $post['type']; ?>" />
	<input type="hidden" class="media-link" value="<?php echo $post['src']; ?>" />
</li>

<?php } } ?>
















