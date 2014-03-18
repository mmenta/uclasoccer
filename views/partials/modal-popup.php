<?php

$link = $_POST['link'];
$type = $_POST['type'];

?>


<div class="modal-wrapper">

	<?php
	if( $type == 'image' ) {?>
		<img src="<?php echo $link; ?>" />
	<?php } else { ?>
		<iframe width="640" height="360" src="//www.youtube.com/embed/<?php echo $link; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
	<?php } ?>


</div>