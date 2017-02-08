<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blognow
 */


?>

<aside id="secondary" class="widget-area sidebar">
	<?php if ( ! is_active_sidebar( 'sidebar-1' ) ) { ?>
		<div class="widget setup-notice">
			<p><?php echo __('There is no content here', 'blognow'); ?></p>
			<p><?php echo __('Please put some widgets to the <strong>Sidebar</strong>', 'blognow'); ?></p>
			<div class="btn">
				<a href="<?php echo home_url(); ?>/wp-admin/widgets.php"><?php echo __('Okay, I\'m doing now', 'blognow'); ?></a>
			</div>
		</div>
	<?php } ?>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
