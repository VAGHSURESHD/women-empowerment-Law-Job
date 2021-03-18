<?php
/**
 * Optimization options
 * 
 * @since 1.0.0
 * @author Omar Badran
*/

# Add Section
$this->parent->options->add_section([
    'id'        =>  'optimization',
    'title'     =>  __('Optimization' , 'cora'),
    'icon'      =>  'flash_on',
]);

# WP Version Meta-Tag
$this->parent->options->add_field([
    'id'            =>  'wp_version_meta_tag',
    'section'       =>  'optimization',
    'title'         =>  __('WP Version Meta-Tag' , 'cora'),
    'type'          =>  'switch',
    'default'       =>  true,
]);

# WP Emoji
$this->parent->options->add_field([
    'id'            =>  'wp_emoji',
    'section'       =>  'optimization',
    'title'         =>  __('WP Emoji' , 'cora'),
    'type'          =>  'switch',
    'default'       =>  true,
]);

# WP RSS Feed
$this->parent->options->add_field([
    'id'            =>  'rss_feed',
    'section'       =>  'optimization',
    'title'         =>  __('RSS Feed' , 'cora'),
    'type'          =>  'switch',
    'default'       =>  true,
]);

# WP RSD
$this->parent->options->add_field([
    'id'            =>  'wp_rsd',
    'section'       =>  'optimization',
    'title'         =>  __('WP RSD' , 'cora'),
    'type'          =>  'switch',
    'default'       =>  true,
]);

# WP Wlwmanifest
$this->parent->options->add_field([
    'id'            =>  'wp_wlwmanifest',
    'section'       =>  'optimization',
    'title'         =>  __('WP Wlwmanifest' , 'cora'),
    'type'          =>  'switch',
    'default'       =>  true,
]);

# WP Shortlink
$this->parent->options->add_field([
    'id'            =>  'wp_shortlink',
    'section'       =>  'optimization',
    'title'         =>  __('WP Shortlink' , 'cora'),
    'type'          =>  'switch',
    'default'       =>  true,
]);

# WP oEmbed
$this->parent->options->add_field([
    'id'            =>  'wp_oEmbed',
    'section'       =>  'optimization',
    'title'         =>  __('WP oEmbed' , 'cora'),
    'type'          =>  'switch',
    'default'       =>  true,
]);

# WP XML-RPC / X-Pingback
$this->parent->options->add_field([
    'id'            =>  'wp_pingback',
    'section'       =>  'optimization',
    'title'         =>  __('WP XML-RPC / X-Pingback' , 'cora'),
    'type'          =>  'switch',
    'default'       =>  true,
]);

# WP Heartbeat
$this->parent->options->add_field([
    'id'            =>  'wp_heartbeat',
    'section'       =>  'optimization',
    'title'         =>  __('WP Heartbeat' , 'cora'),
    'type'          =>  'switch',
    'default'       =>  true,
]);

# Media SVG Support
$this->parent->options->add_field([
    'id'            =>  'svg_support',
    'section'       =>  'optimization',
    'title'         =>  __('Media SVG Support' , 'cora'),
    'type'          =>  'switch',
    'default'       =>  false,
]);

# Media ICO Support
$this->parent->options->add_field([
    'id'            =>  'ico_support',
    'section'       =>  'optimization',
    'title'         =>  __('Media ICO Support' , 'cora'),
    'type'          =>  'switch',
    'default'       =>  false,
]);
