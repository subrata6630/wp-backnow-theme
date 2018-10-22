<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $wp_query;
$big = 999999;
$page_numb = max( 1, get_query_var('paged') );

$max_page = $wp_query->max_num_pages; ?>

<div class="wpneo-pagination">
    <?php
        echo paginate_links( array(
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'    => '?paged=%#%',
            'current'   => $page_numb,
            'total'     => $max_page,
            'type'      => 'list',
            'prev_text' => __('Prev', 'backnow'),
            'next_text' => __('Next', 'backnow'),
        ) );
    ?>
</div>