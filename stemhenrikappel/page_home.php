<?php
/**
 * This file adds the home template to the mono pro.
 *
 * @author mono voce aps
 * @package mono pro
 * @subpackage Customizations
*/

/*
Template Name: Home
*/

//* Add custom body class to the head
add_filter( 'body_class', 'home_add_body_class' );
function home_add_body_class( $classes ) {

   $classes[] = 'home-section';
   return $classes;
   
}

//* Remove custom background
remove_theme_support( 'custom-background');

//* Remove the entry title
// remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//* Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Force full width content
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Top Slider
// =====================================================================================================================

add_action( 'wp_enqueue_scripts', 'enqueue_scripts_frontpage_image' );
function enqueue_scripts_frontpage_image() {
	
	// wp_enqueue_script( 'frontpage-home', get_stylesheet_directory_uri() . '/js/home.js', array( 'jquery' ), '1.0.0' );
	// wp_enqueue_script( 'frontpage-image-height', get_stylesheet_directory_uri() . '/js/frontpage_image.height.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'frontpage-owl-min', get_stylesheet_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'frontpage-owl', get_stylesheet_directory_uri() . '/js/owl.frontslider.js', array( 'jquery' ), '1.0.0', true );
	
}

add_filter( 'body_class', 'slider_body_class' );
function slider_body_class( $classes ) {
	
	if ( have_rows('slider') )
		$classes[] = 'has-owl-slider';
		return $classes;
		
}

// check if the flexible content field has rows of data
add_action( 'genesis_after_header', 'mono_frontpage_slider' );
function mono_frontpage_slider() {
	$loopCount = 0;
	$arrowlink = get_field( 'arrow_link_url' );
	$stateOne = get_field( 'statement_one' );
	$stateTwo = get_field( 'statement_two' );
	$stateThree = get_field( 'statement_three' );
	
	
	if( have_rows('slider') ):
		
		echo '<div id="owl-slider" class="owl-carousel owl-theme">';
		
		// loop through the rows of data
    	while ( have_rows('slider') ) : the_row();

        	if( get_row_layout() == 'slide' ):
				
				echo '<div class="item frame'.$loopCount.'">';
				echo '<div class="featured-section" style="background-image:url( ';
						the_sub_field('image');
				echo ');"><div class="image-section">';
				
				/*
				echo '<div class="slide_content"><h1>';
						the_sub_field('text');
				echo '</h1></div>';
				*/
	
				echo '</div></div>';
				echo '</div>';
				$loopCount ++;
			
			endif;

    	endwhile;
	
		
		
		echo '</div>';
		
		echo '<div class="statements">';
			echo '<h1><a href="#born">'.$stateOne.'</a></h1>';
			echo '<h1><a href="#byen">'.$stateTwo.'</a></h1>';
			echo '<h1><a href="#forbedring">'.$stateThree.'</a></h1>';
		echo '</div>';
	
	else :

    // no layouts found

	endif;
	
}

//* Run the Genesis loop
genesis();
