<?php

# Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Toolbar Module
 * 
 * 
 * @since 1.0.0
 * @author Omar Badran
 */
class Cora_Toolbar {

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

        require_once $this->parent->dir("modules/toolbar/options.php");

        add_action( 'admin_bar_menu', [ $this, 'edit_toolbar'], 999);
    }

    /**
     * Edit Toolbar Items.
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    public function edit_toolbar( $wp_admin_bar ) {
        $add_items  =   $this->parent->options->get_value('toolbar', 'add_items', false);

        # Remove Items
        foreach ($this->parent->options->fields as $field) {
            if ( $field['type'] == 'switch' && $field['section'] == 'toolbar') {
                $value = $this->parent->options->get_value('toolbar', $field['id']);
                                
                if ( !filter_var( $value, FILTER_VALIDATE_BOOLEAN ) ) {
                    $wp_admin_bar->remove_node( str_replace('_', '-', $field['id']) );
                }
            }
        }

        # Add Items
        if ( isset($add_items) && ! empty($add_items) ) {
            foreach ($add_items as $item) {
                $item['id'] = plugin_basename( sanitize_title( $item['title'] ) );
                
                if( $item['new_tab'] ) {
                    $item['meta']['target'] = '_blank';
                }

                $wp_admin_bar->add_node($item);
            }
        }
    }

}