<?php get_header(); 
/*
 * Template Name: Post Page
 * Template Post Type: page
*/
?>

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

