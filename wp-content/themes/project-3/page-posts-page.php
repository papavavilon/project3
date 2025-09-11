<?php
/*
 * Template Name: Post Page
 * Template Post Type: page
*/
get_header();
?>

<main class="site-main">

<?php
$page_id = get_queried_object_id();


$chip1 = trim((string) get_field('chip1_text', $page_id));
$chip2 = trim((string) get_field('chip2_text', $page_id));

if ($chip1 || $chip2): ?>
  <section class="chips">
    <div class="chips__wrap">
      <?php if ($chip1): ?><span class="chip chip--accent"><?php echo esc_html($chip1); ?></span><?php endif; ?>
      <?php if ($chip2): ?><span class="chip"><?php echo esc_html($chip2); ?></span><?php endif; ?>
    </div>
  </section>
<?php endif; ?>

<hr class="divider">

<?php

$items = get_posts([
  'post_type'        => 'menu_item',
  'numberposts'      => 6,
  'orderby'          => 'menu_order',
  'order'            => 'ASC',
  'post_status'      => 'publish',
  'suppress_filters' => true,
]);

$group1 = array_slice($items, 0, 3);
$group2 = array_slice($items, 3, 3);


function menu_item_url($post_id){
  $url = trim((string) get_field('item_link', $post_id));
  if ($url === '') { $url = get_permalink($post_id); }
  return $url;
}
?>

<!-- ===== СЕКЦИЯ 1: Croissants ===== -->
<section class="menu-section">
  <h2 class="menu-title">
    <?php echo esc_html( (string) get_field('section_title_croissants', $page_id) ?: 'Savory Croissants 🥐' ); ?>
  </h2>

  <div class="menu-grid">
    <?php foreach ($group1 as $post): setup_postdata($post);
      $img    = get_field('item_image',       $post->ID);        // image array
      $label  = trim((string) get_field('item_label',      $post->ID)) ?: get_the_title($post);
      $text   = (string)   get_field('item_label_text',    $post->ID);
      $weight = (string)   get_field('item_weight',        $post->ID);
      $url    = menu_item_url($post->ID);
    ?>
      <article class="mcard">
        <?php if (!empty($img['ID'])): ?>
          <a class="mcard__thumb" href="<?php echo esc_url($url); ?>" aria-label="<?php echo esc_attr($label); ?>">
            <div class="mcard__pic">
              <?php
                
                echo wp_get_attachment_image($img['ID'], 'mcard', false, ['loading'=>'lazy']);
              ?>
            </div>
          </a>
        <?php endif; ?>

        <?php if ($label): ?>
          <h3 class="mcard__title">
            <a href="<?php echo esc_url($url); ?>"><?php echo esc_html($label); ?></a>
          </h3>
        <?php endif; ?>

        <?php if ($text): ?>
          <p class="mcard__text"><?php echo esc_html($text); ?></p>
        <?php endif; ?>

        <?php if ($weight): ?>
          <div class="mcard__meta"><?php echo esc_html($weight); ?></div>
        <?php endif; ?>
      </article>
    <?php endforeach; wp_reset_postdata(); ?>
  </div>
</section>

<!-- ===== СЕКЦИЯ 2: Coffee ===== -->
<section class="menu-section">
  <h2 class="menu-title">
    <?php echo esc_html( (string) get_field('section_title_coffee', $page_id) ?: 'Coffee Classics ☕️' ); ?>
  </h2>

  <div class="menu-grid">
    <?php foreach ($group2 as $post): setup_postdata($post);
      $img    = get_field('item_image',       $post->ID);
      $label  = trim((string) get_field('item_label',      $post->ID)) ?: get_the_title($post);
      $text   = (string)   get_field('item_label_text',    $post->ID);
      $weight = (string)   get_field('item_weight',        $post->ID);
      $url    = menu_item_url($post->ID);
    ?>
      <article class="mcard">
        <?php if (!empty($img['ID'])): ?>
          <a class="mcard__thumb" href="<?php echo esc_url($url); ?>" aria-label="<?php echo esc_attr($label); ?>">
            <div class="mcard__pic">
              <?php echo wp_get_attachment_image($img['ID'], 'mcard', false, ['loading'=>'lazy']); ?>
            </div>
          </a>
        <?php endif; ?>

        <?php if ($label): ?>
          <h3 class="mcard__title">
            <a href="<?php echo esc_url($url); ?>"><?php echo esc_html($label); ?></a>
          </h3>
        <?php endif; ?>

        <?php if ($text): ?>
          <p class="mcard__text"><?php echo esc_html($text); ?></p>
        <?php endif; ?>

        <?php if ($weight): ?>
          <div class="mcard__meta"><?php echo esc_html($weight); ?></div>
        <?php endif; ?>
      </article>
    <?php endforeach; wp_reset_postdata(); ?>
  </div>
</section>

</main>

<?php get_footer(); ?>
