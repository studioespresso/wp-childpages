<?php
    /**
    * Example Widget Class
    */
    class Subpages_Widget extends WP_Widget {

        /**
         * Register widget with WordPress.
         */
        function __construct() {
            parent::__construct(
                'subpages_widget', // Base ID
                __( 'Subpages', 'text_domain' ), // Name
                array( 'description' => __( 'A Foo Widget', 'text_domain' ), ) // Args
            );
        }
        
    }

    // register Foo_Widget widget
    function register_subpages_widget() {
        register_widget( 'Subpages_Widget' );
    }
    add_action( 'widgets_init', 'register_subpages_widget' );