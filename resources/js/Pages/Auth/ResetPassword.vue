<template>
    <Head title="Reset Password" />

    <BreezeValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
        <div>
            <label class = "form-label" for="email" > Correo electrónico </label>
            <input id="email" type="email" class="mt-1 block w-full input" v-model="form.email" required autofocus autocomplete="username" />
        </div>

        <div class="mt-4">
            <label class="form-label" for="password" > Contraseña </label>
            <input id="password" type="password" class="mt-1 block w-full btn" v-model="form.password" required autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <label for="password_confirmation"> Confirmar Contraseña </label>
            <input id="password_confirmation" type="password" class="mt-1 block w-full btn" v-model="form.password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button class = "btn block" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Restablecer Contraseña
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
        email: String,
        token: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                token: this.token,
                email: this.email,
                password: '',
                password_confirmation: '',
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.update'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
}
</script>
