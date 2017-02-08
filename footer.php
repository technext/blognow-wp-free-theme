<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blognow
 */

?>

	</div><!-- #content .site-content -->
	
	<footer id="colophon" class="site-footer">

		<?php if ( ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) && get_theme_mod('footer-widgets-on', true) ) { ?>

			<div class="footer-columns clear">

				<div class="container clear">

					<div class="footer-column footer-column-1">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div>

					<div class="footer-column footer-column-2">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</div>

					<div class="footer-column footer-column-3">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</div>

					<div class="footer-column footer-column-4">
						<?php dynamic_sidebar( 'footer-4' ); ?>
					</div>												

				</div><!-- .container -->

			</div><!-- .footer-columns -->

		<?php } ?>

		<?php if ( ( !is_active_sidebar( 'footer-1' ) && !is_active_sidebar( 'footer-2' ) && !is_active_sidebar( 'footer-3' ) &&  !is_active_sidebar( 'footer-4' ) ) && get_theme_mod('footer-widgets-on', true) ) { ?>
			<div class="footer-columns clear">

				<div class="container clear">

					<div class="widget setup-notice">
						<p><?php echo __('<span class="step">Step 4.</span> Add footer widgets', 'blognow'); ?></p>
						<p><?php echo __('Place widgets to the <strong>Footer Column 1/2/3/4</strong>', 'blognow'); ?> (<a href="<?php echo get_template_directory_uri(); ?>/assets/img/how-to-footer-widgets.png" target="_blank">how to</a>)</p>
						<div class="btn">
							<a href="<?php echo home_url(); ?>/wp-admin/widgets.php"><?php echo __('Okay, I\'m doing now', 'blognow'); ?></a>
						</div>
					</div><!-- .widget .setup-notice -->

				</div><!-- .container -->

			</div><!-- .footer-columns -->			

		<?php } ?>

		<div class="clear"></div>

		<div id="site-bottom" class="clear">

				<div class="site-info">

					<?php if(get_theme_mod('footer-credit')) { 
						
						echo get_theme_mod('footer-credit');
						
						} else { 
							$theme_uri = 'http://www.happythemes.com/wordpress-themes/';
							$author_uri = 'http://www.happythemes.com/';
					?>

					&copy; <?php echo date("o"); ?> <a href="<?php echo home_url(); ?>"><?php echo get_bloginfo('name'); ?></a> - <?php echo __('Theme by', 'blognow'); ?> <a href="<?php echo $author_uri; ?>" target="_blank">HappyThemes</a>

				<?php } ?>

				</div><!-- .site-info -->

				<div class="footer-nav">
					<?php 
						if ( has_nav_menu( 'footer' ) ) {
							wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu', 'menu_class' => 'footer-menu' ) ); 
						} else {
					?>
					
						<ul class="footer-menu">
							<li><a href="<?php echo home_url(); ?>/wp-admin/nav-menus.php"><?php echo __('<span class="step">Step 5.</span> Add menu for theme location: Footer Menu', 'blognow'); ?></a></li>
						</ul>

					<?php } ?>					
				</div><!-- .footer-nav -->

		</div>
		<!-- #site-bottom -->
							
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php if ( get_theme_mod('back-top-on', true) ) : ?>

	<div id="back-top">
		<a href="#top" title="<?php echo __('Back to top', 'blognow'); ?>"><span class="genericon genericon-collapse"></span></a>
	</div>

<?php endif; ?>


<?php if ( get_theme_mod('sticky-nav-on', true) ) : ?>

<script type="text/javascript">

	(function($){ //Sticky Header ~ Search ~ Menu

	    $(document).ready(function(){

	        "use strict"; 

			if($(".site-start").css("height") == "120px"){

				var fixed_height = '163';

			} else {
				var fixed_height = '93';
			}

			$(window).scroll(function() {
			    if ($(this).scrollTop() >= fixed_height) {
			        $('.site-header').addClass('stickytop');
			        $('.site-content').addClass('paddingtop'); 
					$('.mobile-menu').addClass('margintop'); 
			    }
			    else {
			        $('.site-header').removeClass('stickytop');
			        $('.site-content').removeClass('paddingtop');
					$('.mobile-menu').removeClass('margintop'); 			        
			    }
			});

			$('.fixed-search-icon > .genericon-search').click(function(){
			    $('.header-search2').slideDown('fast', function() {});
			    $('.fixed-search-icon > .genericon-search').toggleClass('active');
			    $('.fixed-search-icon > .genericon-close').toggleClass('active');  

			    $(window).scroll(function() {
			        if ($(this).scrollTop() >= fixed_height) {
			           $('.header-search2').css('display','block');
			        }
			        else {
			           $('.header-search2').css('display','none');
			        }
			    }); 
			                       
			});

			$('.fixed-search-icon > .genericon-close').click(function(){
			    $('.header-search2').slideUp('fast', function() {});
			    $('.fixed-search-icon > .genericon-search').toggleClass('active');
			    $('.fixed-search-icon > .genericon-close').toggleClass('active');

			    $(window).scroll(function() {
			        $('.header-search2').css('display','none');
			    });  

			});  


	    });

	})(jQuery);

</script>

<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
