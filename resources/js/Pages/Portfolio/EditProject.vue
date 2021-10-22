<template>
    <Head title="Nuevo Proyecto"/>
    <main-layout>

        <div class="container mx-auto p-4">
            <h2 class="font-logo font-semibold text-2xl text-pink-dark border-b-2 border-pink">Datos del proyecto:</h2>
            <form class="mt-2" @submit.prevent="submitUpdateProject">
                <div>
                    <label class = "form-label font-semibold text-lg text-pink-dark" for="name"> Nombre del projecto </label>
                    <input type="text" class="mt-1 block w-full input" v-on:change="updateProject" v-model.lazy="updateForm.name" required/>
                    <div v-if="updateForm.errors.name"><p class="text-red-800">{{ updateForm.errors.name}}</p></div>
                </div>
                <div class="mt-4 flex flex-row">
                    <label for="project_date" class="form-label font-semibold text-lg text-pink-dark">Fecha del proyecto:</label>
                    <datepicker name="project_date" class="input ml-4" v-on:change="updateProject" v-model.lazy="updateForm.project_date" inputFormat="dd-MM-yyyy" :upperLimit="datepickerUpperLimit" style="--vdp-bg-color: #ffffff; --vdp-text-color: #000000; --vdp-box-shadow: 0 4px 10px 0 rgba(128, 144, 160, 0.1), 0 0 1px 0 rgba(128, 144, 160, 0.81); --vdp-border-radius: 3px; --vdp-heading-size: 2.5em; --vdp-heading-weight: bold; --vdp-heading-hover-color: #eeeeee; --vdp-arrow-color: currentColor; --vdp-elem-color: currentColor; --vdp-disabled-color: #d5d9e0; --vdp-hover-color: #000000; --vdp-hover-bg-color: #ebd1e1; --vdp-selected-color: #ffffff; --vdp-selected-bg-color: #a11355; --vdp-elem-font-size: 0.8em; --vdp-elem-border-radius: 3px; --vdp-divider-color: #d5d9e0; padding: 4px;"/>
                </div>
                <div v-if="updateForm.errors.project_date"><p class="text-red-800">{{ updateForm.errors.project_date}}</p></div>

                <div class="mt-4 flex flex-row">
                    <label for="category" class="form-label font-semibold text-lg text-pink-dark">Categoría:</label>
                    <select name = "category" class="input ml-4" id="category" v-model.lazy="updateForm.category" v-on:change="onCategoryChanged" required>
                        <option disabled value =""> Elegir categoría </option>
                        <option v-for="category in categories" :key="category.id"  :value="category.id">{{category.name}}</option>
                        <option value = "0">Nueva:</option>
                    </select>
                    <input v-if="updateForm.category === '0'" class="input ml-2" type="text" name="newCategory" id="newCategory" v-on:blur="updateProject" ref="newCategory" required>
                </div>
                <div v-if="updateForm.errors.category"><p class="text-red-800">{{ updateForm.errors.category}}</p></div>

                <div class="mt-4">
                    <label for="biography" class="form-label font-semibold text-lg text-pink-dark">Descripción</label>
                    <editor v-model.lazy="updateForm.description"  v-on:editorBlur="updateProject"/>
                    <div v-if="updateForm.errors.description"><p class="text-red-800">{{ updateForm.errors.description}}</p></div>
                </div>

            </form>


            <div class="mt-4">
                <div class="border-b-2 border-pink flex flex-row justify-between p-2">
                    <h2 class="font-logo font-semibold text-xl text-pink-dark">Imágenes del proyecto:</h2>

                    <div>
                        <label for="newImage" class="btn cursor-o">Añadir imagen</label>
                        <input class="hidden" type="file" name="newImage" id = "newImage" @input="newImageForm.newImage = $event.target.files[0]" @change="addImage" >
                        <div v-if="newImageForm.errors.newImage"><p class="text-red-800">{{ newImageForm.errors.newImage}}</p></div>
                    </div>

                </div>

                <div class="flex flex-row overflow-x-auto mt-2 p-2">

                    <div v-for="image in project.images" :key="image.id" class="w-1/3 flex-none mr-2 border-2 border-pink-lighter p-2 rounded">
                        <img :src="image.image_url">
                        <button class="btn block w-full mt-2" v-on:click="removeImage(image.id)">Eliminar</button>
                    </div>

                </div>
            </div>
        </div>

    </main-layout>
</template>
<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import Editor from '@/Components/RichEditor.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import Datepicker from 'vue3-datepicker';


export default {
    components:{
        MainLayout,
        Datepicker,
        Editor,
        Head,
    },
    props:
    {
        categories: {},
        project: {},
    },
    setup(){
        const user = computed( () => usePage().props.value.auth.user)
        return { user }
    },
    data()
    {
        return{
            datepickerUpperLimit: new Date(),
            updateForm:this.$inertia.form({
                project_id: this.project.id,
                name: this.project.name,
                description: this.project.description,
                project_date: new Date(this.project.project_date),
                category: this.project.project_category_id,
                newCategoryName: '',
                user_id: this.user.id,
                images: '',
            }),
            deleteImage: this.$inertia.form({
                id: '',
            }),
            newImageForm: this.$inertia.form({
                project_id: this.project.id,
                newImage: '',
            }),
        }
    },
    methods:
    {
        onCategoryChanged()
        {
            if(this.updateForm.category !== '0')
            {
                this.updateProject();
            }
        },
        updateProject()
        {
            if(this.updateForm.category === '0')
            {
                this.updateForm.newCategoryName = this.$refs.newCategory.value;
            }

            if( ((this.updateForm.category === '0') && (this.updateForm.newCategoryName !== '')) || (this.updateForm.category !== '0'))
            {
                this.updateForm.post(this.route('project.update'),{
                    preserveScroll: true,
                    onFinish: () => this.updateForm.reset(),
                });
            }
        },
        addImage()
        {
            this.newImageForm.post(this.route('project_image.add'), {
                preserveScroll: true,
            })
        },
        removeImage(id)
        {
            this.deleteImage.id = id;
            this.deleteImage.post(this.route('project_image.delete'), {
                preserveScroll: true,
            })
        },
    },
}
</script>
