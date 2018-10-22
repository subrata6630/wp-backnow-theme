<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php
    $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
    $headerlayout = get_theme_mod( 'head_style', 'solid' );
  ?>
<div id="page" class="hfeed site <?php echo esc_attr($layout); ?>">
  <header id="masthead" class="site-header header header-<?php echo esc_attr($headerlayout);?>">

  <?php

    $header_style = 2;
    if (isset( $_REQUEST['head-demo'])) {
      $style = esc_attr($_REQUEST['head-demo']);
    }else {
      $style = get_theme_mod('header_style_wrap','3');
    }

    switch($style) {
    case 1:
        $container_class = 'container-fluid thm-wide-header';
        break;
    case 2:
        $container_class = 'container-fluid thm-wide-header';
        break;
    case 3:
        $container_class = 'container';
        break;
    default:
        $container_class = 'container';
        break;
    }

  ?>

    <div class="site-header-wrap <?php echo esc_attr($container_class); ?>">
        <div class="row">
        <?php if($style == '2' || $style == '4') : ?>
            <div class="col-lg-5 clearfix col-4">
        <?php else :  ?>
            <div class="clearfix col-4 order-lg-2 col-lg-auto">
        <?php endif; ?>
          <?php if( get_theme_mod( 'header_explore', false ) ) { ?>
            <div class="thm-explore float-left">
                <a href="#"><i class="back-layout"></i> <?php  esc_html_e( 'Explore', 'backnow' ); ?><i class="fa fa-angle-down"></i></a>
                <?php get_template_part( 'lib/product-category' ); ?>
            </div>
            <?php  } ?>
            <?php if ( has_nav_menu( 'primary' ) ) { ?>
              <div id="main-menu" class="common-menu-wrap float-left d-none d-lg-block">
                  <?php
                      wp_nav_menu(  array(
                          'theme_location' => 'primary',
                          'container'      => '',
                          'menu_class'     => 'nav',
                          'fallback_cb'    => 'wp_page_menu',
                          'depth'          => 4,
                          'walker'         => new Megamenu_Walker()
                          )
                      );
                  ?>
              </div><!--/#main-menu-->
            <?php  } ?>
          </div><!--/.col-md-5-->

          <div class="d-block d-lg-none col-8">
            <?php if( get_theme_mod( 'header_campaign', false ) ): ?>
              <div class="backnow-login-register">
                <ul>
                    <!-- Start Campaign Section -->
                    <?php if( get_theme_mod( 'header_campaign', false ) ):
                        $campaign_text  = get_theme_mod( 'header_campaign_text', 'Start a Campaign' );
                        $campaign_url   = get_theme_mod( 'header_campaign_url'); ?>
                        <li><a href="<?php echo esc_url($campaign_url); ?>" class="backnow-login backnow-dashboard"><?php echo wp_kses_post($campaign_text); ?></a></li>
                    <?php endif; ?>
                    <!-- End Campaign -->
                </ul>

              </div>
            <?php endif; ?>

          </div><!--/.col-md-7-->


          <?php if($header_style == 1) : ?>
            <div class="col-lg-2 col-md-6 col-5 col-sm-6 text-lg-center">
          <?php else : ?>
            <div class=" col-md-6 col-5 col-sm-6 order-lg-1 col-lg-auto">
          <?php endif; ?>
            <div class="themeum-navbar-header">
              <div class="logo-wrapper">
                <a class="themeum-navbar-brand" href="<?php echo esc_url(site_url()); ?>">
                  <?php
                      $logoimg = get_theme_mod( 'logo', get_parent_theme_file_uri().'/images/logo.png' );
                      $logotext = get_theme_mod( 'logo_text', 'backnow' );
                      $logotype = get_theme_mod( 'logo_style', 'logoimg' );
                      switch ($logotype) {
                        case 'logoimg':
                            if( !empty($logoimg) ) {?>
                                <img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php  esc_html_e( 'Logo', 'backnow' ); ?>" title="<?php  esc_html_e( 'Logo', 'backnow' ); ?>">
                            <?php }else{?>
                                <h1> <?php  echo esc_html(get_bloginfo('name'));?> </h1>
                            <?php }
                          break;

                          case 'logotext':
                            if( $logotext ) { ?>
                                <h1> <?php echo esc_html( $logotext ); ?> </h1>
                            <?php }
                            else
                            {?>
                              <h1><?php  echo esc_html(get_bloginfo('name'));?> </h1>
                            <?php }
                          break;

                        default:
                          if( $logotext ) { ?>
                              <h1> <?php echo esc_html( $logotext ); ?> </h1>
                          <?php }
                          else
                          {?>
                            <h1><?php  echo esc_html(get_bloginfo('name'));?> </h1>
                          <?php }
                          break;
                      } ?>
                    </a>
                </div>
            </div><!--/#themeum-navbar-header-->
          </div><!--/.col-md-7-->


            <div class="col-7 col-sm-6 d-lg-none">

            <button type="button" class="navbar-toggle float-right" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="fa fa-navicon"></i>
                <?php _e('Menu','backnow') ?>
            </button>


            <?php if( get_theme_mod( 'header_login', false ) || get_theme_mod( 'header_search', false ) ): ?>
              <div class="backnow-login-register float-right">
                <?php if( get_theme_mod( 'header_search', false ) ): ?>
                    <div class="backnow-search-wrap">
                      <a href="#" class="backnow-search search-open-icon"><i class="back-magnifying-glass-2"></i></a>
                    </div>
                <?php endif; ?>

                <ul>
                    <!-- Login Section -->
                    <?php if( get_theme_mod( 'header_login', false ) ): ?>
                        <?php if ( !is_user_logged_in() ): ?>
                            <li><a data-toggle="modal" data-target="#myModal" href="#"> <i class="back-profile"></i></a></li>
                        <?php else: ?>
                        <?php $dashboard_id = get_option( 'wpneo_crowdfunding_dashboard_page_id','' ); ?>
                        <li><a href="<?php the_permalink( $dashboard_id ); ?>"> <i class="back-profile"></i></a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <!-- End Login section -->
                </ul>

              </div>
            <?php endif; ?>

          </div>
        <div class="col-12 d-lg-none ">
            <div id="mobile-menu" class="">
                <div class="collapse navbar-collapse">
                  <?php
                    if ( has_nav_menu( 'primary' ) ) {
                        wp_nav_menu( array(
                            'theme_location'      => 'primary',
                            'container'           => false,
                            'menu_class'          => 'nav navbar-nav',
                            'fallback_cb'         => 'wp_page_menu',
                            'depth'               => 3,
                            'walker'              => new wp_bootstrap_mobile_navwalker()
                            )
                        );
                    }
                    ?>
                </div>
            </div><!--/.#mobile-menu-->
        </div>

          <?php if($header_style == 1) : ?>
            <div class="col-lg-5 d-none d-lg-block">
          <?php else : ?>
            <?php if( get_theme_mod( 'header_login', false ) || get_theme_mod( 'header_search', false ) || get_theme_mod( 'header_campaign', false ) ) { ?>
                <div class="d-none d-lg-block order-lg-3 col-lg">
            <?php } ?>
          <?php endif; ?>

            <?php if( get_theme_mod( 'header_login', false ) || get_theme_mod( 'header_search', false ) || get_theme_mod( 'header_campaign', false ) ): ?>
              <div class="backnow-login-register">
                <?php if( get_theme_mod( 'header_search', false ) ): ?>
                    <div class="backnow-search-wrap">
                      <a href="#" class="backnow-search search-open-icon"><i class="back-magnifying-glass-2"></i></a>
                    </div>
                <?php endif; ?>

                <ul>
                    <!-- Login Section -->
                    <?php if( get_theme_mod( 'header_login', false ) ): ?>
                        <?php if ( !is_user_logged_in() ): ?>
                            <li><a data-toggle="modal" data-target="#myModal" href="#"> <i class="back-profile"></i><?php _e( 'Login/Sign Up','backnow' ); ?></a></li>
                        <?php else: ?>
                        <?php $dashboard_id = get_option( 'wpneo_crowdfunding_dashboard_page_id','' ); ?>
                        <?php if($dashboard_id){ ?>
                        <li><a href="<?php the_permalink( $dashboard_id ); ?>"> <i class="back-profile"></i><?php echo get_the_title( $dashboard_id ); ?></a></li>
                        <?php } else { ?>
                         <i class="back-profile"></i><a href="<?php echo wp_logout_url( esc_url( home_url('/') ) ); ?>"><?php _e('Logout','backnow'); ?></a>
                        <?php } ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <!-- End Login section -->

                    <!-- Start Campaign Section -->
                    <?php if( get_theme_mod( 'header_campaign', false ) ):
                        $campaign_text  = get_theme_mod( 'header_campaign_text', 'Start a Campaign' );
                        $campaign_url   = get_theme_mod( 'header_campaign_url', '#' ); ?>
                        <li><a href="<?php echo esc_url($campaign_url); ?>" class="backnow-login backnow-dashboard"><?php echo wp_kses_post($campaign_text); ?></a></li>
                    <?php endif; ?>
                    <!-- End Campaign -->
                </ul>

              </div>
            <?php endif; ?>

          </div><!--/.col-md-7-->
        </div><!--/.main-menu-wrap-->

        <div class="thm-fullscreen-search d-flex flex-wrap justify-content-center align-items-center">
            <div class="search-overlay"></div>
            <form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
                <input class="main-font" type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_html_e('Search here...','backnow'); ?>" autocomplete="off" />
                <input type="submit" value="submit" class="d-none" id="thm-search-submit">
                <label for="thm-search-submit"><i class="fa fa-search"></i></label>
            </form>
        </div> <!--/ .main-menu-wrap -->

    </div><!--/.container-->
  </header><!--/.header-->


