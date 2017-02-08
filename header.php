<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blognow
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="HandheldFriendly" content="true">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header clear">

		<div id="top-bar" class="clear">

			<nav id="primary-nav" class="main-navigation">

				<?php 
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'sf-menu' ) );
					} else {
				?>

					<ul class="sf-menu">
						<li><a href="<?php echo home_url(); ?>/wp-admin/nav-menus.php"><?php echo __('<span class="step">Step 1.</span> Add menu for theme location: Primary Menu', 'blognow'); ?></a></li>
					</ul><!-- .sf-menu -->

				<?php } ?>

			</nav><!-- #primary-nav -->

			<div id="slick-mobile-menu"></div>		

			<?php if ( get_theme_mod('header-search-on', true) ) : ?>

				<div class="header-search">
					<form id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<input type="search" name="s" class="search-input" autocomplete="off">
						<button type="submit" class="search-submit"><?php echo __('Search', 'blognow'); ?></button>		
					</form>
				</div><!-- .header-search -->

			<?php endif; ?>	

		</div><!-- #top-bar -->

		<div class="site-start clear">

			<div class="site-branding">

				<?php if (get_theme_mod('logo', get_template_directory_uri().'/assets/img/logo.png') != null) { ?>
				
				<div id="logo">
					<span class="helper"></span>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php echo get_theme_mod('logo', get_template_directory_uri().'/assets/img/logo.png'); ?>" alt=""/>
					</a>
				</div><!-- #logo -->

				<?php } else { ?>

				<div class="site-title">
					<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
				</div><!-- .site-title -->

				<?php } ?>

			</div><!-- .site-branding -->

			<?php
				$show_header_ad = get_theme_mod('header-ad-on', true);
				$header_ad_img_url = get_theme_mod('header-ad-img-url', get_template_directory_uri().'/assets/img/728x90.png');
				$header_ad_url = get_theme_mod('header-ad-url', 'http://www.happythemes.com');

				if ( $show_header_ad  == true ) {
			?>
				<?php if (!empty($header_ad_img_url)) { ?>

					<div class="header-ad">
						<a href="<?php echo esc_url($header_ad_url); ?>" target="_blank"><img src="<?php echo esc_url($header_ad_img_url); ?>" alt="<?php echo __('Advertisement', 'blognow'); ?>"/></a>
					</div><!-- .header-ad -->
				
				<?php } ?>

			<?php } ?>

		</div><!-- .site-start -->

		<div id="secondary-bar" class="clear">

			<nav id="secondary-nav" class="secondary-navigation">

				<?php 
					if ( has_nav_menu( 'secondary' ) ) {
						wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu', 'menu_class' => 'sf-menu' ) );
					} else {
				?>

					<ul class="sf-menu">
						<li><a href="<?php echo home_url(); ?>/wp-admin/nav-menus.php"><?php echo __('<span class="step">Step 2.</span> Add menu for theme location: Secondary Menu', 'blognow'); ?></a></li>
					</ul><!-- .sf-menu -->

				<?php } ?>

			</nav><!-- #secondary-nav -->

		</div><!-- #secondary-bar -->	
		
		<?php if ( get_theme_mod('header-search-on', true) ) : ?>

			<span class="fixed-search-icon">
				<span class="genericon genericon-search"></span>
				<span class="genericon genericon-close"></span>			
			</span><!-- .fixed-search-icon -->

			<div class="header-search2">
				<form id="searchform2" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" name="s" class="search-input2" autocomplete="off">
					<button type="submit" class="search-submit2"><?php echo __('Search', 'blognow')?></button>		
				</form>
			</div><!-- .header-search2 -->

		<?php endif; ?>

		<span class="mobile-menu-icon">
			<span class="menu-icon-open"><?php echo __('Menu', 'blognow'); ?></span>
			<span class="menu-icon-close"><span class="genericon genericon-close"></span></span>		
		</span>

		<?php if ( get_theme_mod('header-search-on', true) ) : ?>

			<span class="mobile-search-icon">
				<span class="genericon genericon-search"></span>
				<span class="genericon genericon-close"></span>				
			</span>

			<div class="header-search3">
				<form id="searchform3" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" name="s" class="search-input2" autocomplete="off">
					<button type="submit" class="search-submit2"><?php echo __('Search', 'blognow')?></button>		
				</form>
			</div><!-- .header-search3 -->			

		<?php endif; ?>

		<div class="mobile-menu clear">

			<?php 

				if ( has_nav_menu( 'primary' ) ) {

					echo '<div class="menu-left">';
					echo '<h3>' . get_theme_mod('primary-nav-heading', __('Pages', 'blognow')) . '</h3>';

					wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-mobile-menu', 'menu_class' => '', 'depth' => 1 ) );

					echo "</div>";

				}

				if ( has_nav_menu( 'secondary' ) ) {

					echo '<div class="menu-right">';
					echo '<h3>' . get_theme_mod('secondary-nav-heading', __('Categories', 'blognow')) . '</h3>';

					wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-mobile-menu', 'menu_class' => '', 'depth' => 1 ) );

					echo "</div>";

				}

			?>

		</div><!-- .mobile-menu -->				

	</header><!-- #masthead -->

	<div id="content" class="site-content clear">
