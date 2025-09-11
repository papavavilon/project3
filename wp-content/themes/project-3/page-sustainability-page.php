<?php
get_header(); 
?>

  <style>
    /* Tiny starter CSS (move to Additional CSS later if you want) */
    html,body{margin:0;padding:0}
    *,*::before,*::after{box-sizing:border-box}
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Inter,Arial,sans-serif;background:#7c2d2d;color:#fff;line-height:1.6}
    .wrap{max-width:1080px;margin:0 auto;padding:24px}
    .subtitle{font-size:14px;color:#f0dcd2;margin:0 0 12px}
    .hero{display:block;width:100%;height:auto;border-radius:8px;margin:0 0 18px}
    .title{font-size:28px;font-weight:800;margin:22px 0 12px}
    .body p{margin:0 0 16px;color:#ffe8e0}
    .inset{background:#fff7ef;color:#222;border:2px solid #eadacc;border-radius:12px;padding:18px 20px;margin:28px 0;max-width:640px}
    .footer{display:grid;grid-template-columns:1fr 1fr;gap:28px;margin-top:28px}
    .footer a{color:#fff;text-decoration:underline}
    @media (max-width:900px){.title{font-size:22px}.footer{grid-template-columns:1fr}}
  </style>
</head>
<body <?php body_class('acf-starter'); ?>>
<?php wp_body_open(); ?>

<?php while (have_posts()): the_post(); ?>

<?php
echo get_field('hero_subtitle_');
  // $id   = get_queried_object_id();
  // Read fields (render nothing if ACF is missing or empty)
  $title_txt  = get_field('page_title');
  $body_html  = get_field('body_content');
  $inset_html = get_field('inset_text');
  $foot_l     = get_field('footer_left');
  $foot_r     = get_field('footer_right');

  // Hero image resolver (accept ID / Array / URL) + fallback to Featured Image
  $hero_url = ''; $hero_alt = '';
  if ($acf) {
    $hero_raw = get_field('hero_image_', $id);
    if (is_numeric($hero_raw)) {
      $hero_url = wp_get_attachment_image_url((int)$hero_raw, 'full');
    } elseif (is_array($hero_raw) && !empty($hero_raw['ID'])) {
      $hero_url = wp_get_attachment_image_url((int)$hero_raw['ID'], 'full');
      if (!empty($hero_raw['alt'])) $hero_alt = (string) $hero_raw['alt'];
    } elseif (is_string($hero_raw) && filter_var($hero_raw, FILTER_VALIDATE_URL)) {
      $hero_url = $hero_raw;
    }
    $alt_field = (string) ($acf ? get_field('hero_alt', $id) : '');
    if ($alt_field) $hero_alt = $alt_field;
  }
  if (!$hero_url) {
    $hero_url = get_the_post_thumbnail_url($id, 'full');
    if ($hero_url) {
      $thumb_id = get_post_thumbnail_id($id);
      $hero_alt = trim((string) get_post_meta($thumb_id, '_wp_attachment_image_alt', true));
    }
  }
?>

<div class="wrap">

 
  <?php if ($hero_url): ?>
    <img class="hero" src="<?php echo esc_url($hero_url); ?>" alt="<?php echo esc_attr($hero_alt); ?>">
  <?php endif; ?>

  <?php if ($title_txt): ?>
    <h1 class="title"><?php echo esc_html($title_txt); ?></h1>
  <?php endif; ?>

  <?php if (!empty($body_html)): ?>
    <div class="body"><?php echo wp_kses_post($body_html); ?></div>
  <?php endif; ?>

  <?php if (!empty($inset_html)): ?>
    <aside class="inset"><?php echo wp_kses_post($inset_html); ?></aside>
  <?php endif; ?>

  <footer class="footer">
    <?php if (!empty($foot_l)) : ?><div><?php echo wp_kses_post($foot_l); ?></div><?php endif; ?>
    <?php if (!empty($foot_r)) : ?><div><?php echo wp_kses_post($foot_r); ?></div><?php endif; ?>
  </footer>

  <?php endwhile; // have_posts ?>
</div>


