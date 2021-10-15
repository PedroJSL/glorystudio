<template>
    <Head title="Nuevo Proyecto"/>
    <main-layout>



    </main-layout>
</template>
<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import Editor from '@/Components/RichEditor.vue';
import ValidationErrors from '@/Components/ValidationErrors.vue';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components:{
        ValidationErrors,
        MainLayout,
        Editor,
        Head,
    },
}
</script>
