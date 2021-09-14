<template>
  <nav class="bg-white shadow-md">
    <div class="max-w-6xl mx-auto px-4">
      <div class="flex justify-between">
        <!-- Mobile menu button -->
        <div class="md:hidden flex items-center">
          <button class="outline-none mobile-menu-button">
            <svg
              class="w-6 h-6 text-gray-500 hover:text-green-500"
              x-show="!showMenu"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </button>
        </div>

        <div class="flex space-x-5">
          <div class="md:justify-items-center">
            <!-- Website Logo -->
            <a href="/" class="flex items-center py-1 px-2">
              <img src="/images/logo.png" alt="Logo" class="h-8 w-8 mr-2" />
              <span class="font-semibold text-pink-dark text-lg"
                >Glory Studio</span
              >
            </a>
          </div>
          <!-- Primary Navbar items -->
          <div class="hidden md:flex items-center space-x-1">
            <a href="" class="nav-link-active">Sobre mi</a>
            <a href="" class="nav-link">Portfolio</a>
            <a href="" class="nav-link">Blog</a>
            <a href="" class="nav-link">Tienda </a>
          </div>
        </div>

        <!-- Login/Registro Menú de usuario -->

        <!-- Secondary Navbar items -->
        <div class="hidden md:flex items-center space-x-3">
          <a
            href=""
            class="
              py-1
              px-1
              font-medium
              text-pink
              rounded
              hover:bg-pink-dark
              hover:text-white
              transition
              duration-300
            "
            >Entrar</a
          >
          <a href="" class="btn">Regístrate</a>
        </div>

        <!-- Opciones de Usuario -->
        <div class="md:hidden flex items-center">
          <button class="outline-none mobile-menu-button">
            <svg
              class="w-6 h-6 text-gray-500 hover:text-green-500"
              x-show="!showMenu"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- mobile menu -->
    <div class="hidden mobile-menu">
      <ul class="">
        <li>
          <a
            href="#services"
            class="
              block
              text-sm
              px-2
              py-4
              hover:bg-green-500
              transition
              duration-300
            "
            >Services</a
          >
        </li>
        <li>
          <a
            href="#about"
            class="
              block
              text-sm
              px-2
              py-4
              hover:bg-green-500
              transition
              duration-300
            "
            >About</a
          >
        </li>
        <li>
          <a
            href="#contact"
            class="
              block
              text-sm
              px-2
              py-4
              hover:bg-green-500
              transition
              duration-300
            "
            >Contact Us</a
          >
        </li>
      </ul>
    </div>
  </nav>
</template>


<script>
const btn = document.querySelector("button.mobile-menu-button");
const menu = document.querySelector(".mobile-menu");

btn.addEventListener("click", () => {
  menu.classList.toggle("hidden");
});
</script>
