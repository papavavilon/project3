<?php
/*
Template Name: Blog6 Page
Template Post Type: page
*/
get_header();

$page_id  = get_queried_object_id();
$img      = get_field('hero_image', $page_id);
$title    = trim((string) get_field('hero_title', $page_id));
$text     = get_field('hero_text', $page_id);

if ($title === '') { $title = get_the_title($page_id); }
if (!$img && has_post_thumbnail($page_id)) {
  $img = ['ID' => get_post_thumbnail_id($page_id)];
}

$back_url = wp_get_referer();
if (empty($back_url)) {
  $parent   = wp_get_post_parent_id($page_id);
  $back_url = $parent ? get_permalink($parent) : home_url('/');
}
?>
<main class="site-main">
  <article class="pcard">
    <div class="pcard__wrap">

      <a href="<?php echo esc_url($back_url); ?>" class="pcard__back" aria-label="Back"
         onclick="if(document.referrer){history.back();return false;}">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M15 18l-6-6 6-6" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>

      <?php if (!empty($img['ID'])): ?>
        <div class="pcard__image">
          <?php echo wp_get_attachment_image($img['ID'], 'full', false, ['loading'=>'lazy','sizes'=>'(max-width:1200px) 94vw, 1200px']); ?>
        </div>
      <?php endif; ?>

      <section class="pcard__card">
        <?php if ($title): ?><h1 class="pcard__title"><?php echo esc_html($title); ?></h1><?php endif; ?>
        <?php if ($text): ?><div class="pcard__text"><?php echo wp_kses_post(apply_filters('the_content', $text)); ?></div><?php endif; ?>
      </section>

    </div>
  </article>
</main>
<?php get_footer(); ?>
