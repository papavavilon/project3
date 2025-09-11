<?php
// короткий JS для открытия/закрытия формы поиска рядом с иконкой
?>
<script>
(function(){
  const container = document.querySelector('.search-container');
  const btn = document.getElementById('search-button');
  const form = document.getElementById('search-form');
  if (!container || !btn || !form) return;

  btn.addEventListener('click', function(){
    container.classList.toggle('open');
    if (container.classList.contains('open')) {
      const input = form.querySelector('.search-field');
      input && input.focus();
    }
  });

  document.addEventListener('click', function(e){
    if (!container.contains(e.target)) container.classList.remove('open');
  });
  document.addEventListener('keydown', function(e){
    if (e.key === 'Escape') container.classList.remove('open');
  });
})();
</script>

<script>
(function(){
  const track = document.getElementById('newsTrack');
  const btn   = document.getElementById('newsMoreBtn');
  if (!track || !btn) return;

  let index = 0; // текущий слайд (страница)
  function slideNext(){
    const viewport = track.parentElement;             // .news__viewport
    const cards = track.querySelectorAll('.news__card');
    if (!cards.length) return;

    const gapPx = parseInt(getComputedStyle(track).gap) || 0;
    const isMobile = window.matchMedia('(max-width: 960px)').matches;

    // ширина шага: ширина видимой области (2 карточки на десктопе, 1 на мобиле)
    const step = viewport.clientWidth + gapPx;

    // максимальное количество страниц (округляем вверх)
    const totalWidth = track.scrollWidth;
    const maxIndex = Math.ceil(totalWidth / step) - 1;

    index = (index >= maxIndex) ? 0 : index + 1;

    const offset = -index * step;
    track.style.transform = `translateX(${offset}px)`;
  }

  btn.addEventListener('click', slideNext);

  // При ресайзе возвращаем в начало (чтобы не «зависало» между страницами)
  window.addEventListener('resize', () => {
    index = 0;
    track.style.transform = 'translateX(0)';
  });
})();
</script>

<?php
// ===== Support & Contacts =====
$home_id = (int) get_option('page_on_front') ?: get_queried_object_id();


$s_title    = get_field('support_title',    $home_id);
$s_subtitle = get_field('support_subtitle', $home_id);
$s_txt1     = get_field('support_text1',    $home_id);
$s_txt2     = get_field('support_text2',    $home_id);

$c_addr   = get_field('contact_address', $home_id);
$c_email  = get_field('contact_email',  $home_id);
$c_txt1   = get_field('contact_text1',  $home_id);
$c_txt2   = get_field('contact_text2',  $home_id);
?>

<section class="support">
    <hr class="divider">
  <div class="support__inner">

   
    <div class="support__left">
      <div class="support__box">
        <?php if ($s_title): ?>
          <h2 class="support__title"><?php echo esc_html($s_title); ?></h2>
        <?php endif; ?>

        <?php if ($s_subtitle): ?>
          <h3 class="support__subtitle"><?php echo esc_html($s_subtitle); ?></h3>
        <?php endif; ?>

        <?php if ($s_txt1): ?>
          <p class="support__p"><?php echo nl2br(esc_html($s_txt1)); ?></p>
        <?php endif; ?>

        <?php if ($s_txt2): ?>
          <p class="support__p"><?php echo nl2br(esc_html($s_txt2)); ?></p>
        <?php endif; ?>
      </div>
    </div>

   
    <div class="support__right">
      <?php if ($c_addr): ?>
        <address class="support__addr"><?php echo nl2br(esc_html($c_addr)); ?></address>
      <?php endif; ?>

      <?php if ($c_email): ?>
        <p class="support__email">
          <a href="mailto:<?php echo esc_attr($c_email); ?>"><?php echo esc_html($c_email); ?></a>
        </p>
      <?php endif; ?>

      <?php if ($c_txt1): ?>
        <p class="support__p"><?php echo nl2br(esc_html($c_txt1)); ?></p>
      <?php endif; ?>

      <?php if ($c_txt2): ?>
        <p class="support__p"><?php echo nl2br(esc_html($c_txt2)); ?></p>
      <?php endif; ?>
    </div>

  </div>
</section>

<?php wp_footer(); ?>
</body>
</html>
