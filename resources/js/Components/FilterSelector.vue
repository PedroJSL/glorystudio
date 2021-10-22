<template>
    <div class="w-auto rounded-md m-auto shadow-sm">
        <ul class="flex flex-row flex-wrap justify-center">
            <li id = "0" class="link ml-3" :class="{'text-shadow': 0 === selected, }" v-on:click="changeFilter()">Todos</li>

            <li v-on:click="changeFilter(category)" :class="{'text-shadow': category.id === this.selected, }" class="link ml-3" v-for="category in categories" :key="category.id" >
                {{category.name}}
            </li>
        </ul>
    </div>

</template>
<script>

export default {
    props:{
        categories: {},
    },
    emits:['filterChange'],
    data(){
        return {
            selected: 0,
        }
    },
    methods:{
        changeFilter(category){
            this.selected = (category == null) ? 0 : category.id;
            this.$emit('filterChange', this.selected);
        }
    },
}
</script>
