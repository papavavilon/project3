<?php
get_header(); 
?>

<?php
/* Template Name: Sustainability – Basic (ACF, Your Fields) */
get_header();
?>

<style>
  /* Tiny starter CSS (you can move to Additional CSS later) */
  html,body{margin:0;padding:0}
  *,*::before,*::after{box-sizing:border-box}
  body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Inter,Arial,sans-serif;background:#7c2d2d;color:#fff;line-height:1.6}
  .wrap{max-width:1080px;margin:0 auto;padding:24px}
  .subtitle{font-size:14px;color:#f0dcd2;margin:0 0 12px}
  .hero{display:block;width:100%;height:auto;border-radius:8px;margin:0 0 18px}
  .title{font-size:28px;font-weight:800;margin:22px 0 12px}
  .body p{margin:0 0 16px;color:#ffe8e0}
  .inset{
    background:#fff7ef;color:#222;border:2px solid #eadacc;border-radius:12px;
    padding:18px 20px;margin:28px auto; /* center it */
    width:100%;max-width:640px;box-shadow:0 2px 8px rgba(0,0,0,.08)
  }
  .footer{display:grid;grid-template-columns:1fr 1fr;gap:28px;margin-top:28px}
  .footer a{color:#fff;text-decoration:underline}
  @media (max-width:900px){.title{font-size:22px}.footer{grid-template-columns:1fr}}
</style>

<div class="wrap">
<?php while ( have_posts() ) : the_post();

  $post_id = get_the_ID();

  // --- ACF fields (using your names) ---
  $subtitle   = function_exists('get_field') ? (string) get_field('hero_subtitle_', $post_id) : '';
  $title_txt  = function_exists('get_field') ? (string) get_field('page_title',     $post_id) : '';
  $body_html  = function_exists('get_field') ?          get_field('body_content',   $post_id) : '';
  $inset_html = function_exists('get_field') ?          get_field('inset_text',     $post_id) : '';
  $foot_l     = function_exists('get_field') ?          get_field('footer_left',    $post_id) : '';
  $foot_r     = function_exists('get_field') ?          get_field('footer_right',   $post_id) : '';

  // --- Hero image (ID / Array / URL) + Featured Image fallback ---
  $hero_url = '';
  $hero_alt = '';
  if ( function_exists('get_field') ) {
    $hero_raw = get_field('hero_image_', $post_id); // your field name with underscore
    if ( is_numeric($hero_raw) ) {
      $hero_url = wp_get_attachment_image_url( (int) $hero_raw, 'full' );
      $hero_alt = (string) get_post_meta( (int) $hero_raw, '_wp_attachment_image_alt', true );
    } elseif ( is_array($hero_raw) && ! empty($hero_raw['ID']) ) {
      $hero_url = wp_get_attachment_image_url( (int) $hero_raw['ID'], 'full' );
      if ( ! empty($hero_raw['alt']) ) $hero_alt = (string) $hero_raw['alt'];
    } elseif ( is_string($hero_raw) && filter_var($hero_raw, FILTER_VALIDATE_URL) ) {
      $hero_url = $hero_raw;
    }
    // Optional custom alt (yours is called hero_alt without underscore; change if needed)
    $alt_from_field = (string) get_field('hero_alt', $post_id);
    if ( $alt_from_field ) $hero_alt = $alt_from_field;
  }
  if ( ! $hero_url ) {
    $hero_url = get_the_post_thumbnail_url( $post_id, 'full' );
    if ( $hero_url ) {
      $thumb_id = get_post_thumbnail_id( $post_id );
      $hero_alt = trim( (string) get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) );
    }
  }
?>

  <?php if ( $subtitle ): ?>
    <p class="subtitle"><?php echo esc_html( $subtitle ); ?></p>
  <?php endif; ?>

  <?php if ( $hero_url ): ?>
    <img class="hero" src="<?php echo esc_url( $hero_url ); ?>" alt="<?php echo esc_attr( $hero_alt ); ?>">
  <?php endif; ?>

  <?php if ( $title_txt ): ?>
    <h1 class="title"><?php echo esc_html( $title_txt ); ?></h1>
  <?php endif; ?>

  <?php if ( ! empty( $body_html ) ): ?>
    <div class="body"><?php echo wp_kses_post( $body_html ); ?></div>
  <?php endif; ?>

  <?php if ( ! empty( $inset_html ) ): ?>
    <aside class="inset"><?php echo wp_kses_post( $inset_html ); ?></aside>
  <?php endif; ?>

  <footer class="footer">
    <?php if ( ! empty( $foot_l ) ): ?><div><?php echo wp_kses_post( $foot_l ); ?></div><?php endif; ?>
    <?php if ( ! empty( $foot_r ) ): ?><div><?php echo wp_kses_post( $foot_r ); ?></div><?php endif; ?>
  </footer>

<?php endwhile; ?>
</div>

<?php get_footer(); ?>

