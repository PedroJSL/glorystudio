<template>
    <Head title="Blog" />

    <main-layout>

        <!-- Cabecera de sección -->
        <div class="w-auto rounded-md m-auto shadow-sm mt-2">
            <ul class="flex flex-row flex-wrap justify-center">
                <li class="text-pink-dark font-semibold italic">Elige un tema: </li>
                <li id = "0" class="link ml-3" :class="{'text-shadow': '/blog' === currentLocation, }"> <a href="/blog">Todos</a></li>

                <li :class="{'text-shadow': '/blog/'+category.slug === currentLocation }" class="link ml-3" v-for="category in categories" :key="category.id" >
                <a :href="'/blog/'+category.slug"> {{category.name}} </a>
                </li>
            </ul>
        </div>

        <div class="flex flex-col mt-2">
            <pagination :links="posts.links" />


            <div class="container mt-5 p-2 m-auto grid grid-cols-1 lg:grid-cols-3 gap-2 justify-items-center">
                <Card v-for="post in posts.data" :key="post.id" :post="post" :category="categories[post.post_category_id-1]" />
            </div>
        </div>
    </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import Card from '@/Components/BlogCard.vue';
import { Head } from '@inertiajs/inertia-vue3';


export default {
    components: {
        MainLayout,
        Pagination,
        Head,
        Card,
    },
    props:
    {
        posts: {},
        categories: {},
    },
    data()
    {
        return{
            currentLocation: window.location.pathname
        }
    }
}
</script>
