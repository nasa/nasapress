<?php 
/*
YARPP Template: You Might Also Like
Author: Brandon Ruffridge
Description: Related posts for NASAPress.
*/
?>
<?php if (have_posts()):?>
<h2 data-otp-ignore='true'>You Might Also Like</h2>
<ul>
	<?php
		$relatedPosts = '';
		while (have_posts()) : the_post();
		$relatedPosts .= '<li><a href="' . get_the_permalink() . '" rel="bookmark">' . get_the_title() . '</a><!-- (' . get_the_score() . ')--></li>';
		endwhile;

		if(function_exists('bwp_external_links')) {
			$relatedPosts = bwp_external_links($relatedPosts);
		}

		echo $relatedPosts;
	?>
</ul>
<?php endif; ?>
