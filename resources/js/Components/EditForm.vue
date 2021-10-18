<template>

<tr>
    <form @submit.prevent="">
        <td>

        </td>

        <td>

        </td>

        <td>

        </td>
    </form>

    <td>
        <button class="">
            <i class="ri-delete-bin-2-line"></i>
        </button>
    </td>

</tr>

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
                this.updateForm.post(this.route(updateUrl, model.id),
                {
                    preserveScroll: true,
                    onFinish: () => this.userForm.reset(),
                })
            }
        },
        deleteLink()
        {
            this.deleteForm.post(this.route(deleteUrl));
        }
    }

}
</script>
