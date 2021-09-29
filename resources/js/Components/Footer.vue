<template>

<footer class="bg-pink-lighter border-t-2 border-pink-dark mt-2">
    <a href="#">
    <div class="bg-pink-light hover:bg-pink border-b-1 border-pink text-center p-2">
         Volver Arriba
    </div>
    </a>

    <div class="flex flex-row justify-between">

        <div class="p-2 m-auto">
            <!-- Enlaces de contacto -->
            <h2 class="text-pink-dark font-logo">Contacta conmigo:</h2>
            <div class="justify-between ">
                <div v-for="contact in owner.contact" :key="contact.id">
                    <a :href = "contact.url" >
                        <img :src = "contact.icon" class="w-10 inline-block rounded-full shadow-md m-2 opacity-75 hover:opacity-100">
                        <span>{{ contact.slug }}</span>
                    </a>
                </div>
            </div>

            <!-- Enlaces de Redes sociales-->
            <h2 class="text-pink-dark font-logo mt-2">Puedes seguirme en</h2>
            <div class="flex flex-row justify-between ">
                <div v-for="rs in owner.rrss" :key="rs.id">
                    <a :href = "rs.url" > <img :src = "rs.icon" class="w-10 rounded-full shadow-md m-2 opacity-75 hover:opacity-100"> </a>
                </div>
            </div>
        </div>

        <!-- Formulario de contacto, solo visible en pantallas grandes -->
        <div class="hidden  w-auto m-auto md:block p-7 border-l-2 border-pink">
            <h2 class="text-pink-dark font-logo">Formulario de contacto</h2>
            <form action="">
            </form>
        </div>

    </div>

    <div>
        <p class="p-10 text-right">©2021, Glory Studio. Todos los derechos reservados.</p>
    </div>
</footer>

</template>

<script>
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

export default {
  setup(){
      const owner = computed( () => usePage().props.value.owner )
      return { owner }
  },
};
</script>
