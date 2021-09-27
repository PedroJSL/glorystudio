<template>
    <Head title="Forgot Password" />

    <div class="mb-4 text-sm text-gray-600">
        ¿Olvidaste la contraseña? No te preocupes, indícanos tu dirección email y te enviaremos un enlace para restablecer tu contraseña.
    </div>

    <BreezeValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
        <div>
            <label class = "form-label" for="email"> Correo electrónico </label>
            <input id="email" type="email" class="mt-1 block w-full input" v-model="form.email" required autofocus autocomplete="username" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button class="block btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Enviar enlace de recuperación
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
                email: ''
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.email'))
        }
    }
}
</script>
