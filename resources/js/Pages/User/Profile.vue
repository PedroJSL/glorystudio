<template>
    <Head title="{{user.name}}"/>
    <main-layout>
        {{user}}
    </main-layout>
</template>
<script>
import MainLayout from '@/Layouts/MainLayout.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components:{
        MainLayout,
        Head,
    },
    props:
    {
        user: {},
    }
}
</script>
