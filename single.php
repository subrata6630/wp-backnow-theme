<?php get_header(); ?>
<section id="main" class="page-content">
    <div class="container">
        <div class="row">
        <?php  
        if(get_theme_mod('blog_single_sidebar', true)) {
            $s_col = '9';
        }else{
            $s_col = '12';
        }
         ?>
            <div id="content" class="site-content col-md-<?php echo esc_attr($s_col); ?> blog-content-wrapper" role="main">
                <?php if ( have_posts() ) :  ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php
                            get_template_part( 'post-format/content', get_post_format() );
                        ?>
                        <?php if(get_theme_mod('blog_single_author', false)):  ?>
                            <div class="backnow-single-post-author clearfix">
                                <?php echo get_avatar( $post, 60 ); ?>
                                <div class="backnow-author-meta-data">
                                    <strong><?php echo get_the_author_meta('display_name'); ?></strong>
                                    <?php echo wpautop(get_the_author_meta('description')); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php
                            if ( is_singular( 'post' ) ){
                                $count_post = esc_attr( get_post_meta( $post->ID, '_post_views_count', true) );
                                if( $count_post == ''){
                                    $count_post = 1;
                                    add_post_meta( $post->ID, '_post_views_count', $count_post);
                                }else{
                                    $count_post = (int)$count_post + 1;
                                    update_post_meta( $post->ID, '_post_views_count', $count_post);
                                }
                            }
                        ?>
                        <div class="entry-content entry-content-page  clearfix">
                            <?php
                                wp_link_pages( array(
                                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'backnow' ) . '</span>',
                                    'after'       => '</div>',
                                    'link_before' => '<span>',
                                    'link_after'  => '</span>',
                                ) ); 
                            ?>
                        </div>
                        <?php
                            if ( get_theme_mod( 'blog_single_comment_en', true ) ) {
                                if ( comments_open() || get_comments_number() ) {
                                    comments_template();
                                }
                            }
                        ?>
                    <?php endwhile; ?>
                <?php else: ?>
                <?php get_template_part( 'post-format/content', 'none' ); ?>
                <?php endif; ?>
                <div class="clearfix"></div>
            </div> <!-- #content -->
            <?php if(get_theme_mod('blog_single_sidebar', true)) {
                get_sidebar( );
            }  ?>
        </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- #main -->

<?php get_footer();
