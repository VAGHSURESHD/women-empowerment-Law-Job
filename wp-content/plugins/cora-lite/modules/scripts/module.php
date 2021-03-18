<?php

# Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Scripts Module
 * 
 * 
 * @since 1.0.0
 * @author Omar Badran
 */
class Cora_Scripts {
    
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

        require_once $this->parent->dir("modules/scripts/options.php");

        add_action( 'admin_head', [$this, 'admin_scripts'] );
        add_action( 'wp_head', [$this, 'frontend_scripts'] );
        add_action( 'login_head', [$this, 'login_scripts'] );
    }

    /**
     * Admin Scripts.
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    public function admin_scripts() {
        $scripts = $this->parent->options->get_value('scripts', 'admin_scripts');

        if ( is_array($scripts) ) {
            foreach ($scripts as $script) {
                extract( $script );
                $tag = ($type == 'css') ? 'style' : 'script';

                echo "<$tag>$content</$tag>";
            }
        }
    }

    /**
     * Front end Scripts.
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    public function frontend_scripts() {
        $scripts = $this->parent->options->get_value('scripts', 'frontend_scripts');

        if ( is_array($scripts) ) {
            foreach ($scripts as $script) {
                extract( $script );
                $tag = ($type == 'css') ? 'style' : 'script';

                echo "<$tag>$content</$tag>";
            }
        }
    }

    /**
     * Login Scripts.
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    public function login_scripts() {
        $scripts = $this->parent->options->get_value('scripts', 'login_scripts');

        if ( is_array($scripts) ) {
            foreach ($scripts as $script) {
                extract( $script );
                $tag = ($type == 'css') ? 'style' : 'script';

                echo "<$tag>$content</$tag>";
            }
        }
    }

}