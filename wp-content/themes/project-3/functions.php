<?php


function demo_load_stylesheet() {
    // Bootstrap
    wp_enqueue_style("bootstrap", "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css");
    // Общие стили
    wp_enqueue_style("main", get_template_directory_uri() . "/style.css");

    // Доп. стили только для Front Page
    if (is_front_page()) {
        wp_enqueue_style("front", get_template_directory_uri() . "/front.css", array("main"));
    }
}
add_action("wp_enqueue_scripts", "demo_load_stylesheet");




add_action('wp_enqueue_scripts', function () {
  // Google Fonts: Titan One
  wp_enqueue_style(
    'gf-titan-one',
    'https://fonts.googleapis.com/css2?family=Titan+One&display=swap',
    [],
    null
  );
});

add_theme_support('post-thumbnails');
