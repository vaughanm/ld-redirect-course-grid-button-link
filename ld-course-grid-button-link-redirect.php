<?php
/* Filter to redirect Course grid link to registration, instead of course page */
add_filter( 'learndash_course_grid_custom_button_link', function($button_link, $post_id ) {
    $ld_registration_page_id = (int) LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Section_Registration_Pages', 'registration' );
    if( ! empty( $ld_registration_page_id ) ) {
        if( ( is_user_logged_in() && !sfwd_lms_has_access( $post_id, get_current_user_id() ) ) || !is_user_logged_in() ) {
            $register_url = get_permalink( $ld_registration_page_id );
            $button_link = $register_url . '?ld_register_id=' . $post_id;
        }
    }
    
    return $button_link;
},10,2 );
