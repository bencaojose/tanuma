<script>
  const openMobileMenuButton = document.getElementById('openMobileMenuButton');
  const mobileMenu = document.getElementById('mobile-menu');
  const userMenuButton = document.getElementById('user-menu-button');
  const userMenu = document.getElementById('user-menu');

  openMobileMenuButton.addEventListener('click', () => {
    const expanded = openMobileMenuButton.getAttribute('aria-expanded') === 'true';
    openMobileMenuButton.setAttribute('aria-expanded', !expanded);
    mobileMenu.classList.toggle('hidden');
  });

  userMenuButton.addEventListener('click', () => {
    const expanded = userMenuButton.getAttribute('aria-expanded') === 'true';
    userMenuButton.setAttribute('aria-expanded', !expanded);
    userMenu.classList.toggle('hidden');
  });
</script>
</body>
</html>