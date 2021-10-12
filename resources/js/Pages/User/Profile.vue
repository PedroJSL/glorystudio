<template>
    <Head :title="user.name"/>
    <main-layout>

        <div class="container flex flex-col p-4">

            <h2 class="font-logo font-semibold text-2xl text-pink-dark border-b-2 border-pink">Perfil de usuario</h2>

            <form id = "userData" class="mt-2 flex flex-col" @submit.prevent="submitUserData">
                <div class="flex flex-col lg:flex-row">

                    <!--imagen de perfil -->
                    <div class="w-1/2">
                        <h3 class="font-logo font-semibold text-lg text-pink-dark">Imagen de usuario:</h3>
                        <img class="rounded border-2 border-pink-lighter" :src="user.avatar" alt="" ref="avatarPreview">
                        <input type="file" name="avatar" id="avatar" v-on:change="submitUserData">
                    </div>

                </div>

                <div class="flex flex-col lg:flex-row mt-4">

                    <div>
                        <label class = "form-label text-pink-dark" for="name"> Nombre </label>
                        <input id="name" type="text" class="mt-1 block w-full input" v-model="user.name" required v-on:change="submitUserData" />
                    </div>

                    <div class="mt-4 lg:mt-0 lg:ml-4">
                        <label class = "form-label text-pink-dark" for="email"> Correo electrónico </label>
                        <input id="email" type="email" class="mt-1 block w-full input" v-model="user.email" required v-on:change="submitUserData"/>
                    </div>

                </div>

                <div class="mt-4">
                    <label for="biography" class="form-label text-pink-dark">Biografía</label>
                    <!--textarea name="biography" id="biography" v-model="user.biography" cols="50" rows="20"></textarea-->
                    <editor :modelValue="user.biography" v-on:change="submitUserData" />
                </div>

            </form>

        </div>

    </main-layout>
</template>
<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import Editor from '@/Components/RichEditor.vue';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components:{
        MainLayout,
        Editor,
        Head,
    },
    mounted(){
    },
    props:
    {
        user: {},
    },
    data(){
        return {
        }
    },
    methods:{
        /*
        onAvatarChanged(e){
            const file = e.target.files[0];
            this.user.avatar = URL.createObjectURL(file);
        },
        */
        submitUserData(){
            console.log("Modificao.");
            console.table(this.user);


        },
    }
}
</script>
