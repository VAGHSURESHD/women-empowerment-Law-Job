<?php

# Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * General Module
 * 
 * 
 * @since 1.0.0
 * @author Omar Badran
 */
class Cora_General {

    /**
     * Class constructor.
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    public function __construct( $parent ) {
        # Load Options
        $this->parent = $parent;

        require_once $this->parent->dir("modules/general/options.php");

        // add_filter('admin_footer_text',  [$this, 'footer'], PHP_INT_MAX);

        add_action('wp_dashboard_setup', [$this, 'add_dashboard_widgets']);
        add_action('admin_head', [$this, 'screen_options']);

        $post_thumbnail = $this->parent->options->get_value('general', 'post_thumbnail');

        if ( filter_var( $post_thumbnail, FILTER_VALIDATE_BOOLEAN ) ){
            add_filter('manage_posts_columns', [$this, 'add_post_admin_thumbnail_column']);
            add_action('manage_posts_custom_column', [$this, 'show_post_thumbnail_column'], 5, 2);
        }
    }

    /**
     * Screen options.
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    public function screen_options() {
        $screen_options = $this->parent->options->get_value('general', 'screen_options');

        if ( ! filter_var( $screen_options, FILTER_VALIDATE_BOOLEAN ) ){
            echo "<style>#screen-meta-links{display:none;}</style>";
        }
    }

    /**
     * Add Dashboard widgets.
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    public function add_dashboard_widgets() {
        global $wp_meta_boxes, $pagenow;
        $widgets = $this->parent->options->get_value('general', 'add_widgets');
        
        if ( is_array($widgets) ) {

            foreach ($widgets as $widget) {
                extract($widget);

                $id = str_replace('_', '-', plugin_basename( sanitize_title( $title ) ) );
                $content = do_shortcode($content);
                
                wp_add_dashboard_widget($id, $title, function () use($content) {
                    echo "<div class='cora-dashboard-widget editor-styles-wrapper'>$content</div>";
                });            
            }

        }

        if ($pagenow == 'index.php') {
            wp_enqueue_style( 'wp-block-library-theme' );
            wp_enqueue_style( 'wp-block-library' );
        }
    }

    /**
     * Footer Content.
     *
     * @since       1.0.0
     * @access      public
     * @return      string
     */
    public function footer( $content ) {
        $content = $this->parent->options->get_value('general', 'footer_text');
        $footer_info = filter_var( $this->parent->options->get_value('general', 'footer_info'), FILTER_VALIDATE_BOOLEAN );

        # Footer Info
        if ( $footer_info ) {

            $memory_limit  = (int) ini_get('memory_limit') ;
            $memory_usage = function_exists('memory_get_peak_usage') ? round(memory_get_peak_usage(TRUE) / 1024 / 1024, 2) : 0;
            $server_ip_address = (!empty($_SERVER[ 'SERVER_ADDR' ]) ? $_SERVER[ 'SERVER_ADDR' ] : "");
            
            # Added for IP Address in IIS
			if ( $server_ip_address == "" ) { 
				$server_ip_address = ( !empty($_SERVER[ 'LOCAL_ADDR' ]) ? $_SERVER[ 'LOCAL_ADDR' ] : "");
            }
            
            $content .= "<div class='cora_footer_info'>";
            # Memory Usage
            $content .= "<span> Memory :  $memory_usage of $memory_limit MB </span>";
            # PHP version
            $content .= "<span> PHP : " . PHP_VERSION . "</span>";
            # IP address
            $content .= "<span> IP : $server_ip_address (" . gethostname() . ") </span>";
            # Bit size
            $content .= "<span> @ ".  (PHP_INT_SIZE * 8) . "BitOS" ."</span>";

            $content .= "</div>";
            
        }

        return $content;
    }

    /**
     * Add the post thumbnail column.
     *
     * @since       1.0.0
     * @access      public
     * @return      array
     */
    public function add_post_admin_thumbnail_column( $columns ){
        global $post_type;

        if ( $post_type == 'post') {
            $columns['cora-thumb'] = '<span class="cora-thumb-icon">'. __('Image', 'cora') .'</span>';
        }
        
        return $columns;
    }

        
    /**
     * Show post thumbnail.
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    public function show_post_thumbnail_column( $columns, $id ){
        switch( $columns ){
            case 'cora-thumb':
                if( function_exists('the_post_thumbnail') ){
                    echo the_post_thumbnail( 'thumbnail' );
                }
                else {
                    echo __('your theme doesn\'t support featured image', 'cora');
                }
            break;
        }
    }

}