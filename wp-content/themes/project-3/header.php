<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
</body>
</html>


<?php
 wp_head(); 

// Ищем страницу "Header Settings" по слагу
$settings_page = get_page_by_path('header-settings', OBJECT, 'page');
$settings_id = $settings_page ? $settings_page->ID : 0;

// Если не нашли — подстрахуемся фронт-пейджем
if (!$settings_id) {
  $settings_id = (int) get_option('page_on_front');
}

// Читаем поля ACF с этой страницы
$logo        = get_field('logo_image', $settings_id);
$logo_link   = get_field('logo_link',  $settings_id) ?: home_url('/');
$show_search = (bool) get_field('show_search', $settings_id);
$show_lang   = (bool) get_field('show_lang_button', $settings_id);
$lang_label  = get_field('lang_label', $settings_id) ?: 'EN';

// Лого: поддержим пустое состояние
$logo_html = '<span>Logo</span>';
if ($logo && !empty($logo['ID'])) {
  $logo_html = wp_get_attachment_image($logo['ID'], 'medium');
}
?>
<nav class="site-nav">
  <div class="site-nav__inner">

    <!-- ЛЕВО: ЛОГО -->
    <a href="<?php echo esc_url($logo_link); ?>" class="site-nav__logo" aria-label="Home">
      <?php echo $logo_html; ?>
    </a>

    <!-- ЦЕНТР: пусто -->
    <div></div>

    <!-- ПРАВО: поиск + макет языка -->
    <div class="site-nav__actions">

      <?php if ($show_search): ?>
        <a href="#" class="pill pill--icon" aria-label="Search">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="11" cy="11" r="7"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </a>
      <?php endif; ?>

      <?php if ($show_lang): ?>
        <div class="pill" aria-label="Language"><?php echo esc_html($lang_label); ?> &#9662;</div>
      <?php endif; ?>

    </div>
  </div>
</nav>
