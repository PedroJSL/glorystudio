<template>

<div class="border-2 border-pink-dark shadow-md rounded-lg p-2 opacity-80 hover:opacity-100">
    <a :href="'/blog/'+category.slug+'/'+post.slug">

        <h3 class="font-logo text-pink-dark text-xl">{{post.name}}</h3>
        <div class="flex flex-row justify-center">
        <div class="text-md" v-html="post.excerpt"/>

        </div>
        <p class="text-right text-pink text-sm mt-1">Fecha: {{formatDate(post.publication_date)}}</p>
    </a>
</div>


</template>
<script>
export default {
    props:{
        post: {},
        category: {}
    },
    data(){
        return {
        }
    },
    methods:{
        formatDate(dateString)
        {
            var date = new Date(dateString);
            return date.toLocaleDateString('es-ES');
        }
    },
}
</script>
