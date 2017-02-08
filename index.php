<?php get_header(); ?>

	<div id="primary" class="content-area layout-1c clear">

		<main id="main" class="site-main clear">

		<?php
		// Display the featured content block if featured post exists
		$args = array(
		'post_type'      => 'post',
		//'orderby'        => 'date',
		//'order'          => 'DESC',
		//'posts_per_page' => 1,
	    'meta_query' => array(
	        array(
	            'key'   => 'is_featured',
	            'value' => 'true'
	        	)
	    	)			
		);

		// The Query
		$the_query = new WP_Query( $args );

		?>

		<?php 
			if( !($the_query->have_posts()) && (get_theme_mod('featured-on', true)) )  {	
		?>

			<div id="featured-content" class="clear">

				<div class="widget setup-notice">
					<p><?php echo __('<span class="step">Step 3.</span> Select featured posts', 'blognow'); ?></p>
					<p><?php echo __('Edit any post and tick the <strong>Featured this post on homepage</strong> checkbox from <strong>Post Options</strong>', 'blognow'); ?> (<a href="<?php echo get_template_directory_uri(); ?>/assets/img/how-to-featured.png" target="_blank"><?php echo __('how to', 'blognow'); ?></a>)</p>
					<div class="home-more">
						<a class="btn" href="<?php echo home_url(); ?>/wp-admin/edit.php"><?php echo __('Okay, I\'m doing now', 'blognow'); ?></a>
					</div>
				</div>
						
			</div><!-- #featured-content -->

		<?php } ?>

		<?php

		if( ($the_query->have_posts()) && (get_theme_mod('featured-on', true)) && !is_paged() ) {

		?>

		<div id="featured-content" class="clear">

			<div class="featured-left">
				<?php

				$args = array(
				'post_type'      => 'post',
				//'orderby'        => 'date',
				//'order'          => 'DESC',
				'posts_per_page' => 1,
			    'meta_query' => array(
			        array(
			            'key'   => 'is_featured',
			            'value' => 'true'
			        	)
			    	)			
				);

				// The Query
				$the_query = new WP_Query( $args );

				// The Loop
				while ( $the_query->have_posts() ) : $the_query->the_post();
				?>	
					<div <?php post_class(''); ?>>
						<a class="thumbnail-link" href="<?php the_permalink(); ?>">
							<div class="thumbnail-wrap">
								<?php 
									if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'featured-large-thumb' ); 
									} else { 
										echo '<img src="' . get_stylesheet_directory_uri() . '/assets/img/thumbnail-default.png" alt="" />';
			        				} 
		        				?>
							</div><!-- .thumbnail-wrap -->
						</a>
						<div class="entry-info">
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>				
						</div><!-- .entry-info -->
						<div class="entry-category">
							<?php blognow_first_category(); ?>
						</div><!-- .entry-category -->
					</div>
				<?php   
					endwhile;
					wp_reset_postdata();
				?>		
			</div><!-- .featured-left -->

			<div class="featured-right">

				<?php

				$args = array(
				'post_type'      => 'post',
				//'orderby'        => 'date',
				//'order'          => 'ASC',
				'offset'	     =>  '1',
				'posts_per_page' => 3,
			    'meta_query' => array(
			        array(
			            'key'   => 'is_featured',
			            'value' => 'true'
			        	)
			    	)				
				);

				// The Query
				$the_query = new WP_Query( $args );

				// The Loop
				while ( $the_query->have_posts() ) : $the_query->the_post();
				?>	

				<div <?php post_class('clear'); ?>>
					<?php if ( has_post_thumbnail() ) { ?>
						<a class="thumbnail-link" href="<?php the_permalink(); ?>">
							<div class="thumbnail-wrap">
								<?php 
									the_post_thumbnail( 'general-thumb' ); 
								?>
							</div><!-- .thumbnail-wrap -->
						</a>
					<?php } ?>	
					<div class="entry-info">
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="entry-meta">
							<span class="entry-category"><?php blognow_first_category(); ?></span>
							<span class="entry-date"><?php echo get_the_date(); ?></span>						
						</div>
					</div><!-- .entry-info -->			
				</div><!-- .hentry -->
				<?php   
					endwhile;
					wp_reset_postdata();
				?>															
			</div><!-- .featured-right -->			

		</div><!-- #featured-content -->

		<?php 
			} 
			wp_reset_postdata();
		?>

		<div id="recent-content" class="content-loop">

 			<?php if ( get_theme_mod('featured-on', true) ) { ?>
 			
				<div class="section-header clear">
					<h3>
						<?php echo __('Latest <span>Stories</span> ', 'blognow'); ?>
						<em>
						<?php 
							$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
							if ($paged > 1) {
								echo '(Page '. $paged.'/'. $wp_query->max_num_pages . ')'; 
							} else {
							}
						?>
						</em>
					</h3>	
					<div class="recent-nav">
						<span class="nav-left">
							<?php previous_posts_link( '<span class="genericon genericon-leftarrow"></span> ' . __('Prev', 'blognow')); ?>
						</span>

						<span class="nav-right">
							<?php next_posts_link( __('Next', 'blognow') . ' <span class="genericon genericon-rightarrow"></span>', 0 ); ?>
						</span>
					</div><!-- .recent-nav -->
				</div><!-- .section-header -->

			<?php } ?>

			<?php

			if ( have_posts() ) :	
						
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part('template-parts/content', 'loop');

			endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; 

			?>

		</div><!-- #recent-content -->

		</main><!-- .site-main -->

		<?php

			global $wp_version;

			if ( $wp_version >= 4.1 ) :

				the_posts_pagination( array( 'prev_text' => __( 'Previous', 'blognow' ) ) );
			
			endif;

		?>	

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
