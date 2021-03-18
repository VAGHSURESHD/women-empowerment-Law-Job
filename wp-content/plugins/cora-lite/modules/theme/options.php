<?php
/**
 * Theme options
 * 
 * @since 1.0.0
 * @author Omar Badran
*/

# Add Section
$this->parent->options->add_section([
    'id'        =>  'theme',
    'title'     =>  __('Theme' , 'cora'),
    'icon'      =>  'gesture',
]);


# Themes

$this->parent->options->add_field([
    'id'        =>  'themes',
    'section'   =>  'theme',
    'type'      =>  'demo',
    'title'     =>  false,
    'options'   =>  [
        [
            'img'   =>  $this->parent->url("modules/theme/themes/light/screenshot.png"),
            'title' =>  __('Light', 'cora'),
            'data'  =>  json_decode( file_get_contents( $this->parent->dir("modules/theme/themes/light/light.json") ), true )
        ],
        [
            'img'   =>  $this->parent->url("modules/theme/themes/dark/screenshot.png"),
            'title' =>  __('Dark', 'cora'),
            'data'  =>  json_decode( file_get_contents( $this->parent->dir("modules/theme/themes/dark/dark.json") ), true )
        ]
    ],
]);


# Shadows

$this->parent->options->add_field([
    'section'   =>  'theme',
    'type'      =>  'html',
    'content'   =>  '<h3 class="cora-separator">' . __('Shadows' , 'cora') . '</h3>',
]);

$this->parent->options->add_field([
    'id'        =>  'shadows',
    'section'   =>  'theme',
    'title'     =>  __('Shadows', 'cora'),
    'type'      =>  'switch',
    'default'   =>  true,
    'description'  =>   __('Add shadow effect to certain elements like Boxes, login form, posts list, etc.', 'cora'),
]);


# General

$this->parent->options->add_field([
    'section'   =>  'theme',
    'type'      =>  'html',
    'content'   =>  '<h3 class="cora-separator">' . __('General' , 'cora') . '</h3>'
]);

$this->parent->options->add_field([
    'id'        =>  'primary_background_color',
    'section'   =>  'theme',
    'title'     =>  __('Primary Background', 'cora'),
    'type'      =>  'color',
    'default'   =>  '#f1f3fb',
    'description'  =>   __('Used as the backgroud color for admin & login pages.', 'cora'),
]);

$this->parent->options->add_field([
    'id'        =>  'secondary_background_color',
    'section'   =>  'theme',
    'title'     =>  __('Secondary Background', 'cora'),
    'type'      =>  'color',
    'default'   =>  '#ffffff',
    'description'  =>   __('Used as the backgroud color for Meta boxes, posts list, login form, menu items & widgets.', 'cora'),
]);

$this->parent->options->add_field([
    'id'        =>  'primary_text_color',
    'section'   =>  'theme',
    'title'     =>  __('Primary Text', 'cora'),
    'type'      =>  'color',
    'default'   =>  '#59668a',
    'description'  =>   __('Main text color. Used for titles & paragraphs.', 'cora'),
]);

$this->parent->options->add_field([
    'id'        =>  'secondary_text_color',
    'section'   =>  'theme',
    'title'     =>  __('Secondary Text', 'cora'),
    'type'      =>  'color',
    'default'   =>  '#868d98',
    'description'  =>   __('Used for short descriptions & sub-paragraphs.', 'cora'),
]);

$this->parent->options->add_field([
    'id'        =>  'link_color',
    'section'   =>  'theme',
    'title'     =>  __('Links', 'cora'),
    'type'      =>  'color',
    'default'   =>  '#417cc5',
    'description'  =>   __('Links color.', 'cora'),
]);



# Menu Colors

$this->parent->options->add_field([
    'section'   =>  'theme',
    'type'      =>  'html',
    'content'   =>  '<h3 class="cora-separator">' . __('Menu' , 'cora') . '</h3>'
]);

$this->parent->options->add_field([
    'id'        =>  'menu_background',
    'section'   =>  'theme',
    'title'     =>  __('Background', 'cora'),
    'type'      =>  'color',
    'default'   =>  '#1e2e42',
    'description'  =>   __('Menu background color.', 'cora'),
]);

$this->parent->options->add_field([
    'id'        =>  'menu_item_text',
    'section'   =>  'theme',
    'title'     =>  __('Item Text', 'cora'),
    'type'      =>  'color',
    'default'   =>  'rgba(255, 255, 255, 0.12)',
    'description'  =>   __('Menu item text color.', 'cora'),
]);

$this->parent->options->add_field([
    'id'        =>  'menu_highlight_text',
    'section'   =>  'theme',
    'title'     =>  __('Item Text - Highlight', 'cora'),
    'type'      =>  'color',
    'default'   =>  'rgba(255, 255, 255, 0.9)',
    'description'  =>   __('Menu item text color when the item is highlighted.', 'cora'),
]);

$this->parent->options->add_field([
    'id'        =>  'menu_highlight_background',
    'section'   =>  'theme',
    'title'     =>  __('Item Background - Highlight', 'cora'),
    'type'      =>  'color',
    'default'   =>  '#02B875',
    'description'  =>   __('Menu item background color when the item is highlighted.', 'cora'),
]);

