<template>
    <Head :title="user.name"/>
    <main-layout>

        <div class="container flex flex-col p-4 mx-auto">

            <h2 class="font-logo font-semibold text-2xl text-pink-dark border-b-2 border-pink">Perfil de usuario</h2>

            <form ref = "userUpdateForm" class="mt-2" @submit.prevent="updateImage">
                <!--imagen de perfil -->
                <div class="flex flex-row p-4 justify-start items-center ">
                    <div class="w-60">
                        <h3 class="font-logo font-semibold text-lg text-pink-dark">Imagen de usuario:</h3>
                        <img class="rounded w-full border-2 mb-2 border-pink-lighter my-auto" :src="user.avatar" alt="" ref="avatarPreview">
                        <label class="btn cursor-pointer block text-center align-middle" for="avatar"> <i class="ri-upload-cloud-line"> </i> <span class=""> Subir Imagen </span> </label>
                        <input id="avatar" type="file" class="mt-2 hidden" name="avatar" @input="userForm.avatar = $event.target.files[0]" v-on:change="submitUserData" ref="avatar">

                        <div v-if="userForm.errors.avatar"><p class="text-red-800">{{ userForm.errors.avatar}}</p></div>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row mt-2">
                    <div>
                        <label class = "form-label font-semibold text-lg text-pink-dark" for="name"> Nombre </label>
                        <input ref = "name" type="text" class="mt-1 block w-full input" v-model.lazy="userForm.name" required v-on:change="submitUserData" />
                        <div v-if="userForm.errors.name"><p class="text-red-800">{{ userForm.errors.name}}</p></div>
                    </div>

                    <div class="mt-4 lg:mt-0 lg:ml-4">
                        <label class = "form-label font-semibold text-lg text-pink-dark" for="email"> Correo electrónico </label>
                        <input ref = "email" type="email" class="mt-1 block w-full input" v-model.lazy="userForm.email" required v-on:change="submitUserData"/>
                        <div v-if="userForm.errors.email"><p class="text-red-800">{{ userForm.errors.email}}</p></div>
                    </div>
                </div>

                <div v-if="!user.web_owner" class="mt-2">
                    <label class="flex items-center">
                        <input ref = "allowMails" type="checkbox" v-model="userForm.allowMails" name = "allowMails" v-on:change="submitUserData" class="rounded text-aqua shadow-sm focus:border-aqua-dark focus:ring focus:ring-aqua-light focus:ring-opacity-50">
                        <span class="ml-2 text-md ">Permitir correos de notificación</span>
                    </label>
                </div>

                <div class="mt-4">
                    <label for="biography" class="form-label font-semibold text-lg text-pink-dark">Biografía</label>
                    <editor v-model="userForm.biography" v-on:editorBlur="submitUserData"/>
                    <div v-if="userForm.errors.biography"><p class="text-red-800">{{ userForm.errors.biography}}</p></div>
                </div>
            </form>

            <!-- Solicitar reset de constraseña -->
            <form class="mt-4" @submit.prevent="resetPassword">
                <input type="hidden" name="email" :value = "changePwd.email" >
                <button class="block btn" :class="{ 'opacity-25': changePwd.processing }" :disabled="changePwd.processing">
                    Solicitar cambio de contraseña
                </button>
            </form>

            <div v-if="user.web_owner" class="mt-4">
                <h2 class="font-logo font-semibold text-2xl text-pink-dark border-b-2 border-pink">Enlaces de Contacto</h2>

                <table class="table-auto">
                    <thead>
                        <tr>
                            <th>Icono</th>
                            <th>Url</th>
                            <th>Slug</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </main-layout>
</template>
<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import Editor from '@/Components/RichEditor.vue';
import ValidationErrors from '@/Components/ValidationErrors.vue';
import EditForm from '@/Components/EditForm.vue';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components:{
        ValidationErrors,
        MainLayout,
        EditForm,
        Editor,
        Head,
    },
    props:
    {
        user: {},
    },
    data(){
        return {
            userForm: this.$inertia.form({
                avatar: '',
                name: this.user.name,
                email: this.user.email,
                allowMails: this.user.allowMails,
                biography: this.user.biography,
            }),

            changePwd: this.$inertia.form({
                email: this.user.email,
            })
        }
    },
    methods:{
        submitUserData()
        {
            if(this.userForm.isDirty)
            {
                //this.userForm.biography = this.user.biography;
                this.userForm.post(this.route('user.update', this.user.id), {
                    preserveScroll: true,
                    onFinish: () => this.userForm.reset(),
                })
            }
        },
        resetPassword()
        {
            this.changePwd.post(this.route('password.email'));
        }
    }
}
</script>
