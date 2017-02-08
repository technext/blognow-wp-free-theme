<div id="post-<?php the_ID(); ?>" <?php post_class('clear'); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
		<a class="thumbnail-link" href="<?php the_permalink(); ?>">
			<div class="thumbnail-wrap">
				<?php 
					the_post_thumbnail( 'general-thumb' ); 
				?>
			</div><!-- .thumbnail-wrap -->
		</a>
	<?php } ?>		

	<div class="entry-overview">

		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		
		<div class="entry-meta">

			<span class="entry-category">
				<?php blognow_first_category(); ?>									
			</span><!-- .entry-category -->						

			<span class="entry-author">
				<?php echo __('by', 'blognow'); ?> <?php the_author_posts_link(); ?>
			</span><!-- .entry-author -->

			<span class="entry-date">
				<?php echo get_the_date(); ?>
			</span><!-- .entry-date -->											

		</div><!-- .entry-meta -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<span class="read-more"><a href="<?php the_permalink(); ?>"><?php echo __('Read More', 'blognow'); ?></a></span>
		</div><!-- .entry-summary -->
			
		<?php 
			if ( get_theme_mod('list-share-on', true) ) :

				get_template_part('template-parts/entry', 'share');
			
			endif; 
		?>

	</div><!-- .entry-overview -->

</div><!-- .hentry -->