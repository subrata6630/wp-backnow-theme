<?php
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/

if(!function_exists('backnow_widdget_init')):

    function backnow_widdget_init()
    {
        $bottomcolumn = get_theme_mod( 'bottom_column', '3' );

        register_sidebar(
            array(
                'name'          => esc_html__( 'Sidebar', 'backnow' ),
                'id'            => 'sidebar',
                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'backnow' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
            )
        );

        global $woocommerce;
        if($woocommerce) {
            register_sidebar(array(
                'name'          => __( 'Shop', 'backnow' ),
                'id'            => 'shop',
                'description'   => __( 'Widgets in this area will be shown on Shop Sidebar.', 'backnow' ),
                'before_title'  => '<h3 class="widget_title">',
                'after_title'   => '</h3>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
                )
            );
        }         

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 1', 'backnow' ),
            'id'            => 'bottom1',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 1.' , 'backnow'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 2', 'backnow' ),
            'id'            => 'bottom2',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 2.' , 'backnow'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 3', 'backnow' ),
            'id'            => 'bottom3',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 3.' , 'backnow'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 4', 'backnow' ),
            'id'            => 'bottom4',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 4.' , 'backnow'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );

        register_sidebar(array(
            'name'          => esc_html__( 'Bottom 5', 'backnow' ),
            'id'            => 'bottom5',
            'description'   => esc_html__( 'Widgets in this area will be shown before Bottom 5.' , 'backnow'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="bottom-widget"><div id="%1$s" class="widget %2$s" >',
            'after_widget'  => '</div></div>'
            )
        );




    }

    add_action('widgets_init','backnow_widdget_init');

endif;

