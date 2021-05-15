<?php

if ( ! defined( 'ABSPATH' ) || function_exists('Zota_Elementor_Product_Flash_Sales') ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Image_Size;

 
class Zota_Elementor_Product_Flash_Sales extends Zota_Elementor_Carousel_Base {

    public function get_name() {
        return 'tbay-product-flash-sales';
    }

    public function get_title() {
        return esc_html__( 'Zota Product Flash Sales', 'zota' );
    }

    public function get_categories() {
        return [ 'zota-elements', 'woocommerce-elements'];
    }

    public function get_icon() {
        return 'eicon-flash';
    }

    /**
     * Retrieve the list of scripts the image carousel widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends()
    {
        return ['slick', 'zota-custom-slick', 'jquery-countdowntimer'];
    }

    public function get_keywords() {
        return [ 'woocommerce-elements', 'product', 'products', 'Flash Sales', 'Flash' ];
    }

    protected function register_controls() {
        $this->register_controls_heading(['position_displayed' => 'main']);
        $this->register_section_styles_heading_wrapper(['position_displayed' => 'main']);
        $this->remove_control('align');
        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'zota' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'position_displayed',
            [
                'label'     => esc_html__('Position Displayed', 'zota'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'main',
                'options'   => [
                    'header'      => esc_html__('Header', 'zota'), 
                    'main'  => esc_html__('Main Content', 'zota'), 
                ],
            ]
        ); 

        $this->register_control_header();
        $this->register_control_main();
        
        $this->end_controls_section(); 
        
        $this->register_style_times_main();
        $this->register_style_content_product();

        $this->add_control_responsive(['position_displayed' => 'main']);

        $this->add_control_carousel(['layout_type' => 'carousel']);
    }

    private function register_control_header() {
        $prefix = 'header_';
        $this->add_control(
            $prefix .'advanced',
            [
                'label' => esc_html__('Header', 'zota'),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'position_displayed' => 'header'
                ],
            ]
        );

        $this->add_control(
            $prefix .'display_type',
            [
                'label' => esc_html__('Display type', 'zota'),
                'type' => Controls_Manager::SELECT,
                'default' => 'text',
                'label_block' => true,
                'condition' => [
                    'position_displayed' => 'header'
                ],
                'options' => [
                    'text' => esc_html__('Text', 'zota'),
                    'image' => esc_html__('Image', 'zota')
                ]
            ]
        );  

        $this->add_control(
            $prefix .'icon',
            [
                'label'     => esc_html__('Icon', 'zota'),
                'type'      => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'tb-icon tb-icon-history',
					'library' => 'tbay-custom',
                ],
                'conditions' => [
					'relation' => 'AND',
					'terms' => [
						[
							'name' => $prefix .'display_type',
							'operator' => '===',
							'value' => 'text',
						],
						[
							'name' => 'position_displayed',
							'operator' => '===',
							'value' => 'header',
						],
					],
				],
            ]
        );  

        $this->add_control(
            $prefix .'text',
            [
                'label'     => esc_html__('Text', 'zota'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('Flash Sale', 'zota'),
                'conditions' => [
					'relation' => 'AND',
					'terms' => [
						[
							'name' => $prefix .'display_type',
							'operator' => '===',
							'value' => 'text',
						],
						[
							'name' => 'position_displayed',
							'operator' => '===',
							'value' => 'header',
						],
					],
				],
            ]
        );  

        $this->add_control(
            $prefix .'image',
            [
                'label'     => esc_html__('Image', 'zota'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'conditions' => [
					'relation' => 'AND',
					'terms' => [
						[
							'name' => $prefix .'display_type',
							'operator' => '===',
							'value' => 'image',
						],
						[
							'name' => 'position_displayed',
							'operator' => '===',
							'value' => 'header',
						],
					],
				],
            ]
        );  

        $pages = $this->get_available_pages();

        if (!empty($pages)) {
            $this->add_control(
                $prefix .'page',
                [
                    'label'        => esc_html__('Select Page', 'zota'),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $pages,
                    'default'      => array_keys($pages)[0],
                    'save_default' => true,
                    'separator'    => 'after',
                    'condition' => [
                        'position_displayed' => 'header'
                    ],
                ]
            );
        } else {
            $this->add_control(
                $prefix .'page',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf(__('<strong>There are no pages in your site.</strong><br>Go to the <a href="%s" target="_blank">pages screen</a> to create one.', 'zota'), admin_url('edit.php?post_type=page')),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                    'condition' => [
                        'position_displayed' => 'header'
                    ],
                ]
            );
        }

    }
    private function register_section_styles_heading_wrapper($condition) {
        $this->start_controls_section(
            'section_style_heading_wrapper',
            [
                'label' => esc_html__( 'Heading Wrapper', 'zota' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => $condition,
            ]
        );

        $this->add_responsive_control(
            'heading_wrapper_style_margin',
            [
                'label' => esc_html__( 'Margin', 'zota' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ], 
                'selectors' => [
                    '{{WRAPPER}} .top-flash-sale-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );        

        $this->add_responsive_control(
            'heading_wrapper_style_padding',
            [
                'label' => esc_html__( 'Padding', 'zota' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ], 
                'selectors' => [
                    '{{WRAPPER}} .top-flash-sale-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_control(
            'heading_wrapper_style_bg',
            [
                'label' => esc_html__( 'Background', 'zota' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .top-flash-sale-wrapper' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_control_main() {
        $prefix = 'main_';
        $this->add_control(
            $prefix .'advanced',
            [
                'label' => esc_html__('Main', 'zota'),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'position_displayed' => 'main'
                ],
            ]
        );

        $this->add_control(
            'date_title',
            [
                'label' => esc_html__('Title Date', 'zota'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Remaining', 'zota'),
                'label_block' => true,
                'condition' => [
                    'position_displayed' => 'main'
                ],
            ]
        );  

        $this->add_control(
            'date_title_ended',
            [
                'label' => esc_html__('Title deal ended', 'zota'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Deal ended.', 'zota'),
                'label_block' => true,
                'condition' => [
                    'position_displayed' => 'main'
                ],
            ]
        );  


        $this->add_control(
            'end_date',
            [
                'label' => esc_html__('End Date', 'zota'),
                'type' => Controls_Manager::DATE_TIME,
                'label_block' => true,
                'placeholder' => esc_html__( 'Choose the end time', 'zota' ),
                'condition' => [
                    'position_displayed' => 'main'
                ],
            ]
        );  

        $this->add_control(
            'bg_top_flash_sale',
            [
                'label' => esc_html__('Background Top Flash Sale', 'zota'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .top-flash-sale-wrapper' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'position_displayed' => 'main'
                ]
            ]
        );  

        $this->add_control(
            'layout_type',
            [
                'label'     => esc_html__('Layout Type', 'zota'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'grid',
                'options'   => [
                    'grid'      => esc_html__('Grid', 'zota'), 
                    'carousel'  => esc_html__('Carousel', 'zota'), 
                ],
                'condition' => [
                    'position_displayed' => 'main'
                ],
            ]
        ); 

        $this->add_control(
            'heading_type',
            [
                'label'     => esc_html__('Heading Type', 'zota'), 
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'normal',
                'options'   => [
                    'normal'      => esc_html__('Normal', 'zota'), 
                    'center'  => esc_html__('Center', 'zota'), 
                ],
                'prefix_class' => 'heading-type-',
                'condition' => [
                    'position_displayed' => 'main'
                ],
            ]
        ); 

        $this->add_control(
            'product_style',
            [
                'label' => esc_html__('Product Style', 'zota'),
                'type' => Controls_Manager::SELECT,
                'default' => 'inner',
                'options' => $this->get_template_product(),
                'prefix_class' => 'elementor-product-',
                'condition' => [
                    'position_displayed' => 'main'
                ],
            ]
        );

        $this->add_control(
            'heading_product_image',
            [
                'label' => esc_html__('Product Image', 'zota'),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'position_displayed' => 'main'
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'product_image',
                'exclude' => [ 'custom' ],
                'default' => 'woocommerce_thumbnail', 
                'condition' => [
                    'position_displayed' => 'main'
                ],
            ]
        );  

        $products = $this->get_available_on_sale_products();
        
        if (!empty($products)) {
            $repeater = $this->register_products_sale_repeater();
            $this->add_control(
                $prefix .'product_sale',
                [
                    'label' => esc_html__( 'Select products', 'zota' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'trending_field' => '{{{ product_sale_item }}}',
                    'condition' => [
                        'position_displayed' => 'main'
                    ],
                ]
            );  
        } else {
            $this->add_control(
                $prefix .'html_products',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf(__('You do not have any discount products. <br>Go to the <strong><a href="%s" target="_blank">Products screen</a></strong> to create one.', 'zota'), admin_url('edit.php?post_type=product')),
                    'separator'       => 'before',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                    'condition' => [
                        'position_displayed' => 'main'
                    ],
                ]
            );
        }

        $this->add_control(
            'enable_readmore',
            [
                'label' => esc_html__( 'Enable Button "Read More" ', 'zota' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'position_displayed' => 'main'
                ],
            ]
        );
        $this->add_control(
            'readmore_text',
            [
                'label' => esc_html__('Button "Read More" Custom Text', 'zota'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'zota'),
                'label_block' => true,
            ]
        );  

        $pages = $this->get_available_pages();

        if (!empty($pages)) {
            $this->add_control(
                'readmore_page',
                [
                    'label'        => esc_html__('Page', 'zota'),
                    'type'         => Controls_Manager::SELECT2,
                    'options'      => $pages,
                    'default'      => array_keys($pages)[0],
                    'label_block' => true,
                    'save_default' => true,
                    'separator'    => 'after',
                ]
            );
        } else {
            $this->add_control(
                'readmore_page',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf(__('<strong>There are no pages in your site.</strong><br>Go to the <a href="%s" target="_blank">pages screen</a> to create one.', 'zota'), admin_url('edit.php?post_type=page')),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

    }
    private function register_products_sale_repeater() {
        $products = $this->get_available_on_sale_products();
        $repeater = new \Elementor\Repeater(); 
        $repeater->add_control (
            'product_sale_item', 
            [
                'label' => esc_html__( 'Product', 'zota' ),
                'type'         => Controls_Manager::SELECT,
                    'options'      => $products,
                    'default'      => array_keys($products)[0],
                    'multiple' => true,
                    'label_block' => true,
                    'save_default' => true,
                    'description' => esc_html( 'Only search for sale products', 'zota' ),
            ]
        );

        return $repeater;
    }

    private function register_style_times_main() {
        $this->start_controls_section(
            'section_style_times_main',
            [
                'label' => esc_html__('Style Times', 'zota'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'position_displayed' => 'main'
                ]
            ]
        );

        $this->add_control(
            'color_times',
			[
                'label'     => esc_html__('Color', 'zota'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .flash-sales-date .times' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'times_typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
                'selector' => '{{WRAPPER}} .flash-sales-date .times',
            ]
        );
        

        $this->end_controls_section();
    }

    private function register_style_content_product() {
        $active_theme           = zota_tbay_get_theme();

        if( $active_theme !== 'fashion' ) return;

        $this->start_controls_section(
            'section_style_content_product',
            [
                'label' => esc_html__('Content Products', 'zota'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'position_displayed' => 'main'
                ]
            ]
        );

        $this->add_responsive_control(
            'style_content_product_align',
            [
                'label' => esc_html__('Alignment', 'zota'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('left', 'zota'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('center', 'zota'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('right', 'zota'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-flash-sales .caption,{{WRAPPER}} .product-flash-sales .stock-flash-sale' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }


    public function render_content_header() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        if( $position_displayed !== 'header' ) return;

        if( !empty($header_page) ) {
            $link = get_permalink($header_page);
        }


        if( $header_display_type === 'text' ) {
            $this->render_content_header_text($link);
        } else {
            $this->render_content_header_image($link);
        }

    }

    protected function render_btn_readmore() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        if( !empty($readmore_page) ) {
            $link = get_permalink($readmore_page);
        }

        if( $enable_readmore && !empty($link) ) : ?>
            <a class="show-all" href="<?php echo esc_url($link); ?>" title="<?php esc_attr( $readmore_text ); ?>"><?php echo trim($readmore_text); ?></a>
        <?php endif;
    }

    private function render_content_header_text($link) {
        $settings = $this->get_settings_for_display();
        extract($settings);

        if( !empty($header_icon['value']) ) {
            echo '<a class="flash-sale" href="'. esc_url($link) .'" title="'. esc_attr( $header_text ) .'"><i class="'. esc_attr($header_icon['value']) .'"></i>'. trim($header_text) .'</a>';
        } else {
            echo '<a class="flash-sale" href="'. esc_url($link) .'" title="'. esc_attr( $header_text ) .'">'. trim($header_text) .'</a>';
        }
    }

    private function render_content_header_image($link) {
        $settings = $this->get_settings_for_display();
        extract($settings);
        
        $image_id           = $header_image['id'];

        echo '<a class="flash-sale" href="'. esc_url($link) .'">'. wp_get_attachment_image($image_id, 'full') .'</a>'; 
    }

    public function render_content_main() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        if( $position_displayed !== 'main' ) return;


        $ids = $this->get_id_products_flash_sale( $main_product_sale ); 


        if( !is_array($ids) ){
            $atts['ids'] = $ids;
        } else {
            if( count($ids) === 0 ) {
                echo '<div class="not-product-flash-sales">'. esc_html__('Please select the show product', 'zota')  .'</div>';
                return;
            }

            $atts['ids'] = implode(',', $ids);
        }

        $atts['orderby'] = 'post__in';

        $type = 'products';

        $shortcode = new WC_Shortcode_Products($atts, $type);
        $args = $shortcode->get_query_args();

        $loop = new WP_Query($args); 

        $end_date     = strtotime($end_date);
        if( !$loop->have_posts() ) return;

        $this->add_render_attribute('row', 'class', ['products']);

        $attr_row = $this->get_render_attribute_string('row');
        
        wc_get_template( 'layout-products/layout-products.php' , array( 'loop' => $loop, 'product_style' => $product_style, 'flash_sales' => true, 'end_date' => $end_date, 'attr_row' => $attr_row, 'size_image' => $product_image_size) );
        
        if( zota_tbay_get_theme() !== 'electronics' ) {
            $this->render_btn_readmore();
        }
    }
    public function deal_end_class() {
        $settings = $this->get_settings_for_display();
        extract($settings);


        $class_deal_ended   = '';
        $end_date           = strtotime($end_date);
        $today              = strtotime("today");
        if ( !empty($end_date) &&  ($today > $end_date) ) {
            $class_deal_ended = 'deal-ended';
        }

        return $class_deal_ended;
    }

    protected function get_id_products_flash_sale($main_product_sale) {

        $product_ids = array();

        foreach ($main_product_sale as $item ) :

            extract($item);
            array_push($product_ids, $product_sale_item);

        endforeach;

        return $product_ids;
    }

}
$widgets_manager->register_widget_type(new Zota_Elementor_Product_Flash_Sales());