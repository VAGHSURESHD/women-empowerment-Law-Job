<?php

# Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Menu Module
 * 
 * 
 * @since 1.0.0
 * @author Omar Badran
 */
class Cora_Menu {

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

        require_once $this->parent->dir("modules/menu/options.php");

        add_action('admin_menu', [$this, "build_menu"], PHP_INT_MAX);
        add_filter('adminmenu', [$this, "branding"]);
    }

    /**
     * Build Menu.
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    public function build_menu () {
        global $menu, $admin_page_hooks, $_registered_pages, $_parent_pages;

        $this->update_if_necessary();

        $items = $this->parent->options->get_value('menu', 'items', []);

        # Build the menu

        foreach ( $items as $v ) {
            extract( $v );

            # Default item
            if ( $type == 'default' ){
                $item = $info;
                $item[0] = $title;
            }
            
            # Link item
            if ( $type == 'link' ) {
                $url = isset($url) ? $url : '#';
                $item = [$title, 'read', $url, $title, 'menu-top menu-top-first', ''];
            }
            
            # Page item
            if ( $type == 'page' ) {

                $menu_slug = 'custom-page-' . plugin_basename( sanitize_title( $title ) );
                $admin_page_hooks[ $menu_slug ] = sanitize_title( $title );
                $hookname = get_plugin_page_hookname( $menu_slug, '' );

                $page_content =  "<div class='wrap cora-custom-page editor-styles-wrapper'>
                    <h1>$title</h1>
                    $page_content
                </div>";
                
                add_action( $hookname, function() use($title, $page_content) {
                    wp_enqueue_style( 'wp-block-library-theme' );
                    wp_enqueue_style( 'wp-block-library' );
                            
                    echo do_shortcode($page_content);
                });
                
                $item = [$title, 'read', $menu_slug, $title, 'menu-top menu-top-first', $hookname];

                $_registered_pages[ $hookname ] = true;
            }
            
            # Custom Icon
            if ( isset($v['custom_icon']) ) {
                $item[6] = 'dashicons-cora-' . $v['custom_icon'];
            }

            # Check user role first, then add the item.
            if ( ! ( isset($v['hide_for']) && in_array( wp_get_current_user()->roles[0], (array) $v['hide_for']) ) ) {
                $res[] = $item;
            }
        }

        # Change
        $menu = $res;
    }

    /**
     * Get Menu Items
     * 
     * Get an array of current menu items to be used in the repeater field.
     *
     * @since       1.0.0
     * @access      public
     * @return      array
     */
    public function get_menu_items () {
        global $menu;

        # Remove separators
        $menu = array_filter($menu, function($v){
            return strpos( $v[4], 'wp-menu-separator' ) === false;
        });

        # Remove links manager
        $menu = array_filter($menu, function($v){
            return $v[1] !== 'manage_links';
        });
        
        # Remove HTML from the item name
        array_walk($menu, function(&$item){
            $item[0] = preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $item[0]);
        });

        # Create the array
        $res = array_map(function($item) {
            return [
                'type'      =>   'default',
                'title'     =>   $item[0],
                'info'      =>   $item,
            ];
        }, $menu);

        # Sort by key
        ksort($res);
        
        return array_values($res);
    }

    /**
     * Update if necessary.
     * 
     * Compare saved menu items with the current ones (before modifying) to see if new
     * items were added or removed. In case the user has enabled/disabled some plugins.
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    public function update_if_necessary () {
        $should_update = false;

        $original = $this->get_menu_items();
        $original_info = array_column($original, 'info');
        
        $saved = $this->parent->options->get_value('menu', 'items', []);
        $saved_info = array_column($saved, 'info');

        # Detect new items
        if( $original !== $saved ){
            foreach ( $original as $k => $v ) {
                $is_new = $v['type'] == 'default' && !in_array($v['info'][5], array_column($saved_info, array_keys($saved_info)[5]) );
    
                if ( $is_new ) {
                    $saved[] = $v;
                    $should_update = true;
                }
            }
        }

        # Removed missing items
        foreach ( $saved as $k => $v ) {
            $missing = $v['type'] == 'default' && !in_array($v['info'][5], array_column($original_info, array_keys($original_info)[5]) );
            
            if ($missing) {
                $should_update = true;
                unset($saved[$k]);
            }
        }

        # Update
        if( $should_update ){
            $this->parent->options->update_value('menu', 'items', array_values($saved));
        }
    }

    /**
     * Get Roles.
     * 
     * Get an array current menu items to be used in the repeater field.
     *
     * @since       1.0.0
     * @access      public
     * @return      array
     */
    public function get_roles () {
        if ( ! function_exists( 'get_editable_roles' ) ) {
            require_once ABSPATH . 'wp-admin/includes/user.php';
        }
        
        $editable_roles = get_editable_roles();

        foreach ($editable_roles as $role => $details) {
            $sub['id'] = esc_attr($role);
            $sub['text'] = translate_user_role($details['name']);
            
            $roles[] = $sub;
        }

        return $roles;
    }

    /**
     * Branding.
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    public function branding () {
        $show_logo = $this->parent->options->get_value('menu', 'show_logo');
        $logo_type = $this->parent->options->get_value('menu', 'logo_type');
        $logo = $this->parent->options->get_value('menu', 'logo', '');
        $logo_width = $this->parent->options->get_value('menu', 'logo_width');
        $logo_width .= 'px';

        $name = get_bloginfo();

        if ( ! filter_var( $show_logo, FILTER_VALIDATE_BOOLEAN ) ) {
            return;
        }

        if ( $logo_type == 'logo' ) {
            echo "<li class='cora-branding'> <img src='$logo' width='$logo_width'/> </li>";
        } else {
            echo "<li class='cora-branding'>$name</li>";
        }
    }

}