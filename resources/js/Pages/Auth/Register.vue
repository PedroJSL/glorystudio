<template>
    <Head title="Register" />

    <ValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
        <div>
            <label class = "form-label" for="name"> Nombre </label>
            <input id="name" type="text" class="mt-1 block w-full input" v-model="form.name" required autofocus autocomplete="name" />
        </div>

        <div class="mt-4">
            <label class = "form-label" for="email"> Correo electrónico </label>
            <input id="email" type="email" class="mt-1 block w-full input" v-model="form.email" required autocomplete="username" />
        </div>

        <div class="mt-4">
            <label class = "form-label" for="password"> Contraseña </label>
            <input id="password" type="password" class="mt-1 block w-full input" v-model="form.password" required autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <label class="form-label" for="password_confirmation" >Confirmar Contraseña </label>
            <input id="password_confirmation" type="password" class="mt-1 block w-full input" v-model="form.password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <Link :href="route('login')" class="underline link">
               ¿Ya tienes cuenta? Accede ahora
            </Link>

            <button class="ml-4 btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Registrarse
            </button>
        </div>
    </form>
</template>

<script>
import AuthLayout from '@/Layouts/AuthBaseLayout.vue'
import ValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: AuthLayout,

    components: {
        ValidationErrors,
        Head,
        Link,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
}
</script>
