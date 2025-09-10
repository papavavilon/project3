<?php
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'theme-style',
        get_stylesheet_uri(), // это всегда /wp-content/themes/ВАША_ТЕМА/style.css
        [],
        filemtime( get_stylesheet_directory() . '/style.css' ) // анти-кэш
    );
});
