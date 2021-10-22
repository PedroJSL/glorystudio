<template>
    <Head :title="post.name"/>
    <main-layout>
        <div class="container m-auto p-2 flex flex-col">
            <div class="flex flex-row justify-between">
                <div class="flex flex-row justify-items-start">
                <a href="javascript:history.back()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-pink hover:text-pink-dark mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                    </svg>
                </a>
                <h2 class="font-logo font-bold text-pink-dark  text-xl">{{post.name}}</h2>
                </div>
                <div v-if="user && user.web_owner" class="flex flex-row">
                    <a :href="'/blog/post/edit/'+post.id" class="btn mr-2 w-10 h-10 text-2xl">
                        <i class="ri-pencil-line"></i>
                    </a>
                    <button class="btn w-10 h-10 text-2xl" v-on:click="deletePost">
                        <i class="ri-delete-bin-6-line"></i>
                    </button>
                </div>
            </div>

            <div class="mt-4 p-4">
                <img :src="post.image" alt="">
                <div class="p-2 text-lg flex flex-col">
                    <div v-html="post.excerpt"/>
                    <div v-html="post.content"/>
                    <span class="font-logo text-sm text-pink-dark text-right">Fecha de publicación: {{ formatDate(post.publication_date) }}</span>
                </div>

            </div>

        </div>
    </main-layout>
</template>
<script>
    import MainLayout from '@/Layouts/MainLayout.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import { computed } from 'vue';
    import { usePage } from '@inertiajs/inertia-vue3';


export default {
    components:{
        MainLayout,
        Head,
    },
    props:{
        post:{},
    },
    setup()
    {
        const user = computed( () => usePage().props.value.auth.user)
        return { user }
    },
    data(){
        return {
            deleteForm: this.$inertia.form({
                post: this.post.id,
            })
        }
    },
    methods:{
        formatDate(dateString)
        {
            var date = new Date(dateString);
            return date.toLocaleDateString('es-ES');
        },
        deletePost()
        {
            this.deleteForm.post(this.route('post.delete'));
        }
    },

}
</script>
