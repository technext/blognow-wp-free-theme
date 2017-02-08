<?php
/**
 * Defines customizer options
 *
 * @package Customizer Library Demo
 */

function customizer_library_demo_options() {

	// Theme defaults
	$primary_color = '#5bc08c';
	$secondary_color = '#666';

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// More Examples
	$section = 'examples';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Theme Settings', 'blognow' ),
		'priority' => '10'
	);

	$options['logo'] = array(
		'id' => 'logo',
		'label'   => __( 'Logo', 'blognow' ),
		'section' => $section,
		'type'    => 'image',
		'default' => get_template_directory_uri().'/assets/img/logo.png'
	);

	$layout_choices = array(
		'choice-1' => 'Responsive Layout',
		'choice-2' => 'Fixed Layout'
	);

	$options['site-layout'] = array(
		'id' => 'site-layout',
		'label'   => __( 'Site Layout', 'blognow' ),
		'section' => $section,
		'type'    => 'radio',
		'choices' => $layout_choices,
		'default' => 'choice-1'
	);

	$options['sticky-nav-on'] = array(
		'id' => 'sticky-nav-on',
		'label'   => __( 'Sticky header navigation', 'blognow' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);

	$options['primary-nav-heading'] = array(
		'id' => 'primary-nav-heading',
		'label'   => __( 'Mobile Primary Menu Heading Text', 'blognow' ),
		'section' => $section,
		'type'    => 'text',
		'default' => __('Pages', 'blognow'),
	);

	$options['secondary-nav-heading'] = array(
		'id' => 'secondary-nav-heading',
		'label'   => __( 'Mobile Secondary Menu Heading Text', 'blognow' ),
		'section' => $section,
		'type'    => 'text',
		'default' => __('Categories', 'blognow'),
	);			

	$options['header-search-on'] = array(
		'id' => 'header-search-on',
		'label'   => __( 'Display header search form', 'blognow' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);	

	$options['header-ad-on'] = array(
		'id' => 'header-ad-on',
		'label'   => __( 'Display header advertisement', 'blognow' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => '1'
	);	

	$options['header-ad-img-url'] = array(
		'id' => 'header-ad-img-url',
		'label'   => __( 'Header Ad Image URL', 'blognow' ),
		'section' => $section,
		'type'    => 'url',
		'default' => get_template_directory_uri().'/assets/img/728x90.png',
	);	

	$options['header-ad-url'] = array(
		'id' => 'header-ad-url',
		'label'   => __( 'Header Ad URL', 'blognow' ),
		'section' => $section,
		'type'    => 'url',
		'default' => 'http://www.happythemes.com',		
	);

	$options['featured-on'] = array(
		'id' => 'featured-on',
		'label'   => __( 'Display featured content on homepage', 'blognow' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);

	$options['entry-excerpt-length'] = array(
		'id' => 'entry-excerpt-length',
		'label'   => __( 'Number of words to show on excerpt', 'blognow' ),
		'section' => $section,
		'type'    => 'text',
		'default' => '20',		
	);

	$options['list-share-on'] = array(
		'id' => 'list-share-on',
		'label'   => __( 'Display share icons on posts list', 'blognow' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);

	$options['single-share-on'] = array(
		'id' => 'single-share-on',
		'label'   => __( 'Display share icons on single posts', 'blognow' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);	

	$options['author-box-on'] = array(
		'id' => 'author-box-on',
		'label'   => __( 'Display author box on single posts', 'blognow' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);	
	$options['related-posts-on'] = array(
		'id' => 'related-posts-on',
		'label'   => __( 'Display related posts on single posts', 'blognow' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);	

	$options['footer-widgets-on'] = array(
		'id' => 'footer-widgets-on',
		'label'   => __( 'Display footer widgets', 'blognow' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);

	$options['back-top-on'] = array(
		'id' => 'back-top-on',
		'label'   => __( 'Display "back to top" icon link on the site bottom', 'blognow' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);	

	$options['footer-credit'] = array(
		'id' => 'footer-credit',
		'label'   => __( 'Customize Site Footer Text/Link', 'blognow' ),
		'section' => $section,
		'type'    => 'textarea',
		'default' => '&copy; ' . date("o") . ' <a href="' . home_url() .'">' . get_bloginfo('name') . '</a> - Theme by <a href="http://www.happythemes.com" target="_blank">HappyThemes</a>'
	);			

	//$options['example-range'] = array(
	//	'id' => 'example-range',
	//	'label'   => __( 'Example Range Input', 'blognow' ),
	//	'section' => $section,
	//	'type'    => 'range',
	//	'input_attrs' => array(
	//      'min'   => 0,
	//        'max'   => 10,
	//        'step'  => 1,
	//       'style' => 'color: #0a0',
	//	)
	//);

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();

}
add_action( 'init', 'customizer_library_demo_options' );