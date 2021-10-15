<template>
    <Head :title="user.name"/>
    <main-layout>

        <div class="container flex flex-col p-4 mx-auto">

            <h2 class="font-logo font-semibold text-2xl text-pink-dark border-b-2 border-pink">Perfil de usuario</h2>

            <form id = "updateImage" class="mt-2" @submit.prevent="updateImage">
                <div class="flex flex-row p-4 justify-start items-center ">

                    <!--imagen de perfil -->
                    <div class="w-60">
                        <h3 class="font-logo font-semibold text-lg text-pink-dark">Imagen de usuario:</h3>
                        <img class="rounded w-full border-2 border-pink-lighter my-auto" :src="user.avatar" alt="" ref="avatarPreview">
                        <input type="file" name="avatar" id="avatar" v-on:change="onAvatarChanged" v-on:blur="submitUserData" ref="avatar">
                    </div>
                    <input type="hidden" name = "user_id" :value = "user.id" >

                    <input class="btn block ml-5 h-20 align-middle" type="submit" value="Actualizar Imagen">
                </div>
            </form>


            <ValidationErrors class="mb-4" />
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

                <div v-if="!user.web_owner" class="mt-4">
                    <label class="flex items-center">
                        <input type="checkbox" v-model="form.allowMails" name = "allowMails" v-on:change="submitUserData" class="rounded text-aqua shadow-sm focus:border-aqua-dark focus:ring focus:ring-aqua-light focus:ring-opacity-50">
                        <span class="ml-2 text-md ">Permitir correos de notificación</span>
                    </label>
                </div>

                <div class="mt-4">
                    <label for="biography" class="form-label text-pink-dark">Biografía</label>
                    <!--textarea name="biography" id="biography" v-model="user.biography" cols="50" rows="20"></textarea-->
                    <editor v-model="user.biography" v-on:editorBlur="submitUserData"/>
                    <input id="biography" type = "hidden" name ="biography" v-model.lazy = "form.biography"  ref = "biography">
                </div>
            </form>

            <!-- Solicitar reset de constraseña -->
            <form class="mt-4" @submit.prevent="resetPassword">
                <input type="hidden" name="email" :value = "formPwd.email" >
                <button class="block btn" :class="{ 'opacity-25': formPwd.processing }" :disabled="formPwd.processing">
                    Solicitar cambio de contraseña
                </button>
            </form>

        </div>

    </main-layout>
</template>
<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import Editor from '@/Components/RichEditor.vue';
import ValidationErrors from '@/Components/ValidationErrors.vue';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components:{
        ValidationErrors,
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
                allowMails: this.user.allowMails,
                biography: this.user.biography,
            }),
            formPwd: this.$inertia.form({
                email: this.user.email,
            }),
            formDeleteLink:this.$inertia.form({
                id: '',
            }),
            iconForm:this.$inertia.form({
                icon: '',
                id: '',
            }),
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
        resetPassword()
        {
            this.formPwd.post(this.route('password.email'));
        },
        deleteContact()
        {
            this.formDeleteLink.id = this.$refs.linkId.value;
            this.formDeleteLink.post(this.route('contact.delete'), {
                preserveScroll: true,
            });
        },
        updateIcon(e, id){
            this.iconForm.icon = e.target.files[0];
            this,iconForm.id = id;
            this.iconForm.post(this.route('contact.update_icon'),{
                preserveScroll: true,
            });
        },
    }
}
</script>
