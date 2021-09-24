<template>
    <Navbar/>
    <main>
        <slot />
    </main>
    <Footer/>
</template>

<script>
import Navbar from "@/Components/Navbar";
import Footer from "@/Components/Footer.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Navbar,
    Footer,
    Link,
  },
};
</script>
