<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<div class="wpneo-listing-img">
    <a href="<?php echo get_permalink(); ?>" title="<?php  echo get_the_title(); ?>"> <?php echo woocommerce_get_product_thumbnail(); ?></a>
    <div class="overlay">
		<div>
			<div>
				<a href="<?php echo get_permalink(); ?>"><?php _e('View Campaign','backnow'); ?></a>
			</div>
		</div>
	</div>
</div>