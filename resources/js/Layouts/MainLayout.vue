<template>
    <div class="flex flex-col h-screen">
        <Navbar/>
        <main class="pt-2 flex-grow">
            <slot />
        </main>
        <Footer/>
    </div>
</template>

<script>
import Navbar from "@/Components/Navbar";
import FlashMessage from "@/Components/FlashMessage.vue"
import Footer from "@/Components/Footer.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Navbar,
    Footer,
    FlashMessage,
    Link,
  },
};
</script>
