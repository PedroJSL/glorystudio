<template>
    <div  v-click-outside="onClickOutside">
        <editor-menu :editor="editor" :allowImages="false"/>
        <editor-content :editor="editor" />
    </div>
</template>

<script>
import { Editor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import Underline from '@tiptap/extension-underline'
import Align from '@tiptap/extension-text-align'
import EditorMenu from '@/Components/RichEditorMenu.vue'
import vClickOutside from 'click-outside-vue3';


import OrderedList from '@tiptap/extension-ordered-list'
import BulletList from '@tiptap/extension-bullet-list'
import ListItem from '@tiptap/extension-list-item'

export default {
  components: {
    EditorContent,
    EditorMenu,
  },
  directives:{
      clickOutside: vClickOutside.directive
  },
  props: {
    modelValue: {
      type: String,
      default: '',
    },
  },
    emits:["update:modelValue", "editorBlur"],
  data() {
    return {
      editor: null,
      focused: false,
    }
  },

  watch: {
    modelValue(value) {
        const isSame = this.editor.getHTML() === value;
        if (isSame) {
            return;
        }
        this.editor.commands.setContent(value, false);
    },
  },

  mounted() {
    this.editor = new Editor({
      content: this.modelValue,
      extensions: [
        StarterKit,
        Underline,
        Align.configure({
            types:['paragraph'],
            alignments: ['left', 'center', 'right'],
            defaultAlignment: 'left',
        }),
        BulletList,
        OrderedList,
        ListItem,
      ],
      editorProps:{
          attributes:{
              class: 'border p-2 focus:outline-none focus:border-aqua-dark focus:ring focus:ring-aqua focus:ring-opacity-50 rounded-md shadow-sm',
          },
      },
      onFocus: () => {
          this.focused = true;
      },
      onUpdate: () => {
        this.$emit('update:modelValue', this.editor.getHTML())
      },
    })
  },
  methods:{
    onClickOutside(event){
        if(this.focused)
        {
            this.focused = false;
            this.$emit('editorBlur','');
        }
    },
  },
  beforeUnmount() {
    this.editor.destroy()
  },
}
</script>


<style lang="scss">
/* Basic editor styles */
.ProseMirror {
  > * + * {
    margin-top: 0.75em;
  }

  ul
  {
      list-style: inherit !important;
  }
  ol
  {
      list-style: decimal !important;
  }

  ul, ol
  {
    padding: 0 1rem;
  }

  blockquote {
    padding-left: 1rem;
    border-left: 3px solid rgba(#0D0D0D, 0.1);
  }
}
</style>

