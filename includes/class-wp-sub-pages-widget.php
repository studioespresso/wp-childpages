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


        /**
         * Display the widget
         * @param $args
         * @param $instance
         */
        function widget($args, $instance)
        {
            extract($args);

            // The widget title
            $title = apply_filters('widget_title', $instance['title']);
            $before_title = "<div class='widget-title'>";
            $after_title = "</div>";
            ?>
            <aside id="wp-sub-pages" class="widget wp-sub-pages">
                <?php if ( $title ) echo $before_title . $title . $after_title; ?>
            </aside>
            <?php
        }


        /**
         * Update the widget
         * @param $new_instance
         * @param $old_instance
         * @return mixed
         */
        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title'] = strip_tags( $new_instance['title'] );
            return $instance;
        }

        /**
         * Render the widget form in the Dashboard
         * @param $instance
         */
        function form($instance) {

            //Set up some default widget settings.
            $defaults = array( 'title' => __('Our sponsors', 'wp-sponsors'), 'check_images' => 'on' , 'category' => 'All'); ?>

            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'wp-sponsors'); ?></label>
                <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
            </p>
        <?php }

    }

    /**
     * Register the widget
     */
    function register_subpages_widget() {
        register_widget( 'Subpages_Widget' );
    }
    add_action( 'widgets_init', 'register_subpages_widget' );