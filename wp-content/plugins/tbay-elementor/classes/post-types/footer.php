<?php
/**
 * Footer manager for Thembay Elementor
 *
 * @package    tbay-elementor
 * @author     Team Thembays <thembayteam@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  2015-2016 Thembay Elementor
 */
 
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

class Tbay_PostType_Footer {

  	public static function init() {
    	add_action( 'init', array( __CLASS__, 'register_post_type' ) );
    	add_action( 'init', array( __CLASS__, 'register_footer_vc' ) );
    	add_action( 'admin_init', array( __CLASS__, 'add_role_caps' ) );
  	}

  	public static function register_post_type() {
	    $labels = array(
			'name'                  => __( 'فوتر ساز', 'tbay-elementor' ),
			'singular_name'         => __( 'فوتر', 'tbay-elementor' ),
			'add_new'               => __( 'افزودن فوتر جدید', 'tbay-elementor' ),
			'add_new_item'          => __( 'افزودن فوتر جدید', 'tbay-elementor' ),
			'edit_item'             => __( 'ویرایش فوتر', 'tbay-elementor' ),
			'new_item'              => __( 'فوتر جدید', 'tbay-elementor' ),
			'all_items'             => __( 'فوتر ساز', 'tbay-elementor' ),
			'view_item'             => __( 'نمایش فوتر', 'tbay-elementor' ),
			'search_items'          => __( 'جستجو فوتر', 'tbay-elementor' ),
			'not_found'             => __( 'فوتری یافت نشد', 'tbay-elementor' ),
			'not_found_in_trash'    => __( 'فوتری در زباله دان یافت نشد', 'tbay-elementor' ),
			'parent_item_colon'     => '',
			'menu_name'             => __( 'فوتر ساز', 'tbay-elementor' ),
	    );

	    $type = 'tbay_footer';

	    register_post_type( $type,
	      	array(
		        'labels'            => apply_filters( 'tbay_postype_footer_labels' , $labels ),
		        'supports'          => array( 'title', 'editor' ),
		        'public'            => true,
		        'has_archive'       => false,
		        'menu_icon' 		=> 'dashicons-welcome-widgets-menus',
		        'menu_position'     => 51,
				'capability_type'   => array($type,'{$type}s'),
				'map_meta_cap'      => true,	      	
			)
	    );

  	}

  	public static function add_role_caps() {
 
		 // Add the roles you'd like to administer the custom post types
		 $roles = array('administrator');

		 $type  = 'tbay_footer';
		 
		 // Loop through each role and assign capabilities
		 foreach($roles as $the_role) { 
		 
		    $role = get_role($the_role);
		 
			$role->add_cap( 'read' );
			$role->add_cap( 'read_{$type}');
			$role->add_cap( 'read_private_{$type}s' );
			$role->add_cap( 'edit_{$type}' );
			$role->add_cap( 'edit_{$type}s' );
			$role->add_cap( 'edit_others_{$type}s' );
			$role->add_cap( 'edit_published_{$type}s' );
			$role->add_cap( 'publish_{$type}s' );
			$role->add_cap( 'delete_others_{$type}s' );
			$role->add_cap( 'delete_private_{$type}s' ); 
			$role->add_cap( 'delete_published_{$type}s' );
		 
		 }
	}
 

  	public static function register_footer_vc() {
	    $options = get_option('wpb_js_content_types');
	    if ( is_array($options) && !in_array('tbay_footer', $options) ) {
	      	$options[] = 'tbay_footer';
	      	update_option( 'wpb_js_content_types', $options );
	    }
  	}
  
}

Tbay_PostType_Footer::init();