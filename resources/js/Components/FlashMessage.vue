<template>

      <transition
        enter-active-class="opacity-100 duration-200"
        enter-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="opacity-0 duration-300"
        leave-class="opacity-100"
        leave-to-class="opacity-0" >

            <div v-if="message" :class="{'success': type == 0, 'info': type == 1, 'error': type == 2, 'warning': type == 3}" class="p-3 w-auto fixed top-0 right-0 z-40 float-right rounded-lg" >
                <p> {{message}} </p>
            </div>

      </transition>

</template>

<script>
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

export default {
    setup(){
        const type = computed(() => usePage.props.value.flash.type)
        const message = computed(() => usePage.props.value.flash.message )
    }
}
</script>
