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

<?php wp_footer(); ?>
</body>
</html>
