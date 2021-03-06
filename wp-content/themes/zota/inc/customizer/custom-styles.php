<?php

if ( !defined( 'TBAY_ELEMENTOR_ACTIVED' ) ) return;

//convert hex to rgb
if ( !function_exists ('zota_tbay_getbowtied_hex2rgb') ) {
	function zota_tbay_getbowtied_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
		
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return implode(",", $rgb); // returns the rgb values separated by commas
		//return $rgb; // returns an array with the rgb values
	}
}


if ( !function_exists ('zota_tbay_color_lightens_darkens') ) {
	/**
	 * Lightens/darkens a given colour (hex format), returning the altered colour in hex format.7
	 * @param str $hex Colour as hexadecimal (with or without hash);
	 * @percent float $percent Decimal ( 0.2 = lighten by 20%(), -0.4 = darken by 40%() )
	 * @return str Lightened/Darkend colour as hexadecimal (with hash);
	 */
	function zota_tbay_color_lightens_darkens( $hex, $percent ) {
		
		// validate hex string
		
		$hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
		$new_hex = '#';
		
		if ( strlen( $hex ) < 6 ) {
			$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
		}
		
		// convert to decimal and change luminosity
		for ($i = 0; $i < 3; $i++) {
			$dec = hexdec( substr( $hex, $i*2, 2 ) );
			$dec = min( max( 0, $dec + $dec * $percent ), 255 ); 
			$new_hex .= str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT );
		}		
		
		return $new_hex;
	}
}

if ( !function_exists ('zota_tbay_default_theme_primary_color') ) {
	function zota_tbay_default_theme_primary_color() {

		$active_theme = zota_tbay_get_theme();

		$theme_variable = array();

		switch ($active_theme) {
			case 'beauty':
				$theme_variable['main_color'] 			= '#D7A484';
				break;
			case 'electronics':
				$theme_variable['main_color'] 			= '#0D6DD7';
				break;
			case 'fashion':
				$theme_variable['main_color'] 			= '#1D1D1D';
				break;
			case 'furniture':
				$theme_variable['main_color'] 			= '#F38816';
				break;
			case 'organic':
				$theme_variable['main_color'] 			= '#5C9963';
				break;
		}


		return apply_filters( 'zota_get_default_theme_color', $theme_variable);
	}
}

