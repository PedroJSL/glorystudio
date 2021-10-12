<template>
    <div v-if="editor" class="flex flex-row justify-center my-2 p-2 px-4 rounded shadow-md">
        <button type="button" class = "btn-toolbox" v-on:click="undo" :disabled="!editor.can().undo()">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
            </svg>
        </button>
        <button type="button" class = "btn-toolbox" v-on:click="redo" :disabled="!editor.can().redo()">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </button>

        <div class="vertical-separator"></div>

        <button v-on:click="toggleBold">
            <svg xmlns="http://www.w3.org/2000/svg" v-bind:class="{'text-aqua-dark': editor.isActive('bold')}" class="btn-toolbox"  fill="currentColor" viewBox="0 0 24 24"  stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11h4.5a2.5 2.5 0 1 0 0-5H8v5zm10 4.5a4.5 4.5 0 0 1-4.5 4.5H6V4h6.5a4.5 4.5 0 0 1 3.256 7.606A4.498 4.498 0 0 1 18 15.5zM8 13v5h5.5a2.5 2.5 0 1 0 0-5H8z"/>
            </svg>
        </button>
        <button v-on:click="toggleItalic">
            <svg xmlns="http://www.w3.org/2000/svg" v-bind:class="{'text-aqua-dark': editor.isActive('italic')}" class="btn-toolbox" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor" >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 20H7v-2h2.927l2.116-12H9V4h8v2h-2.927l-2.116 12H15z"/>
            </svg>
        </button>
        <button v-on:click="toggleUnderline" >
            <svg xmlns="http://www.w3.org/2000/svg" v-bind:class="{'text-aqua-dark': editor.isActive('underline')}" class="btn-toolbox" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 3v9a4 4 0 1 0 8 0V3h2v9a6 6 0 1 1-12 0V3h2zM4 20h16v2H4v-2z"/>
            </svg>
        </button>

        <div class="vertical-separator"></div>

        <button v-on:click="toggleLeftAlign">
            <svg xmlns="http://www.w3.org/2000/svg"  v-bind:class="{'text-aqua-dark': editor.isActive({textAlign: 'left'})}" class="btn-toolbox" fill="currentColor" viewBox="0 0 24 24"  stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 4h18v2H3V4zm0 15h14v2H3v-2zm0-5h18v2H3v-2zm0-5h14v2H3V9z"/>
            </svg>
        </button>
        <button v-on:click="toggleCenterAlign">
            <svg xmlns="http://www.w3.org/2000/svg" v-bind:class="{'text-aqua-dark': editor.isActive({textAlign: 'center'})}" class="btn-toolbox" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor" >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 4h18v2H3V4zm2 15h14v2H5v-2zm-2-5h18v2H3v-2zm2-5h14v2H5V9z"/>
            </svg>
        </button>
        <button v-on:click="toggleRightAlign">
            <svg xmlns="http://www.w3.org/2000/svg" v-bind:class="{'text-aqua-dark': editor.isActive({textAlign: 'right'})}" class="btn-toolbox" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 4h18v2H3V4zm4 15h14v2H7v-2zm-4-5h18v2H3v-2zm4-5h14v2H7V9z"/>
            </svg>
        </button>

        <div class="vertical-separator"></div>

        <button v-on:click="toggleOrderedList">
            <svg xmlns="http://www.w3.org/2000/svg"  v-bind:class="{'text-aqua-dark': editor.isActive('orderedList')}" class="btn-toolbox" fill="currentColor" viewBox="0 0 24 24"  stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 4h13v2H8V4zM5 3v3h1v1H3V6h1V4H3V3h2zM3 14v-2.5h2V11H3v-1h3v2.5H4v.5h2v1H3zm2 5.5H3v-1h2V18H3v-1h3v4H3v-1h2v-.5zM8 11h13v2H8v-2zm0 7h13v2H8v-2z"/>
            </svg>
        </button>
        <button v-on:click="toggleUnorderedList">
            <svg xmlns="http://www.w3.org/2000/svg" v-bind:class="{'text-aqua-dark': editor.isActive('bulletList')}" class="btn-toolbox" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor" >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 4h13v2H8V4zM4.5 6.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 7a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 6.9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zM8 11h13v2H8v-2zm0 7h13v2H8v-2z"/>
            </svg>
        </button>

        <div class="vertical-separator"></div>

        <button v-on:click="toggleQuote">
            <svg xmlns="http://www.w3.org/2000/svg"  v-bind:class="{'text-aqua-dark': editor.isActive('blockquote')}" class="btn-toolbox" fill="currentColor" viewBox="0 0 24 24"  stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19.417 6.679C20.447 7.773 21 9 21 10.989c0 3.5-2.457 6.637-6.03 8.188l-.893-1.378c3.335-1.804 3.987-4.145 4.247-5.621-.537.278-1.24.375-1.929.311-1.804-.167-3.226-1.648-3.226-3.489a3.5 3.5 0 0 1 3.5-3.5c1.073 0 2.099.49 2.748 1.179zm-10 0C10.447 7.773 11 9 11 10.989c0 3.5-2.457 6.637-6.03 8.188l-.893-1.378c3.335-1.804 3.987-4.145 4.247-5.621-.537.278-1.24.375-1.929.311C4.591 12.322 3.17 10.841 3.17 9a3.5 3.5 0 0 1 3.5-3.5c1.073 0 2.099.49 2.748 1.179z"/>
            </svg>
        </button>
        <button v-if="allowImages" v-on:click="addImage">
            <svg xmlns="http://www.w3.org/2000/svg" class="btn-toolbox" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor" >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.828 21l-.02.02-.021-.02H2.992A.993.993 0 0 1 2 20.007V3.993A1 1 0 0 1 2.992 3h18.016c.548 0 .992.445.992.993v16.014a1 1 0 0 1-.992.993H4.828zM20 15V5H4v14L14 9l6 6zm0 2.828l-6-6L6.828 19H20v-1.172zM8 11a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
            </svg>
        </button>


    </div>
</template>
<script>
export default {
    props:{
        editor: {},
        allowImages: Boolean,
    },
    data(){
        return{

        }
    },
    methods:{
        undo(){
            this.editor.chain().focus().undo().run();
        },
        redo(){
            this.editor.chain().focus().redo().run();
        },
        toggleBold(){
            this.editor.chain().toggleBold().focus().run();
        },
        toggleItalic(){
            this.editor.chain().toggleItalic().focus().run();
        },
        toggleUnderline(){
            this.editor.chain().toggleUnderline().focus().run();
        },
        toggleLeftAlign()
        {
            this.editor.chain().focus().setTextAlign('left').run();
        },
        toggleCenterAlign()
        {
            this.editor.chain().focus().setTextAlign('center').run();
        },
        toggleRightAlign()
        {
            this.editor.chain().focus().setTextAlign('right').run();
        },
        toggleOrderedList()
        {
            this.editor.chain().focus().toggleOrderedList().run();
        },
        toggleUnorderedList()
        {
            this.editor.chain().focus().toggleBulletList().run();
        },
        toggleQuote()
        {
            this.editor.chain().focus().toggleBlockquote().run();
        },
        addImage()
        {

        },


    }
}
</script>
