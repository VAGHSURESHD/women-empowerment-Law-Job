<?php

# Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Optimization Module
 * 
 * 
 * @since 1.0.0
 * @author Omar Badran
 */
class Cora_Optimization {
    
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

        require_once $this->parent->dir("modules/optimization/options.php");

        extract( $this->parent->options->get_values()['optimization'] );

        # Filter returned booleans
        $filter = function ($var) {
            return filter_var( $var, FILTER_VALIDATE_BOOLEAN );
        };

        # WP Version Meta-Tag
        if ( !$filter($wp_version_meta_tag) ) {
            $this->disable_wp_version_meta_tag();
        }

        # WP Emoji
        if ( !$filter($wp_emoji) ) {
            $this->disable_wp_emoji();
        }

        # RSS Feed
        if ( !$filter($rss_feed) ) {
            $this->disable_rss_feed();
        }
        
        # WP RSD
        if ( !$filter($wp_rsd) ) {
            remove_action( 'wp_head', 'rsd_link' );
        }

        # WP wlwmanifest
        if ( !$filter($wp_wlwmanifest) ) {
            remove_action( 'wp_head', 'wlwmanifest_link' );
        }

        # WP shortlink
        if ( !$filter($wp_shortlink) ) {
            remove_action( 'wp_head', 'wp_shortlink_wp_head' );
        }
        
        # WP OEmbed
        if ( !$filter($wp_oEmbed) ) {
            $this->disable_wp_oEmbed();
        }

        # WP pingback
        if ( !$filter($wp_pingback) ) {
            add_filter( 'xmlrpc_methods', function( $methods ) {
                unset( $methods['pingback.ping'] );
                return $methods;
            });

            add_action('wp', function() {
                header_remove('X-Pingback');
            }, 1000);            
        }

        # WP OEmbed
        if ( !$filter($wp_oEmbed) ) {
            $this->disable_wp_oEmbed();
        }
        
        # WP Heartbeat
        if ( !$filter($wp_heartbeat) ) {
            add_action( 'init', function () {
                wp_deregister_script('heartbeat');
            }, 1);
        }

        # WP SVG Support
        if ( $filter($svg_support) ) {
            $this->enable_svg_support();
        }
        
        # WP ICO Support
        if ( $filter($ico_support) ) {
            add_filter( 'wp_mime_type_icon', function( $icon, $mime, $post_id ) {
                if( $src = false || 'image/x-icon' === $mime && $post_id > 0 ){
                    $src = wp_get_attachment_image_src( $post_id );
                }
            
                return is_array( $src ) ? array_shift( $src ) : $icon;
            }, 10, 3);             
        }
    }

    /**
     * Disable WP Version Meta-Tag
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    public function disable_wp_version_meta_tag() {
        add_filter('the_generator', '__return_empty_string');
        remove_action('wp_head', 'wp_generator');
    }

    /**
     * Disable WP Emoji.
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    public function disable_wp_emoji() {
        add_action( 'init', function () {
            remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
            remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
            remove_action( 'wp_print_styles', 'print_emoji_styles' );
            remove_action( 'admin_print_styles', 'print_emoji_styles' );
            remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
            remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
            remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

            add_filter( 'tiny_mce_plugins', [$this, 'disable_emojis_tinymce'] );
            add_filter( 'wp_resource_hints', [$this, 'disable_emojis_remove_dns_prefetch'], 10, 2 );
        });
    }

    /**
     * Filter function used to remove the tinymce emoji plugin.
     *
     * @since       1.0.0
     * @access      public
     * @return      array
     */
    public function disable_emojis_tinymce( $plugins ) {
        if ( is_array( $plugins ) ) {
            return array_diff( $plugins, ['wpemoji'] );
        } else {
            return [];
        }
    }
   
    /**
     * Remove emoji CDN hostname from DNS prefetching hints.
     *
     * @since       1.0.0
     * @access      public
     * @return      array
     */
    public function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
        if ( $relation_type == 'dns-prefetch' ) {
            $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
            $urls = array_diff( $urls, [ $emoji_svg_url ] );
        }

        return $urls;
    }

    /**
     * Disable RSS Feed.
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    public function disable_rss_feed() {
        $disable_feeds = function () {
            wp_redirect( home_url() );
            die;
        };
        
        # Disable global RSS, RDF & Atom feeds.
        add_action( 'do_feed',      $disable_feeds, -1 );
        add_action( 'do_feed_rdf',  $disable_feeds, -1 );
        add_action( 'do_feed_rss',  $disable_feeds, -1 );
        add_action( 'do_feed_rss2', $disable_feeds, -1 );
        add_action( 'do_feed_atom', $disable_feeds, -1 );
        
        # Disable comment feeds.
        add_action( 'do_feed_rss2_comments', $disable_feeds, -1 );
        add_action( 'do_feed_atom_comments', $disable_feeds, -1 );
        
        # Prevent feed links from being inserted in the <head> of the page.
        add_action( 'feed_links_show_posts_feed',    '__return_false', -1 );
        add_action( 'feed_links_show_comments_feed', '__return_false', -1 );
        remove_action( 'wp_head', 'feed_links',       2 );
        remove_action( 'wp_head', 'feed_links_extra', 3 );
    }

    /**
     * Disable WP oEmbed
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    public function disable_wp_oEmbed() {
        add_action('init', function (){
            remove_action( 'rest_api_init', 'wp_oembed_register_route' );
            remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
            remove_action( 'wp_head', 'wp_oembed_add_host_js' );

            add_filter( 'embed_oembed_discover', '__return_false' );
            add_filter( 'tiny_mce_plugins', [$this, 'disable_embeds_tiny_mce_plugin'] );
            add_filter( 'rewrite_rules_array', [$this, 'disable_embeds_rewrites'] );

            remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
            remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );
        }, 9999);
    }
    
    /**
     * Disable oEmbed tinyMCE plugin
     *
     * @since       1.0.0
     * @access      public
     * @return      array
     */
    function disable_embeds_tiny_mce_plugin ($plugins) {
        return array_diff($plugins, ['wpembed']);
    }

    /**
     * Disable oEmbed Rewrites
     *
     * @since       1.0.0
     * @access      public
     * @return      array
     */
    function disable_embeds_rewrites($rules) {
        foreach($rules as $rule => $rewrite) {
            if(false !== strpos($rewrite, 'embed=true')) {
                unset($rules[$rule]);
            }
        }

        return $rules;
    }
    
    /**
     * Enable SVG Support
     *
     * @since       1.0.0
     * @access      public
     * @return      void
     */
    function enable_svg_support() {
        add_filter('upload_mimes', function ($filterile_types) {
            $new_filetypes = [];
            $new_filetypes['svg'] = 'image/svg+xml';
            $filterile_types = array_merge($filterile_types, $new_filetypes );
        
            return $filterile_types;        
        });
    }
    
}