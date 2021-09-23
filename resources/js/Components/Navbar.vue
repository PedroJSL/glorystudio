<template>
  <header v-click-outside="onClickOutside">
    <nav class="flex flex-row shadow-md justify-between" ref = "target">
      <!-- Botón Menú -->
      <div  class="flex flex-row items-center mx-2 lg:hidden">
        <button v-on:click="showMenu = !showMenu" class="w-10 h-10 outline-none relative">
          <div class="w-5">
              <span aria-hidden="true" class="block absolute h-0.5 w-5 bg-pink-dark transform transition duration-500 ease-in-out" :class="{'rotate-45': showMenu,' -translate-y-1.5': !showMenu }"></span>
              <span aria-hidden="true" class="block absolute h-0.5 w-5 bg-pink-dark transform transition duration-500 ease-in-out" :class="{'opacity-0': showMenu } "></span>
              <span aria-hidden="true" class="block absolute h-0.5 w-5 bg-pink-dark transform transition duration-500 ease-in-out" :class="{'-rotate-45': showMenu, ' translate-y-1.5': !showMenu}"></span>
          </div>
        </button>
      </div>


      <div class="flex flex-row lg:justify-start">
        <!-- Logo -->
        <a class="flex flex-row p-2 items-center" href="/">
          <img class="w-8 mr-2" src="/images/Logo_icon.png" alt="" />
          <span class="text-lg font-bold text-pink-dark">Glory Studio</span>
        </a>

        <!-- Links de Navegacion -->
        <div class="hidden lg:flex lg:flex-row p-2 items-center">
          <a v-bind:class="{'text-aqua-dark': this.currentUrl === '/about-me',}" class="text-pink mx-2 hover:text-pink-dark" href="/about-me">Sobre mi</a>
          <a v-bind:class="{'text-aqua-dark': this.currentUrl === '/portfolio',}" class="text-pink mx-2 hover:text-pink-dark" href="/portfolio">Portfolio</a>
          <a v-bind:class="{'text-aqua-dark': this.currentUrl === '/blog',}" class="text-pink mx-2 hover:text-pink-dark" href="/blog">Blog</a>
          <a v-bind:class="{'text-aqua-dark': this.currentUrl === '/shop',}" class="text-pink mx-2 hover:text-pink-dark" href="/shop">Tienda</a>
          <!--a v-bind:class="{'text-aqua-dark': this.currentUrl === '/contact',}" class="text-pink mx-2 hover:text-pink-dark" href="/contact">Contacto</a-->
        </div>
      </div>

      <!-- Avatar de usuario -->
      <div v-on:click="showHideUserMenu" class="flex flex-row items-center mr-2 lg:hidden" >
        <button class="outline-none">
          <img class="w-9 rounded-full border-2 border-pink hover:border-pink-dark p-1" src="/images/user.png" alt="" />
        </button>
      </div>

      <!-- Login/Panel de usuario -->
      <div class="hidden lg:flex lg:flex-row p-2 items-center">
        <a class="mr-1 text-sm p-1 rounded-md text-pink-dark hover:text-aqua-dark" href="/register">Regístrate</a>
        <a class="mr-1 text-sm p-1 rounded-md text-pink-dark border-2 border-pink-dark
                hover:text-white hover:border-aqua-dark hover:bg-aqua" href="/login">Iniciar Sesión</a>
      </div>
    </nav>
      <!-- Menu movil -->
      <!-- Transicion:
      *.- enter-class: Estado inicial
      *.- enter-active-class: Animacion de entrada
      *.- enter-to: Estado final tras la entrada.

      *.- leave: estado inicial de salida
      *.- leave-active: Animación de salida
      *.- leave-to: estado final tras la salida
      -->
      <transition
        enter-active-class="transform transition duration-200"
        enter-class="-translate-y-1/2 scale-y-0 opacity-0"
        enter-to-class="translate-y-0 scale-y-100 opacity-100"
        leave-active-class="transform transition duration-300"
        leave-class="translate-y-0 scale-y-100 opacity-100"
        leave-to-class="-translate-y-1/2 scale-y-0 opacity-0"
      >
      <div v-if="showMenu" class="" ref="menu">
        <ul class="absolute left-0 right-0 bg-white mb-4 shadow-md overflow-hidden lg:hidden">
          <li>
            <a v-bind:class="{'text-aqua-dark hover:text-aqua-dark':this.currentUrl === '/about-me',}" class="block text-pink hover:text-pink-dark mr-4 p-2 shadow-sm" href="/about-me">Sobre mi</a>
          </li>
          <li>
            <a v-bind:class="{'text-aqua-dark': this.currentUrl === '/portfolio',}" class="block text-pink hover:text-pink-dark mr-4 p-2 shadow-sm" href="/portfolio" >Portfolio</a>
          </li>
          <li>
            <a v-bind:class="{'text-aqua-dark': this.currentUrl === '/blog',}" class="block text-pink hover:text-pink-dark mr-4 p-2 shadow-sm" href="/blog">Blog</a>
          </li>
          <li>
            <a v-bind:class="{'text-aqua-dark': this.currentUrl === '/shop',}" class="block text-pink hover:text-pink-dark mr-4 p-2 shadow-sm" href="/shop" >Tienda</a>
          </li>
        </ul>
      </div>
      </transition>


    <div class="flex-col items-end hidden" ref="userMenu">
      <ul class="text-center">
        <li class="p-2">
          <a class="mr-1 w-auto text-sm p-1 rounded-md text-pink-dark hover:text-aqua-dark " href="/register"> Regístrate </a>
        </li>
        <li class="p-2">
          <a class="mr-1 w-auto text-sm p-1 rounded-md text-pink-dark border-2 border-pink-dark
                  hover:text-white hover:border-aqua-dark hover:bg-aqua " href="/login"> Iniciar Sesión </a>
        </li>
      </ul>
    </div>

  </header>
</template>

<script>
import vClickOutside from 'click-outside-vue3';

export default {
  props: [],
  directives:{
      clickOutside: vClickOutside.directive
  },
  data() {
    return {
      currentUrl: "",
      showMenu: false,
    };
  },
  mounted: function () {
    this.currentUrl = window.location.pathname;
  },
  methods: {
    showHideMenu() {
      //this.$refs.menu.classList.toggle("hidden");
      //this.$refs.menu.classList.toggle("transform");
      //this.$refs.menuIcon.classList.toggle("transform");
    },
    showHideUserMenu() {},
    onClickOutside(event){
        if(this.showMenu === true)
        {
            this.showMenu = false;
        }
    },
  },
};
</script>
