<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Site Identity
    |--------------------------------------------------------------------------
    */
    'site_name'    => env('APP_NAME', 'JMSync'),
    'site_tagline' => 'Trusted Design Partner',
    'site_logo'    => null,     // path in storage/public (managed via admin)
    'site_logo_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Header Configuration
    |--------------------------------------------------------------------------
    */
    'header' => [
        'style'           => 'default', // default | r_nav | c_nav | l_nav
        'show_top_bar'    => true,
        'top_bar_height'  => 40,
        'mid_height'      => 80,
        'show_search'     => true,
        'top_info'        => 'New York, NY 10013 &nbsp;|&nbsp; <a href="mailto:example@example.com">example@example.com</a> &nbsp;|&nbsp; +1-800-123-4567',
    ],

    /*
    |--------------------------------------------------------------------------
    | Footer Configuration
    |--------------------------------------------------------------------------
    */
    'footer' => [
        'type'        => 'default',  // default | small
        'show_logo'   => true,
        'show_nav'    => true,
        'show_social' => true,
        'show_newsletter' => true,
        'tagline'     => 'Lorem ipsum dolor sit amet consectetur. Eget ornare ac eleifend leo mauris suspendisse.',
        'copyright'   => '&copy; ' . date('Y') . ' All Rights Reserved JMSync.',
        'address'     => 'New York, NY 10013',
        'email'       => 'example@example.com',
        'phone'       => '+1-800-123-4567',
    ],

    /*
    |--------------------------------------------------------------------------
    | Social Icons
    |--------------------------------------------------------------------------
    */
    'social' => [
        'facebook'  => '',
        'twitter'   => '',
        'linkedin'  => '',
        'instagram' => '',
        'youtube'   => '',
        'github'    => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | Navigation Menus
    |--------------------------------------------------------------------------
    | Fallback menus if no DB records exist yet.
    */
    'nav_primary' => [
        ['label' => 'Inicio',     'route' => 'home',            'children' => []],
        ['label' => 'Servicios',  'route' => 'services',        'children' => []],
        ['label' => 'Portfolio',  'route' => 'portfolio.index', 'children' => []],
        ['label' => 'Blog',       'route' => 'blog.index',      'children' => []],
        ['label' => 'Contacto',   'route' => 'contact',         'children' => []],
    ],

    'nav_footer' => [
        ['label' => 'Servicios',  'route' => 'services'],
        ['label' => 'Portfolio',  'route' => 'portfolio.index'],
        ['label' => 'Blog',       'route' => 'blog.index'],
        ['label' => 'Contacto',   'route' => 'contact'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Contact Form
    |--------------------------------------------------------------------------
    */
    'contact' => [
        'recipient_email' => env('MAIL_FROM_ADDRESS', 'admin@jmsync.es'),
        'honeypot_field'  => 'website',  // spam protection
        'show_map'        => false,
        'map_embed_url'   => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | Analytics & Scripts
    |--------------------------------------------------------------------------
    */
    'analytics' => [
        'google_id'      => '',
        'head_scripts'   => '',
        'body_scripts'   => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | Portfolio Settings
    |--------------------------------------------------------------------------
    */
    'portfolio' => [
        'items_per_page' => 9,
        'default_filter' => 'all',
        'layout'         => 'grid', // grid | masonry
    ],

    /*
    |--------------------------------------------------------------------------
    | Blog Settings
    |--------------------------------------------------------------------------
    */
    'blog' => [
        'items_per_page' => 9,
        'show_sidebar'   => false,
        'layout'         => 'grid', // grid | list
    ],

];
