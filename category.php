<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blognow
 */

get_header(); ?>

	<div id="primary" class="content-area clear">

		<main id="main" class="site-main clear">

		<div id="recent-content" class="content-loop">

			<div class="section-header clear">
				<h1>
					<?php single_cat_title(''); ?>
					<em>
					<?php 
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
						if ($paged > 1) {
							echo '(Page '. $paged.'/'. $wp_query->max_num_pages . ')'; 
						} else {
						}
					?>
					</em>
				</h1>	
				<div class="recent-nav">
					<span class="nav-left">
						<?php previous_posts_link( '<span class="genericon genericon-leftarrow"></span> ' . __('Prev', 'blognow')); ?>
					</span>

					<span class="nav-right">
						<?php next_posts_link( __('Next', 'blognow') . ' <span class="genericon genericon-rightarrow"></span>', 0 ); ?>
					</span>
				</div><!-- .recent-nav -->
			</div><!-- .section-header -->

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
