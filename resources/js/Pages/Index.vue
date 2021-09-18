<template>
    <Head title="Index" />

    <main-layout>
        <h2>Esto es texto propio del index C:</h2>
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
