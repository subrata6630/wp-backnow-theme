<?php
define( 'BACKNOW_CSS', get_parent_theme_file_uri().'/css/' );
define( 'BACKNOW_JS', get_parent_theme_file_uri().'/js/' );

/*-------------------------------------------*
 *				Startup Register
 *------------------------------------------*/
include( get_parent_theme_file_path('lib/main-function/themeum-register.php') );

/* -------------------------------------------
*           	Include TGM Plugins
* -------------------------------------------- */
include( get_parent_theme_file_path('lib/class-tgm-plugin-activation.php') );


/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary' => esc_html__( 'Primary Menu', 'backnow' ),
) );


/*-------------------------------------------
*          		add font backnow
*--------------------------------------------*/
include( get_parent_theme_file_path('lib/fontbacknow-helper.php') );

/*-------------------------------------------*
 *				navwalker
 *------------------------------------------*/
include( get_parent_theme_file_path('lib/menu/admin-megamenu-walker.php') );
include( get_parent_theme_file_path('lib/menu/meagmenu-walker.php') );
include( get_parent_theme_file_path('lib/menu/mobile-navwalker.php') );
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Themeum_Megamenu_Walker';
}, 10, 2 );


/*-------------------------------------------------------
*				Themeum Core
*-------------------------------------------------------*/
include( get_parent_theme_file_path('lib/main-function/themeum-core.php') );


/*-----------------------------------------------------
 * 				Custom Excerpt Length
 *----------------------------------------------------*/
if(!function_exists('backnow_excerpt_max_charlength')):
	function backnow_excerpt_max_charlength($charlength) {
		$excerpt = get_the_excerpt();
		$charlength++;
		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex = mb_substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				return mb_substr( $subex, 0, $excut );
			} else {
				return $subex;
			}
		} else {
			return $excerpt;
		}
	}
endif;


/*-----------------------------------------------------
 * 				RBGA
 *----------------------------------------------------*/

if(!function_exists('backnowhex2rgba')){
    function backnowhex2rgba($hex,$opacity) {
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
       return $rgb[0].','.$rgb[1].','.$rgb[2].','.$opacity;
    }
}


/*-------------------------------------------
 *          	Custom Excerpt Length
*-------------------------------------------*/
if(!function_exists('crowdfunding_excerpt_max_charlength')):
    function crowdfunding_excerpt_max_charlength($str,$charlength) {
        $excerpt = $str;
        $charlength++;
        if ( mb_strlen( $excerpt ) > $charlength ) {
            $subex = mb_substr( $excerpt, 0, $charlength - 5 );
            $exwords = explode( ' ', $subex );
            $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
            if ( $excut < 0 ) {
                return mb_substr( $subex, 0, $excut );
            } else {
                return $subex;
            }
        } else {
            return $excerpt;
        }
    }
endif;



/* ------------------------------------------ *
 *				woocommerce support
* ------------------------------------------ */
function backnow_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'backnow_woocommerce_support' );

function backnow_loop_columns() {
	return 3;  
}
add_filter('loop_shop_columns', 'backnow_loop_columns'); // Set Number of rows in Shop

function backnow_document_title_parts($parts){
	if (is_post_type_archive() && function_exists('is_shop') && is_shop()) {
		$parts['title'] = esc_html__('Shop','backnow');
	}
	return $parts;
}
add_filter( 'document_title_parts', 'backnow_document_title_parts', 99 );


/* -------------------------------------------
 * 				Custom body class
 * ------------------------------------------- */
add_filter( 'body_class', 'backnow_body_class' );
function backnow_body_class( $classes ) {
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $classes[] = $layout.'-bg';
	return $classes;
}

/* -------------------------------------------
 * 				Logout Redirect Home
 * ------------------------------------------- */
add_action( 'wp_logout', 'backnow_auto_redirect_external_after_logout');
function backnow_auto_redirect_external_after_logout(){
  wp_redirect( home_url('/') );
  exit();
}


/* -------------------------------------------
 *   Add Custom Field To Category Form
 * ------------------------------------------- */

add_action( 'product_cat_add_form_fields', 'product_cat_form_custom_field_add', 10 ); 
add_action( 'product_cat_edit_form_fields', 'product_cat_form_custom_field_edit', 10, 2 );

