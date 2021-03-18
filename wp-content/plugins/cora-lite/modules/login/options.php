<?php
/**
 * Login options
 * 
 * @since 1.0.0
 * @author Omar Badran
*/

# Add Section
$this->parent->options->add_section([
    'id'        =>  'login',
    'title'     =>  __('Login Page' , 'cora'),
    'icon'      =>  'vpn_key',
]);


# Layout
$this->parent->options->add_field([
    'id'           =>  'layout',
    'section'      =>  'login',
    'title'        =>   __('Layout' , 'cora'),
    'type'         =>   'image-select',
    'default'      =>   'modern',
    'options'      =>   [
        [
            'text'  =>  __('Standard', 'cora'),
            'id'    =>  'standard',
            'url'   =>  $this->parent->url('modules/login/assets/images/standard.png')
        ],
        [
            'text'  =>  __('Modern', 'cora'),
            'id'    =>  'modern',
            'url'   =>  $this->parent->url('modules/login/assets/images/modern.png') 
        ]
    ],
    'description'   =>  __('Select login page layout.', 'cora'),
]);


# Title
$this->parent->options->add_field([
    'id'           =>  'title',
    'section'      =>  'login',
    'title'        =>   __('Title' , 'cora'),
    'type'         =>   'text',
    'default'      =>   '',
    'condition'    =>   ['layout', '===', 'modern'],
    'description'  =>   __('Login page title.', 'cora'),
]);


# Description
$this->parent->options->add_field([
    'id'           =>  'description',
    'section'      =>  'login',
    'title'        =>   __('Description' , 'cora'),
    'type'         =>   'editor',
    'default'      =>   '',
    'condition'    =>   ['layout', '===', 'modern'],
    'description'  =>   __('A short paragraph that will be displayed under the title.', 'cora'),
]);


# Background Type
$this->parent->options->add_field([
    'id'           =>  'background_type',
    'section'      =>  'login',
    'title'        =>   __('Background Type' , 'cora'),
    'type'         =>   'select',
    'default'      =>   'default',
    'options'      =>   [
        [
            'id'    =>  'default',
            'text'  =>  __('Default', 'cora')
        ],
        [
            'id'    =>  'image',
            'text'  =>  __('Image', 'cora')
        ]
    ],
    'description'  =>   __('Choose the default color or upload a custom background image.', 'cora'),
]);


# Background Image
$this->parent->options->add_field([
    'id'           =>  'background_image',
    'section'      =>  'login',
    'title'        =>   __('Background Image' , 'cora'),
    'type'         =>   'image',
    'default'      =>   'https://images.unsplash.com/photo-1541253768886-47a2cef5e09e?w=1567',
    'condition'    =>   ['background_type', '==', 'image'],
    'description'  =>   __('Background image url.', 'cora'),
]);

# Show Logo
$this->parent->options->add_field([
    'id'           =>  'show_logo',
    'section'      =>  'login',
    'title'        =>   __('Show Logo' , 'cora'),
    'type'         =>   'switch',
    'default'      =>   true,
    'description'  =>   __('Display a logo above the login form.', 'cora'),
]);

# logo Type
$this->parent->options->add_field([
    'id'           =>  'logo_type',
    'section'      =>  'login',
    'title'        =>   __('Logo Type' , 'cora'),
    'type'         =>   'select',
    'default'      =>   'site_name',
    'options'      =>   [
        [
            'id'    =>  'logo',
            'text'  =>  __('Logo', 'cora')
        ],
        [
            'id'    =>  'site_name',
            'text'  =>  __('Site Name', 'cora')
        ]
    ],
    'condition'    =>   ['show_logo', '===', true],
    'description'  =>   __('Choose the logo type.', 'cora'),
]);

# Logo
$this->parent->options->add_field([
    'id'            =>  'logo',
    'section'       =>  'login',
    'title'         =>  __('Logo' , 'cora'),
    'type'          =>  'image',
    'default'       =>  $this->parent->url('assets/SVG/logo-dark.svg'),
    'condition'     =>  [
        ['logo_type', '===', 'logo'],
        ['show_logo', '===', true]
    ],
    'description'  =>   __('Logo image url.', 'cora'),
]);

# Logo Width
$this->parent->options->add_field([
    'id'           =>  'logo_width',
    'section'      =>  'login',
    'title'        =>   __('Logo Width' , 'cora'),
    'type'         =>   'text',
    'default'       =>  '31',
    'condition'     =>  [
        ['logo_type', '===', 'logo'],
        ['show_logo', '===', true]
    ],
    'description'  =>   __('Logo image width measured in pixels. The height will be set automatically.', 'cora'),
]);
