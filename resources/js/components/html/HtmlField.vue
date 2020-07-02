<template>
    <div>
        <textarea class="jdlabs-code-editor" rows="20" v-model="content" v-if="showCode"></textarea>
        <quill-editor :content="content" @change="handleChange($event)" v-else />
        <button class="btn btn-default btn-primary inline-flex items-center relative my-3"
                v-if="field.toggle_enabled"
                @click="toggleCode($event)">Toggle Editor
        </button>
    </div>
</template>

<script>
    import {codemirror} from 'vue-codemirror'
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'

    import { quillEditor } from 'vue-quill-editor'

    export default {
        components: {
            quillEditor,
            codemirror
        },
        data() {
            return {
                content: this.field.value ? this.field.value : '',
                showCode: false,
                codeOptions: {
                    tabSize: 2,
                    mode: 'htmlmixed',
                    htmlMode: true,
                    theme: 'monokai',
                    lineNumbers: true,
                    line: true,
                    collapseIdentical: true,
                    highlightDifferences: true,
                    lineWrapping: true,
                    value: this.field.value ? this.field.value : ''
                }
            }
        },
        props: ['field'],
        mounted() {
            if (this.field.default_editor === 'code') {
                this.showCode = true;
            }
            this.$watch('content', (ov, nv) => {
                this.handleChange(this.content);
            });
        },
        methods: {
            toggleCode($event) {
                $event.preventDefault();
                this.showCode = !this.showCode;
            },
            handleChange(event) {
                this.$emit('html-changed', event.html ? event.html : event);
            }
        },
    }
</script>
