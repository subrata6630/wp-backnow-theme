<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $post;
$funding_goal = get_post_meta($post->ID, '_nf_funding_goal', true);
?>
<div class="wpneo-funding-data">
	<div class="wpneo-funding-goal">
		<div class="wpneo-meta-desc"><?php echo wc_price( $funding_goal ); ?></div>
	    <div class="wpneo-meta-name"><?php _e('Funding Goal', 'backnow'); ?></div>
	</div>
