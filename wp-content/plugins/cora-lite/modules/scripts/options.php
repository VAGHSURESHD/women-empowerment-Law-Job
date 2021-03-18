<?php
/**
 * Custom Scripts options
 * 
 * @since 1.0.0
 * @author Omar Badran
*/

# Add Section
$this->parent->options->add_section([
    'id'        =>  'scripts',
    'title'     =>  __('Custom Scripts' , 'cora'),
    'icon'      =>  'power',
]);

# Admin Scripts
$this->parent->options->add_field([
    'id'            =>  'admin_scripts',
    'section'       =>  'scripts',
    'title'         =>  __('Admin Scripts', 'cora'),
    'description'   =>  __('This option allows you to add custom CSS & JS to the admin area.', 'cora'),
    'type'          =>  'repeater',
    'fields'        =>  [
        [
            'id'        =>  'title',
            'title'     =>  __('Title', 'cora'),
            'type'      =>  'text',
        ],
        [
            'id'        =>  'type',
            'title'     =>  __('Type', 'cora'),
            'type'      =>  'select',
            'options'   =>  [
                [
                    'text'  =>  __('CSS', 'cora'),
                    'id'    =>  'css'
                ],
                [
                    'text'  =>  __('JS', 'cora'),
                    'id'    =>  'js'
                ]
            ]
        ],
        [
            'id'    =>  'content',
            'title' =>  __('Code', 'cora'),
            'type'  =>  'textarea',
            'placeholder' => __('Put your code here.', 'cora')
        ],
    ],
    'new_item_default'  => [
        'title'         =>  __('Custom Script', 'cora'),
        'type'          =>  'css',
        'content'       =>  ''
    ],
]);

# frontend Scripts
$this->parent->options->add_field([
    'id'            =>  'frontend_scripts',
    'section'       =>  'scripts',
    'title'         =>  __('Front-end Scripts', 'cora'),
    'description'   =>  __('This option allows you to add custom CSS & JS on the front-end.', 'cora'),
    'type'          =>  'repeater',
    'fields'        =>  [
        [
            'id'        =>  'title',
            'title'     =>  __('Title', 'cora'),
            'type'      =>  'text',
        ],
        [
            'id'        =>  'type',
            'title'     =>  __('Type', 'cora'),
            'type'      =>  'select',
            'options'   =>  [
                [
                    'text'  =>  __('CSS', 'cora'),
                    'id'    =>  'css'
                ],
                [
                    'text'  =>  __('JS', 'cora'),
                    'id'    =>  'js'
                ]
            ]
        ],
        [
            'id'            =>      'content',
            'title'         =>      __('Code', 'cora'),
            'type'          =>      'textarea',
            'placeholder'   =>      __('Put your code here.', 'cora')
        ],
    ],
    'new_item_default'  => [
        'title'         =>  __('Custom Script', 'cora'),
        'type'          =>  'css',
        'content'       =>  ''
    ],
]);

# login Scripts
$this->parent->options->add_field([
    'id'            =>  'login_scripts',
    'section'       =>  'scripts',
    'title'         =>  __('Login Scripts', 'cora'),
    'description'   =>  __('This option allows you to add custom CSS & JS to the login area.', 'cora'),
    'type'          =>  'repeater',
    'fields'        =>  [
        [
            'id'        =>  'title',
            'title'     =>  __('Title', 'cora'),
            'type'      =>  'text',
        ],
        [
            'id'        =>  'type',
            'title'     =>  __('Type', 'cora'),
            'type'      =>  'select',
            'options'   =>  [
                [
                    'text'  =>  __('CSS', 'cora'),
                    'id'    =>  'css'
                ],
                [
                    'text'  =>  __('JS', 'cora'),
                    'id'    =>  'js'
                ]
            ]
        ],
        [
            'id'            =>      'content',
            'title'         =>      __('Code', 'cora'),
            'type'          =>      'textarea',
            'placeholder'   =>      __('Put your code here.', 'cora')
        ],
    ],
    'new_item_default'  => [
        'title'         =>  __('Custom Script', 'cora'),
        'type'          =>  'css',
        'content'       =>  ''
    ],
]);
