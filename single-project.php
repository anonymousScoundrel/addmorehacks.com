<?php

    get_header();
    get_search_form();

    wp_nav_menu(
        array(
            "theme_location" => "main"
        )
    );

    if (have_posts()) :
        while (have_posts()) :
            the_post();
            //loop content (template tags, html, etc)
            the_title();
            the_author();
            the_time();
            the_content();

        endwhile;
    endif;

    get_footer();

?>

