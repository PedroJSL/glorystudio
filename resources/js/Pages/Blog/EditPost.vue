<template>
    <Head title="Nuevo Proyecto"/>
    <main-layout>

        <div class="container mx-auto p-4">
            <h2 class="font-logo font-semibold text-2xl text-pink-dark border-b-2 border-pink">Añadir nuevo proyecto:</h2>
            <form class="mt-2" @submit.prevent="updateProject">
                <div>
                    <label class = "form-label font-semibold text-lg text-pink-dark" for="name"> Titulo del post </label>
                    <input type="text" class="mt-1 block w-full input" v-model.lazy="updatePostForm.name" v-on:change="updateProject"/>
                    <div v-if="updatePostForm.errors.name"><p class="text-red-800">{{ updatePostForm.errors.name}}</p></div>
                </div>

                <div class="mt-4">
                    <img class="w-1/2 rounded mb-2" :src="updatePostForm.image">
                    <label for="selectImages" class="btn cursor-pointer text-center align-middle">Seleccionar imágen</label>
                    <input type="file" id="selectImages" name="selectImages" class="hidden" @input="updatePostForm.image = $event.target.files[0]" @change="updateProject">
                </div>


                <div class="mt-4">
                    <label for="excerpt" class="form-label font-semibold text-lg text-pink-dark">Resumen del post</label>
                    <editor v-model.lazy="updatePostForm.excerpt" v-on:editorBlur="updateProject"/>
                    <div v-if="updatePostForm.errors.excerpt"><p class="text-red-800">{{ updatePostForm.errors.excerpt}}</p></div>
                </div>

                <div class="mt-4">
                    <label for="content" class="form-label font-semibold text-lg text-pink-dark">Cuerpo del post</label>
                    <editor v-model.lazy="updatePostForm.content" v-on:editorBlur="updateProject"/>
                    <div v-if="updatePostForm.errors.content"><p class="text-red-800">{{ updatePostForm.errors.content}}</p></div>
                </div>

                <div class="mt-4 flex flex-row">
                    <label for="category" class="form-label font-semibold text-lg text-pink-dark">Categoría:</label>
                    <select name = "category" class="input ml-4" id="category" v-model.lazy="updatePostForm.category" v-on:change="onCategoryChanged" required>
                        <option disabled value =""> Elegir categoría </option>
                        <option v-for="category in categories" :key="category.id"  :value="category.id">{{category.name}}</option>
                        <option value = "0">Nueva:</option>
                    </select>
                    <input v-if="updatePostForm.category === '0'" class="input ml-2" type="text" name="newCategory" id="newCategory" v-on:blur="updateProject" ref="newCategory" required>
                </div>
                <div v-if="updatePostForm.errors.category"><p class="text-red-800">{{ updatePostForm.errors.category}}</p></div>

                <div class="mt-4 flex flex-row">
                    <label for="publication_date" class="form-label font-semibold text-lg text-pink-dark">Fecha de publicación: </label>
                    <datepicker v-on:change="updateProject" name="publication_date" class="input ml-4" v-model="updatePostForm.publication_date" inputFormat="dd-MM-yyyy" style="--vdp-bg-color: #ffffff; --vdp-text-color: #000000; --vdp-box-shadow: 0 4px 10px 0 rgba(128, 144, 160, 0.1), 0 0 1px 0 rgba(128, 144, 160, 0.81); --vdp-border-radius: 3px; --vdp-heading-size: 2.5em; --vdp-heading-weight: bold; --vdp-heading-hover-color: #eeeeee; --vdp-arrow-color: currentColor; --vdp-elem-color: currentColor; --vdp-disabled-color: #d5d9e0; --vdp-hover-color: #000000; --vdp-hover-bg-color: #ebd1e1; --vdp-selected-color: #ffffff; --vdp-selected-bg-color: #a11355; --vdp-elem-font-size: 0.8em; --vdp-elem-border-radius: 3px; --vdp-divider-color: #d5d9e0; padding: 4px;"/>
                </div>
                <div v-if="updatePostForm.errors.project_date"><p class="text-red-800">{{ updatePostForm.errors.project_date}}</p></div>
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
        post: {},
        categories: {},
    },
    setup(){
        const user = computed( () => usePage().props.value.auth.user)
        return { user }
    },
    data()
    {
        return{
            updatePostForm:this.$inertia.form({
                name: this.post.name,
                image: this.post.image,
                excerpt: this.post.excerpt,
                content: this.post.content,
                category: this.post.post_category_id,
                newCategoryName: '',
                post_id: this.post.id,
                publication_date: new Date(this.post.publication_date),
            }),
        }
    },
    methods:
    {
        onCategoryChanged()
        {
            if(this.updatePostForm.category !== '0')
            {
                this.updateProject();
            }
        },
        updateProject()
        {
            //this.updatePostForm.images = this.selectedImages;
            if(this.updatePostForm.category === '0')
            {
                this.updatePostForm.newCategoryName = this.$refs.newCategory.value;
            }
            this.updatePostForm.post(this.route('post.update'),{
                preserveScroll: true,
                onFinish: () => this.updatePostForm.reset(),
            });
        }
    },
}
</script>
