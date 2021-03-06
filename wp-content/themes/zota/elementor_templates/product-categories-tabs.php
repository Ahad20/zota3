<?php 
/**
 * Templates Name: Elementor
 * Widget: Product Categories Tabs
 */

extract( $settings );

$this->settings_layout();
$navigation = apply_filters('zota_navigation', 'style-nav-2');
$this->add_render_attribute('wrapper', 'class', $navigation); 

$random_id = zota_tbay_random_key();
?>

<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>
    <div class="wrapper-heading-tab">
        <?php
            $this->render_element_heading(); 
            $this->render_tabs_title($categories_tabs, $random_id);
        ?>
    </div>
    <?php 
        $this->render_product_tabs_content($categories_tabs, $random_id);
        $this->render_item_button();
    ?>
</div>