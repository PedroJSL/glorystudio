<template>

<div class="w-full h-full">
    <div class="relative">
        <img class="rounded" :src="images[index].image_url" >

        <button v-on:click="onPreviousClick" class="absolute h-full w-1/6 p-4 text-pink-light hover:text-pink top-0 left-0">
            <div class="flex justify-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </div>
        </button>
        <button v-on:click="onNextClick" class="absolute h-full w-1/6 p-4 text-pink-light hover:text-pink top-0 right-0">
            <div class="flex justify-end">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </button>
    </div>
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
            interval: null,
        }
    },
    created(){
        this.interval = setInterval(()=>this.next(), 5000);
    },
    beforeUnmount(){
        clearInterval();
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
        onPreviousClick(){
            clearInterval(this.interval);
            this.previous();
        },
        onNextClick()
        {
            clearInterval(this.interval);
            this.next();
        }
    },


}
</script>
