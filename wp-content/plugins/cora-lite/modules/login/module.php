<?php

# Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Login Module
 * 
 * 
 * @since 1.0.0
 * @author Omar Badran
 */
class Cora_Login {
    
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

        require_once $this->parent->dir("modules/login/options.php");
                
        # Enqueu assets
        add_action( 'login_enqueue_scripts', [$this->parent, "styles"] );
        add_action( 'login_enqueue_scripts', [$this, "scripts"] );

        add_filter( 'login_body_class', [$this  , "body_class"] );
        add_action( 'login_enqueue_scripts', [$this  , "vars"] );
    }

    /**
     * Enqueue scripts.
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    public function scripts() {
        wp_enqueue_script('jquery');

        # Login
        wp_enqueue_script( 
            'cora-login',
            $this->parent->url( "modules/login/assets/js/login.js" )
        );
    }

    /**
     * Body class.
     *
     * @since       1.0.0
     * @access      public
     * @return      array
     */
    public function body_class ( $classes ) {
        $layout = $this->parent->options->get_value('login', 'layout', 'standard');
        $classes[] = 'cora-' . esc_attr($layout);
        
        return $classes;
    }

    /**
     * Localize vars.
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    public function vars () {
        $data = $this->parent->options->get_values()['login'];
        $data['site_name'] = get_bloginfo();

        wp_localize_script(
            'cora-login',
            'CoraLogin',
            $data
        );
    }

}