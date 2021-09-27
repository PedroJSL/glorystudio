<template>
    <Head title="Confirmar Contraseña" />

    <div class="mb-4 text-sm text-gray-600">
        Esta es un área restringida de la aplicación. Por favor, confirma tu contraseña para continuar.
    </div>

    <BreezeValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
        <div>
            <label class="form-label" for="password" > Contraseña </label>
            <input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" autofocus />
        </div>

        <div class="flex justify-end mt-4">
            <button class="ml-4 btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Confirm
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

    data() {
        return {
            form: this.$inertia.form({
                password: '',
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.confirm'), {
                onFinish: () => this.form.reset(),
            })
        }
    }
}
</script>
