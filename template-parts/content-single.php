<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blognow
 */	
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">	
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>

		<div class="entry-meta clear">

			<span class="entry-author">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?></a>			
				<?php echo __('by', 'blognow'); ?> <strong><?php echo the_author_posts_link(); ?></strong>
			</span><!-- .entry-author -->
			<span class="entry-date"><?php echo get_the_date(); ?></span>
			<span class="entry-category">
				<?php blognow_first_category(); ?>						
			</span>									
		</div><!-- .entry-meta -->

		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'blognow' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blognow' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php 
		if ( get_theme_mod('single-share-on', true) ) :

			get_template_part('template-parts/entry', 'share');

		endif; 
	?>


	<span class="entry-tags">

		<?php if (has_tag()) { ?><span class="tag-links"><?php the_tags(' ', ' '); ?></span><?php } ?>
			
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'blognow' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</span><!-- .entry-tags -->

</article><!-- #post-## -->

<?php if ( get_theme_mod('author-box-on', true) ) : ?>

<div class="author-box clear">
	<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?></a>
	<div class="author-meta">	
		<h4 class="author-name"><?php echo __('About the author:', 'blognow'); ?> <span><?php the_author_meta('display_name'); ?></span></h4>	
		<div class="author-desc">
			<?php 
				echo the_author_meta('description'); 
			?>
		</div>
		<div class="author-posts-link">
			<span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo __('View all posts by', 'blognow'); ?> <?php the_author(); ?> &raquo;</a></span>
		</div>
	</div>
</div><!-- .author-box -->

<?php endif; ?>

<?php
	
	if ( get_theme_mod('related-posts-on', true) ) : 
	 
	// Get the taxonomy terms of the current page for the specified taxonomy.
	$terms = wp_get_post_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );

	// Bail if the term empty.
	if ( empty( $terms ) ) {
		return;
	}

	// Posts query arguments.
	$query = array(
		'post__not_in' => array( get_the_ID() ),
		'tax_query'    => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'id',
				'terms'    => $terms,
				'operator' => 'IN'
			)
		),
		'posts_per_page' => 3,
		'post_type'      => 'post',
	);

	// Allow dev to filter the query.
	$args = apply_filters( 'blognow_related_posts_args', $query );

	// The post query
	$related = new WP_Query( $args );

	if ( $related->have_posts() ) : $i = 1; ?>

		<div class="entry-related clear">
			<h3><?php echo __('Related Posts', 'blognow'); ?></h3>
			<div class="related-loop clear">
				<?php while ( $related->have_posts() ) : $related->the_post(); ?>
					<?php
					$class = ( 0 == $i % 3 ) ? 'hentry last' : 'hentry';
					?>
					<div class="<?php echo esc_attr( $class ); ?>">
						<?php if ( has_post_thumbnail() ) { ?>
							<a class="thumbnail-link" href="<?php the_permalink(); ?>">
								<div class="thumbnail-wrap">
									<?php 
										the_post_thumbnail( 'general-thumb' ); 
									?>
								</div><!-- .thumbnail-wrap -->
							</a>
						<?php } ?>				
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="entry-meta">
							<span class="entry-date"><?php echo get_the_date(); ?></span>
						</div>
					</div><!-- .grid -->
				<?php $i++; endwhile; ?>
			</div><!-- .related-posts -->
		</div><!-- .entry-related -->

	<?php endif;

	// Restore original Post Data.
	wp_reset_postdata();

	endif;
?>