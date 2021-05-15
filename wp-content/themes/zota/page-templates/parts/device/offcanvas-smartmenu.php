<?php 
    $location = 'mobile-menu';
    $tbay_location  = '';
    if ( has_nav_menu( $location ) ) { 
        $tbay_location = $location;
    }

    
    $mmenu_langue           = zota_tbay_get_config('enable_mmenu_langue', false); 
    $mmenu_currency         = zota_tbay_get_config('enable_mmenu_currency', false); 

    $menu_mobile_select    =  zota_tbay_get_config('menu_mobile_select');

?>
  
<div id="tbay-mobile-smartmenu" data-title="<?php esc_attr_e('Menu', 'zota'); ?>" class="tbay-mmenu d-xl-none"> 


    <div class="tbay-offcanvas-body">
        
        <div id="mmenu-close">
            <button type="button" class="btn btn-toggle-canvas" data-toggle="offcanvas">
                <i class="tb-icon tb-icon-close-01"></i>
            </button>
        </div>

        <nav id="tbay-mobile-menu-navbar" class="navbar navbar-offcanvas navbar-static">
            <?php

                $args = array(
                    'fallback_cb' => '',
                );

                if( empty($menu_mobile_select) ) {
                    $args['theme_location']     = $tbay_location;
                } else {
                    $args['menu']               = $menu_mobile_select;
                }

                $args['container_id']       =   'main-mobile-menu-mmenu';
                $args['menu_id']            =   'main-mobile-menu-mmenu-wrapper';
                $args['walker']             =   new Zota_Tbay_mmenu_menu();

                wp_nav_menu($args);


            ?>
        </nav>


    </div>
    <?php if($mmenu_langue || $mmenu_currency ) {
        ?>
         <div id="mm-tbay-bottom">  
    
            <div class="mm-bottom-track-wrapper">

                <?php 
                    ?>
                    <div class="mm-bottom-langue-currency ">
                        <?php if( $mmenu_langue ): ?>
                            <div class="mm-bottom-langue">
                                <?php do_action('zota_tbay_header_custom_language'); ?>
                            </div>
                        <?php endif; ?>
                
                        <?php if( $mmenu_currency && class_exists('WooCommerce') && class_exists( 'WOOCS' ) ): ?>
                            <div class="mm-bottom-currency">
                                <div class="tbay-currency">
                                <?php echo do_shortcode( '[woocs txt_type = "desc"]' ); ?> 
                                </div>
                            </div>
                        <?php endif; ?>
                        
                    </div>
                    <?php
                ?>
            </div>


        </div>
        <?php
    }
    ?>
   
</div>