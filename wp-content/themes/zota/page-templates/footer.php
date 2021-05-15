<?php

$footer 	= apply_filters( 'zota_tbay_get_footer_layout', 'footer_default' );
$cookie_newsletter  = zota_tbay_get_cookie('newsletter_remove');
?>

	</div><!-- .site-content -->
	<?php if ( zota_tbay_active_newsletter_sidebar() && !$cookie_newsletter  ) : ?>
		<div id="newsletter-popup" class="newsletter-popup">
			<?php dynamic_sidebar( 'newsletter-popup' ); ?>
		</div>
	<?php endif; ?>
	
	<?php if( !zota_checkout_optimized() ) : ?>
		<footer id="tbay-footer" <?php zota_tbay_footer_class();?>>
			<?php if ( $footer != 'footer_default' ): ?>
				
				<?php zota_tbay_display_footer_builder($footer); ?>

			<?php else: ?> 
				
				<?php get_template_part( 'page-templates/footer-default' ); ?>
				
			<?php endif; ?>			
		</footer><!-- .site-footer -->
	<?php endif; ?>
	
	<?php 

	$_id = zota_tbay_random_key();

	?>

	<?php
	if ( zota_tbay_get_config('back_to_top') ) { ?>
		<div class="tbay-to-top">
			<a href="javascript:void(0);" id="back-to-top">
				<i class="tb-icon tb-icon-angle-up"></i>
			</a>
		</div>
	<?php
	}
	?>

	<?php
	if ( zota_tbay_get_config('mobile_back_to_top') ) { ?>
		<div class="tbay-to-top-mobile tbay-to-top">

			<div class="more-to-top">
			
				<a href="javascript:void(0);" id="back-to-top-mobile">
					<i class="tb-icon tb-icon-angle-up"></i>
				</a>
				
			</div>
		</div>
		
		
	<?php
	}
	?>
	
	

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>