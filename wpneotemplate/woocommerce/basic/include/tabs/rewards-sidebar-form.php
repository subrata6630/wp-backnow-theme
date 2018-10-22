<!-- Quantity Box WooCommerce -->
<?php
    if ( ! defined( 'ABSPATH' ) ) {
        exit; # Exit if accessed directly
    }
    global $post, $woocommerce, $product;
    $currency = '$';
    if ($product->get_type() == 'crowdfunding') {
        if (WPNEOCF()->campaignValid()) {
            $recomanded_price = get_post_meta($post->ID, 'wpneo_funding_recommended_price', true);
            $min_price = get_post_meta($post->ID, 'wpneo_funding_minimum_price', true);
            $max_price = get_post_meta($post->ID, 'wpneo_funding_maximum_price', true);
            if(function_exists( 'get_woocommerce_currency_symbol' )){
                $currency = get_woocommerce_currency_symbol();
            }

            if (! empty($_GET['reward_min_amount'])){
                $recomanded_price = (int) esc_html($_GET['reward_min_amount']);
            } ?>

            <div id="backnow_project" class="quantity_box">
                <span><?php _e('Make a pledge without a reward', 'backnow'); ?> </span>
                <span class="wpneo-tooltip">
                    <span class="wpneo-tooltip-min"><?php _e('Minimum amount is ','backnow'); echo esc_attr($currency.$min_price); ?></span>
                    <span class="wpneo-tooltip-max"><?php _e('Maximum amount is ','backnow'); echo esc_attr($currency.$max_price); ?></span>
                </span>
                <form enctype="multipart/form-data" method="post" class="cart">
                    <?php do_action('before_wpneo_donate_field'); ?>
                    <input type="number" min="0" placeholder="" name="wpneo_donate_amount_field" class="input-text amount wpneo_donate_amount_field text" value="<?php echo esc_attr($recomanded_price); ?>" data-min-price="<?php echo esc_attr($min_price) ?>" data-max-price="<?php echo esc_attr($max_price) ?>" >
                    <?php do_action('after_wpneo_donate_field'); ?>
                    <input type="hidden" value="<?php echo esc_attr($post->ID); ?>" name="add-to-cart">
                    <button type="submit" class="q<?php echo apply_filters('add_to_donate_button_class', 'wpneo_donate_button'); ?>"><i class="fa fa-long-arrow-right"></i></button>
                </form>
            </div>
            
        <?php } else {
            _e('This campaigns is over.','backnow');
        }
    }
?>
<!-- Quantity Box End -->

<span id="backnow_project_demo" class="backnow-rewards">
    <span><?php _e('Rewards', 'backnow'); ?></span>
</span>

