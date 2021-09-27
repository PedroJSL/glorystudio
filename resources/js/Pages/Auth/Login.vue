<template>
    <Head title="Log in" />
    <body class="bg-pink-lighter"/>

    <form @submit.prevent="submit">
        <div>
            <label class="form-label" for="email" >Correo electrónico</label>
            <input id="email" type="email" class="mt-1 block w-full input" v-model="form.email" required autofocus autocomplete="username" />
        </div>

        <div class="mt-4">
            <label class="form-label" for="password" >Contraseña</label>
            <input id="password" type="password" class="mt-1 block w-full input" v-model="form.password" required autocomplete="current-password" />
        </div>

        <div class="block mt-4">
            <label class="flex items-center">
                <input type="checkbox" v-model="proxyChecked"
           class="rounded text-aqua shadow-sm focus:border-aqua-dark focus:ring focus:ring-aqua-light focus:ring-opacity-50">
                <span class="ml-2 text-md ">Recordarme</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">

            <a href="/forgot-password" class="link underline">
                ¿Olvidaste la contraseña?
            </a>

            <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class = "ml-4 btn">
                Iniciar Sesión
            </button>
        </div>
    </form>
</template>

<script>
import AuthLayout from '@/Layouts/AuthBaseLayout.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    layout: AuthLayout,

    components: {
        BreezeValidationErrors,
        Head,
    },

    props: {
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },
    mounted(){
        document.body.classList.add('bg-pink-lighter');
    },
    unmounted()
    {
        document.body.classList.remove('bg-pink-lighter');
    },
    methods: {
        submit() {
            this.form.post(this.route('login'), {
                onFinish: () => this.form.reset('password'),
            })
        }
    }
}
</script>
