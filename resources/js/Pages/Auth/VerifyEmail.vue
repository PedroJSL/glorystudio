<template>
    <Head title="Email Verification" />

    <div class="mb-4 text-sm text-gray-600">
       ¡Gracias por registrarte! Antes de continuar... ¿Podrías verificar tu dirección de correo pulsando en el enlace que te ha llegado a la bandeja de entrada? Si aún no has recibido nada, puede solicitar un nuevo correo de verificación.
    </div>

    <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent" >
        Se ha enviado un nuevo enlace de verificación
    </div>

    <form @submit.prevent="submit">
        <div class="mt-4 flex items-center justify-between">
            <button class="block btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Reenviar Correo de verificación
            </button>

            <Link :href="route('logout')" method="post" as="button" class="underline text-sm text-gray-600 hover:text-gray-900">Log Out</Link>
        </div>
    </form>
</template>

<script>
import AuthLayout from '@/Layouts/AuthBaseLayout.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: AuthLayout,

    components: {
        Head,
        Link,
    },

    props: {
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form()
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('verification.send'))
        },
    },

    computed: {
        verificationLinkSent() {
            return this.status === 'verification-link-sent';
        }
    }
}
</script>
