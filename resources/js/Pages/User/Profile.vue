<template>
    <Head :title="user.name"/>
    <main-layout>

        <div class="container flex flex-col p-4">

            <h2 class="font-logo font-semibold text-lg text-pink-dark">Perfil de usuario</h2>

            <div class="flex flex-col lg:flex-row">
                <form action="" method="post">

                    <!--imagen de perfil -->
                    <div class="w-1/2">
                        <img class="rounded border-2 border-pink-lighter" :src="user.avatar" alt="">
                        <input type="file" name="avatar" id="avatar">
                    </div>

                </form>
            </div>

        </div>

    </main-layout>
</template>
<script>
import MainLayout from '@/Layouts/MainLayout.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components:{
        MainLayout,
        Head,
    },
    mounted(){
        console.table(this.user);
    },
    props:
    {
        user: {},
    }
}
</script>
