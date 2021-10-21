<template>
    <Head :title="user.name"/>
    <main-layout>

        <div class="container flex flex-col p-4 mx-auto">

            <h2 class="font-logo font-semibold text-2xl text-pink-dark border-b-2 border-pink">Perfil de usuario</h2>

            <form ref = "userUpdateForm" class="mt-2" @submit.prevent="submitUserData">
                <!--imagen de perfil -->
                <div class="flex flex-row p-4 justify-start items-center ">
                    <div class="w-60">
                        <h3 class="font-logo font-semibold text-lg text-pink-dark">Imagen de usuario:</h3>
                        <img class="rounded w-full border-2 mb-2 border-pink-lighter my-auto" :src="user.avatar" alt="" ref="avatarPreview">
                        <label class="btn cursor-pointer block text-center align-middle" for="avatar"> <i class="ri-upload-cloud-line text-lg relative top-1"> </i> <span class="text-lg mr-2"> Subir Imagen </span> </label>
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
                <div class="flex flex-row justify-between border-b-2 border-pink p-2">
                    <h2 class="font-logo font-semibold text-2xl text-pink-dark">Enlaces de Contacto</h2>
                    <button class="btn" v-on:click="showAddContactLinkForm">
                        Añadir Nuevo
                    </button>
                </div>

                <div>
                    <link-form v-for="link in user.contact_links" :deleteUrl="'contactlink.delete'" :updateUrl="'contactlink.update'" :model="link" :key="link.id"/>
                </div>
                <div v-if="addNewContact">
                    <h2 class="font-logo text-md font-semibold text-pink-dark">Nuevo enlace de contacto: </h2>
                    <form class="flex flex-col xl:flex-row" @submit.prevent="submitNewCL">
                        <div class="p-2 w-1/3 lg:w-1/12">
                            <img class="rounded w-full" :src="newContactLinkForm.icon" alt="" ref="prevNewCL">
                            <label class="btn mt-2 cursor-pointer block text-center align-middle" for="icon_new_cl">Modificar</label>
                            <input id="icon_new_cl" type="file" name="icon_new_cl" class="mt-2 hidden" @input="newContactLinkForm.icon = $event.target.files[0]" v-on:change="prevCL" >
                        </div>

                        <div class="flex flex-col w-full lg:w-10/12">
                            <div class="p-2 w-full">
                                <label class = "form-label" for="url">Enlace de contacto</label>
                                <input type="text" name="'url_new_cl" class="block w-full input" v-model.lazy="newContactLinkForm.url">
                            </div>

                            <div class="p-2 w-full">
                                <label for="form-label" form="slug">Slug</label>
                                <input type="text" name="'slug_new_cl" class="block w-full input" v-model.lazy="newContactLinkForm.slug" >
                            </div>
                        </div>
                    </form>

                    <div class="flex flex-row justify-between p-2">
                        <button class="btn" v-on:click="submitNewCL">
                            Guardar
                        </button>
                        <button class="btn" v-on:click="cancelNewCL">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main-layout>
</template>
<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import Editor from '@/Components/RichEditor.vue';
import ValidationErrors from '@/Components/ValidationErrors.vue';
import LinkForm from '@/Components/LinkForm.vue';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components:{
        ValidationErrors,
        MainLayout,
        LinkForm,
        Editor,
        Head,
    },
    props:
    {
        user: {},
    },
    mounted()
    {
        console.log(this.user);
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
            }),
            addNewContact: false,
            newContactLinkForm: this.$inertia.form({
                icon: '/images/placeholder.png',
                url: '',
                slug: '',
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
        },
        showAddContactLinkForm()
        {
            this.addNewContact = true;
        },
        prevCL()
        {

        },
        submitNewCL()
        {
            if(this.submitNewCL.isDirty)
            {

            }
        },
        cancelNewCL()
        {
            this.newContactLinkForm.reset();
            this.addNewContact = false;
        },
    }
}
</script>