<?php
    global $post;
    $campaign_rewards   = get_post_meta($post->ID, 'wpneo_reward', true);
    $campaign_rewards   = stripslashes($campaign_rewards);
    $campaign_rewards_a = json_decode($campaign_rewards, true);
    if (is_array($campaign_rewards_a)) {
        if (count($campaign_rewards_a) > 0) {

            $i      = 0;
            $amount = array();

            foreach ($campaign_rewards_a as $key => $row) {
                $amount[$key] = $row['wpneo_rewards_pladge_amount'];
            }
            array_multisort($amount, SORT_ASC, $campaign_rewards_a);
            
            foreach ($campaign_rewards_a as $key => $value) {
                $key++;
                $i++;
                $quantity = '';
                
                $post_id    = get_the_ID();
                $min_data   = $value['wpneo_rewards_pladge_amount'];
                $max_data   = '';
                $orders     = 0;
                ( ! empty($campaign_rewards_a[$i]['wpneo_rewards_pladge_amount']))? ( $max_data = $campaign_rewards_a[$i]['wpneo_rewards_pladge_amount'] - 1 ) : ($max_data = 9000000000);
                if( $min_data != '' ){
                    $orders = wpneo_campaign_order_number_data( $min_data,$max_data,$post_id );
                }
                if( $value['wpneo_rewards_item_limit'] ){
                    $quantity = 0;
                    if( $value['wpneo_rewards_item_limit'] >= $orders ){
                        $quantity = $value['wpneo_rewards_item_limit'] - $orders;
                    }
                }
            ?>
             

            <div class="tab-rewards-wrapper<?php echo ( $quantity === 0 ) ? ' disable' : ''; ?>">
                <?php if( $value['wpneo_rewards_image_field'] ){ ?>
                    <div class="wpneo-rewards-image">
                        <?php echo '<img src="'.wp_get_attachment_url( $value["wpneo_rewards_image_field"] ).'"/>'; ?>
                    </div>
                <?php } ?>
                <div class="backnow-reward-cont">
                    <h3>
                        <?php echo get_woocommerce_currency_symbol(). $value['wpneo_rewards_pladge_amount'];
                            if( 'true' != get_option('wpneo_reward_fixed_price','') ){
                                echo ( ! empty($campaign_rewards_a[$i]['wpneo_rewards_pladge_amount']))? ' - '. get_woocommerce_currency_symbol(). ($campaign_rewards_a[$i]['wpneo_rewards_pladge_amount'] - 1) : ' - more';    
                            }
                        ?>
                    </h3>
                    <p><?php echo esc_html($value['wpneo_rewards_description']); ?></p>
                    <?php if( $min_data != '' ){
                        echo '<p>'.$orders.' '.__('backnows','backnow').'</p>'; } ?>


                        <?php 

                        $est_delivery = ucfirst(date_i18n("M", strtotime($value['wpneo_rewards_endmonth']))).', '.$value['wpneo_rewards_endyear'];
                        if ( ! empty($value['wpneo_rewards_endmonth']) || ! empty($value['wpneo_rewards_endyear'])){ ?>
                            <div class="backnow-estimate-date">
                                <?php
                                    echo '<span>'.__('Estimated Delivery: ', 'backnow').'</span>';
                                    echo "<span>{$est_delivery}</span>";
                                ?>
                            </div>
                    <?php } ?>


                    <?php if (get_option('wpneo_single_page_reward_design') == 1) { ?>
                    <div class="overlay">
                        <div>
                            <div>
                                <?php if( $quantity === 0 ): ?>
                                    <span class="wpneo-error"><?php _e( 'Reward no longer available.', 'backnow' ); ?></span>
                                <?php else: ?>
                                    <form enctype="multipart/form-data" method="post" class="cart">
                                        <input type="hidden" value="<?php echo esc_attr($value['wpneo_rewards_pladge_amount']); ?>" name="wpneo_donate_amount_field" />
                                        <input type="hidden" value="<?php echo esc_attr($key); ?>" name="wpneo_rewards_index" />
                                        <input type="hidden" value="<?php echo esc_attr($post->post_author); ?>" name="_cf_product_author_id">
                                        <input type="hidden" value="<?php echo esc_attr($post->ID); ?>" name="add-to-cart">
                                        <button type="submit" class="select_rewards_button"><?php _e('Select Reward','backnow'); ?></button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php } else if (get_option('wpneo_single_page_reward_design') == 2){ ?>
                    <div class="tab-rewards-submit-form-style1">
                        <?php if( $quantity === 0 ): ?>
                            <span class="wpneo-error"><?php _e( 'Reward no longer available.', 'backnow' ); ?></span>
                        <?php else: ?>
                            <form enctype="multipart/form-data" method="post" class="cart">
                                <input type="hidden" value="<?php echo esc_attr($value['wpneo_rewards_pladge_amount']); ?>" name="wpneo_donate_amount_field" />
                                <input type="hidden" value="<?php echo esc_attr($key); ?>" name="wpneo_rewards_index" />
                                <input type="hidden" value="<?php echo esc_attr($post->post_author); ?>" name="_cf_product_author_id">
                                <input type="hidden" value="<?php echo esc_attr($post->ID); ?>" name="add-to-cart">
                                <button type="submit" class="select_rewards_button"><?php _e('Select Reward','backnow'); ?></button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php } ?>

                </div>
            </div>
            <?php
            }
        }
    }
?>
<div style="clear: both"></div>