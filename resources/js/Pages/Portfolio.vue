<template>
    <Head title="Portfolio" />

    <main-layout>
        <!-- Cabecera de sección -->
        <div class="text-center">
            <h2 class = "font-logo font-bold text-pink-dark text-2xl">Mis Trabajos</h2>
        </div>


        <!-- Barra de navegación por las diferentes categorías de los proyectos -->
        <Filter :categories="categories" v-on:filterChange="changeFilter"/>
        <!--
        <div class="w-auto rounded-md m-auto shadow-sm">
            <ul class="flex flex-row justify-center">
                <li id = "0" class="link ml-3" :class="{'text-shadow': 0 === selected, }" v-on:click="changeFilter()">Todos</li>

                <li v-on:click="changeFilter(category)" :class="{'text-shadow': category.id === this.selected, }" class="link ml-3" v-for="category in categories" :key="category.id" >
                    {{category.name}}
                </li>
            </ul>
        </div>
        -->

        <!-- Prueba Filtrado -->
        <div class="container mt-5 p-2 m-auto grid grid-cols-1 lg:grid-cols-3 gap-2">

            <Card :class="{'hidden': selected != 0 && project.project_category_id != selected }" v-for="project in projects" :key="project.id" :project="project" :category="categories[project.project_category_id-1]" />

            <!--
            <ul class="flex flex-col">

                <li :class="{'hidden': selected != 0 && project.project_category_id != selected }" class="" v-for="project in projects" :key="project.id">{{ project.name }} - Categoria: {{categories[project.project_category_id - 1].name}}</li>

            </ul>
            -->
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
        selected: Number,
    },
    data(){
        return {
            selected: this.$props.selected,
        }
    },
    methods:{
        changeFilter(category){
            this.selected = category;
        }
    },
}
</script>
