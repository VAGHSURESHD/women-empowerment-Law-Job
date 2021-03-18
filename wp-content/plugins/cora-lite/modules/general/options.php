<?php
/**
 * General options
 * 
 * @since 1.0.0
 * @author Omar Badran
*/

# Add Section
$this->parent->options->add_section([
    'id'        =>  'general',
    'title'     =>  __('General', 'cora'),
    'icon'      =>  'dns',
]);


# Add Dashboard Widgets
$this->parent->options->add_field([
    'id'            =>  'add_widgets',
    'section'       =>  'general',
    'title'         =>  __('Dashboard Widgets', 'cora'),
    'type'          =>  'repeater',
    'description'   =>  __('Easily add custom dashboard widgets.', 'cora'),
    'fields'        =>  [
        [
            'id'        =>  'title',
            'title'     =>  __('Title', 'cora'),
            'type'      =>  'text',
        ],
        [
            'id'    =>  'content',
            'title' =>  __('Content', 'cora'),
            'type'  =>  'editor',
        ],
    ],
    'new_item_default'  =>  [
        'title'         =>  __('Custom Widget', 'cora'),
        'content'       =>  ''
    ]
]);

# Footer Text
$this->parent->options->add_field([
    'id'            =>  'footer_text',
    'section'       =>  'general',
    'title'         =>  __('Footer Text', 'cora'),
    'type'          =>  'textarea',
    'default'       =>  __('Thank you for creating with WordPress.', 'cora'),
    'description'   =>  __('Change the default admin footer text.', 'cora'),
]);

# Footer info
$this->parent->options->add_field([
    'id'            =>  'footer_info',
    'section'       =>  'general',
    'title'         =>  __('Footer Information', 'cora'),
    'type'          =>  'switch',
    'description'   =>  __('Show useful information about your WordPress installation in the footer.', 'cora'),
    'default'       =>  true
]);

# Post Thumbnail
$this->parent->options->add_field([
    'id'            =>  'post_thumbnail',
    'section'       =>  'general',
    'title'         =>  __('Posts Thumbnail', 'cora'),
    'description'   =>  __('Show the featured image in posts list.', 'cora'),
    'type'          =>  'switch',
    'default'       =>  true
]);


# Screen Options
$this->parent->options->add_field([
    'id'            =>  'screen_options',
    'section'       =>  'general',
    'title'         =>  __('Screen Options', 'cora'),
    'type'          =>  'switch',
    'default'       =>  true,
    'description'   =>  __('Show screen options & help button.', 'cora'),
]);

