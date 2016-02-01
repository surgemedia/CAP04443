<?php 
function create_design_page(){
// debug(get_page_by_title('Design Review'));
if( get_page_by_title('Design Review') == false ) {
    $new_page_id =  wp_insert_post(array(
        'post_type' => 'page',
        'post_title' => 'Design Review',
        'post_name' => 'design-review',
        'comment_status' => 'closed',
            'ping_status'    => 'closed',
            'post_content'   => '',
            'post_status'    => 'publish',
    ));
    if ( $new_page_id && ! is_wp_error( $new_page_id ) ){
            update_post_meta( $new_page_id, '_wp_page_template', 'template-design-review.php' );
       }
    }
}
// }
// }
// register_activation_hook('/content', 'create_design_page');