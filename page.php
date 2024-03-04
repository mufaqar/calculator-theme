<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="post" id="post-<?php the_ID(); ?>">
        <h1><?php the_title(); ?></h1>
        <div class="entry">
           <?php if ( has_post_thumbnail() ) { ?>
    		    <div class="featured-image">
					<?php the_post_thumbnail( 'single-post-thumbnail' ); ?>
    		    </div>
			<?php } ?>	
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
			<div class="tags">
				<?php the_tags( __('Tags:','text_domain'),'','.'); ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<?php endwhile; endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>