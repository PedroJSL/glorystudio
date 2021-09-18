<template>
  <header>
    <nav class="flex flex-row shadow-md justify-between">
      <!-- Botón Menú -->
      <div v-on:click="showHideMenu" class="flex flex-row items-center ml-2 text-pink-dark lg:hidden">
          <button class ="outline-none">

            <svg v-if="showMenu" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /> <!-- boton con X -->
            </svg>
            <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /> <!-- Boton de menu -->
            </svg>

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
          <a v-bind:class="{'text-aqua-dark': this.currentUrl === '/about-me'}" class="text-pink mx-2 hover:text-aqua-dark" href="/about-me" >Sobre mi</a>
          <a v-bind:class="{'text-aqua-dark': this.currentUrl === '/portfolio'}" class="text-pink mx-2 hover:text-aqua-dark" href="/portfolio">Portfolio</a>
          <a v-bind:class="{'text-aqua-dark': this.currentUrl === '/blog'}" class="text-pink mx-2 hover:text-aqua-dark" href="/blog">Blog</a>
          <a v-bind:class="{'text-aqua-dark': this.currentUrl === '/shop'}" class="text-pink mx-2 hover:text-aqua-dark" href="/shop">Tienda</a>
          <a v-bind:class="{'text-aqua-dark': this.currentUrl === '/contact'}" class="text-pink mx-2 hover:text-aqua-dark" href="/contact">Contacto</a>
        </div>
      </div>

      <!-- Avatar de usuario -->
      <div v-on:click="showHideUserMenu" class="flex flex-row items-center mr-2">
          <button class="outline-none">
            <img class="w-9 rounded-full border-2 border-pink-dark hover:border-aqua-dark p-1" src="/images/user.png" alt="">
          </button>
      </div>

      <!-- Login/Panel de usuario
      <div class="hidden lg:flex lg:flex-row p-2 items-center">
        <a class="mr-1 text-sm p-1 rounded-md text-pink-dark hover:text-aqua-dark" href="/register" >
          Regístrate
        </a>
        <a class="mr-1 text-sm p-1 rounded-md text-pink-dark border-2 border-pink-dark hover:text-white hover:border-aqua-dark hover:bg-aqua" href="/login">
          Iniciar Sesión
        </a>
      </div>
      -->
    </nav>

    <div v-show="showMenu" class="" id="mobile-menu" >
        <ul class="">
        <li><a v-bind:class="{'text-aqua-dark': this.currentUrl === '/about-me'}" class="block text-pink hover:text-aqua-dark mr-4 p-2 shadow-sm" href="/about-me">Sobre mi</a></li>
        <li><a v-bind:class="{'text-aqua-dark': this.currentUrl === '/portfolio'}" class="block text-pink hover:text-aqua-dark mr-4 p-2 shadow-sm" href="/portfolio">Portfolio</a></li>
        <li><a v-bind:class="{'text-aqua-dark': this.currentUrl === '/blog'}" class="block text-pink hover:text-aqua-dark mr-4 p-2 shadow-sm" href="/blog">Blog</a></li>
        <li><a v-bind:class="{'text-aqua-dark': this.currentUrl === '/shop'}" class="block text-pink hover:text-aqua-dark mr-4 p-2 shadow-sm" href="/shop">Tienda</a></li>
        <li><a v-bind:class="{'text-aqua-dark': this.currentUrl === '/contact'}" class="block text-pink hover:text-aqua-dark mr-4 p-2 shadow-sm" href="/contact">Contacto</a></li>
        </ul>
    </div>

    <div v-show="showUserMenu" class="flex flex-col items-end" id = "user-menu">
        <ul class="text-center">
        <li class="p-2">
        <a class="mr-1 w-auto text-sm p-1 rounded-md text-pink-dark hover:text-aqua-dark" href="/register" >
          Regístrate
        </a>
        </li>
        <li class="p-2">
        <a class="mr-1 w-auto text-sm p-1 rounded-md text-pink-dark border-2 border-pink-dark hover:text-white hover:border-aqua-dark hover:bg-aqua" href="/login">
          Iniciar Sesión
        </a>
        </li>
        </ul>
    </div>
  </header>
</template>

<script>
import { onBeforeMount } from '@vue/runtime-core';
export default {
  props: [],
  data(){
      return{
       showMenu:false,
       showUserMenu:false,
       currentUrl:"",
      }
  },
  mounted:function(){
      this.currentUrl = window.location.pathname;
  },
  methods:{
      showHideMenu(){
          if(this.showMenu == false)
          {
            this.showMenu = true;
          }
          else
          {
            this.showMenu = false;
          }
      },
      showHideUserMenu(){
          if(this.showUserMenu == false)
          {
            this.showUserMenu = true;
          }
          else
          {
            this.showUserMenu = false;
          }
      },
  }
};
</script>
