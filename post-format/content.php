<article id="post-<?php the_ID(); ?>" <?php if( !is_single()) post_class('backnow-post themeum-grid-post'); ?> <?php if(is_single()){ post_class('backnow-post themeum-grid-post single-post');} ?>>
    <?php if ( has_post_thumbnail() ){ ?>
    <div class="blog-details-img">
        <?php if(!is_single()) : ?>
        <a href="<?php echo esc_url(get_the_permalink()); ?>">
            <?php endif; ?>
            <?php the_post_thumbnail('backnow-large', array('class' => 'img-fluid')); ?>
            <?php if(!is_single()) : ?>
        </a>
        <?php endif; ?>
    </div>
    <?php } ?>
    <div class="themeum-post-grid-title clearfix">
        <?php if(!is_single() && has_post_thumbnail()) : ?>
        <div class="themeum-grid-post-avater">
            <?php echo get_avatar( get_the_author_meta( 'ID' ) , 50 );?>
        </div>
        <?php endif; ?>

        <?php if(!is_single() && get_theme_mod('blog_date', true)) : ?>
        <div class="backnow-date-meta">
            <div class="backnow-date-meta">
                <time datetime="<?php echo get_the_date('Y-m-d') ?>"><?php echo get_the_date(); ?></time>
            </div>
        </div>
        <?php endif; ?>
        <?php if(is_single()){ ?>
        <div class="thm-post-meta">
            <?php if(get_theme_mod('blog_single_comment', true)) : ?>
                <div class="comments">
                    <i class="fa fa-comments"></i>
                    <?php comments_number( '0', '1', '%' ); ?>
                </div>
            <?php endif; ?>
            <?php if(get_theme_mod('blog_single_date', true)) : ?>
                <div class="date">
                    <i class="fa fa-clock-o"></i>
                    <?php echo get_the_date().' '; echo get_the_time(); ?>
                </div>     
            <?php endif; ?>
            <?php if(get_theme_mod('blog_single_category', true)) : ?>
                <div class="cat-list">
                    <?php if(get_the_category_list()) : ?>
                        <i class="fa fa-folder-open-o"></i>
                    <?php endif; ?>
                    <?php printf(esc_html__('%s', 'backnow'), get_the_category_list(', ')); ?>
                </div> 
            <?php endif; ?>      
            <?php if(get_theme_mod('blog_single_tag', true)) : ?>
                <div class="tag-list">
                    <?php if(get_the_tag_list()) : ?>
                        <i class="fa fa-tags"></i>
                    <?php endif; ?>
                    <?php echo get_the_tag_list('',', ',''); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php } ?>
        <h2 class="content-item-title">
            <?php if(!is_single()) : ?>
            <a href="<?php esc_url(the_permalink()); ?>">
                <?php endif; ?>
                <?php the_title(); ?>
                <?php if(!is_single()) : ?>
            </a>
            <?php endif; ?>
        </h2>
    </div>

    <div class="entry-blog">
        <?php if( !is_single() ){ ?>
            <?php get_template_part( 'post-format/entry-content' ); ?>
        <?php } else {  ?>
        <div class="thm-single-post-content">
            <div class="thm-single-post-content-inner">
                <?php the_content(); ?>
            </div>
            <?php include( get_parent_theme_file_path('post-format/social-buttons.php') ); ?>
        </div>
        <?php } ?>
    </div>

</article>