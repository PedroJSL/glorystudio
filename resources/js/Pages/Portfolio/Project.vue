<template>
    <Head :title="project.name"/>
    <main-layout>
        <div class="container m-auto p-2 flex flex-col">
            <div class="flex flex-row justify-items-start">
                <a href="/portfolio">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-pink hover:text-pink-dark mr-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                    </svg>
                </a>
                <h2 class="font-logo font-bold text-pink-dark  text-xl">{{project.name}}</h2>
            </div>

            <div class="mt-4 p-4">

                <p class="p-2 text-lg flex flex-col">
                    {{project.description}}

                    <span class="font-logo text-sm text-pink-dark text-right">Proyecto realizado el: {{ formatDate(project.project_date) }}</span>
                </p>



                <!-- Slider de imágenes -->
                <Carousel :images="project.images"/>


            </div>

        </div>
    </main-layout>
</template>
<script>
    import MainLayout from '@/Layouts/MainLayout.vue';
    import Carousel from '@/Components/Carousel.vue';
    import { Head } from '@inertiajs/inertia-vue3';


export default {
    components:{
        MainLayout,
        Carousel,
        Head,
    },
    props:{
        project:{},
    },
    methods:{
        formatDate(dateString)
        {
            var date = new Date(dateString);
            return date.toLocaleDateString('es-ES');
        },

    },

}
</script>
