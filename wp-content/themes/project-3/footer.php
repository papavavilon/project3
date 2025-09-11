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


<?php wp_footer(); ?>
</body>
</html>
