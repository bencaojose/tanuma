<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BBC auto</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .nav-link,
    .mobile-nav-link {
      border-color: transparent;
      cursor: pointer;
    }

    .nav-link:hover,
    .mobile-nav-link:hover {
      border-color: gray;
    }

    .nav-link.active,
    .mobile-nav-link.active {
      border-color: blue;
      color: blue;
    }

    .sm\:justify-center {
      justify-content: center;
    }
  </style>
</head>
<body>
  <nav class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-16 justify-between items-center">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button -->
          <button type="button" id="openMobileMenuButton" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <!-- Icon when menu is closed -->
            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!-- Icon when menu is open -->
            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="flex items-center">
          <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
        </div>
        <div class="hidden sm:flex sm:space-x-8 mx-auto">
          <a href="home.php" id="dashboardLink" class="nav-link inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium text-gray-900">Home</a>
          <a href="compra.php" id="teamLink" class="nav-link inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium text-gray-500">Compra</a>
          <a href="aluga.php" id="projectsLink" class="nav-link inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium text-gray-500">Aluguer</a>
          <a href="registo.php" id="calendarLink" class="nav-link inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium text-gray-500">Registo</a>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
  <!-- Botão de Logout -->
  <button type="button" class="relative rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
    <a href="../connection/logout.php" class="flex items-center">
      <span class="sr-only">Sair</span>
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
      </svg>
    </a>
  </button>

  <!-- Botão para Perfil -->
  <button type="button" class="relative rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 ml-3">
    <a href="perfil_cliente.php" class="flex items-center">
      <span class="sr-only">Perfil</span>
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.75c-4.43 0-8 3.57-8 8s3.57 8 8 8 8-3.57 8-8-3.57-8-8-8zM12 2.5c5.24 0 9.5 4.26 9.5 9.5s-4.26 9.5-9.5 9.5-9.5-4.26-9.5-9.5S6.76 2.5 12 2.5zm0 4.5a2.25 2.25 0 0 0-2.25 2.25A2.25 2.25 0 1 0 12 7zm0 7.75c-2.64 0-5 1.29-5 2.25v.25h10v-.25c0-.96-2.36-2.25-5-2.25z" />
      </svg>
    </a>
  </button>

  <!-- Profile dropdown -->
  <div class="relative ml-3" x-data="{ open: false }" @click.away="open = false">
    <div>
      <button @click="open = !open" type="button" class="relative flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
        <span class="absolute -inset-1.5"></span>
        <span class="sr-only">Open user menu</span>
      </button>
    </div>
  </div>
</div>

      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu">
      <div class="space-y-1 pb-4 pt-2">
        <a href="home.php" id="mobileDashboardLink" class="mobile-nav-link block border-l-4 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-indigo-700">Home</a>
        <a href="compra.php" id="mobileTeamLink" class="mobile-nav-link block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500">Compra</a>
        <a href="aluga.php" id="mobileProjectsLink" class="mobile-nav-link block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500">Aluguer</a>
        <a href="registo.php" id="mobileCalendarLink" class="mobile-nav-link block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500">Registo</a>
      </div>
    </div>
  </nav>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const links = document.querySelectorAll('.nav-link');
      const mobileLinks = document.querySelectorAll('.mobile-nav-link');

      links.forEach(link => {
        link.addEventListener('click', function () {
          links.forEach(link => link.classList.remove('active'));
          this.classList.add('active');
        });
      });

      mobileLinks.forEach(link => {
        link.addEventListener('click', function () {
          mobileLinks.forEach(link => link.classList.remove('active'));
          this.classList.add('active');
        });
      });
    });
  </script>
</body>
</html>
