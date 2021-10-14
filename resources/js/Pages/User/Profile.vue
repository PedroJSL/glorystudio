<template>
    <Head :title="user.name"/>
    <main-layout>

        <div class="container flex flex-col p-4 mx-auto">

            <h2 class="font-logo font-semibold text-2xl text-pink-dark border-b-2 border-pink">Perfil de usuario</h2>

            <form id = "updateImage" class="mt-2" @submit.prevent="updateImage">
                <div class="flex flex-row p-4 justify-between items-center ">

                    <!--imagen de perfil -->
                    <div class="w-5/12">
                        <h3 class="font-logo font-semibold text-lg text-pink-dark">Imagen de usuario:</h3>
                        <img class="rounded w-full border-2 border-pink-lighter my-auto" :src="user.avatar" alt="" ref="avatarPreview">
                        <input type="file" name="avatar" id="avatar" v-on:change="onAvatarChanged" v-on:blur="submitUserData" ref="avatar">
                    </div>
                    <input type="hidden" name = "user_id" :value = "user.id" >

                    <input class="btn block ml-5 h-20 align-middle" type="submit" value="Actualizar Imagen">
                </div>
            </form>

            <form id = "userData" class="mt-2 flex flex-col" @submit.prevent="submitUserData">
                <div class="flex flex-col lg:flex-row mt-4">

                    <div>
                        <label class = "form-label text-pink-dark" for="name"> Nombre </label>
                        <input id="name" type="text" class="mt-1 block w-full input" v-model.lazy="form.name" required v-on:blur="submitUserData" />
                    </div>

                    <div class="mt-4 lg:mt-0 lg:ml-4">
                        <label class = "form-label text-pink-dark" for="email"> Correo electrónico </label>
                        <input id="email" type="email" class="mt-1 block w-full input" v-model.lazy="form.email" required v-on:blur="submitUserData"/>
                    </div>

                </div>

                <div class="mt-4">
                    <label for="biography" class="form-label text-pink-dark">Biografía</label>
                    <!--textarea name="biography" id="biography" v-model="user.biography" cols="50" rows="20"></textarea-->
                    <editor v-model="user.biography" v-on:editorBlur="submitUserData"/>
                    <input id="biography" type = "hidden" name ="biography" v-model.lazy = "form.biography"  ref = "biography">
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
    props:
    {
        user: {},
    },
    data(){
        return {
            imageForm: this.$inertia.form({
                avatar: '',
                user_id: this.user.id,
            }),
            form: this.$inertia.form({
                name: this.user.name,
                email: this.user.email,
                biography: this.user.biography,
            })
        }
    },
    methods:{
        onAvatarChanged(e){
            const file = e.target.files[0];
            this.user.avatar = URL.createObjectURL(file);
        },
        updateImage(){
            if(this.$refs.avatar){
                this.imageForm.avatar = this.$refs.avatar.files[0];
            }
            this.imageForm.post(this.route('user.update.image'), {
                preserveScroll: true,
                onSuccess: () => this.$refs.avatar.value =null,
            })
        },
        submitUserData(){
                this.form.biography = this.user.biography;
                this.form.put(this.route('user.update', this.user.id),{
                    preserveScroll: true,
                    onFinish: () => this.form.reset()
                })

        },
    }
}
</script>
