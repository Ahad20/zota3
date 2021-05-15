<?php if ( ! defined('ZOTA_THEME_DIR')) exit('No direct script access allowed');

$theme_primary = require_once( get_parent_theme_file_path( ZOTA_INC . '/class-primary-color.php') );

$main_color_skin 	= '.has-before:hover,button.btn-close:hover ';  
$main_bg_skin 		= '.btn-theme,.owl-carousel > .slick-arrow:hover,.owl-carousel > .slick-arrow:focus,.tbay-element-product-categories-tabs .tabs-list > li > a.active,.tbay-element-product-categories-tabs .tabs-list > li > a:hover,.tbay-element-product-tabs .tabs-list > li > a.active,.tbay-element-product-tabs .tabs-list > li > a:hover,.has-before:hover:after , .title-widget-2::after,.product-block.inner .group-buttons > div > a:hover,.product-block.inner .group-buttons > div.button-wishlist > div > div:hover,.product-block.inner .group-buttons > div a.added,.product-block.inner .group-buttons > div > a.loading,.product-block.inner .group-buttons > div.button-wishlist > div .yith-wcwl-wishlistexistsbrowse,.product-block.inner .group-buttons > div.button-wishlist > div .yith-wcwl-wishlistaddedbrowse ';
$main_border_skin 	= '';


$main_color 			= $theme_primary['color']; 
$main_bg 				= $theme_primary['background'];
$main_border 			= $theme_primary['border'];
$main_top_border 		= $theme_primary['border-top-color'];
$main_right_border 		= $theme_primary['border-right-color'];
$main_bottom_border 	= $theme_primary['border-bottom-color'];
$main_left_border 		= $theme_primary['border-left-color'];




if( !empty($main_color_skin) ) {
	$main_color 	= $main_color . ',' . $main_color_skin; 
}
if( !empty($main_bg_skin) ) {
	$main_bg 	= $main_bg. ',' .$main_bg_skin; 
}
if( !empty($main_border_skin) ) {
	$main_border 	= $main_border. ',' .$main_border_skin; 
}
if( !empty($main_border_top_skin) ) {
	$main_top_border 	= $main_top_border. ',' .$main_border_top_skin; 
}
/**
 * ------------------------------------------------------------------------------------------------
 * Prepare CSS selectors for theme settions (colors, borders, typography etc.)
 * ------------------------------------------------------------------------------------------------
 */

$output = array();

/*CustomMain color*/
$output['main_color'] = array( 
	'color' => zota_texttrim($main_color),
	'background-color' => zota_texttrim($main_bg),
	'border-color' => zota_texttrim($main_border),
);
if( !empty($main_top_border) ) {

	$bordertop = array(
		'border-top-color' => zota_texttrim($main_top_border),
	);

	$output['main_color'] = array_merge($output['main_color'],$bordertop);
}
if( !empty($main_right_border) ) {
	
	$borderright = array(
		'border-right-color' => zota_texttrim($main_right_border),
	);

	$output['main_color'] = array_merge($output['main_color'],$borderright);
}
if( !empty($main_bottom_border) ) {
	
	$borderbottom = array(
		'border-bottom-color' => zota_texttrim($main_bottom_border),
	);

	$output['main_color'] = array_merge($output['main_color'],$borderbottom);
}
if( !empty($main_left_border) ) {
	
	$borderleft = array(
		'border-left-color' => zota_texttrim($main_left_border),
	);

	$output['main_color'] = array_merge($output['main_color'],$borderleft);
}


/*Custom Fonts*/
$output['primary-font'] = array('body, p');
$output['secondary-font'] = array('h1, h2, h3, h4, h5, h6, .btn, .button, .rev-btn, .rev-btn:visited');

/*Background hover*/
$output['background_hover']  	= $theme_primary['background_hover'];
/*Tablet*/
$output['tablet_color'] 	 	= $theme_primary['tablet_color'];
$output['tablet_background'] 	= $theme_primary['tablet_background'];
$output['tablet_border'] 		= $theme_primary['tablet_border'];
/*Mobile*/
$output['mobile_color'] 		= $theme_primary['mobile_color'];
$output['mobile_background'] 	= $theme_primary['mobile_background'];
$output['mobile_border'] 		= $theme_primary['mobile_border'];

/*Header Mobile*/
$output['header_mobile_bg'] = array( 
	'background-color' => zota_texttrim('.topbar-device-mobile')
);
$output['header_mobile_color'] = array( 
	'color' => zota_texttrim('.topbar-device-mobile i, .topbar-device-mobile.active-home-icon .topbar-title')
);

return apply_filters( 'zota_get_output', $output);
