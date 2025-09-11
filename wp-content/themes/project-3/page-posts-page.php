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
      <?php if ($chip1): ?>
        <span class="chip chip--accent"><?php echo esc_html($chip1); ?></span>
      <?php endif; ?>

      <?php if ($chip2): ?>
        <span class="chip"><?php echo esc_html($chip2); ?></span>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>

<hr class="divider">

<?php
// один запрос CPT (замени 'menu_item', если в CPT UI другой slug)
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
?>

<!-- СЕКЦИЯ 1 -->
<section class="menu-section">
  <h2 class="menu-title">
    <?php echo esc_html( (string) get_field('section_title_croissants', $page_id) ?: 'Savory Croissants 🥐' ); ?>
  </h2>

  <div class="menu-grid">
    <?php foreach ($group1 as $post): setup_postdata($post);
      $image  = get_field('item_image',  $post->ID);
      $title  = trim((string) get_field('item_heading', $post->ID));
      $text   = (string) get_field('item_desc',   $post->ID);
      $weight = (string) get_field('item_weight', $post->ID);
      if ($title === '') { $title = get_the_title($post); }
      $plink  = get_permalink($post);
    ?>
      <article class="mcard">
        <?php if (!empty($image['ID'])): ?>
          <a class="mcard__thumb" href="<?php echo esc_url($plink); ?>" aria-label="<?php echo esc_attr($title); ?>">
            <div class="mcard__pic">
              <?php echo wp_get_attachment_image($image['ID'], 'large', false, ['loading'=>'lazy']); ?>
            </div>
          </a>
        <?php endif; ?>

        <?php if ($title): ?>
          <h3 class="mcard__title">
            <a href="<?php echo esc_url($plink); ?>"><?php echo esc_html($title); ?></a>
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

<!-- СЕКЦИЯ 2 -->
<section class="menu-section">
  <h2 class="menu-title">
    <?php echo esc_html( (string) get_field('section_title_coffee', $page_id) ?: 'Coffee Classics ☕️' ); ?>
  </h2>

  <div class="menu-grid">
    <?php foreach ($group2 as $post): setup_postdata($post);
      $image  = get_field('item_image',  $post->ID);
      $title  = trim((string) get_field('item_heading', $post->ID));
      $text   = (string) get_field('item_desc',   $post->ID);
      $weight = (string) get_field('item_weight', $post->ID);
      if ($title === '') { $title = get_the_title($post); }
      $plink  = get_permalink($post);
    ?>
      <article class="mcard">
        <?php if (!empty($image['ID'])): ?>
          <a class="mcard__thumb" href="<?php echo esc_url($plink); ?>" aria-label="<?php echo esc_attr($title); ?>">
            <div class="mcard__pic">
              <?php echo wp_get_attachment_image($image['ID'], 'large', false, ['loading'=>'lazy']); ?>
            </div>
          </a>
        <?php endif; ?>

        <?php if ($title): ?>
          <h3 class="mcard__title">
            <a href="<?php echo esc_url($plink); ?>"><?php echo esc_html($title); ?></a>
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
