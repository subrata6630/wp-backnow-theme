<?php 
    $col = get_theme_mod( 'bottom_column', 3 );
    $enable_bottom_section  = get_theme_mod( 'enable_bottom_section', true );
    $enable_mailchimp       = get_theme_mod( 'enable_mailchimp', true ); ?>


    <?php if ($enable_bottom_section == 'true'): ?>
    <div class="bottom footer-wrap">
        <div class="container bottom-footer-cont">
            <div class="row clearfix">

                <!-- Without MailChimp -->
                <?php if ($enable_mailchimp == 'false'){ ?>
                    <?php if (is_active_sidebar('bottom1')):?>
                    <div class="bottom-wrap col-sm-6 col-lg-<?php echo esc_attr($col);?>">
                        <?php dynamic_sidebar('bottom1'); ?>
                    </div>
                    <?php endif; ?> 
                    <?php if (is_active_sidebar('bottom2')):?>
                        <div class="bottom-wrap col-sm-6 col-lg-<?php echo esc_attr($col);?>">
                            <?php dynamic_sidebar('bottom2'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('bottom3')):?>
                    <div class="bottom-wrap col-sm-6 col-lg-<?php echo esc_attr($col);?>">
                        <?php dynamic_sidebar('bottom3'); ?>
                    </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('bottom4')):?>
                    <div class="bottom-wrap col-sm-6 col-lg-<?php echo esc_attr($col);?>">
                        <?php dynamic_sidebar('bottom4'); ?>
                    </div><!-- End -->
                    <?php endif; ?>
                <?php }else{ ?>

                <!-- With MailChimp -->
                <div class="col-lg-8">
                    <div class="row">
                        <?php if (is_active_sidebar('bottom1')):?>
                            <div class="bottom-wrap col-sm-6 col-lg-<?php echo esc_attr($col);?>">
                                <?php dynamic_sidebar('bottom1'); ?> 
                            </div>
                        <?php endif; ?> 
                        <?php if (is_active_sidebar('bottom2')):?>
                            <div class="bottom-wrap col-sm-6 col-lg-<?php echo esc_attr($col);?>">
                                <?php dynamic_sidebar('bottom2'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (is_active_sidebar('bottom3')):?>
                            <div class="bottom-wrap col-sm-6 col-lg-<?php echo esc_attr($col);?>">
                                <?php dynamic_sidebar('bottom3'); ?>
                            </div>
                        <?php endif; ?>   
                        <?php if (is_active_sidebar('bottom4')):?>
                            <div class="bottom-wrap col-sm-6 col-lg-<?php echo esc_attr($col);?>">
                                <?php dynamic_sidebar('bottom4'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- mailchil-container start -->
                <?php if (is_active_sidebar('bottom5')):?>
                    <div class="col-lg-4 mailchimp-inner bottom-wrap">
                        <div class="mailchil-container">
                                <?php  
                                    $mailchimp = get_theme_mod( 'mailchimp_img', get_parent_theme_file_uri().'/images/mail-icon.png' );
                                    if( !empty($mailchimp) ) { ?>
                                        <img class="enter-logo img-responsive" alt="logo" src="<?php echo esc_url( $mailchimp ); ?>" >
                                    <?php }
                                 ?>
                                <?php dynamic_sidebar('bottom5'); ?>
                            
                        </div>
                    </div>
                <?php endif; ?>
                <!-- mailchimp end --> 
                <?php } ?>

            </div>
        </div>
    </div><!--/#footer-->
    <?php endif ?>

    <?php if ( get_theme_mod( 'enable_footer_en', true )) { ?>
    <!-- start footer -->
    <footer id="footer"> 
        <div class="container">
            <div class="footer-copyright">
                <div class="row">  
                    <div class="col-md-6 text-left copy-wrapper">
                        <?php 
                        $footerlogo = get_theme_mod( 'footerlogo', get_parent_theme_file_uri().'/images/footer-logo.png' );
                        if( !empty($footerlogo) ) {?>
                            <img class="enter-logo img-responsive" src="<?php echo esc_url( $footerlogo ); ?>" alt="<?php  esc_html_e( 'Logo', 'backnow' ); ?>" title="<?php  esc_html_e( 'Logo', 'backnow' ); ?>">
                        <?php } ?>
                        <?php if( get_theme_mod( 'copyright_en', true ) ) { ?>
                                <span><?php echo wp_kses_post( get_theme_mod( 'copyright_text', '© 2018 backnow. All Rights Reserved.') ); ?></span>
                        <?php } ?>
                    </div> <!-- end row -->
                    <div class="col-md-6 text-right copy-wrapper">
                        <?php if( get_theme_mod( 'socialshare_en', true ) ) { ?>
                        <?php get_template_part('lib/social-link')?>
                        <?php } ?>
                    </div> <!-- end row -->
                </div> <!-- end row -->
            </div> <!-- end row --> 
        </div> <!-- end container -->
    </footer>
    <!-- End footer -->
    <?php } ?>

</div> <!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
