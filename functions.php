<?php

    /**
     * Load Enqueued Scripts in the Footer
     *
     * Automatically move JavaScript code to page footer, speeding up page
     * loading time.
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

    /**
     *
     * Load theme specific CSS and JS file(s)
     */
    function morehacks_scripts () {
        wp_enqueue_style(
            "morehacksbootstrapcss",
            get_template_directory_uri() . "/bower_components/bootstrap/dist/css/bootstrap.min.css"
        );
        wp_enqueue_style(
            "morehackscss",
            get_template_directory_uri() . "/style.css"
        );
        wp_enqueue_script(
            "morehacksbootstrapjs",
            get_template_directory_uri() . "/bower_components/bootstrap/dist/js/bootstrap.min.js",
            array("jquery"),
            false,
            true
        );
        wp_enqueue_script(
            "morehacksjs",
            get_template_directory_uri() . "/morehacks.min.js",
            array("morehacksbootstrapjs"),
            false,
            true
        );
    }
    add_action("wp_enqueue_scripts", "morehacks_scripts");

    /**
     *
     * Register theme specific navigational menu
     */
    function morehacks_menu () {
        register_nav_menu(
            "main",
            "The site's main menu, displayed on the left"
        );
    }
    add_action("after_setup_theme", "morehacks_menu");

    /**
     *
     * Register portfolio custom post type
     */
    function create_project_post_type () {
        $labels = array(
            "name" => _x("Project", "post type general name", "morehacks"),
            "singular_name" => _x("Project", "post type singular name", "morehacks"),
            "menu_name" => _x("Projects", "admin menu name", "morehacks"),
            "name_admin_bar" => _x("Project", "add new on admin bar", "morehacks"),
            "add_new" => _x("Add New", "project", "morehacks"),
            "add_new_item" => __("Add New Project", "morehacks"),
            "new_item" => __("New Project", "morehacks"),
            "edit_item" => __("Edit Project", "morehacks"),
            "view_item" => __("View Project", "morehacks"),
            "all_items" => __("All Projects", "morehacks"),
            "search_items" => __("Search Projects", "morehacks"),
            "parent_item_colon" => __("Parent Projects", "morehacks"),
            "not_found" => __("No projects found.", "morehacks"),
            "not_found_in_trash" => __("No projects found in Trash.", "morehacks")
        );
        $args = array(
            "labels" => $labels,
            "public" => true,
            "menu_position" => 20,
            "has_archive" => true,
            "taxonomies" => array("category")
        );
        register_post_type(
            "project",
            $args
        );
    }
    add_action("init", "create_project_post_type");
