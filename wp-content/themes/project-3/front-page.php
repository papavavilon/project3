<?php
get_header();

$home_id      = get_queried_object_id();
$hero_title   = get_field('hero_title', $home_id);
$hero_desc    = get_field('hero_desc', $home_id);
$hero_phone   = get_field('hero_phone', $home_id);
$hero_crois   = get_field('hero_croissant', $home_id);
$icon_left    = get_field('hero_icon_left', $home_id);
$icon_right   = get_field('hero_icon_right', $home_id);
$hero_time    = get_field('hero_time', $home_id);
$hero_address = get_field('hero_address', $home_id);
?>

<main class="site-main">
  <section class="hero">
    <div class="hero__inner">

      <?php if ($hero_title): ?>
        <h1 class="hero__title"><?php echo esc_html($hero_title); ?></h1>
      <?php endif; ?>

      <div class="hero__grid">
        <!-- ЛЕВО: иконка + 2 строки, прилипает к низу -->
        <aside class="hero__side hero__side--left">
          <?php if (!empty($icon_left['ID'])): ?>
            <?php echo wp_get_attachment_image($icon_left['ID'], 'medium', false, ['class'=>'kid']); ?>
          <?php endif; ?>
          <div class="info__text">
            <?php if ($hero_time): ?><div class="info__time"><?php echo esc_html($hero_time); ?></div><?php endif; ?>
            <?php if ($hero_address): ?><div class="info__addr"><?php echo esc_html($hero_address); ?></div><?php endif; ?>
          </div>
        </aside>

        <!-- ЦЕНТР: телефон + круассан, строго по центру -->
        <div class="hero__center">
          <div class="phone-wrap">
            <?php if (!empty($hero_phone['ID'])): ?>
              <?php echo wp_get_attachment_image($hero_phone['ID'], 'large', false, ['class'=>'phone']); ?>
            <?php endif; ?>

            <?php if (!empty($hero_crois['ID'])): ?>
              <?php echo wp_get_attachment_image($hero_crois['ID'], 'large', false, ['class'=>'croissant']); ?>
            <?php endif; ?>
          </div>
        </div>

        <!-- ПРАВО: пекарь + абзац -->
        <aside class="hero__side hero__side--right">
          <?php if (!empty($icon_right['ID'])): ?>
            <?php echo wp_get_attachment_image($icon_right['ID'], 'medium', false, ['class'=>'chef']); ?>
          <?php endif; ?>
          <?php if ($hero_desc): ?>
            <p class="hero__desc"><?php echo esc_html($hero_desc); ?></p>
          <?php endif; ?>
        </aside>
      </div>

    </div>
  </section>
</main>

<?php get_footer(); ?>
