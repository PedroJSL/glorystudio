<template>

<div class="w-full h-full">
    <img :src="images[index].image_url" >

    <button v-on:click="previous"> Anterior </button>
    <button v-on:click="next"> Siguiente </button>
</div>

</template>
<script>

export default {
    props:{
        images: {},
    },
    data()
    {
        return{
            index: 0,
        }
    },
    methods:{
        previous()
        {
            if(this.index > 0)
            {
                this.index--;
            }
            else
            {
                this.index = this.$props.images.length - 1;
            }
        },
        next()
        {
            if(this.index < this.$props.images.length-1)
            {
                this.index ++;
            }
            else
            {
                this.index = 0;
            }
        },
    },


}
</script>
