<template>
    <Head title="Blog" />

    <main-layout>
        <h2>Esto es texto propio del Blog C:</h2>
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
}
</script>
