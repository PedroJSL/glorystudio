<template>
    <Head title="Portfolio" />

    <main-layout>
        <!-- Cabecera de sección -->
        <div class="text-center">
            <h2 class = "font-logo font-bold text-pink-dark text-2xl">Mis Trabajos</h2>
        </div>

        <!-- Barra de navegación por las diferentes categorías de los proyectos -->
        <Filter :categories="categories" v-on:filterChange="changeFilter"/>

        <!-- Prueba Filtrado -->
        <div class="container mt-5 p-2 m-auto grid grid-cols-1 lg:grid-cols-3 gap-2 justify-items-center">
            <Card :class="{'hidden': selected != 0 && project.project_category_id != selected }" v-for="project in projects" :key="project.id" :project="project" :category="categories[project.project_category_id-1]" />
        </div>

    </main-layout>
</template>

<script>
import Filter from '@/Components/FilterSelector.vue';
import Card from '@/Components/ProjectCard.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        MainLayout,
        Head,
        Filter,
        Card,
    },
    props:{
        categories: {},
        projects: {},
    },
    data(){
        return {
            selected: 0,
        }
    },
    methods:{
        changeFilter(category){
            this.selected = category;
        }
    },
}
</script>
