<?php
get_header(); 
?>

<?php
/* Template Name: Sustainability – Basic (ACF, Your Fields) */
get_header();
?>

<style>
 
  
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
    <img class="hero_1" src="<?php echo esc_url( $hero_url ); ?>" alt="<?php echo esc_attr( $hero_alt ); ?>">
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

 

<?php endwhile; ?>
</div>

<?php get_footer(); ?>