$this->parent->options->add_field([
    'id'        =>  'menu_submenu_background',
    'section'   =>  'theme',
    'title'     =>  __('Submenu Background', 'cora'),
    'type'      =>  'color',
    'default'   =>  '#1e2e42',
    'description'  =>   __('Background color for submenus.', 'cora'),
]);

$this->parent->options->add_field([
    'id'        =>  'menu_submenu_item_text',
    'section'   =>  'theme',
    'title'     =>  __('Submenu Item Text', 'cora'),
    'type'      =>  'color',
    'default'   =>  'rgba(255, 255, 255, 0.125)',
    'description'  =>   __('Submenu item text color.', 'cora'),
]);

$this->parent->options->add_field([
    'id'        =>  'menu_submenu_highlight_text',
    'section'   =>  'theme',
    'title'     =>  __('Submenu Item Text - Highlight', 'cora'),
    'type'      =>  'color',
    'default'   =>  'rgba(255, 255, 255, 0.8)',
    'description'  =>   __('Submenu item color when the item is highlighted.', 'cora'),
]);

$this->parent->options->add_field([
    'id'        =>  'menu_logo_text',
    'section'   =>  'theme',
    'title'     =>  __('Logo Text', 'cora'),
    'type'      =>  'color',
    'default'   =>  'rgba(255, 255, 255, 0.95)',
    'description'  =>   __('If you choose the site name as a logo, you can set the color here. Note that this won\'t affect image logos.', 'cora'),
]);

# Toolbar Colors

$this->parent->options->add_field([
    'section'   =>  'theme',
    'type'      =>  'html',
    'content'   =>  '<h3 class="cora-separator">' . __('Toolbar' , 'cora') . '</h3>'
]);

$this->parent->options->add_field([
    'id'        =>  'toolbar_background',
    'section'   =>  'theme',
    'title'     =>  __('Toolbar Background', 'cora'),
    'type'      =>  'color',
    'default'   =>  'rgba(255, 255, 255, 0)'
]);

$this->parent->options->add_field([
    'id'        =>  'toolbar_item_text',
    'section'   =>  'theme',
    'title'     =>  __('Item Text', 'cora'),
    'type'      =>  'color',
    'default'   =>  '#59668a'
]);

$this->parent->options->add_field([
    'id'        =>  'toolbar_highlight_text',
    'section'   =>  'theme',
    'title'     =>  __('Item Text - Highlight', 'cora'),
    'type'      =>  'color',
    'default'   =>  'rgba(255, 255, 255, 1)'
]);

$this->parent->options->add_field([
    'id'        =>  'toolbar_highlight_background',
    'section'   =>  'theme',
    'title'     =>  __('Item background - Highlight', 'cora'),
    'type'      =>  'color',
    'default'   =>  'rgb(91, 96, 107)'
]);

# Buttons

$this->parent->options->add_field([
    'section'   =>  'theme',
    'type'      =>  'html',
    'content'   =>  '<h3 class="cora-separator">' . __('Buttons' , 'cora') . '</h3>'
]);

$this->parent->options->add_field([
    'id'        =>  'primary_button_color',
    'section'   =>  'theme',
    'title'     =>  __('Primary Button Color', 'cora'),
    'type'      =>  'color',
    'default'   =>  '#02B875'
]);

$this->parent->options->add_field([
    'id'        =>  'primary_button_text',
    'section'   =>  'theme',
    'title'     =>  __('Primary Button Text', 'cora'),
    'type'      =>  'color',
    'default'   =>  '#ffffff'
]);

$this->parent->options->add_field([
    'id'        =>  'secondary_button_color',
    'section'   =>  'theme',
    'title'     =>  __('Secondary Button Color', 'cora'),
    'type'      =>  'color',
    'default'   =>  '#a4aeb9'
]);

$this->parent->options->add_field([
    'id'        =>  'secondary_button_text',
    'section'   =>  'theme',
    'title'     =>  __('Secondary Button Text', 'cora'),
    'type'      =>  'color',
    'default'   =>  '#ffffff'
]);


# Forms

$this->parent->options->add_field([
    'section'   =>  'theme',
    'type'      =>  'html',
    'content'   =>  '<h3 class="cora-separator">' . __('Forms' , 'cora') . '</h3>'
]);

$this->parent->options->add_field([
    'id'        =>  'forms_field_background',
    'section'   =>  'theme',
    'title'     =>  __('Control Field Background', 'cora'),
    'type'      =>  'color',
    'default'   =>  'rgba(0, 0, 0, 0)',
    'description'  =>   __('Background color used in form elements, i.e. inputs, checkboxes, select, textarea, etc.', 'cora'),
]);

$this->parent->options->add_field([
    'id'        =>  'forms_field_border',
    'section'   =>  'theme',
    'title'     =>  __('Control Field Border', 'cora'),
    'type'      =>  'color',
    'default'   =>  'rgba(0, 0, 0, 0.08)',
    'description'  =>   __('Border color used in form elements.', 'cora'),
]);