if ( !function_exists ('zota_tbay_custom_styles') ) {
	function zota_tbay_custom_styles() {
		global $reduxConfig;	

		$output = $reduxConfig->output;

		$main_color  		= $main_bg_color =  $main_border_color  = zota_tbay_get_config('main_color');

		

		$logo_img_width        		= zota_tbay_get_config( 'logo_img_width' );
		$logo_padding        		= zota_tbay_get_config( 'logo_padding' );	

		$logo_img_width_mobile 		= zota_tbay_get_config( 'logo_img_width_mobile' );
		$logo_mobile_padding 		= zota_tbay_get_config( 'logo_mobile_padding' );

		$custom_css 			= zota_tbay_get_config( 'custom_css' );
		$css_desktop 			= zota_tbay_get_config( 'css_desktop' );
		$css_tablet 			= zota_tbay_get_config( 'css_tablet' );
		$css_wide_mobile 		= zota_tbay_get_config( 'css_wide_mobile' );
		$css_mobile         	= zota_tbay_get_config( 'css_mobile' );

		$show_typography        = (bool) zota_tbay_get_config( 'show_typography', false );
		 
		$bg_buy_now 		  = zota_tbay_get_config( 'bg_buy_now' );
		$color_buy_now 		  = zota_tbay_get_config( 'color_buy_now' );

		ob_start();	
		?>
		
		/* Theme Options Styles */
		
		<?php if( $show_typography ) : ?>	
			/* Typography */
			/* Main Font */
			<?php
				$font_source 			= zota_tbay_get_config('font_source');
				$main_font 				= zota_tbay_get_config('main_font');
				$main_google_font_face = zota_tbay_get_config('main_google_font_face');
				$main_custom_font_face = zota_tbay_get_config('main_custom_font_face');

				$primary_font = $output['primary-font'];
			?>
			<?php if ( ($font_source == "2" && $main_google_font_face) || ($font_source == "3" && $main_custom_font_face) ): ?>
				<?php echo trim($primary_font); ?> {
				font-family: 
					<?php 
						switch ($font_source) {
							case '3':
								echo trim($main_custom_font_face);
								break;								
							case '2':
								echo trim($main_google_font_face);
								break;							
							
							default:
								echo trim($main_google_font_face);
								break;
						}
					?>
				}
			<?php endif; ?>

		<?php endif; ?>

			/* check main color */ 
			#reviews ul.wcpr-filter-button-ul .wcpr-filter-button:hover {
				background-color: <?php echo esc_html( $main_color ) ?> !important;
				border-color: <?php echo esc_html( $main_color ) ?> !important;
			}
			.tbay-element.tbay-element-product-flash-sales .show-all:hover, .show-all:hover {
				border-color: <?php echo esc_html( $main_color ) ?> !important;
			}
			#reviews .wcpr-filter-button:hover, #reviews .wcpr-filter-button.wcpr-active, .woocommerce .woof_submit_search_form_container button.woof_reset_search_form:hover, .woocommerce .woof_submit_search_form_container button.woof_reset_search_form:focus, .tbay-dropdown-cart .group-button p.buttons a.button.view-cart:hover, .tbay-dropdown-cart .group-button p.buttons a.button.view-cart:focus, .tbay-dropdown-cart .group-button p.buttons a.button.view-cart:active:hover, .cart-dropdown .group-button p.buttons a.button.view-cart:hover, .cart-dropdown .group-button p.buttons a.button.view-cart:focus, .cart-dropdown .group-button p.buttons a.button.view-cart:active:hover, #reviews .wcpr-filter-button:hover, #reviews .wcpr-filter-button.wcpr-active {
				background-color: <?php echo esc_html( $main_color ) ?> !important;
			}
			/* Dokan */ 
			.dokan-pagination-container ul.dokan-pagination > li:not(.disabled):hover a, .dokan-pagination-container ul.dokan-pagination > li:not(.disabled):focus a, .dokan-pagination-container ul.dokan-pagination > li:not(.disabled).active a {
				border-color: <?php echo esc_html( $main_color ) ?>;
			}
			/* wcfm */
			.wcfmmp_sold_by_container_advanced .wcfmmp_sold_by_wrapper .wcfmmp_sold_by_store a:hover, .wcfmmp_sold_by_wrapper a:hover, .wcfmmp_sold_by_wrapper a, #wcfmmp-store .categories_list > ul > li a:hover {
				color: <?php echo esc_html( $main_color ) ?> !important;
			}

			<?php if ( $main_color != "" ) : ?>

				/*background*/
				<?php if( isset($output['background_hover']) && !empty($output['background_hover']) ) : ?>
				<?php echo trim($output['background_hover']); ?> {
					background: <?php echo esc_html( zota_tbay_color_lightens_darkens( $main_bg_color, -0.1) ); ?>;
				}
				<?php endif; ?>

			<?php endif; ?> 


			<?php if ( $logo_img_width != "" ) : ?>
			.site-header .logo img {
	            max-width: <?php echo esc_html( $logo_img_width ); ?>px;
	        } 
	        <?php endif; ?>

	        <?php if ( $logo_padding != "" ) : ?>
	        .site-header .logo img {

	            <?php if( !empty($logo_padding['padding-top'] ) ) : ?>
					padding-top: <?php echo esc_html( $logo_padding['padding-top'] ); ?>;
	        	<?php endif; ?>

	        	<?php if( !empty($logo_padding['padding-right'] ) ) : ?>
					padding-right: <?php echo esc_html( $logo_padding['padding-right'] ); ?>;
	        	<?php endif; ?>
	        	
	        	<?php if( !empty($logo_padding['padding-bottom'] ) ) : ?>
					padding-bottom: <?php echo esc_html( $logo_padding['padding-bottom'] ); ?>;
	        	<?php endif; ?>

	        	<?php if( !empty($logo_padding['padding-left'] ) ) : ?>
					 padding-left: <?php echo esc_html( $logo_padding['padding-left'] ); ?>;
	        	<?php endif; ?>

	        }
			<?php endif; ?> 

	        <?php if ( $main_color != "" ) : ?>

        	/*Tablet*/
	        @media (max-width: 1199px)  and (min-width: 768px) {
				/*color*/
				<?php if( isset($output['tablet_color']) && !empty($output['tablet_color']) ) : ?>
					<?php echo trim($output['tablet_color']); ?> {
						color: <?php echo esc_html( $main_color ) ?>;
					}
				<?php endif; ?>


				/*background*/
				<?php if( isset($output['tablet_background']) && !empty($output['tablet_background']) ) : ?>
					<?php echo trim($output['tablet_background']); ?> {
						background-color: <?php echo esc_html( $main_bg_color ) ?>;
					}
				<?php endif; ?>

				/*Border*/
				<?php if( isset($output['tablet_border']) && !empty($output['tablet_border']) ) : ?>
				<?php echo trim($output['tablet_border']); ?> {
					border-color: <?php echo esc_html( $main_border_color ) ?>;
				}
				<?php endif; ?>

		    }

		    /*Mobile*/
		    @media (max-width: 767px) {
				/*color*/
				<?php if( isset($output['mobile_color']) && !empty($output['mobile_color']) ) : ?>
					<?php echo trim($output['mobile_color']); ?> {
						color: <?php echo esc_html( $main_color ) ?>;
					}
				<?php endif; ?>

				/*background*/
				<?php if( isset($output['mobile_background']) && !empty($output['mobile_background']) ) : ?>
					<?php echo trim($output['mobile_background']); ?> {
						background-color: <?php echo esc_html( $main_bg_color ) ?>;
					}
				<?php endif; ?>

				/*Border*/
				<?php if( isset($output['mobile_border']) && !empty($output['mobile_border']) ) : ?>
				<?php echo trim($output['mobile_border']); ?> {
					border-color: <?php echo esc_html( $main_border_color ) ?>;
				}
				<?php endif; ?>

		    }

		    /*No edit code customize*/	
		    @media (max-width: 1199px)  and (min-width: 768px) {	       
		    	/*color*/
				.footer-device-mobile > * a:hover,.footer-device-mobile > *.active a,.footer-device-mobile > *.active a i , body.woocommerce-wishlist .footer-device-mobile > .device-wishlist a,body.woocommerce-wishlist .footer-device-mobile > .device-wishlist a i,.vc_tta-container .vc_tta-panel.vc_active .vc_tta-panel-title > a span,.cart_totals table .order-total .woocs_special_price_code {
					color: <?php echo esc_html( $main_color ) ?>;
				}

				/*background*/
				.topbar-device-mobile .top-cart a.wc-continue,.topbar-device-mobile .cart-dropdown .cart-icon .mini-cart-items,.footer-device-mobile > * a .mini-cart-items,.tbay-addon-newletter .input-group-btn input {
					background-color: <?php echo esc_html( $main_bg_color ) ?>;
				}

				/*Border*/
				.topbar-device-mobile .top-cart a.wc-continue {
					border-color: <?php echo esc_html( $main_border_color ) ?>;
				}
			}


		   <?php endif; ?>

	        @media (max-width: 1199px) {

	        	<?php if ( $logo_img_width_mobile != "" ) : ?>
	            /* Limit logo image height for mobile according to mobile header height */
	            .mobile-logo a img {
	               	width: <?php echo esc_html( $logo_img_width_mobile ); ?>px;
	            }     
	            <?php endif; ?>       

	            <?php if ( $logo_mobile_padding['padding-top'] != "" || $logo_mobile_padding['padding-right'] || $logo_mobile_padding['padding-bottom'] || $logo_mobile_padding['padding-left'] ) : ?>
	            .mobile-logo a img {

		            <?php if( !empty($logo_mobile_padding['padding-top'] ) ) : ?>
						padding-top: <?php echo esc_html( $logo_mobile_padding['padding-top'] ); ?>;
		        	<?php endif; ?>

		        	<?php if( !empty($logo_mobile_padding['padding-right'] ) ) : ?>
						padding-right: <?php echo esc_html( $logo_mobile_padding['padding-right'] ); ?>;
		        	<?php endif; ?>

		        	<?php if( !empty($logo_mobile_padding['padding-bottom'] ) ) : ?>
						padding-bottom: <?php echo esc_html( $logo_mobile_padding['padding-bottom'] ); ?>;
		        	<?php endif; ?>

		        	<?php if( !empty($logo_mobile_padding['padding-left'] ) ) : ?>
						 padding-left: <?php echo esc_html( $logo_mobile_padding['padding-left'] ); ?>;
		        	<?php endif; ?>
		           
	            }
	            <?php endif; ?>
			}

			@media screen and (max-width: 782px) {
				html body.admin-bar{
					top: -46px !important;
					position: relative;
				}
			} 

			<?php if( !empty($color_buy_now) ) : ?>
        		#shop-now.has-buy-now .tbay-buy-now.button, 
				#shop-now.has-buy-now .tbay-buy-now.button.disabled, 
				.mobile-btn-cart-click #tbay-click-buy-now, 
				#shop-now.has-buy-now .tbay-buy-now.button:not(.disabled):hover, 
				#shop-now.has-buy-now .tbay-buy-now.button:not(.disabled):focus,
				.mobile-btn-cart-click #tbay-click-buy-now:hover,  
				.mobile-btn-cart-click #tbay-click-buy-now:focus {
					color: <?php echo esc_html( $color_buy_now ) ?> !important;
				}   
			<?php endif; ?>

			<?php if( !empty($bg_buy_now) ) : ?>
        		#shop-now.has-buy-now .tbay-buy-now.button, 
				#shop-now.has-buy-now .tbay-buy-now.button.disabled, 
				.mobile-btn-cart-click #tbay-click-buy-now {
					background-color: <?php echo esc_html( $bg_buy_now ) ?> !important;
					border-color: <?php echo esc_html( $bg_buy_now ) ?> !important;
				}
				#shop-now.has-buy-now .tbay-buy-now.button:not(.disabled):hover, 
				#shop-now.has-buy-now .tbay-buy-now.button:not(.disabled):focus,
				.mobile-btn-cart-click #tbay-click-buy-now:hover,  
				.mobile-btn-cart-click #tbay-click-buy-now:focus {
					background: <?php echo esc_html( zota_tbay_color_lightens_darkens( $bg_buy_now, -0.1) ); ?> !important;
					border-color: <?php echo esc_html( zota_tbay_color_lightens_darkens( $bg_buy_now, -0.1) ); ?> !important;
				} 
			<?php endif; ?>

			/* Custom CSS */
	        <?php 
	        if( $custom_css != '' ) {
	            echo trim($custom_css);
	        }
	        if( $css_desktop != '' ) {
	            echo '@media (min-width: 1024px) { ' . ($css_desktop) . ' }'; 
	        }
	        if( $css_tablet != '' ) {
	            echo '@media (min-width: 768px) and (max-width: 1023px) {' . ($css_tablet) . ' }'; 
	        }
	        if( $css_wide_mobile != '' ) {
	            echo '@media (min-width: 481px) and (max-width: 767px) { ' . ($css_wide_mobile) . ' }'; 
	        }
	        if( $css_mobile != '' ) {
	            echo '@media (max-width: 480px) { ' . ($css_mobile) . ' }'; 
	        }
	        ?>


	<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			} 
		}

		$custom_css = implode($new_lines);

		wp_enqueue_style( 'zota-style', ZOTA_THEME_DIR . '/style.css', array(), '1.0' );

		wp_add_inline_style( 'zota-style', $custom_css );

		if( class_exists( 'WooCommerce' ) && class_exists( 'YITH_Woocompare' ) ) {
			wp_add_inline_style( 'zota-woocommerce', $custom_css );
		}
	}

	add_action( 'wp_enqueue_scripts', 'zota_tbay_custom_styles', 200 ); 
}