<template>
    <Navbar></Navbar>
    <main>
        <slot />
    </main>
</template>

<script>
import Navbar from "@/Components/Navbar";
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Navbar,
    Link,
  },
};
</script>
