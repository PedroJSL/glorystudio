<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap -mb-1 justify-end p-2">
      <template v-for="(link, key) in links" :key="key">
        <div v-if="link.url === null"  class="mr-1 mb-1 px-3 py-2 text-sm leading-3 text-pink-lighter border rounded" v-html="link.label" />
        <Link v-else :class="{ 'pagination-active': link.active }" class="mr-1 mb-1 px-3 py-2 text-sm leading-3 border border-pink-dark  rounded hover:bg-pink-dark hover:text-white focus:border-pink-dark focus:text-white"  :href="link.url" v-html="link.label" />
      </template>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components:
    {
        Link,
    },
    props: {
        links: Array,
    },
}
</script>