function product_cat_form_custom_field_add( $taxonomy ) { ?>
	<div class="form-field">
		<!--Add Icon-->
		<label for="product_cat_custom_order"><?php _e('Select category icon','backnow');?></label>
		<select  id="product_cat_custom_order" name="product_cat_custom_order">
			<?php
				$iconlist = getBacknowIconsList();
				$op = '<option value="%s"%s>%s</option>';
				foreach ($iconlist as $value ) {
					if ($product_cat_custom_order == $value) {
						printf($op, $value, ' selected="selected"', $value);
					} else {
						printf($op, $value, '', $value);
					}
				}
				?>
		</select>
		<p class="description"><?php _e('Add Category Icon','backnow');?></p>

		<!--Color Picker-->
		<label for="product_cat_color_custom_order"><?php _e('Category Color Option','backnow');?></label>
		<input class="backnow-color-picker" name="product_cat_color_custom_order" id="product_cat_color_custom_order" type="text" value="#33D3C0" size="40" aria-required="true" />
		<p class="description"><?php _e('Add Category Color','backnow');?></p>

		<!--Subtitle-->
		<label for="product_cat_subtitle_custom_order"><?php _e('Category Sub Title','backnow');?></label>
		<input name="product_cat_subtitle_custom_order" id="product_cat_subtitle_custom_order" type="text" value="" size="40" aria-required="true" />
		<p class="description"><?php _e('Add sub title','backnow');?></p>
	</div>
<?php }

function product_cat_form_custom_field_edit( $tag, $taxonomy ) { ?>
	<!--Add Icon-->
	<tr class="form-field">
		<th scope="row"><label for="product_cat_custom_order"><?php _e('Select category icon','backnow');?></label></th>
		<td>
			<select  id="product_cat_custom_order" name="product_cat_custom_order">
			<?php
			    $option_name = 'product_cat_custom_order_' . $tag->term_id;
			    $product_cat_custom_order = get_option( $option_name );
			    $iconlist = getBacknowIconsList();

				$op = '<option value="%s"%s>%s</option>';

				foreach ($iconlist as $value ) {

					if ($product_cat_custom_order == $value) {
			            printf($op, $value, ' selected="selected"', $value);
			        } else {
			            printf($op, $value, '', $value);
			        }
			    }
				?>
			</select>
		</td>
	</tr>

	<!--Color Picker-->
	<?php 
		$option_name = 'product_cat_color_custom_order_' . $tag->term_id;
		$product_cat_color_custom_order = get_option( $option_name );
	?>
	<tr class="form-field">
	  <th scope="row" valign="top"><label for="product_cat_color_custom_order"><?php _e('Category Color Option','backnow');?></label></th>
	  <td>
	    <input class="backnow-color-picker" type="text" name="product_cat_color_custom_order" id="product_cat_color_custom_order" value="<?php echo esc_attr( $product_cat_color_custom_order ) ? esc_attr( $product_cat_color_custom_order ) : ''; ?>" size="40" aria-required="true" />
	     <p class="description"><?php _e('Category Color Option','backnow');?></p>
	  </td>
	</tr>


	<!--Subtitle-->
	<?php 
		$option_name = 'product_cat_subtitle_custom_order_' . $tag->term_id;
		$product_cat_subtitle_custom_order = get_option( $option_name );
	?>
	<tr class="form-field">
	  <th scope="row" valign="top"><label for="product_cat_subtitle_custom_order"><?php _e('Category Sub Title','backnow');?></label></th>
	  <td>
	    <input type="text" name="product_cat_subtitle_custom_order" id="product_cat_subtitle_custom_order" value="<?php echo esc_attr( $product_cat_subtitle_custom_order ) ? esc_attr( $product_cat_subtitle_custom_order ) : ''; ?>" size="40" aria-required="true" />
	     <p class="description"><?php _e('Add sub title','backnow');?></p>
	  </td>
	</tr>


<?php }

/** Save Custom Field Of product_cat Form */
add_action( 'created_product_cat', 'product_cat_form_custom_field_save', 10, 2 ); 
add_action( 'edited_product_cat', 'product_cat_form_custom_field_save', 10, 2 );
 
