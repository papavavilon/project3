<?php
get_header();
if (have_posts()) : while (have_posts()) : the_post();
$img = get_field('hero_image');
$t = get_field('overlay_title') ?: get_the_title();
$c = get_field('overlay_content');
?>
<main class="sp">
<section class="sp-hero">
<?php if ($img) : ?>
<img class="sp-hero__img" src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>">
<?php endif; ?>
<div class="sp-card">
<h1 class="sp-title"><?php echo esc_html($t); ?></h1>
<div class="sp-text">
<?php echo $c ? wp_kses_post($c) : the_content(); ?>
</div>
</div>
</section>
</main>
<?php
endwhile; endif;
get_footer();
