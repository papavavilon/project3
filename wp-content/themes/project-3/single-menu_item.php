<?php
/* Шаблон одиночной карточки menu_item (модальное «окно») */
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
  $id     = get_the_ID();
  $image  = get_field('item_image',  $id);
  $title  = trim((string) get_field('item_heading', $id)) ?: get_the_title();
  $text   = (string) get_field('item_desc',   $id);
  $weight = (string) get_field('item_weight', $id);

  // Куда возвращаться по стрелке «назад» (замени 'posts-page' на свой slug, если другой)
  $list_page = get_page_by_path('posts-page');
  $back_url  = $list_page ? get_permalink($list_page->ID) : home_url('/');
?>
<main class="site-main">
  <div class="prod-overlay">

    <a class="prod-back" href="<?php echo esc_url($back_url); ?>" aria-label="Back">
      <!-- простая стрелка влево -->
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#f7ebcf" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <polyline points="15 18 9 12 15 6"></polyline>
      </svg>
    </a>

    <article class="prod-card">
      <?php if (!empty($image['ID'])): ?>
        <div class="prod-img">
          <?php echo wp_get_attachment_image($image['ID'], 'large', false, ['loading'=>'lazy']); ?>
        </div>
      <?php endif; ?>

      <h1 class="prod-title"><?php echo esc_html($title); ?></h1>

      <?php if ($text): ?>
        <div class="prod-text"><p><?php echo esc_html($text); ?></p></div>
      <?php endif; ?>

      <?php if ($weight): ?>
        <div class="prod-meta"><?php echo esc_html($weight); ?></div>
      <?php endif; ?>
    </article>

  </div>
</main>
<?php
endwhile; endif;

get_footer();
