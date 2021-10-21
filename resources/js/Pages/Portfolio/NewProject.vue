<template>
    <Head title="Nuevo Proyecto"/>
    <main-layout>

        <div class="container mx-auto p-4">
            <h2 class="font-logo font-semibold text-2xl text-pink-dark border-b-2 border-pink">Añadir nuevo proyecto:</h2>
            <form class="mt-2" @submit.prevent="submitNewProject">
                <div>
                    <label class = "form-label font-semibold text-lg text-pink-dark" for="name"> Nombre del projecto </label>
                    <input type="text" class="mt-1 block w-full input" v-model="newProjectForm.name" required/>
                    <div v-if="newProjectForm.errors.name"><p class="text-red-800">{{ newProjectForm.errors.name}}</p></div>
                </div>
                <div class="mt-4 flex flex-row">
                    <label for="project_date" class="form-label font-semibold text-lg text-pink-dark">Fecha del proyecto:</label>
                    <datepicker name="project_date" class="input ml-4" v-model="newProjectForm.project_date" inputFormat="dd-MM-yyyy" :upperLimit="datepickerUpperLimit" style="--vdp-bg-color: #ffffff; --vdp-text-color: #000000; --vdp-box-shadow: 0 4px 10px 0 rgba(128, 144, 160, 0.1), 0 0 1px 0 rgba(128, 144, 160, 0.81); --vdp-border-radius: 3px; --vdp-heading-size: 2.5em; --vdp-heading-weight: bold; --vdp-heading-hover-color: #eeeeee; --vdp-arrow-color: currentColor; --vdp-elem-color: currentColor; --vdp-disabled-color: #d5d9e0; --vdp-hover-color: #000000; --vdp-hover-bg-color: #ebd1e1; --vdp-selected-color: #ffffff; --vdp-selected-bg-color: #a11355; --vdp-elem-font-size: 0.8em; --vdp-elem-border-radius: 3px; --vdp-divider-color: #d5d9e0; padding: 4px;"/>
                </div>
                <div v-if="newProjectForm.errors.project_date"><p class="text-red-800">{{ newProjectForm.errors.project_date}}</p></div>

                <div class="mt-4 flex flex-row">
                    <label for="category" class="form-label font-semibold text-lg text-pink-dark">Categoría:</label>
                    <select name = "category" class="input ml-4" id="category" v-model="newProjectForm.category" required>
                        <option disabled value =""> Elegir categoría </option>
                        <option v-for="category in categories" :key="category.id"  :value="category.id">{{category.name}}</option>
                        <option value = "0">Nueva:</option>
                    </select>
                    <input v-if="newProjectForm.category === '0'" class="input ml-2" type="text" name="newCategory" id="newCategory" ref="newCategory" required>
                </div>
                <div v-if="newProjectForm.errors.category"><p class="text-red-800">{{ newProjectForm.errors.category}}</p></div>

                <div class="mt-4">
                    <label for="biography" class="form-label font-semibold text-lg text-pink-dark">Descripción</label>
                    <editor v-model="newProjectForm.description"/>
                    <div v-if="newProjectForm.errors.description"><p class="text-red-800">{{ newProjectForm.errors.description}}</p></div>
                </div>

                <div class="mt-4">
                    <label for="selectImages" class="btn cursor-pointer text-center align-middle">Seleccionar imagenes</label>
                    <input type="file" id="selectImages" name="selectImages" class="hidden" multiple @input="newProjectForm.images = $event.target.files" @change="previewImages">
                    <div v-if="newProjectForm.errors.images"><p class="text-red-800">{{ newProjectForm.errors.images}}</p></div>
                    <div class="flex flex-row overflow-x-auto border-t-2 border-pink-light mt-2 p-2">
                        <img v-for="(image, key) in selectedImages" :key="key" :src="image.src" class="w-1/4 mr-2 rounded">
                    </div>
                </div>

                <input class="btn block w-full mt-4" type="submit" value="Guardar Nuevo Proyecto">
            </form>
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
    },
    setup(){
        const user = computed( () => usePage().props.value.auth.user)
        return { user }
    },
    data()
    {
        return{
            selectedImages: [],
            datepickerUpperLimit: new Date(),
            newProjectForm:this.$inertia.form({
                name: '',
                description: '',
                project_date: new Date(),
                category: '',
                newCategoryName: '',
                user_id: this.user.id,
                images: '',
            }),
        }
    },
    methods:
    {
        previewImages(e)
        {
            var selectedFiles = e.target.files;
            for(let i = 0; i < selectedFiles.length; i++)
            {
                let img = {
                    src: URL.createObjectURL(selectedFiles[i]),
                    file: selectedFiles[i],
                }
                this.selectedImages.push(img);
            }
        },
        submitNewProject()
        {
            //this.newProjectForm.images = this.selectedImages;
            if(this.newProjectForm.category === '0')
            {
                this.newProjectForm.category = this.$refs.newCategory.value;
            }
            this.newProjectForm.post(this.route('project.new'));
        }
    },
}
</script>
