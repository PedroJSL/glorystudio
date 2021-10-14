<template>

      <transition
        enter-active-class="opacity-100 duration-200"
        enter-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="opacity-0 duration-300"
        leave-class="opacity-100"
        leave-to-class="opacity-0" >

            <div v-show="message" :class="{'success': type == 0, 'info': type == 1, 'error': type == 2, 'warning': type == 3}" class="w-auto fixed top-14 right-5 z-40 float-right rounded-lg opacity-75" >
                <p class="p-3"> {{message}} </p>
            </div>

      </transition>

</template>

<script>
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

export default {
    setup(){
        const type = computed(() => usePage().props.value.flash.type);
        const message = computed(() => usePage().props.value.flash.message );
        return{ type, message}
    },
    watch:{
        message(val)
        {
            if(val != this.msg)
            {
                this.show = false;
            }
            if(!this.show)
            {
                if(this.tout != null)
                    clearTimeout(this.tout);

                this.show = true;
                this.tout = setTimeout(this.close, 5000);
                this.msg = this.message;
            }
        },
    },
    data(){
        return{
            show: false,
            tout: null,
            msg: null,
        }
    },
    methods:{
        close()
        {
            this.show = false;
            this.$inertia.reload();
        }
    }
}
</script>
