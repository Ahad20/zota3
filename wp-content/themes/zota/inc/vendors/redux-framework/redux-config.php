<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if( defined('TBAY_ELEMENTOR_ACTIVED') && !TBAY_ELEMENTOR_ACTIVED) return;

if (!class_exists('Zota_Redux_Framework_Config')) {

    class Zota_Redux_Framework_Config
    {
        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;
        public $output;
        public $default_color; 

        public function __construct()
        {
            if (!class_exists('ReduxFramework')) {
                return; 
            }  

            add_action('init', array($this, 'initSettings'), 10);
        }

        public function redux_output() 
        {
            $this->output = require_once( get_parent_theme_file_path( ZOTA_INC .'/skins/'.zota_tbay_get_theme().'/output.php') );
        }        

        public function redux_default_color() 
        {
            $this->default_color = zota_tbay_default_theme_primary_color();

        }

        public function initSettings()
        {
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            //Create output
            $this->redux_output();            

            //Create default color all skins
            $this->redux_default_color();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        public function setSections()
        {

            $output = $this->output;

            $default_color = $this->default_color;

            $sidebars = zota_sidebars_array();

            $columns = array( 
                '1' => esc_html__('1 Column', 'zota'),
                '2' => esc_html__('2 Columns', 'zota'),
                '3' => esc_html__('3 Columns', 'zota'),
                '4' => esc_html__('4 Columns', 'zota'),
                '5' => esc_html__('5 Columns', 'zota'),
                '6' => esc_html__('6 Columns', 'zota')
            );     

            $aspect_ratio = array( 
                '16_9' => '16:9',
                '4_3' => '4:3',
            );        

            $blog_image_size = array( 
                'thumbnail'         => esc_html__('Thumbnail', 'zota'),
                'medium'            => esc_html__('Medium', 'zota'),
                'large'             => esc_html__('Large', 'zota'),
                'full'              => esc_html__('Full', 'zota'),
            );      
          
            
            // General Settings Tab
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-settings',
                'title' => esc_html__('General', 'zota'),
                'fields' => array(
                    array(
                        'id'        => 'active_theme',
                        'type'      => 'image_select', 
                        'compiler'  => true,
                        'class'     => 'image-large active_skins',
                        'title'     => esc_html__('Activated Skin', 'zota'),
                        'options'   => zota_tbay_get_themes(),
                        'default'   => 'electronics'
                    ), 
                    array(
                        'id'            => 'config_media',
                        'type'          => 'switch',
                        'title'         => esc_html__('Enable Config Image Size', 'zota'),
                        'subtitle'      => esc_html__('Config image size in WooCommerce and Media Setting', 'zota'),
                        'default'       => false
                    ),
                )
            );
            // Header
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-view-web',
                'title' => esc_html__('Header', 'zota'),
                'fields' => array(
                    array(
                        'id' => 'header_type',
                        'type' => 'select',
                        'title' => esc_html__('Select Header Layout', 'zota'),
                        'options' => zota_tbay_get_header_layouts(),
                        'default' => 'header_default'
                    ),
                    array(
                        'id' => 'media-logo', 
                        'type' => 'media',
                        'title' => esc_html__('Upload Logo', 'zota'),
                        'required' => array('header_type','=','header_default'),
                        'subtitle' => esc_html__('Image File (.png or .gif)', 'zota'),
                    ),
                    array(
                        'id' => 'header_located_on_slider',
                        'type' => 'switch',
                        'title' => esc_html__('Header Located On Slider', 'zota'),
                        'subtitle' => esc_html__('Only home-page','zota'),
                        'default' => false,
                    ),
                )
            );
            
            // Footer
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-border-bottom',
                'title' => esc_html__('Footer', 'zota'),
                'fields' => array(
                    array(
                        'id' => 'footer_type',
                        'type' => 'select',
                        'title' => esc_html__('Select Footer Layout', 'zota'),
                        'options' => zota_tbay_get_footer_layouts(),
 						'default' => 'footer_default'
                    ),
                    array(
                        'id' => 'copyright_text',
                        'type' => 'editor',
                        'title' => esc_html__('Copyright Text', 'zota'),
                        'default' => esc_html__('Copyright  &#64; 2021 Zota Designed by ThemBay. All Rights Reserved.', 'zota'),
                        'required' => array('footer_type','=','footer_default')
                    ),
                    array(
                        'id' => 'back_to_top',
                        'type' => 'switch',
                        'title' => esc_html__('Enable "Back to Top" Button', 'zota'),
                        'default' => true,
                    ),
                )
            );



            // Mobile
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-smartphone-iphone',
                'title' => esc_html__('Mobile', 'zota'),
            );

            // Mobile Header settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Header', 'zota'),
                'fields' => array(
                    array(
                        'id' => 'mobile_header',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Mobile Header', 'zota'),
                        'subtitle'  => esc_html__('Only off when use Header Elementor Pro on mobile ', 'zota'),
                        'default' => true
                    ),   
                    array(
                        'id' => 'mobile-logo',
                        'type' => 'media',
                        'required' => array('mobile_header','=', true),
                        'title' => esc_html__('Upload Logo', 'zota'),
                        'subtitle' => esc_html__('Image File (.png or .gif)', 'zota'),
                    ),
                    array(
                        'id'        => 'logo_img_width_mobile',
                        'type'      => 'slider',
                        'required' => array('mobile_header','=', true),
                        'title'     => esc_html__('Logo maximum width (px)', 'zota'),
                        "default"   => 69,
                        "min"       => 50,
                        "step"      => 1,
                        "max"       => 600,
                    ),
                    array(
                        'id'             => 'logo_mobile_padding',
                        'type'           => 'spacing',
                        'mode'           => 'padding',
                        'required' => array('mobile_header','=', true),
                        'units'          => array('px'),
                        'units_extended' => 'false',
                        'title'          => esc_html__('Logo Padding', 'zota'),
                        'desc'           => esc_html__('Add more spacing around logo.', 'zota'),
                        'default'            => array(
                            'padding-top'     => '',
                            'padding-right'   => '',
                            'padding-bottom'  => '',
                            'padding-left'    => '',
                            'units'          => 'px',
                        ),
                    ),
                    array(
                        'id'        => 'always_display_logo',
                        'type'      => 'switch',
                        'required' => array('mobile_header','=', true),
                        'title'     => esc_html__('Always Display Logo', 'zota'),
                        'subtitle'      => esc_html__('Logo displays on all pages (page title is disabled)', 'zota'),
                        'default'   => false
                    ),                    
                    array(
                        'id'        => 'menu_mobile_all_page',
                        'type'      => 'switch',
                        'required'  => array('mobile_header','=', true),
                        'title'     => esc_html__('Always Display Menu', 'zota'),
                        'subtitle'  => esc_html__('Menu displays on all pages (Button Back is disabled)', 'zota'),
                        'default'   => false
                    ),
                    array(
                        'id'        => 'enable_menu_mobile_search',
                        'type'      => 'switch',
                        'required'  => array('mobile_header','=', true),
                        'title'     => esc_html__('Enable Form Search', 'zota'),
                        'subtitle' => esc_html__('Enable or disable Form Search', 'zota'),
                        'default'   => true
                    ),
                    array(
                        'id'        => 'all_page_menu_mobile_search',
                        'type'      => 'switch',
                        'required'  => array('enable_menu_mobile_search','=', true),
                        'title'     => esc_html__('Always Display Search', 'zota'),
                        'subtitle'  => esc_html__('Search displays on all pages', 'zota'),
                        'class' =>   'tbay-search-mb-all-page',
                        'default'   => false
                    ),
                    
                    array(
                        'id'        => 'hidden_header_el_pro_mobile',
                        'type'      => 'switch',
                        'title'     => esc_html__('Hide Header Elementor Pro', 'zota'),
                        'subtitle'  => esc_html__('Hide Header Elementor Pro on mobile', 'zota'),
                        'default'   => true
                    ),
                )
            );

             // Mobile Footer settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Footer', 'zota'),
                'fields' => array(                
                    array(
                        'id' => 'mobile_footer',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Desktop Footer', 'zota'),
                        'default' => false
                    ),  
                    array(
                        'id' => 'mobile_footer_collapse',
                        'type' => 'switch',
                        'required' => array('mobile_footer','=', true),
                        'title' => esc_html__('Collapse widgets on mobile', 'zota'),
                        'subtitle'  => esc_html__( 'Widgets added to the footer will be collapsed by default and opened when you click on their titles.', 'zota' ),
                        'default' => false
                    ),   
                    array(
                        'id' => 'mobile_back_to_top',
                        'type' => 'switch',
                        'title' => esc_html__('Enable "Back to Top" Button', 'zota'),
                        'default' => false
                    ),                 
                    array(
                        'id' => 'mobile_footer_icon',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Mobile Footer', 'zota'),
                        'default' => true
                    ),
                    array(
                        'id'          => 'mobile_footer_slides',
                        'type'        => 'slides',
                        'title'       => esc_html__( 'Config List Menu Icon', 'zota' ),
                        'subtitle' => esc_html__( 'Enter icon name of fonts: ', 'zota' ) . '<a href="//fontawesome.com/icons?m=free/" target="_blank">Awesome</a> , <a href="//fonts.thembay.com/simple-line-icons//" target="_blank">Simple Line Icons</a>, <a href="//fonts.thembay.com/material-design-iconic/" target="_blank">Material Design Iconic</a></br></br><b>'. esc_html__( 'List default URLs:', 'zota' ) . '</b></br></br><span class="des-label">'. esc_html__('Home page:', 'zota') .'</span><b class="df-url">{{home}}</b></br><span class="des-label">'. esc_html__('Shop page:', 'zota') .'</span><b class="df-url">{{shop}}</b></br><span class="des-label">'. esc_html__('My account page:', 'zota') .'</span><b class="df-url">{{account}}</b></br><span class="des-label">'. esc_html__('Cart page:', 'zota') .'</span><b class="df-url">{{cart}}</b></br><span class="des-label">'. esc_html__('Checkout page:', 'zota') .'</span><b class="df-url">{{checkout}}</b></br><span class="des-label">'. esc_html__('Wishlist page:', 'zota') .'</span><b class="df-url">{{wishlist}}</b></br></br>'. esc_html__( 'Watch video tutorial: ', 'zota' ) . '<a href="//youtu.be/d7b6dIzV-YI/" target="_blank">here</a>',
                        'class' =>   'tbay-redux-slides',
                        'show' => array(
                            'title' => true,
                            'description' => true,
                            'url' => true,
                        ),
                        'content_title' => esc_html__( 'Menu', 'zota' ),
                        'required' => array('mobile_footer_icon','=', true),
                        'placeholder'   => array(
                            'title'      => esc_html__( 'Title', 'zota' ),
                            'description' => esc_html__( 'Enter icon name', 'zota' ),
                            'url'       => esc_html__( 'Link', 'zota' ),
                        ),
                    ),
                )
            );     

            // Mobile Search settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Search', 'zota'),
                'fields' => array( 
                    array(
                        'id'=>'mobile_search_type',
                        'type' => 'button_set',
                        'title' => esc_html__('Search Result', 'zota'),
                        'options' => array(
                            'post' => esc_html__('Post', 'zota'), 
                            'product' => esc_html__('Product', 'zota')
                        ),
                        'default' => 'product'
                    ),
                    array(
                        'id' => 'mobile_autocomplete_search',
                        'type' => 'switch',
                        'title' => esc_html__('Auto-complete Search?', 'zota'),
                        'default' => 1
                    ),
                    array(
                        'id'       => 'mobile_search_placeholder',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Placeholder', 'zota' ),
                        'default'  => esc_html__( 'Search in 20.000+ products...', 'zota' ),
                    ),   
                    array(
                        'id' => 'mobile_enable_search_category',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Search in Categories', 'zota'),
                        'default' => true
                    ), 
                    array(
                        'id' => 'mobile_show_search_product_image',
                        'type' => 'switch',
                        'title' => esc_html__('Show Image of Search Result', 'zota'),
                        'required' => array('mobile_autocomplete_search', '=', '1'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'mobile_show_search_product_price',
                        'type' => 'switch',
                        'title' => esc_html__('Show Price of Search Result', 'zota'),
                        'required' => array(array('mobile_autocomplete_search', '=', '1'), array('mobile_search_type', '=', 'product')),
                        'default' => true
                    ),  
                    array(
                        'id' => 'mobile_search_min_chars',
                        'type'  => 'slider',
                        'required' => array('mobile_autocomplete_search', '=', '1'),
                        'title' => esc_html__('Search Min Characters', 'zota'),
                        'default' => 2,
                        'min'   => 1,
                        'step'  => 1,
                        'max'   => 6,
                    ), 
                    array(
                        'id' => 'mobile_search_max_number_results',
                        'type'  => 'slider',
                        'required' => array('mobile_autocomplete_search', '=', '1'),
                        'title' => esc_html__('Number of Search Results', 'zota'),
                        'desc'  => esc_html__( 'Max number of results show in Mobile', 'zota' ),
                        'default' => 5,
                        'min'   => 2,
                        'step'  => 1,
                        'max'   => 20,
                    ), 
                )
            );

            // Menu mobile settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Menu Mobile', 'zota'),
                'fields' => array(              
                    array(
                        'id'       => 'menu_mobile_select',
                        'type'     => 'select',
                        'data'     => 'menus',
                        'title'    => esc_html__( 'Main Menu Mobile', 'zota' ),
                        'desc'     => esc_html__( 'Select the menu you want to display.', 'zota' ),
                        'default' => 69
                    ),
                    array(
                        'id' => 'enable_mmenu_langue', 
                        'type' => 'switch',
                        'title' => esc_html__('Enable Custom Language', 'zota'),
                        'desc'  => esc_html__( 'If you use WPML will appear here', 'zota' ),
                        'default' => true
                    ),   
                    array(
                        'id' => 'enable_mmenu_currency', 
                        'type' => 'switch',
                        'title' => esc_html__('Enable Currency', 'zota'),
                        'default' => true
                    ),  
                )
            );
            
          

            // Mobile Woocommerce settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Mobile WooCommerce', 'zota'),
                'fields' => array(                
                    array(
                        'id' => 'mobile_product_number',
                        'type' => 'image_select',
                        'title' => esc_html__('Product Column in Shop page', 'zota'),
                        'options' => array(
                            'one' => array(
                                'title' => esc_html__( 'One Column', 'zota' ),
                                'img'   => ZOTA_ASSETS_IMAGES . '/mobile/one_column.jpg'
                            ),                            
                            'two' => array(
                                'title' => esc_html__( 'Two Columns', 'zota' ),
                                'img'   => ZOTA_ASSETS_IMAGES . '/mobile/two_columns.jpg'
                            ),
                        ),
                        'default' => 'two'
                    ),  
					array(
                        'id' => 'enable_add_cart_mobile',
                        'type' => 'switch',
                        'title' => esc_html__('Show "Add to Cart" Button', 'zota'),
                        'subtitle' => esc_html__('On Home and page Shop', 'zota'),
                        'default' => false
                    ),
                    array(
                        'id' => 'enable_wishlist_mobile',
                        'type' => 'switch',
                        'title' => esc_html__('Show "Wishlist" Button', 'zota'),
                        'subtitle' => esc_html__('Enable or disable in Home and Shop page', 'zota'),
                        'default' => false
                    ),
                    array(
                        'id' => 'enable_one_name_mobile',
                        'type' => 'switch',
                        'title' => esc_html__('Show Full Product Name', 'zota'),
                        'subtitle' => esc_html__('Enable or disable in Home and Shop page', 'zota'),
                        'default' => false
                    ),             
                    array(
                        'id' => 'mobile_form_cart_style',
                        'type' => 'select',   
                        'title' => esc_html__('Add To Cart Form Type', 'zota'),
                        'subtitle' => esc_html__('On Page Single Product', 'zota'),
                        'options' => array(
                            'default' => esc_html__('Default', 'zota'),
                            'popup' => esc_html__('Popup', 'zota') 
                        ),
                        'default' => 'popup'
                    ),
                    array(
                        'id' => 'enable_quantity_mobile',
                        'type' => 'switch',
                        'title' => esc_html__('Show Quantity', 'zota'),
                        'subtitle' => esc_html__('On Page Single Product', 'zota'),
                        'required' => array('mobile_form_cart_style','=', 'default'),
                        'default' => false
                    ),     
                    array(
                        'id' => 'enable_tabs_mobile',
                        'type' => 'switch',
                        'title' => esc_html__('Show Sidebar Tabs', 'zota'),
                        'subtitle' => esc_html__('On Page Single Product', 'zota'),
                        'default' => true
                    ),
                )
            );

            // Style
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-format-color-text',
                'title' => esc_html__('Style', 'zota'),
            ); 

            // Style
            $this->sections[] = array(
                'title' => esc_html__('Main', 'zota'),
                'subsection' => true,
                'fields' => array(
                    array(
                        'id'       => 'boby_bg',
                        'type'     => 'background',
                        'output'   => array( 'body' ),
                        'title'    => esc_html__( 'Body Background', 'zota' ),
                        'subtitle' => esc_html__( 'Body background with image, color, etc.', 'zota' ),
                    ),
                   
                    array (
                        'title' => esc_html__('Theme Main Color', 'zota'),
                        'id' => 'main_color',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => $default_color['main_color'],
                        'output' => $output['main_color'],
                    ), 

                                   
                    
                )
            );

            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Typography', 'zota'),
                'fields' => array(
                    array(
                        'id' => 'show_typography',
                        'type' => 'switch',
                        'title' => esc_html__('Edit Typography', 'zota'),
                        'default' => false
                    ),
                    array(
                        'title'    => esc_html__('Font Source', 'zota'),
                        'id'       => 'font_source',
                        'type'     => 'radio',
                        'required' => array('show_typography','=', true),
                        'options'  => array(
                            '1' => 'Standard + Google Webfonts',
                            '2' => 'Google Custom',
                            '3' => 'Custom Fonts'
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id'=>'font_google_code',
                        'type' => 'text',
                        'title' => esc_html__('Google Link', 'zota'), 
                        'subtitle' => '<em>'.esc_html__('Paste the provided Google Code', 'zota').'</em>',
                        'default' => '',
                        'desc' => esc_html__('e.g.: https://fonts.googleapis.com/css?family=Open+Sans', 'zota'),
                        'required' => array('font_source','=','2')
                    ),

                    array (
                        'id' => 'main_custom_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;">'. sprintf(
                                                                    '%1$s <a href="%2$s">%3$s</a>',
                                                                    esc_html__( 'Video guide custom font in ', 'zota' ),
                                                                    esc_url( 'https://www.youtube.com/watch?v=ljXAxueAQUc' ),
                                                                    esc_html__( 'here', 'zota' )
                                ) .'</h3>',
                        'required' => array('font_source','=','3')
                    ),

                    array (
                        'id' => 'main_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Main Font', 'zota').'</h3>',
                        'required' => array('show_typography','=', true),
                    ),                    

                    // Standard + Google Webfonts
                    array (
                        'title' => esc_html__('Font Face', 'zota'),
                        'id' => 'main_font',
                        'type' => 'typography',
                        'line-height' => false,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => false,
                        'all_styles'=> true,
                        'font-size' => false,
                        'color' => false,
                        'output' => $output['primary-font'],
                        'default' => array (
                            'font-family' => '',
                            'subsets' => '',
                        ),
                        'required' => array( 
                            array('font_source','=','1'), 
                            array('show_typography','=', true) 
                        )
                    ),
                    
                    // Google Custom                        
                    array (
                        'title' => esc_html__('Google Font Face', 'zota'),
                        'subtitle' => '<em>'.esc_html__('Enter your Google Font Name for the theme\'s Main Typography', 'zota').'</em>',
                        'desc' => esc_html__('e.g.: &#39;Open Sans&#39;, sans-serif', 'zota'),
                        'id' => 'main_google_font_face',
                        'type' => 'text',
                        'default' => '',
                        'required' => array( 
                            array('font_source','=','2'), 
                            array('show_typography','=', true) 
                        )
                    ),                    

                    // main Custom fonts                      
                    array (
                        'title' => esc_html__('Main custom Font Face', 'zota'),
                        'subtitle' => '<em>'.esc_html__('Enter your Custom Font Name for the theme\'s Main Typography', 'zota').'</em>',
                        'desc' => esc_html__('e.g.: &#39;Open Sans&#39;, sans-serif', 'zota'),
                        'id' => 'main_custom_font_face',
                        'type' => 'text',
                        'default' => '',
                        'required' => array( 
                            array('font_source','=','3'), 
                            array('show_typography','=', true) 
                        )
                    ),
                )
            );

            // Style
            $this->sections[] = array(
                'title' => esc_html__('Header Mobile', 'zota'),
                'subsection' => true,
                'fields' => array(
                    array(
                        'id'       => 'header_mobile_bg',
                        'type'     => 'background',
                        'output' => $output['header_mobile_bg'],
                        'title'    => esc_html__( 'Header Mobile Background', 'zota' ),
                    ),
                    array (
                        'title' => esc_html__('Header Color', 'zota'),
                        'id' => 'header_mobile_color',
                        'type' => 'color',
                        'transparent' => false,
                        'output' => $output['header_mobile_color'],
                    ),                    
                )
            );

            // Style WooCommerce
            $this->sections[] = array(
                'title' => esc_html__('WooCommerce Theme', 'zota'),
                'subsection' => true,
                'fields' => array(
                    array(
                        'title' => esc_html__('Background', 'zota'),
                        'subtitle' => esc_html__('Background button "Buy Now"', 'zota'),
                        'id' => 'bg_buy_now', 
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),          
                    array(
                        'title' => esc_html__('Color', 'zota'),
                        'subtitle' => esc_html__('Color button "Buy Now"', 'zota'),
                        'id' => 'color_buy_now', 
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '',
                    ),           
                )
            );


            // WooCommerce
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-shopping-cart',
                'title' => esc_html__('WooCommerce', 'zota'),
                'fields' => array(       
                    array(
                        'title'    => esc_html__('Label Sale Format', 'zota'),
                        'id'       => 'sale_tags',
                        'type'     => 'radio',
                        'options'  => array( 
                            'Sale!' => esc_html__('Sale!' ,'zota'),
                            'Save {percent-diff}%' => esc_html__('Save {percent-diff}% (e.g "Save 50%")' ,'zota'),
                            'Save {symbol}{price-diff}' => esc_html__('Save {symbol}{price-diff} (e.g "Save $50")' ,'zota'),
                            'custom' => esc_html__('Custom Format (e.g -50%, -$50)' ,'zota')
                        ),
                        'default' => 'custom'
                    ),
                    array(
                        'id'        => 'sale_tag_custom',
                        'type'      => 'text',
                        'title'     => esc_html__( 'Custom Format', 'zota' ),
                        'desc'      => esc_html__('{price-diff} inserts the dollar amount off.', 'zota'). '</br>'.
                                       esc_html__('{percent-diff} inserts the percent reduction (rounded).', 'zota'). '</br>'.
                                       esc_html__('{symbol} inserts the Default currency symbol.', 'zota'), 
                        'required'  => array('sale_tags','=', 'custom'),
                        'default'   => '-{percent-diff}%'
                    ), 
                    array(
                        'id' => 'enable_label_featured',
                        'type' => 'switch',
                        'title' => esc_html__('Enable "Featured" Label', 'zota'),
                        'default' => true
                    ),   
                    array(
                        'id'        => 'custom_label_featured',
                        'type'      => 'text',
                        'title'     => esc_html__( '"Featured Label" Custom Text', 'zota' ),
                        'required'  => array('enable_label_featured','=', true),
                        'default'   => esc_html__('Featured', 'zota')
                    ),
                    
                    array(
                        'id' => 'enable_brand',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Brand Name', 'zota'),
                        'subtitle' => esc_html__('Enable/Disable brand name on HomePage and Shop Page', 'zota'),
                        'default' => false
                    ),
                    array(
                        'id' => 'enable_text_time_coutdown',
                        'type' => 'switch', 
                        'title' => esc_html__('Enable the text of Time Countdown', 'zota'),
                        'default' => false
                    ),
                    
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),            
                    array(
                        'id' => 'product_display_image_mode',
                        'type' => 'image_select',
                        'title' => esc_html__('Product Image Display Mode', 'zota'),
                        'options' => array(
                            'one' => array(
                                'title' => esc_html__( 'Single Image', 'zota' ),
                                'img' => ZOTA_ASSETS_IMAGES . '/image_mode/single-image.png'
                            ),                                  
                            'two' => array(
                                'title' => esc_html__( 'Double Images (Hover)', 'zota' ),
                                'img' => ZOTA_ASSETS_IMAGES . '/image_mode/display-hover.gif'
                            ),                                                                                                                             
                        ),
                        'default' => 'slider'
                    ),
                    array(
                        'id' => 'enable_quickview',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Quick View', 'zota'),
                        'default' => 1
                    ),                    
                    array(
                        'id' => 'enable_woocommerce_catalog_mode',
                        'type' => 'switch',
                        'title' => esc_html__('Show WooCommerce Catalog Mode', 'zota'),
                        'default' => false
                    ),    
                    array(
                        'id' => 'enable_woocommerce_quantity_mode',
                        'type' => 'switch',
                        'title' => esc_html__('Enable WooCommerce Quantity Mode', 'zota'),
                        'subtitle' => esc_html__('Enable/Disable show quantity on Home Page and Shop Page', 'zota'),
                        'default' => false
                    ),                   
                    array(
                        'id' => 'ajax_update_quantity',
                        'type' => 'switch',
                        'title' => esc_html__('Quantity Ajax Auto-update', 'zota'),
                        'subtitle' => esc_html__('Enable/Disable quantity ajax auto-update on page Cart', 'zota'),
                        'default' => true
                    ),   
					array(
                        'id' => 'enable_variation_swatch',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Product Variation Swatch', 'zota'),
                        'subtitle' => esc_html__('Enable/Disable Product Variation Swatch on HomePage and Shop page', 'zota'),
                        'default' => true
                    ), 
                    array(
                        'id' => 'variation_swatch',
                        'type' => 'select',
                        'title' => esc_html__('Product Attribute', 'zota'),
                        'required' => array('enable_variation_swatch','=',1),
                        'options' => zota_tbay_get_variation_swatchs(),
                        'default' => ''
                    ),  					                
                )
            );

            // woocommerce Breadcrumb settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Mini Cart', 'zota'),
                'fields' => array(
                     array(
                        'id' => 'woo_mini_cart_position',
                        'type' => 'select', 
                        'title' => esc_html__('Mini-Cart Position', 'zota'),
                        'options' => array( 
                            'left'       => esc_html__('Left', 'zota'),
                            'right'      => esc_html__('Right', 'zota'),
                            'popup'      => esc_html__('Popup', 'zota'),
                            'no-popup'   => esc_html__('None Popup', 'zota')
                        ),
                        'default' => 'popup'
                    ), 
                )
            ); 

            // woocommerce Breadcrumb settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Breadcrumb', 'zota'),
                'fields' => array(
                    array(
                        'id' => 'show_product_breadcrumb',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Breadcrumb', 'zota'),
                        'default' => true
                    ),
                    array(
                        'id' => 'product_breadcrumb_layout',
                        'type' => 'image_select',
                        'class'     => 'image-two',
                        'compiler' => true,
                        'title' => esc_html__('Breadcrumb Layout', 'zota'),
                        'required' => array('show_product_breadcrumb','=',1),
                        'options' => array(                          
                            'image' => array(
                                'title' => esc_html__( 'Background Image', 'zota' ),
                                'img'   => ZOTA_ASSETS_IMAGES . '/breadcrumbs/image.jpg'
                            ),
                            'color' => array(
                                'title' => esc_html__( 'Background color', 'zota' ),
                                'img'   => ZOTA_ASSETS_IMAGES . '/breadcrumbs/color.jpg'
                            ),
                            'text'=> array(
                                'title' => esc_html__( 'Text Only', 'zota' ),
                                'img'   => ZOTA_ASSETS_IMAGES . '/breadcrumbs/text_only.jpg'
                            ),
                        ),
                        'default' => 'color'
                    ),
                    array (
                        'title' => esc_html__('Breadcrumb Background Color', 'zota'),
                        'subtitle' => '<em>'.esc_html__('The Breadcrumb background color of the site.', 'zota').'</em>',
                        'id' => 'woo_breadcrumb_color',
                        'required' => array('product_breadcrumb_layout','=',array('default','color')),
                        'type' => 'color',
                        'default' => '#f4f9fc',
                        'transparent' => false,
                    ),
                    array( 
                        'id' => 'woo_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumb Background', 'zota'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your Breadcrumb.', 'zota'),
                        'required' => array('product_breadcrumb_layout','=','image'),
                        'default'  => array( 
                            'url'=> ZOTA_IMAGES .'/breadcrumbs-woo.jpg'
                        ),
                    ),
                    array(
                        'id' => 'enable_previous_page_woo',
                        'type' => 'switch',
                        'required' => array('show_product_breadcrumb','=',1),
                        'title' => esc_html__('Previous page', 'zota'),
                        'default' => true
                    ), 
                )
            ); 

            // WooCommerce Archive settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Shop', 'zota'),
                'fields' => array(       
                    array(
                        'id' => 'product_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Shop Layout', 'zota'),
                        'options' => array(
                            'shop-left' => array(
                                'title' => esc_html__( 'Left Sidebar', 'zota' ),
                                'img' => ZOTA_ASSETS_IMAGES . '/product_archives/shop_left_sidebar.jpg'
                            ),                                  
                            'shop-right' => array(
                                'title' => esc_html__( 'Right Sidebar', 'zota' ),
                                'img' => ZOTA_ASSETS_IMAGES . '/product_archives/shop_right_sidebar.jpg'
                            ),                                                                         
                            'full-width' => array(
                                'title' => esc_html__( 'No Sidebar', 'zota' ),
                                'img' => ZOTA_ASSETS_IMAGES . '/product_archives/shop_no_sidebar.jpg'
                            ),                                                      
                        ),
                        'default' => 'shop-left'
                    ),
                    array(
                        'id' => 'product_archive_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Sidebar', 'zota'),
                        'options' => $sidebars,
                        'default' => 'product-archive'
                    ),   
                    array(
                        'id' => 'enable_display_mode',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Products Display Mode', 'zota'),
                        'subtitle' => esc_html__('Enable/Disable Display Mode', 'zota'),
                        'default' => true
                    ),   
                    array(
                        'id' => 'product_display_mode',
                        'type' => 'button_set',
                        'title' => esc_html__('Products Display Mode', 'zota'),
                        'required' => array('enable_display_mode','=',1),
                        'options' => array(
                            'grid' => esc_html__('Grid', 'zota'), 
                            'list' => esc_html__('List', 'zota')
                        ),
                        'default' => 'grid'
                    ),                                
                    array(
                        'id' => 'title_product_archives',
                        'type' => 'switch',
                        'title' => esc_html__('Show Title of Categories', 'zota'),
                        'default' => false 
                    ),                       
                    array(
                        'id' => 'pro_des_image_product_archives',
                        'type' => 'switch',
                        'title' => esc_html__('Show Description, Image of Categories', 'zota'),
                        'default' => true
                    ),
                    array(
                        'id' => 'number_products_per_page',
                        'type' => 'slider',
                        'title' => esc_html__('Number of Products Per Page', 'zota'),
                        'default' => 15,
                        'min' => 1,
                        'step' => 1,
                        'max' => 100,
                    ),
                    array(
                        'id' => 'product_columns',
                        'type' => 'select',
                        'title' => esc_html__('Product Columns', 'zota'),
                        'options' => $columns,
                        'default' => 4
                    ),
                    array(
                        'id' => 'product_pagination_style',
                        'type' => 'select',
                        'title' => esc_html__('Product Pagination Style', 'zota'),
                        'options' => array( 
                            'number' => esc_html__('Pagination Number', 'zota'),
                            'loadmore'  => esc_html__('Load More Button', 'zota'),  
                        ),
                        'default' => 'number' 
                    ),            
                )
            );
            // Product Page
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Single Product', 'zota'),
                'fields' => array(
                    array(
                        'id' => 'product_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Select Single Product Layout', 'zota'),
                        'options' => array(
                            'vertical' => array(
                                'title' => esc_html__('Image Vertical', 'zota'),
                                'img' => ZOTA_ASSETS_IMAGES . '/product_single/verical_thumbnail.jpg'
                            ),                             
                            'horizontal' => array(
                                'title' => esc_html__('Image Horizontal', 'zota'),
                                'img' => ZOTA_ASSETS_IMAGES . '/product_single/horizontal_thumbnail.jpg'
                            ),                                                                                  
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'zota'),
                                'img' => ZOTA_ASSETS_IMAGES . '/product_single/left_main_sidebar.jpg'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'zota'),
                                'img' => ZOTA_ASSETS_IMAGES . '/product_single/main_right_sidebar.jpg'
                            ),
                        ),
                        'default' => 'horizontal'
                    ),                   
                    array(
                        'id' => 'product_single_sidebar',
                        'type' => 'select',
                        'required' => array('product_single_layout','=',array('left-main','main-right')),
                        'title' => esc_html__('Single Product Sidebar', 'zota'),
                        'options' => $sidebars,
                        'default' => 'product-single'
                    ),
                )
            );


            // Product Page
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Single Product Advanced Options', 'zota'),
                'fields' => array(
                    array(
                        'id' => 'enable_total_sales',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Total Sales', 'zota'),
                        'default' => true
                    ),                     
                    array(
                        'id' => 'enable_buy_now',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Buy Now', 'zota'),
                        'default' => false
                    ),
                    array( 
                        'id' => 'redirect_buy_now',
                        'required' => array('enable_buy_now','=',true),
                        'type' => 'button_set',
                        'title' => esc_html__('Redirect to page after Buy Now', 'zota'),
                        'options' => array( 
                                'cart'          => 'Page Cart',
                                'checkout'      => 'Page CheckOut',
                        ),
                        'default' => 'cart'
                    ),
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),   
                   
                    array(
                        'id' => 'style_single_tabs_style',
                        'type' => 'button_set',
                        'title' => esc_html__('Tab Mode', 'zota'),
                        'options' => array(
                                'fulltext'          => 'Full Text',
                                'tabs'          => 'Tabs',
                                'accordion'        => 'Accordion',
                        ),
                        'default' => 'tabs'
                    ),
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),
                    array(
                        'id' => 'enable_size_guide',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Size Guide', 'zota'),
                        'default' => 1
                    ),
                    array(
                        'id'       => 'size_guide_title',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Size Guide Title', 'zota' ),
                        'required' => array('enable_size_guide','=', true),
                        'default'  => esc_html__( 'Size chart', 'zota' ),
                    ),    
                    array(
                        'id'       => 'size_guide_icon',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Size Guide Icon', 'zota' ),
                        'required' => array('enable_size_guide','=', true),
                        'desc'       => esc_html__( 'Enter icon name of fonts: ', 'zota' ) . '<a href="//fontawesome.com/v4.7.0/" target="_blank">Awesome</a> , <a href="//fonts.thembay.com/simple-line-icons//" target="_blank">simplelineicons</a>, <a href="//fonts.thembay.com/linearicons/" target="_blank">linearicons</a>',
                        'default'  => 'tb-icon tb-icon-angle-right',
                    ),                
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),       
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),    
                    array(
                        'id' => 'enable_sticky_menu_bar',
                        'type' => 'switch',
                        'title' => esc_html__('Sticky Menu Bar', 'zota'),
                        'subtitle' => esc_html__('Enable/disable Sticky Menu Bar', 'zota'),
                        'default' => false
                    ),
                    array(
                        'id' => 'enable_zoom_image',
                        'type' => 'switch',
                        'title' => esc_html__('Zoom inner image', 'zota'),
                        'subtitle' => esc_html__('Enable/disable Zoom inner Image', 'zota'),
                        'default' => false
                    ),    
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide', 
                        'type' => 'divide'
                    ),                 
                    array(
                        'id' => 'video_aspect_ratio',
                        'type' => 'select',
                        'title' => esc_html__('Featured Video Aspect Ratio', 'zota'),
                        'subtitle' => esc_html__('Choose the aspect ratio for your video', 'zota'),
                        'options' => $aspect_ratio,
                        'default' => '16_9'
                    ),     
                    array(
                        'id'      => 'video_position',
                        'title'    => esc_html__( 'Featured Video Position', 'zota' ),
                        'type'    => 'select',
                        'default' => 'last',
                        'options' => array(
                            'last' => esc_html__( 'The last product gallery', 'zota' ),
                            'first' => esc_html__( 'The first product gallery', 'zota' ),
                        ),
                    ),  
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),              
                    array(
                        'id' => 'enable_product_social_share',
                        'type' => 'switch',
                        'title' => esc_html__('Social Share', 'zota'),
                        'subtitle' => esc_html__('Enable/disable Social Share', 'zota'),
                        'default' => true
                    ),
                    array(
                        'id' => 'enable_product_review_tab',
                        'type' => 'switch',
                        'title' => esc_html__('Product Review Tab', 'zota'),
                        'subtitle' => esc_html__('Enable/disable Review Tab', 'zota'),
                        'default' => true
                    ),
                    array(
                        'id' => 'enable_product_releated',
                        'type' => 'switch',
                        'title' => esc_html__('Products Releated', 'zota'),
                        'subtitle' => esc_html__('Enable/disable Products Releated', 'zota'),
                        'default' => true
                    ),
                    array(
                        'id' => 'enable_product_upsells',
                        'type' => 'switch',
                        'title' => esc_html__('Products upsells', 'zota'),
                        'subtitle' => esc_html__('Enable/disable Products upsells', 'zota'),
                        'default' => true
                    ),                    
                    array(
                        'id' => 'enable_product_countdown',
                        'type' => 'switch',
                        'title' => esc_html__('Display Countdown time ', 'zota'),
                        'default' => true
                    ),
                    array(
                        'id' => 'number_product_thumbnail',
                        'type'  => 'slider',
                        'title' => esc_html__('Number Images Thumbnail to show', 'zota'),
                        'default' => 4,
                        'min'   => 2,
                        'step'  => 1,
                        'max'   => 8,
                    ),  
                    array(
                        'id' => 'number_product_releated',
                        'type' => 'slider',
                        'title' => esc_html__('Number of related products to show', 'zota'),
                        'default' => 8,
                        'min' => 1,
                        'step' => 1,
                        'max' => 20,
                    ),                    
                    array(
                        'id' => 'releated_product_columns',
                        'type' => 'select',
                        'title' => esc_html__('Releated Products Columns', 'zota'),
                        'options' => $columns,
                        'default' => 5
                    ),
                    array(
                        'id'       => 'html_before_add_to_cart_btn',
                        'type'     => 'textarea',
                        'title'    => esc_html__( 'HTML before Add To Cart button (Global)', 'zota' ),
                        'desc'     => esc_html__( 'Enter HTML and shortcodes that will show before Add to cart selections.', 'zota' ),
                    ),
                    array(
                        'id'       => 'html_after_add_to_cart_btn',
                        'type'     => 'textarea',
                        'title'    => esc_html__( 'HTML after Add To Cart button (Global)', 'zota' ),
                        'desc'     => esc_html__( 'Enter HTML and shortcodes that will show after Add to cart button.', 'zota' ),
                    ),
                )

            );
          
            // woocommerce Menu Account settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Other page', 'zota'),
                'fields' => array(
                    array(
                        'id' => 'show_woocommerce_password_strength',
                        'type' => 'switch',
                        'title' => esc_html__('Show Password Strength Meter', 'zota'),
                        'subtitle' => esc_html__('Enable or disable in page My Account', 'zota'),
                        'default' => true
                    ),  
                    array(
                        'id' => 'show_checkout_image',
                        'type' => 'switch',
                        'title' => esc_html__('Show Image Product', 'zota'),
                        'subtitle'  => esc_html__( 'Enable or disable "Image Product" in page Checkout', 'zota' ),
                        'default' => true
                    ),  
                    array(
                        'id' => 'show_checkout_optimized',
                        'type' => 'switch',
                        'title' => esc_html__('Checkout Optimized', 'zota'),
                        'subtitle'  => esc_html__('Remove "Header" and "Footer" in page Checkout', 'zota'),
                        'default' => true
                    ),
                    array(
                        'id' => 'checkout_logo',
                        'type' => 'media',
                        'required' => array('show_checkout_optimized','=', true),
                        'title' => esc_html__('Upload Logo in page Checkout', 'zota'),
                        'subtitle' => esc_html__('Image File (.png or .gif)', 'zota'),
                    ),
                    array(
                        'id'        => 'checkout_img_width',
                        'type'      => 'slider',
                        'required' => array('show_checkout_optimized','=', true),
                        'title'     => esc_html__('Logo maximum width (px)', 'zota'),
                        "default"   => 120,
                        "min"       => 50,
                        "step"      => 1,
                        "max"       => 600,
                    ),
                )
            );

            // woocommerce Multi-vendor settings
            $this->sections[] = $this->multi_vendor_sections( $columns );

            // Blog settings
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-border-color',
                'title' => esc_html__('Blog', 'zota'),
                'fields' => array(
                    array(
                        'id' => 'show_blog_breadcrumb',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumb', 'zota'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'blog_breadcrumb_layout',
                        'type' => 'image_select',
                        'class'     => 'image-two',
                        'compiler' => true,
                        'title' => esc_html__('Select Breadcrumb Blog Layout', 'zota'),
                        'subtitle' => esc_html__('Only works on blog archiver', 'zota'),
                        'required' => array('show_blog_breadcrumb','=',1),
                        'options' => array(                        
                            'image' => array(
                                'title' => esc_html__( 'Background Image', 'zota' ),
                                'img'   => ZOTA_ASSETS_IMAGES . '/breadcrumbs/image.jpg'
                            ),
                            'color' => array(
                                'title' => esc_html__( 'Background color', 'zota' ),
                                'img'   => ZOTA_ASSETS_IMAGES . '/breadcrumbs/color.jpg'
                            ),
                            'text'=> array(
                                'title' => esc_html__( 'Text Only', 'zota' ),
                                'img'   => ZOTA_ASSETS_IMAGES . '/breadcrumbs/text_only.jpg'
                            ),
                        ),
                        'default' => 'color'
                    ),
                    array (
                        'title' => esc_html__('Breadcrumb Background Color', 'zota'),
                        'id' => 'blog_breadcrumb_color',
                        'type' => 'color',
                        'default' => '#fafafa',
                        'transparent' => false,
                        'required' => array('blog_breadcrumb_layout','=',array('default','color')),
                    ),
                    array(
                        'id' => 'blog_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumb Background Image', 'zota'),
                        'subtitle' => esc_html__('Image File (.png or .jpg)', 'zota'),
                        'default'  => array(
                            'url'=> ZOTA_IMAGES .'/breadcrumbs-blog.jpg'
                        ),
                        'required' => array('blog_breadcrumb_layout','=','image'),
                    ),
                    array(
                        'id' => 'enable_previous_page_post',
                        'type' => 'switch',
                        'title' => esc_html__('Previous page', 'zota'),
                        'required' => array('show_blog_breadcrumb','=',1),
                        'subtitle' => esc_html__('Enable Previous Page Button', 'zota'),
                        'default' => true
                    ), 
                )
            );

            // Archive Blogs settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Blog Article', 'zota'),
                'fields' => array(
                    array(
                        'id' => 'blog_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Blog Layout', 'zota'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__( 'Articles', 'zota' ),
                                'img' => ZOTA_ASSETS_IMAGES . '/blog_archives/blog_no_sidebar.jpg'
                            ),
                            'left-main' => array(
                                'title' => esc_html__( 'Articles - Left Sidebar', 'zota' ),
                                'img' => ZOTA_ASSETS_IMAGES . '/blog_archives/blog_left_sidebar.jpg'
                            ),
                            'main-right' => array(
                                'title' => esc_html__( 'Articles - Right Sidebar', 'zota' ),
                                'img' => ZOTA_ASSETS_IMAGES . '/blog_archives/blog_right_sidebar.jpg'
                            ),                   
                        ),
                        'default' => 'main-right'
                    ),
                    array(
                        'id' => 'blog_archive_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Blog Archive Sidebar', 'zota'),
                        'options' => $sidebars,
                        'default' => 'blog-archive-sidebar',
                        'required' => array('blog_archive_layout','!=','main'),
                    ),
                    array(
                        'id' => 'blog_columns',
                        'type' => 'select',
                        'title' => esc_html__('Post Column', 'zota'),
                        'options' => $columns,
                        'default' => '2'
                    ),
                    array(
                        'id'   => 'opt-divide',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),   
                    array(
                        'id' => 'layout_blog',
                        'type' => 'select',
                        'title' => esc_html__('Layout Blog', 'zota'),
                        'options' => array(
                            'post-style-1' =>  esc_html__( 'Post Style 1', 'zota' ),
                            'post-style-2' =>  esc_html__( 'Post Style 2', 'zota' ),
                        ),
                        'default' => 'post-style-1'
                    ),                 
                    array(
                        'id' => 'blog_image_sizes',
                        'type' => 'select',
                        'title' => esc_html__('Post Image Size', 'zota'),
                        'options' => $blog_image_size,
                        'default' => 'full'
                    ),                 
                    array(
                        'id' => 'enable_date',
                        'type' => 'switch',
                        'title' => esc_html__('Date', 'zota'),
                        'default' => true
                    ),                    
                    array(
                        'id' => 'enable_author',
                        'type' => 'switch',
                        'title' => esc_html__('Author', 'zota'),
                        'default' => false
                    ),                        
                    array(
                        'id' => 'enable_categories',
                        'type' => 'switch',
                        'title' => esc_html__('Categories', 'zota'),
                        'default' => true
                    ),                                            
                    array(
                        'id' => 'enable_comment',
                        'type' => 'switch',
                        'title' => esc_html__('Comment', 'zota'),
                        'default' => true
                    ),                    
                    array(
                        'id' => 'enable_comment_text',
                        'type' => 'switch',
                        'title' => esc_html__('Comment Text', 'zota'),
                        'required' => array('enable_comment', '=', true),
                        'default' => false
                    ),                    
                    array(
                        'id' => 'enable_short_descriptions',
                        'type' => 'switch',
                        'title' => esc_html__('Short descriptions', 'zota'),
                        'default' => false
                    ),                    
                    array(
                        'id' => 'enable_readmore',
                        'type' => 'switch',
                        'title' => esc_html__('Read More', 'zota'),
                        'default' => false
                    ),
                    array(
                        'id' => 'text_readmore',
                        'type' => 'text',
                        'title' => esc_html__('Button "Read more" Custom Text', 'zota'),
                        'required' => array('enable_readmore', '=', true),
                        'default' => 'Read More',
                    ),
                )
            );

            // Single Blogs settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Single Blog', 'zota'),
                'fields' => array(
                    
                    array(
                        'id' => 'blog_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Blog Single Layout', 'zota'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__( 'Main Only', 'zota' ),
                                'img' => ZOTA_ASSETS_IMAGES . '/single _post/main.jpg'
                            ),
                            'left-main' => array(
                                'title' => esc_html__( 'Left - Main Sidebar', 'zota' ),
                                'img' => ZOTA_ASSETS_IMAGES . '/single _post/left_sidebar.jpg'
                            ),
                            'main-right' => array(
                                'title' => esc_html__( 'Main - Right Sidebar', 'zota' ),
                                'img' => ZOTA_ASSETS_IMAGES . '/single _post/right_sidebar.jpg'
                            ),
                        ),
                        'default' => 'main-right'
                    ),
                    array(
                        'id' => 'blog_single_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Blog Sidebar', 'zota'),
                        'options'   => $sidebars,
                        'default'   => 'blog-single-sidebar',
                        'required' => array('blog_single_layout','!=','main'),
                    ),
                    array(
                        'id' => 'show_blog_social_share',
                        'type' => 'switch',
                        'title' => esc_html__('Show Social Share', 'zota'),
                        'default' => 1
                    ),
                )
            );
            // Page 404 settings
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-search-replace',
                'title' => esc_html__('Page 404', 'zota'),
                'fields' => array(
                    array(
                        'id'       => 'img_404',
                        'type' => 'media',
                        'title' => esc_html__('Upload Image 404', 'zota'),
                        'subtitle' => esc_html__('Image File (.png or .gif)', 'zota'),
                    ),
                )
            );
            // Social Media
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-share',
                'title' => esc_html__('Social Share', 'zota'),
                'fields' => array(
                    array(
                        'id' => 'enable_code_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Code Share', 'zota'),
                        'default' => true
                    ),
                    array(
                        'id'       => 'select_share_type',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Please select a sharing type', 'zota' ),
                        'required'  => array('enable_code_share','=', true),
                        'options'  => array(
                            'custom' => 'TB Share',
                            'addthis' => 'Add This',
                        ),
                        'default'  => 'addthis'
                    ),
                    array(
                        'id'        =>'code_share',
                        'type'      => 'textarea',
                        'required'  => array('select_share_type','=', 'addthis'),
                        'title'     => esc_html__('"Addthis" Your Code', 'zota'), 
                        'desc'      => esc_html__('You get your code share in https://www.addthis.com', 'zota'),
                        'validate'  => 'html_custom',
                        'default'   => '<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59f2a47d2f1aaba2"></script>'
                    ),
                    array(
                        'id'       => 'sortable_sharing',
                        'type'     => 'sortable',
                        'mode'     => 'checkbox',
                        'title'    => esc_html__( 'Sortable Sharing', 'zota' ),
                        'required'  => array('select_share_type','=', 'custom'),
                        'options'  => array(
                            'facebook'      => 'Facebook',
                            'twitter'       => 'Twitter',
                            'linkedin'      => 'Linkedin',
                            'pinterest'     => 'Pinterest',
                            'whatsapp'      => 'Whatsapp',
                            'email'         => 'Email',
                        ),
                        'default'   => array(
                            'facebook'  => true,
                            'twitter'   => true,
                            'linkedin'  => true,
                            'pinterest' => false,
                            'whatsapp'  => false,
                            'email'     => true,
                        )
                    ),
                )
            );

            // Performance
            $this->sections[] = array(
                'icon' => 'el-icon-cog',
                'title' => esc_html__('Performance', 'zota'),
            );  

            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Performance', 'zota'),
                'fields' => array(
                    array (
                        'id'       => 'minified_js',
                        'type'     => 'switch',
                        'title'    => esc_html__('Include minified JS', 'zota'),
                        'subtitle' => esc_html__('Minified version of functions.js and device.js file will be loaded', 'zota'),
                        'default' => true
                    ),
                )
            );


            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Preloader', 'zota'),
                'fields' => array(
                    array(
                        'id'        => 'preload',
                        'type'      => 'switch',
                        'title'     => esc_html__('Preload Website', 'zota'),
                        'default'   => false
                    ),
                    array(
                        'id' => 'select_preloader',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Select Preloader', 'zota'),
                        'subtitle' => esc_html__('Choose a Preloader for your website.', 'zota'),
                        'required'  => array('preload','=',true),
                        'options' => array(
                            'loader1' => array(
                                'title' => esc_html__( 'Loader 1', 'zota' ),
                                'img'   => ZOTA_ASSETS_IMAGES . '/preloader/loader1.png'
                            ),         
                            'loader2' => array(
                                'title' => esc_html__( 'Loader 2', 'zota' ),
                                'img'   => ZOTA_ASSETS_IMAGES . '/preloader/loader2.png'
                            ),              
                            'loader3' => array(
                                'title' => esc_html__( 'Loader 3', 'zota' ),
                                'img'   => ZOTA_ASSETS_IMAGES . '/preloader/loader3.png'
                            ),         
                            'loader4' => array(
                                'title' => esc_html__( 'Loader 4', 'zota' ),
                                'img'   => ZOTA_ASSETS_IMAGES . '/preloader/loader4.png'
                            ),          
                            'loader5' => array(
                                'title' => esc_html__( 'Loader 5', 'zota' ),
                                'img'   => ZOTA_ASSETS_IMAGES . '/preloader/loader5.png'
                            ),         
                            'loader6' => array(
                                'title' => esc_html__( 'Loader 6', 'zota' ),
                                'img'   => ZOTA_ASSETS_IMAGES . '/preloader/loader6.png'
                            ),                        
                            'custom_image' => array(
                                'title' => esc_html__( 'Custom image', 'zota' ),
                                'img'   => ZOTA_ASSETS_IMAGES . '/preloader/custom_image.png'
                            ),         
                        ),
                        'default' => 'loader1'
                    ),
                    array(
                        'id' => 'media-preloader',
                        'type' => 'media',
                        'required' => array('select_preloader','=', 'custom_image'),
                        'title' => esc_html__('Upload preloader image', 'zota'),
                        'subtitle' => esc_html__('Image File (.gif)', 'zota'),
                        'desc' =>   sprintf( wp_kses( __('You can download some the Gif images <a target="_blank" href="%1$s">here</a>.', 'zota' ),  array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), 'https://loading.io/' ), 
                    ),
                )
            );            

            // Custom Code
            $this->sections[] = array(
                'icon' => 'zmdi zmdi-code-setting',
                'title' => esc_html__('Custom CSS/JS', 'zota'),
            );            

            // Css Custom Code
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Custom CSS', 'zota'),
                'fields' => array(
                    array (
                        'title' => esc_html__('Global Custom CSS', 'zota'),
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                    ),
                    array (
                        'title' => esc_html__('Custom CSS for desktop', 'zota'),
                        'id' => 'css_desktop',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                    ),
                    array (
                        'title' => esc_html__('Custom CSS for tablet', 'zota'),
                        'id' => 'css_tablet',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                    ),
                    array (
                        'title' => esc_html__('Custom CSS for mobile landscape', 'zota'),
                        'id' => 'css_wide_mobile',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                    ),
                    array (
                        'title' => esc_html__('Custom CSS for mobile', 'zota'),
                        'id' => 'css_mobile',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                    ),
                )
            );

            // Js Custom Code
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Custom Js', 'zota'),
                'fields' => array(
                    array (
                        'title' => esc_html__('Header JavaScript Code', 'zota'),
                        'subtitle' => '<em>'.esc_html__('Paste your custom JS code here. The code will be added to the header of your site.', 'zota').'<em>',
                        'id' => 'header_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                    ),
                    
                    array (
                        'title' => esc_html__('Footer JavaScript Code', 'zota'),
                        'subtitle' => '<em>'.esc_html__('Here is the place to paste your Google Analytics code or any other JS code you might want to add to be loaded in the footer of your website.', 'zota').'<em>',
                        'id' => 'footer_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                    ),
                )
            );



            $this->sections[] = array(
                'title' => esc_html__('Import / Export', 'zota'),
                'desc' => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'zota'),
                'icon' => 'zmdi zmdi-download',
                'fields' => array(
                    array(
                        'id' => 'opt-import-export',
                        'type' => 'import_export',
                        'title' => 'Import Export',
                        'subtitle' => 'Save and restore your Redux options',
                        'full_width' => false,
                    ),
                ),
            );

            $this->sections[] = array(
                'type' => 'divide',
            );
        }

        public function multi_vendor_fields( $columns ) {
            $wcmp_array = $fields_dokan = array();

            if( class_exists('WCMp') ) {
                $wcmp_array = array(
                    'id'        => 'show_vendor_name_wcmp',
                    'type'      => 'info',
                    'title'     => esc_html__('Enable Vendor Name Only WCMP Vendor', 'zota'),
                    'subtitle'  => sprintf(__('Go to the <a href="%s" target="_blank">Setting</a> Enable "Sold by" for WCMP Vendor', 'zota'), admin_url('admin.php?page=wcmp-setting-admin')),
                );
            }

            $fields = array(
                array(
                    'id' => 'show_vendor_name',
                    'type' => 'switch',
                    'title' => esc_html__('Enable Vendor Name', 'zota'),
                    'subtitle' => esc_html__('Enable/Disable Vendor Name on HomePage and Shop page only works for Dokan, WCMP Vendor', 'zota'),
                    'default' => true
                ),  
                $wcmp_array
            );


            if( class_exists('WeDevs_Dokan') ) {
                $fields_dokan = array(
                    array(
                        'id'   => 'divide_vendor_1',
                        'class' => 'big-divide',
                        'type' => 'divide'
                    ),
                    array(
                        'id' => 'show_info_vendor_tab',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Tab Info Vendor Dokan', 'zota'),
                        'subtitle' => esc_html__('Enable/Disable tab Info Vendor on Product Detail Dokan', 'zota'),
                        'default' => true
                    ), 
                    array(
                        'id'        => 'show_seller_tab',
                        'type'      => 'info',
                        'title'     => esc_html__('Enable/Disable Tab Products Seller', 'zota'),
                        'subtitle'  => sprintf(__('Go to the <a href="%s" target="_blank">Setting</a> of each Seller to Enable/Disable this tab of Dokan Vendor.', 'zota'), home_url('dashboard/settings/store/')),
                    ),
                    array(
                        'id' => 'seller_tab_per_page',
                        'type' => 'slider',
                        'title' => esc_html__('Dokan Number of Products Seller Tab', 'zota'),
                        'default' => 4,
                        'min' => 1,
                        'step' => 1,
                        'max' => 10,
                    ),
                    array(
                        'id' => 'seller_tab_columns',
                        'type' => 'select',
                        'title' => esc_html__('Dokan Product Columns Seller Tab', 'zota'),
                        'options' => $columns,
                        'default' => 4
                    ),
                );
            }
            

            $fields = array_merge( $fields, $fields_dokan );

            return $fields;
        }

        public function multi_vendor_sections( $columns ) {
            if( !zota_woo_is_active_vendor() ) return;

            
            $output_array = array(
                'subsection' => true,
                'title' => esc_html__('Multi-vendor', 'zota'),
                'fields' => $this->multi_vendor_fields( $columns )
            );
            
            
            return $output_array;
        }
		
		
		
		
        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
		 
		 /**
     * Custom function for the callback validation referenced above
     * */
		
		 
        public function setArguments()
        {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'zota_tbay_theme_options',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'),
                // Name that appears at the top of your panel
                'display_version' => esc_html__('Version ', 'zota').$theme->get('Version'),
                'ajax_save'     => true,
                // Version that appears at the top of your panel
                'menu_type' => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true,
                // Show the sections below the admin menu item or not
                'menu_title' => esc_html__('Zota Options', 'zota'),
                'page_title' => esc_html__('Zota Options', 'zota'),

                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly' => false,
                // Must be defined to add google fonts to the typography module
                'async_typography' => false,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar' => true,
                // Show the panel pages on the admin bar
                'admin_bar_icon' => 'dashicons-portfolio',
                // Choose an icon for the admin bar menu
                'admin_bar_priority' => 50,
                // Choose an priority for the admin bar menu
                'global_variable' => 'zota_options',
                // Set a different name for your global variable other than the opt_name
                'dev_mode' => false,
				'forced_dev_mode_off' => false,
                // Show the time the page took to load, etc
                'update_notice' => true,
                // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                'customizer' => true,
                // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority' => 61,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options',
                // Specify a custom URL to an icon
                'last_tab' => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options',
                // Page slug used to denote the panel
                'save_defaults' => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show' => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info' => false,
                // REMOVE

                // HINTS
                'hints' => array(
                    'icon' => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color' => 'lightgray',
                    'icon_size' => 'normal',
                    'tip_style' => array(
                        'color' => 'light',
                        'shadow' => true,
                        'rounded' => false,
                        'style' => '',
                    ),
                    'tip_position' => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'mouseover',
                        ),
                        'hide' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'click mouseleave',
                        ),
                    ),
                )
            );
            
            $this->args['intro_text'] = '';

            // Add content after the form.
            $this->args['footer_text'] = '';
            return $this->args;
			
			if ( ! function_exists( 'redux_validate_callback_function' ) ) {
				function redux_validate_callback_function( $field, $value, $existing_value ) {
					$error   = false;
					$warning = false;

					//do your validation
					if ( $value == 1 ) {
						$error = true;
						$value = $existing_value;
					} elseif ( $value == 2 ) {
						$warning = true;
						$value   = $existing_value;
					}

					$return['value'] = $value;

					if ( $error == true ) {
						$field['msg']    = 'your custom error message';
						$return['error'] = $field;
					}

					if ( $warning == true ) {
						$field['msg']      = 'your custom warning message';
						$return['warning'] = $field;
					}

					return $return;
				}
			}
			
        }
    }

    global $reduxConfig;
    $reduxConfig = new Zota_Redux_Framework_Config();
	
}