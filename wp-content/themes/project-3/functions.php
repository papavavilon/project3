<?php
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'theme-style',
        get_stylesheet_uri(), // это всегда /wp-content/themes/ВАША_ТЕМА/style.css
        [],
        filemtime( get_stylesheet_directory() . '/style.css' ) // анти-кэш
    );
});



add_action('wp_enqueue_scripts', function () {
  // Google Fonts: Titan One
  wp_enqueue_style(
    'gf-titan-one',
    'https://fonts.googleapis.com/css2?family=Titan+One&display=swap',
    [],
    null
  );
});
