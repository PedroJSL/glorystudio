<template>
    <Navbar/>
    <main class="pt-2">
        <slot />
    </main>
    <Footer/>
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
