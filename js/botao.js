<script>
 
  const openButton = document.querySelector('.open-slide-over');

  // Encontrar o painel deslizante
  const slideOver = document.querySelector('.slide-over');

  // Encontrar o botão para fechar o painel
  const closeButton = slideOver.querySelector('.close-slide-over');

  // Função para abrir o painel deslizante
  function openSlideOver() {
    slideOver.classList.add('open');
  }

  // Função para fechar o painel deslizante
  function closeSlideOver() {
    slideOver.classList.remove('open');
  }

  // Adicionar eventos de clique para abrir e fechar o painel
  openButton.addEventListener('click', openSlideOver);
  closeButton.addEventListener('click', closeSlideOver);
</script>
