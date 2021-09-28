<template>

<footer class="bg-pink-lighter border-t-2 border-pink-dark mt-2">
    <a href="#">
    <div class="bg-pink-light hover:bg-pink border-b-1 border-pink text-center p-2">
         Volver Arriba
    </div>
    </a>

    <div class="flex flex-row justify-center m-3">

        <div class="w-autop-7">
            <!-- Enlaces de Contacto -->
            <div>
                <h2 class="text-pink-dark font-logo"> Puedes contactar conmigo en los siguientes enlaces: </h2>
                <ul>
                    <li v-for="rs in owner.rrss" :key="rs.id">
                        <a :href = "rs.url" > <img :src = "rs.icon"> </a>
                    </li>
                </ul>
            </div>
            <!-- Enlaces a las RRSS -->
            <div>
            </div>
        </div>

        <!-- Formulario de contacto, solo visible en pantallas grandes -->
        <div class="hidden  w-auto lg:block bg-blue-500 p-7">

        </div>

    </div>

    <p class="p-10 text-right">©2021, Glory Studio. Todos los derechos reservados.</p>
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
