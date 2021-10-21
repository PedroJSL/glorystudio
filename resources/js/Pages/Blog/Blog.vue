<template>
    <Head title="Blog" />

    <main-layout>
        <pagination class="mt-6" :links="posts.links" />

        <ul>
            <li v-for="post in posts.data" :key="post.id"> {{post.name}}</li>
        </ul>

    </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head } from '@inertiajs/inertia-vue3';


export default {
    components: {
        MainLayout,
        Pagination,
        Head,
    },
    props:
    {
        posts: {},
        categories: {},
    }
}
</script>
