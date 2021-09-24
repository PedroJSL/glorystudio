<template>
  <header class="sticky top-0" v-click-outside="onClickOutside">
    <nav class="flex flex-row shadow-md justify-between bg-white mb-2" ref = "target">
      <!-- Botón Menú -->
      <div  class="flex flex-row items-center mx-2 lg:hidden">
        <button v-on:click="showHideMenu" class="w-10 h-10 outline-none relative">
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
      <div class="flex flex-row items-center mr-2 lg:hidden" >
        <button v-on:click="showHideUserMenu" class="outline-none">
          <img v-bind:class="{'border-aqua-dark':this.showUserMenu}" class="w-9 rounded-full border-2 border-pink hover:border-pink-dark p-1" src="/images/user.png" alt="" />
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


    <transition
        enter-active-class="transform transition duration-200"
        enter-class="-translate-y-1/2 scale-y-0 opacity-0"
        enter-to-class="translate-y-0 scale-y-100 opacity-100"
        leave-active-class="transform transition duration-300"
        leave-class="translate-y-0 scale-y-100 opacity-100"
        leave-to-class="-translate-y-1/2 scale-y-0 opacity-0" >

    <div v-if="showUserMenu" class="absolute w-auto mt-0 p-2 right-0 flex flex-col items-end bg-white shadow-md rounded-b-md">
      <ul v-if="user === null" class="text-center">
        <li class="p-2">
          <a class="mr-1 w-auto text-sm p-1 rounded-md text-pink-dark hover:text-aqua-dark " href="/register"> Regístrate </a>
        </li>
        <li class="p-2">
          <a class="mr-1 w-auto text-sm p-1 rounded-md text-pink-dark border-2 border-pink-dark
                  hover:text-white hover:border-aqua-dark hover:bg-aqua " href="/login"> Iniciar Sesión </a>
        </li>
      </ul>
      <div v-else>
        <ul class="mb-0 p-2 shadow-sm text-right">
            <li><h2>Hola, {{ user.name }}</h2></li>
        </ul>

        <ul class="text-center p-2">
            <li>
                <form @submit.prevent="logout">
                    <input class="mr-1 w-auto text-sm p-1 rounded-md bg-white text-pink-dark border-2 border-pink-dark
                  hover:text-white hover:border-aqua-dark hover:bg-aqua " type="submit" value="Cerrar Sesión">
                </form>
            </li>
        </ul>

      </div>
    </div>

    </transition>
  </header>
</template>

<script>
import vClickOutside from 'click-outside-vue3';
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3'

export default {
  props: [],
  directives:{
      clickOutside: vClickOutside.directive
  },
  setup(){
      const user = computed( () => usePage().props.value.auth.user)
        console.log(user);
      return { user }
  },
  data() {
    return {
      currentUrl: "",
      showMenu: false,
      showUserMenu: false,
    };
  },
  mounted: function () {
    this.currentUrl = window.location.pathname;
  },
  methods: {
    onClickOutside(event){
        if(this.showMenu === true)
        {
            this.showMenu = false;
        }
        if(this.showUserMenu === true)
        {
            this.showUserMenu = false;
        }
    },
    showHideUserMenu(){
        this.showUserMenu = !this.showUserMenu;
        this.showMenu = false;
    },
    showHideMenu()
    {
        this.showMenu = !this.showMenu;
        this.showUserMenu = false;
    },
    logout(){
        this.$inertia.post('/logout', {})
        this.showMenu = false;
        this.showUserMenu = false;
    },
  },
};
</script>