if ( ! function_exists( 'backnow_fonts_url' ) ) :
    function backnow_fonts_url() {
    $fonts_url = '';

    $montserrat = _x( 'on', 'Montserrat font: on or off', 'backnow' );

    if ( 'off' !== $montserrat ) {
    $font_families = array();

    if ( 'off' !== $montserrat ) {
    $font_families[] = 'Montserrat:100,200,300,400,500,600,700';
    }

    $query_args = array(
    'family'  => urlencode( implode( '|', $font_families ) ),
    'subset'  => urlencode( 'latin,latin-ext' ),
    );

    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url_raw( $fonts_url );
    }
endif;


/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/
if(!function_exists('backnow_style')):

    function backnow_style(){

        wp_enqueue_style( 'default-google-font', '//fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700' );

        wp_enqueue_style( 'backnow-font', backnow_fonts_url(), array(), null );

        wp_enqueue_media();
        wp_enqueue_style( 'bootstrap', BACKNOW_CSS . 'bootstrap.min.css',false,'all');
        if ( is_rtl() ) {
            wp_enqueue_style( 'bootstrap-rtl', BACKNOW_CSS . 'bootstrap-rtl.min.css',false,'all');
        }
        wp_enqueue_style( 'font-awesome', BACKNOW_CSS . 'font-awesome.min.css',false,'all');
        wp_enqueue_style( 'backnow-font-style', BACKNOW_CSS . 'backnow-font-style.css',false,'all');
        wp_enqueue_style( 'magnific-popup', BACKNOW_CSS . 'magnific-popup.css',false,'all');
        wp_enqueue_style( 'backnow-main', BACKNOW_CSS . 'main.css',false,'all');
        wp_enqueue_style( 'backnow-woocommerce', BACKNOW_CSS . 'woocommerce.css',false,'all');
        wp_enqueue_style( 'js-social', BACKNOW_CSS . 'jssocials.css',false,'all');
        wp_enqueue_style( 'backnow-custom.css', BACKNOW_CSS . 'custom.css',false,'all');
        wp_enqueue_style( 'backnow-responsive', BACKNOW_CSS . 'responsive.css',false,'all');
         
        wp_enqueue_style( 'backnow-style',get_stylesheet_uri());
        wp_add_inline_style( 'backnow-style', BACKNOW_css_generator() );

        wp_enqueue_script('popper',BACKNOW_JS.'popper.min.js',array(),false,true);
        wp_enqueue_script('bootstrap',BACKNOW_JS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('loopcounter',BACKNOW_JS.'loopcounter.js',array(),false,true);
        wp_enqueue_script('js-social',BACKNOW_JS.'jssocials.min.js',array(),false,true);
        if( get_theme_mod( "google_map_api" ) ){ wp_enqueue_script('gmaps','https://maps.googleapis.com/maps/api/js?key='.get_theme_mod( "google_map_api" ),array(),false,true); }
        wp_enqueue_script('jquery.magnific-popup.min',BACKNOW_JS.'jquery.magnific-popup.min.js',array(),false,true);
        
        if( get_theme_mod( 'custom_preset_en', true ) == 0 ) {
            wp_enqueue_style( 'themeum-preset', get_parent_theme_file_uri(). '/css/presets/preset' . get_theme_mod( 'preset', '1' ) . '.css', array(),false,'all' );
        }
        if ( is_singular() ) {wp_enqueue_script( 'comment-reply' );}
        wp_enqueue_script('backnow-main',BACKNOW_JS.'main.js',array(),false,true);

        // For Ajax URL
        wp_enqueue_script('backnow-main');
        wp_localize_script( 'backnow-main', 'ajax_objects', array( 
            'ajaxurl'           => admin_url( 'admin-ajax.php' ),
            'redirecturl'       => home_url('/'),
            'loadingmessage'    => __('Sending user info, please wait...','backnow')
        ));

    }

    add_action('wp_enqueue_scripts','backnow_style');

endif;

if(!function_exists('backnow_admin_style')):

    function backnow_admin_style(){
        wp_enqueue_media();
        wp_register_script('thmpostmeta', get_parent_theme_file_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('themeum-widget-js', get_parent_theme_file_uri().'/js/widget-js.js', array('jquery'));
        wp_enqueue_script('thmpostmeta');

        if( is_admin() ) {    
            wp_enqueue_style( 'wp-color-picker' ); 
            wp_enqueue_script('backnow-colorpicker', get_parent_theme_file_uri().'/js/admin-colorpicker.js',  array( 'wp-color-picker' ),false,true);
        }

    }
    add_action('admin_enqueue_scripts','backnow_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/
add_action( 'tgmpa_register', 'backnow_plugins_include');

if(!function_exists('backnow_plugins_include')):

    function backnow_plugins_include()
    {
        $plugins = array(
                array(
                    'name'                  => esc_html__( 'Themeum Core', 'backnow' ),
                    'slug'                  => 'themeum-core',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/backnow/themeum-core.zip'),
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ), 
                array(
                    'name'                  => 'Woocoomerce',
                    'slug'                  => 'woocommerce',
                    'required'              => true, 
                    'version'               => '', 
                    'force_activation'      => false,
                    'force_deactivation'    => false, 
                    'external_url'          => 'https://downloads.wordpress.org/plugin/woocommerce.3.0.8.zip', 
                ),
                array(
                    'name'                  => esc_html__( 'Contact Form 7', 'backnow' ),
                    'slug'                  => 'contact-form-7',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/contact-form-7.4.8.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'Elementor', 'backnow' ),
                    'slug'                  => 'elementor',
                    'required'              => true,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/elementor.1.4.8.zip'),
                ),                
                array(
                    'name'                  => esc_html__( 'MailChimp for WordPress', 'backnow' ),
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.1.3.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'WP Crowdfunding', 'backnow' ),
                    'slug'                  => 'wp-crowdfunding',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/wp-crowdfunding.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'Widget Importer & Exporter', 'backnow' ),
                    'slug'                  => 'widget-importer-exporter',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => esc_url('https://downloads.wordpress.org/plugin/widget-importer-exporter.1.4.5.zip'),
                ),
                array(
                    'name'                  => esc_html__( 'One CLick Demo importer', 'backnow' ),
                    'slug'                  => 'themeum-demo-importer',
                    'source'                => esc_url('http://demo.themeum.com/wordpress/plugins/backnow/themeum-demo-importer.zip'),
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),

            );
    $config = array(
            'domain'            => 'backnow',
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'backnow' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'backnow' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'backnow' ),
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'backnow'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'backnow'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','backnow'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'backnow' )
                )
    );

    tgmpa( $plugins, $config );

    }

endif;
