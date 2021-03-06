<?php 
/**
 * The template Image layout carousel
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Zota
 * @since Zota 1.0
 */
?>
<div class="single-main-content">
	<div class="row">
		<div class="image-mains col-lg-6">
			<?php
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>
		</div>

		<div class="information col-lg-6">
			<div class="summary entry-summary ">
				<div class="zota-single-product-title-main">
					<?php
						/**
						 * zota_top_single_product hook
						 * @hooked the_product_single_time_countdown -5
						 * @hooked woocommerce_template_single_title -10
						 * @hooked woocommerce_template_single_rating -20
						 */
						do_action( 'zota_top_single_product' );
					?>
				</div>

				<?php
					/**
					 * woocommerce_single_product_summary hook
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked excerpt_product_variable - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked share_box_html - 50
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>

			</div><!-- .summary -->
		</div>
		
	</div>
</div>
<?php
	/**
	 * woocommerce_after_single_product_summary hook
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 */
	do_action( 'woocommerce_after_single_product_summary' );
?>