<template>
    <Head title="Nuevo Proyecto"/>
    <main-layout>

        <div class="container mx-auto p-4">
            <h2 class="font-logo font-semibold text-2xl text-pink-dark border-b-2 border-pink">Añadir nuevo proyecto:</h2>
            <form class="mt-2" @submit.prevent="submitNewPost">
                <div>
                    <label class = "form-label font-semibold text-lg text-pink-dark" for="name"> Titulo del post </label>
                    <input type="text" class="mt-1 block w-full input" v-model="newPostForm.name" required/>
                    <div v-if="newPostForm.errors.name"><p class="text-red-800">{{ newPostForm.errors.name}}</p></div>
                </div>

                <div class="mt-4">
                    <img class="w-1/2 rounded mb-2" src="/images/placeholder.png" ref="postImg">
                    <label for="selectImages" class="btn cursor-pointer text-center align-middle">Seleccionar imágen</label>
                    <input type="file" id="selectImages" name="selectImages" class="hidden" @input="newPostForm.image = $event.target.files[0]" @change="previewImage">
                </div>


                <div class="mt-4">
                    <label for="excerpt" class="form-label font-semibold text-lg text-pink-dark">Resumen del post</label>
                    <editor v-model="newPostForm.excerpt"/>
                    <div v-if="newPostForm.errors.excerpt"><p class="text-red-800">{{ newPostForm.errors.excerpt}}</p></div>
                </div>

                <div class="mt-4">
                    <label for="content" class="form-label font-semibold text-lg text-pink-dark">Cuerpo del post</label>
                    <editor v-model="newPostForm.content"/>
                    <div v-if="newPostForm.errors.content"><p class="text-red-800">{{ newPostForm.errors.content}}</p></div>
                </div>

                <div class="mt-4 flex flex-row">
                    <label for="category" class="form-label font-semibold text-lg text-pink-dark">Categoría:</label>
                    <select name = "category" class="input ml-4" id="category" v-model="newPostForm.category" required>
                        <option disabled value =""> Elegir categoría </option>
                        <option v-for="category in categories" :key="category.id"  :value="category.id">{{category.name}}</option>
                        <option value = "0">Nueva:</option>
                    </select>
                    <input v-if="newPostForm.category === '0'" class="input ml-2" type="text" name="newCategory" id="newCategory" ref="newCategory" required>
                </div>
                <div v-if="newPostForm.errors.category"><p class="text-red-800">{{ newPostForm.errors.category}}</p></div>

                <div class="mt-4 flex flex-row">
                    <label for="publication_date" class="form-label font-semibold text-lg text-pink-dark">Fecha de publicación: </label>
                    <datepicker name="publication_date" class="input ml-4" v-model="newPostForm.publication_date" inputFormat="dd-MM-yyyy" style="--vdp-bg-color: #ffffff; --vdp-text-color: #000000; --vdp-box-shadow: 0 4px 10px 0 rgba(128, 144, 160, 0.1), 0 0 1px 0 rgba(128, 144, 160, 0.81); --vdp-border-radius: 3px; --vdp-heading-size: 2.5em; --vdp-heading-weight: bold; --vdp-heading-hover-color: #eeeeee; --vdp-arrow-color: currentColor; --vdp-elem-color: currentColor; --vdp-disabled-color: #d5d9e0; --vdp-hover-color: #000000; --vdp-hover-bg-color: #ebd1e1; --vdp-selected-color: #ffffff; --vdp-selected-bg-color: #a11355; --vdp-elem-font-size: 0.8em; --vdp-elem-border-radius: 3px; --vdp-divider-color: #d5d9e0; padding: 4px;"/>
                </div>
                <div v-if="newPostForm.errors.project_date"><p class="text-red-800">{{ newPostForm.errors.project_date}}</p></div>

                <input class="btn block w-full mt-4" type="submit" value="Guardar Nuevo Post">
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
            newPostForm:this.$inertia.form({
                name: '',
                image: '',
                excerpt: '',
                content: '',
                category: '',
                newCategoryName: '',
                user_id: this.user.id,
                publication_date: new Date(),
            }),
        }
    },
    methods:
    {
        previewImage(e)
        {
            this.$refs.postImg.src = URL.createObjectURL(this.newPostForm.image);
        },
        submitNewPost()
        {
            //this.newPostForm.images = this.selectedImages;
            if(this.newPostForm.category === '0')
            {
                this.newPostForm.newCategoryName = this.$refs.newCategory.value;
            }
            this.newPostForm.post(this.route('post.new'));
        }
    },
}
</script>
