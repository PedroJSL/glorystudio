<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-pink-lighter via-pink-light to-pink">
        <div class="w-11/12 sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
            <div>
                <Link href="/">
                    <img class = "w-6/12 mx-auto my-4" src="/images/logo_oficial.png" >
                </Link>
            </div>

            <slot />
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    }
}
</script>
