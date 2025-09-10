<?php
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'theme-style',
        get_stylesheet_uri(), // это всегда /wp-content/themes/ВАША_ТЕМА/style.css
        [],
        filemtime( get_stylesheet_directory() . '/style.css' ) // анти-кэш
    );
    $path = get_stylesheet_directory() . '/assets/js/search-modal.js';
  wp_enqueue_script(
    'site-search-modal',
    get_stylesheet_directory_uri() . '/assets/js/search-modal.js',
    [],
    file_exists($path) ? filemtime($path) : null,
    true // в футере
  );
});

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style(
    'font-titan-one',
    'https://fonts.googleapis.com/css2?family=Titan+One&display=swap',
    [],
    null
  );
});