<?php if ( !is_user_logged_in() ): ?>
    <!-- Login -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title"><?php _e( 'Sign In','backnow' ); ?></h5>
                 
                </div>
                <div class="modal-body">
                    <form id="login" action="login" method="post">
                        <div class="login-error alert alert-danger" role="alert"></div>
                        <input type="text"  id="usernamelogin" name="username" class="form-control" placeholder="Username">
                        <input type="password" id="passwordlogin" name="password" class="form-control" placeholder="Password">
                        <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" style="text-align:left;"><?php echo esc_html__( 'Forgot password?','backnow' ); ?></a>
                        <input type="submit" class="btn btn-primary submit_button"  value="Log In" name="submit">
                      
                          <input type="checkbox" id="rememberlogin" name="remember" style="margin-top:10px;" >Remember me<label style="margin-left:170px;"><?php _e( '','backnow' ); ?></label>                    

                        <?php wp_nonce_field( 'ajax-login-nonce', 'securitylogin' ); ?>
                    </form>
                </div>
                <div class="modal-footer clearfix d-block text-left">
                    <div class="d-inline-block">
                    </div>
                    <div class="d-inline-block float-right">
                        <p style="text-align:center;">New to unsupp? <a data-toggle="modal" data-target="#registerlog" href="#" data-dismiss="modal" ><?php echo esc_html__( 'Sign up!','backnow' ); ?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="registerlog" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   <p class="modal-title-text"><?php _e( 'Have any Account? <a href="http://www.unsupp.com/#">Log in</a>','backnow' ); ?></p>         </br>        
                    


                </div>
                <div class="modal-body">
                    <form id="register" action="login" method="post">
                      <h4 class="modal-title"><?php _e( 'Sign Up','backnow' ); ?></h4>
                        <div class="login-error alert alert-danger" role="alert"></div>
                        <input type="text" id="username" name="username" class="form-control" placeholder="<?php _e( 'Username','backnow' ); ?>">
                        <input type="text" id="email" name="email" class="form-control" placeholder="<?php _e( 'Email','backnow' ); ?>">
                      <input type="text" id="email" name="Re-Enter email" class="form-control" placeholder="<?php _e( 'Re-Enter email','backnow' ); ?>">
                        <input type="password" id="password" name="password" class="form-control" placeholder="<?php _e( 'Password','backnow' ); ?>">
                      <input type="password" id="password" name="re-password" class="form-control" placeholder="<?php _e( 'Re-Enter password','backnow' ); ?>">
                     <input type="checkbox" id="rememberlogin" name="remember">
                      <label style="  margin-left:20px;
  margin-top:-22px;">Receive our weekly newsletter and other occasional updates</label>
                      <input type="submit" class="btn btn-primary submit_button"  value="Create Account" name="submit">
                        <?php wp_nonce_field( 'ajax-register-nonce', 'security' ); ?>
                    </form>
                </div>
                <div class="modal-footer clearfix d-block text-left">
                    <div class="d-inline-block">
                  
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
