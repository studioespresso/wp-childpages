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
                __( 'Child pages', 'wp-childpages' ), // Name
                array( 'description' => __( 'Lists the child pages of the current page', 'wp-childpages' ), ) // Args
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




            $postid = get_the_ID();
            $args = array(
                'child_of'      => $postid,
                'authors'       => '',
                'date_format'   => get_option('date_format'),
                'depth'         => $instance['depth'],
                'echo'          => 0,
                'exclude'       => '',
                'include'       => '',
                'link_after'    => '',
                'link_before'   => '',
                'post_type'     => 'page',
                'post_status'   => 'publish',
                'show_date'     => '',
                'sort_column'   => 'menu_order',
                'sort_order'    => '',
                'title_li'      => __(''),
	            'link_before'   => '',
	            'link_after'    => ''
            );
            $subpages = wp_list_pages( $args );


            if( count( $subpages ) != 0 ) {


                // The widget title
                $title = apply_filters('widget_title', $instance['title']);
                $before_title = "<h2 class='widget-title'>";
                $after_title = "</h2>";
                ?>
                <aside id="wp-childpages" class="widget wp-childpages widget_pages">
                    <?php if ( $title ) echo $before_title . $title . $after_title; ?>
                    <ul class="<?php echo (isset($instance['menu-class'])) ? $instance['menu-class'] : '' ?>">
	                <?php echo $subpages; ?>
                    </ul>
                </aside>
            <?php
            }

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
            $instance['menu-class'] = strip_tags( $new_instance['menu-class'] );
            $instance['item-class'] = strip_tags( $new_instance['item-class'] );
            $instance['depth'] = strip_tags( $new_instance['depth'] );
            return $instance;
        }

        /**
         * Render the widget form in the Dashboard
         * @param $instance
         */
        function form($instance) {
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'wp-childpages'); ?></label>
                <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'menu-class' ); ?>"><?php _e('Menu class', 'wp-childpages'); ?></label>
                <input id="<?php echo $this->get_field_id( 'menu-class' ); ?>" name="<?php echo $this->get_field_name( 'menu-class' ); ?>" value="<?php echo $instance['menu-class']; ?>" style="width:50%;" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'item-class' ); ?>"><?php _e('Item class', 'wp-childpages'); ?></label>
                <input id="<?php echo $this->get_field_id( 'item-class' ); ?>" name="<?php echo $this->get_field_name( 'item-class' ); ?>" value="<?php echo $instance['item-class']; ?>" style="width:50%;" />
            </p>
	        <p>
                <label for="<?php echo $this->get_field_id( 'depth' ); ?>"><?php _e('Depth', 'wp-childpages'); ?></label>
                <input id="<?php echo $this->get_field_id( 'depth' ); ?>" name="<?php echo $this->get_field_name( 'depth' ); ?>" value="<?php echo $instance['depth']; ?>" style="width:100%;" type="number" max="10" min="0" />
		        <em><?php _e('Set to 0 to show all subpages', 'wp-childpages'); ?></em>
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