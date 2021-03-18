<?php
/**
 * Menu options
 * 
 * @since 1.0.0
 * @author Omar Badran
*/

# Add Section
$this->parent->options->add_section([
    'id'        =>  'menu',
    'title'     =>  __('Menu' , 'cora'),
    'icon'      =>  'clear_all',
]);

# Show Logo
$this->parent->options->add_field([
    'id'           =>  'show_logo',
    'section'      =>  'menu',
    'title'        =>   __('Show Logo' , 'cora'),
    'type'         =>   'switch',
    'default'      =>   true,
    'description'  =>   __('Display a logo above the menu items.', 'cora'),
]);

# logo Type
$this->parent->options->add_field([
    'id'           =>  'logo_type',
    'section'      =>  'menu',
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
    'section'       =>  'menu',
    'title'         =>  __('Logo' , 'cora'),
    'type'          =>  'image',
    'default'       =>  $this->parent->url('assets/SVG/logo-light.svg'),
    'condition'     =>  [
        ['logo_type', '===', 'logo'],
        ['show_logo', '===', true]
    ],
    'description'  =>   __('Logo image url.', 'cora'),
]);

# Logo Width
$this->parent->options->add_field([
    'id'           =>  'logo_width',
    'section'      =>  'menu',
    'title'        =>   __('Logo Width' , 'cora'),
    'type'         =>   'text',
    'default'       =>  '31',
    'condition'     =>  [
        ['logo_type', '===', 'logo'],
        ['show_logo', '===', true]
    ],
    'description'  =>   __('Logo image width measured in pixels. The height will be set automatically.', 'cora'),
]);

# Menu Items
add_action('_admin_menu', function (){
    
    $this->parent->options->add_field([
        'id'            =>  'items',
        'section'       =>  'menu',
        'title'         =>  __('Menu Items' , 'cora'),
        'type'          =>  'repeater',
        'description'   =>  __('This option allows you to edit the admin menu items, You can set user roles, change the title, icon, reorder, and add new links & pages.', 'cora'),
        'fields'        =>  [
            [
                'id'    =>  'title',
                'title' =>  __('Title' , 'cora'),
                'type'  =>  'text',
            ],
            [
                'id'    =>  'custom_icon',
                'title' =>  __('Icon' , 'cora'),
                'type'  =>  'icon',
            ],
            [
                'id'    =>  'type',
                'title' =>  __('Type' , 'cora'),
                'type'  =>  'select',
                'options' => [
                    [
                        'id' => 'link',
                        'text' => __('Link' , 'cora')
                    ],
                    [
                        'id' => 'page',
                        'text' => __('Page' , 'cora')
                    ]
                ],
                'condition' => ['type', '!==', 'default']
            ],
            [
                'id'    =>  'url',
                'title' =>  __('URL' , 'cora'),
                'type'  =>  'text',
                'condition' => ['type', '==', 'link']
            ],
            [
                'id'    =>  'page_content',
                'title' =>  __('Page Content' , 'cora'),
                'type'  =>  'editor',
                'condition' => ['type', '==', 'page']
            ],
            [
                'id'    =>  'hide_for',
                'title' =>  __('Hide For' , 'cora'),
                'type'  =>  'select',
                'options' => $this->get_roles(),
                'multiple' => true
            ]
        ],
        'default' =>  $this->get_menu_items(),
        'new_item_default'  => [
            'type'          =>  'link',
            'title'         =>  __('New Item', 'cora'),
            'custom_icon'   =>  'settings',
        ],
        'remove_condition' => ['type' , '!==' , 'default'],
        'remove_disabled_title' =>  __('Default items cannot be removed.', 'cora')
    ]);

}, PHP_INT_MAX);