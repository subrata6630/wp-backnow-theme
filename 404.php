<?php get_header('alternative');
/*
*Template Name: 404 Page Template
*/
?>


<div class="backnow-error-wrapper" style="background-image: url(<?php echo esc_url( get_theme_mod('errorlogo', '')); ?>)">
    <div class="container">
        <div class="info-wrapper">
            <h2 class="error-message-title">
                <?php  echo esc_html(get_theme_mod( '404_title', esc_html__('404', 'backnow') )); ?>
            </h2>
            <p class="error-message">
                <?php  echo esc_html(get_theme_mod( '404_description', esc_html__('Oops! you’ve encountered an error!', 'backnow') )); ?>
            </p>
            <a class="btn btn-backnow white" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php  esc_html_e( 'HOME', 'backnow' ); ?>">
                <?php  echo esc_html(get_theme_mod( '404_btn_text', esc_html__('Go Home', 'backnow') )); ?>
            </a>
        </div>
    </div>
</div>
<?php get_footer('alternative'); ?>
