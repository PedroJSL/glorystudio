<template>
    <Head title="Index" />

    <main-layout>

        <div class="container mx-auto mt-2">
            <div class="flex flex-row lg:flex-row p-2">
                <img class="w-48 rounded" src="/images/glory_sf.png" alt="">

                <div class="flex flex-col">
                    <h2 class="font-logo font-semibold text-pink-dark">Hola, Soy Gloria</h2>
                    <h2 class="font-logo font-semibold text-pink-dark">¡Bienvenido a mi estudio!</h2>

                    <div class="mt-1" v-html="biography"/>

                </div>

            </div>

            <div class="flex flex-row p-2">
                <div>
                    <h3 class="font-logo font-semibold text-pink-dark">Mis servicios</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Incidunt tempora, ipsa optio fugiat nobis ipsum officiis dicta distinctio facilis molestiae mollitia ea fuga voluptatibus fugit esse tenetur, minus exercitationem reiciendis.</p>
                    <ul>
                        <li>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</li>
                        <li>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</li>
                        <li>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</li>
                        <li>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</li>
                    </ul>
                </div>
                <img class="w-60 rounded hidden lg:block" src="/images/glory.jpeg" alt="">
            </div>

        </div>


    </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        MainLayout,
        Head,
    },
    props:
    {
        biography: "",
    }
}
</script>
