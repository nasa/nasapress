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
	<?php while (have_posts()) : the_post(); ?>
	<li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a><!-- (<?php the_score(); ?>)--></li>
	<?php endwhile; ?>
</ul>
<?php endif; ?>
