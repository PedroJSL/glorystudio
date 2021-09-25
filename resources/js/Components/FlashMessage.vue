<template>
    <div class="p-3 bg-sky-200 border-2 border-sky-800 rounded-lg text-sky-900 w-auto abolute float-right" >
        <p> Mensaje de ejemplo </p>
    </div>
</template>

<script>
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

export default {
    setup(){
        const message = computed(() => usePage.props.value.flash.message )
    }
}
</script>