function product_cat_form_custom_field_save( $term_id, $tt_id ) {

    if ( isset( $_POST['product_cat_custom_order'] ) ) {         
        $option_name = 'product_cat_custom_order_' . $term_id;
        update_option( $option_name, sanitize_text_field( $_POST['product_cat_custom_order'] ) );
    }

	if ( isset( $_POST['product_cat_subtitle_custom_order'] ) ) {			
		$option_name = 'product_cat_subtitle_custom_order_' . $term_id;
		update_option( $option_name, sanitize_text_field( $_POST['product_cat_subtitle_custom_order'] ) );
	}

	if ( isset( $_POST['product_cat_color_custom_order'] ) ) {			
		$option_name = 'product_cat_color_custom_order_' . $term_id;
		update_option( $option_name, sanitize_text_field( $_POST['product_cat_color_custom_order'] ) );
	}

}


/* -------------------------------------------
 * 				WooCommerce Product Filter
 * ------------------------------------------- */
add_action( 'woocommerce_product_query', 'limit_show_cf_campaign_in_shop' );
function limit_show_cf_campaign_in_shop($wp_query){
	$type = get_theme_mod( 'shop_product', 'allproduct' );
	if( $type == 'without_crowdfunding' ){
		$tax_query = array(
	        array(
	            'taxonomy' 	=> 'product_type',
	            'field'    	=> 'slug',
	            'terms' 	=> array(
	                'crowdfunding'
	            ),
	            'operator' => 'NOT IN'
	        )
	    );
	    $wp_query->set( 'tax_query', $tax_query );
	}
	if( $type == 'only_crowdfunding' ){
		$tax_query = array(
	        array(
	            'taxonomy' => 'product_type',
	            'field'    => 'slug',
	            'terms' => array(
	                'crowdfunding'
	            ),
	            'operator' => 'IN'
	        )
	    );
	    $wp_query->set( 'tax_query', $tax_query );
	}
    return $wp_query;
}


/* -------------------------------------------
 *   Love it Action
 * ------------------------------------------- */
add_action( 'wp_ajax_thm_campaign_action','themeum_campaign_action' );
add_action( 'wp_ajax_nopriv_thm_campaign_action', 'themeum_campaign_action' );
function themeum_campaign_action(){
    if ( ! is_user_logged_in()){
        die(json_encode(array('success'=> 0, 'message' => __('Please Sign In first', 'backnow') )));
    }

    $loved_campaign_ids  = array();
    $user_id             = get_current_user_id();
    $campaign_id         = sanitize_text_field($_POST['campaign_id']);
	$prev_campaign_ids   = get_user_meta($user_id, 'loved_campaign_ids', true);
	$postid 			 = get_post_meta( $campaign_id, 'loved_campaign_ids', true );

    if ($prev_campaign_ids){
        $loved_campaign_ids = json_decode( $prev_campaign_ids, true );
	}
	
    if (in_array($campaign_id, $loved_campaign_ids)){
        if(($key = array_search($campaign_id, $loved_campaign_ids)) !== false) {
            unset( $loved_campaign_ids[$key] );
        }
        $json_update_campaign_ids = json_encode($loved_campaign_ids);
		update_user_meta($user_id, 'loved_campaign_ids', $json_update_campaign_ids);
		if( $postid ){
			$postid = (int)$postid - 1;
			update_post_meta( $campaign_id, 'loved_campaign_ids', $postid );
		}else{
			$postid = 0;
			update_post_meta( $campaign_id, 'loved_campaign_ids', 0 );
		}
		die(json_encode(array('success'=> 1, 'number' => $postid, 'message' => 'delete' )));
    }else{
        $loved_campaign_ids[] = $campaign_id;
		update_user_meta($user_id, 'loved_campaign_ids', json_encode($loved_campaign_ids) );
		if( $postid ){
			$postid = (int)$postid + 1;
			update_post_meta( $campaign_id, 'loved_campaign_ids', $postid );
		}else{
			$postid = 1;
			update_post_meta( $campaign_id, 'loved_campaign_ids', 1 );
		}
        die(json_encode(array('success'=> 1, 'number' => $postid , 'message' => 'love' )));
    }
}