<template>

<div class="border-2 border-pink-dark shadow-md rounded-lg p-2 opacity-80 hover:opacity-100">
    <a :href="'/portfolio/'+project.slug">

        <h3 class="font-logo text-pink-dark text-xl">{{project.name}}</h3>
        <div class="flex flex-row">
            <img class="w-7/12 m-2 rounded" :src="project.images" alt="">
            <p class="text-md">{{project.description}}</p>
        </div>
        <p class="text-right text-pink text-sm mt-1">Fecha: {{project.project_date}}</p>
    </a>
</div>


</template>
<script>
export default {
    props:{
        project: {},
        category: {}
    },
    data(){
        return {
        }
    },
    methods:{

    },
}
</script>
