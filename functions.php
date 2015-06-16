<?php

    /**
     * Load Enqueued Scripts in the Footer
     *
     * Automatically move JavaScript code to page footer, speeding up page loading time.
     */
    function footer_enqueue_scripts() {
        remove_action('wp_head', 'wp_print_scripts');
        remove_action('wp_head', 'wp_print_head_scripts', 9);
        remove_action('wp_head', 'wp_enqueue_scripts', 1);
        add_action('wp_footer', 'wp_print_scripts', 5);
        add_action('wp_footer', 'wp_enqueue_scripts', 5);
        add_action('wp_footer', 'wp_print_head_scripts', 5);
    }
    add_action('after_setup_theme', 'footer_enqueue_scripts');

    function morehacks_scripts () {
        wp_enqueue_style(
            "morehackscss",
            get_template_directory_uri() . "/style.css"
        );
        wp_enqueue_script(
            "morehacksjs",
            get_template_directory_uri() . "/morehacks.min.js",
            array("jquery"),
            false,
            true
        );
    }
    add_action("wp_enqueue_scripts", "morehacks_scripts");
