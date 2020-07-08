<div class="entry-meta clear">

	<span class="entry-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?></a> <?php the_author_posts_link(); ?> &#8212; </span> 
	<span class="entry-date"><?php echo get_the_date(); ?></span>

	<span class='entry-comment'><?php comments_popup_link( 'add comment', '1 comment', '% comments', 'comments-link', 'comments off'); ?></span>
	
</div><!-- .entry-meta -->