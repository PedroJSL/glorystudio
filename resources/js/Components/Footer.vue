<template>

<footer class="bg-pink-lighter border-t-2 border-pink-dark mt-2">
    <a href="#">
    <div class="bg-pink-light hover:bg-pink border-b-1 border-pink text-center p-2">
         Volver Arriba
    </div>
    </a>

    <div class="flex flex-row justify-between">

        <div class="p-2 m-auto mt-2">
            <!-- Enlaces de contacto -->
            <h2 class="text-pink-dark font-logo mb-4">Contacta conmigo:</h2>
            <div class="justify-between ">
                <div v-for="contact in owner.contact" :key="contact.id">
                    <a :href = "contact.url" >
                        <img :src = "contact.icon" class="w-10 inline-block rounded-full shadow-md m-2 opacity-75 hover:opacity-100">
                        <span>{{ contact.slug }}</span>
                    </a>
                </div>
            </div>



            <!-- Enlaces de Redes sociales-->
            <h2 class="text-pink-dark font-logo mt-4">Puedes seguirme en</h2>

            <div class="flex flex-row justify-between ">
                <div v-for="rs in owner.rrss" :key="rs.id">
                    <a :href = "rs.url" > <img :src = "rs.icon" class="w-10 rounded-full shadow-md m-2 opacity-75 hover:opacity-100"> </a>
                </div>

            </div>

        </div>

        <!-- Formulario de contacto, solo visible en pantallas grandes -->
        <div class="hidden  w-6/12 m-auto md:block p-7 border-l-2 border-pink mt-2">
            <h2 class="text-pink-dark font-logo">Formulario de contacto</h2>

            <ValidationErrors class="mb-4 mt-4" />

            <form @submit.prevent="submit">
                <div class="mt-2">
                    <label class="form-label" for="email">Correo electrónico </label>
                    <input id="email" name = "email" type="email" class="mt-1 block w-full input" v-model="form.email" required>
                </div>
                <div class="mt-2">
                    <label class="form-label" for="email">Asunto </label>
                    <input id="email" name = "email" type="text" class="mt-1 block w-full input" v-model="form.subject" required>
                </div>
                <div class="mt-2">
                    <label class="form-label" for="email">Mensaje </label>
                    <textarea id="email" name = "email" class="mt-1 block w-full input" v-model="form.message" required></textarea>
                </div>

                <div class="w-auto mt-4 flex flex-row justify-end">
                    <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class = "ml-4 btn text-md">
                        Enviar Mensaje
                    </button>
                </div>

            </form>
        </div>

    </div>


    <div class="flex p-3 justify-end">

        <!--
        <a href="#" class="link underline font-logo">Aviso Legal</a>
        <a href="#" class="link underline font-logo">Términos y Condiciones</a>
        <a href="#" class="link underline font-logo mr-8">Política de Cookies</a>
        -->
        <p class="text-sm font-logo text-pink-dark">©2021, Glory Studio. Todos los derechos reservados.</p>
    </div>
</footer>

</template>

<script>
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import ValidationErrors from '@/Components/ValidationErrors.vue'

export default {
    components:{
        ValidationErrors,
    },
  setup(){
      const owner = computed( () => usePage().props.value.owner )
      return { owner }
  },
  data(){
      return{
          form: this.$inertia.form(
              {email:'',
              subject:'',
              message:''})
      }
  },
  methods:{
      submit(){
          this.form.post(this.route('/'));
      },
  },
};
</script>
