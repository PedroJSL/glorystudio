<template>
    <div class="border-b-2 border-pink-lighter p-2">
        <form class="flex flex-col xl:flex-row" @submit.prevent="sendForm">
            <div class="p-2 w-1/3 lg:w-1/12">
                <img class="rounded w-full" :src="model.icon" alt="">
                <label class="btn mt-2 cursor-pointer block text-center align-middle" :for="'icon_'+model.id">Modificar</label>
                <input :id="'icon_'+model.id" type="file" :name="'icon_'+model.id" class="mt-2 hidden" @input="updateForm.icon = $event.target.files[0]" v-on:change="sendForm" >
            </div>

            <div class="flex flex-col w-full lg:w-10/12">
                <div class="p-2 w-full">
                    <label class = "form-label" for="url">Enlace de contacto</label>
                    <input type="text" :name="'url_'+model.id" class="block w-full input" v-model.lazy="updateForm.url" v-on:change="sendForm">
                </div>

                <div class="p-2 w-full">
                    <label for="form-label" form="slug">Slug</label>
                    <input type="text" :name="'slug_'+model.idd" class="block w-full input" v-model.lazy="updateForm.slug" v-on:change="sendForm" >
                </div>
            </div>
        </form>

        <button class="btn w-full" v-on:click="deleteLink">
            <span>Eliminar Enlace</span>
        </button>


    </div>

</template>
<script>


export default {
    props:{
        model: {},
        updateUrl: "",
        deleteUrl: "",
    },
    data(){
        return {

            updateForm: this.$inertia.form({
                id: this.model.id,
                icon: this.model.icon,
                url: this.model.url,
                slug: this.model.slug,
            }),
            deleteForm: this.$inertia.form({
                id: this.model.id,
            })

        }
    },
    methods:{
        sendForm()
        {
            if(this.updateForm.isDirty){
                this.updateForm.post(this.route(this.updateUrl, this.model.id),
                {
                    preserveScroll: true,
                    onFinish: () => this.updateForm.reset(),
                })
            }
        },
        deleteLink()
        {
            this.deleteForm.post(this.route(this.deleteUrl, this.model.id),
            {
                preserveScroll: true,
            })
        }
    }

}
</script>
