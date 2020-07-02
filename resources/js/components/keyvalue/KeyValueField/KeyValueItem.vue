<template>
    <div v-if="isNotObject" class="flex items-center key-value-item">
        <div class="flex flex-grow border-b border-50 key-value-fields">
            <div class="w-48 cursor-text">
                <p class="font-mono text-sm blockw-full py-4 text-90 px-3">
                    {{itemKey}}
                </p>
            </div>

            <div @click="handleValueFieldFocus" class="flex-grow border-l border-50">
                <div class="px-4" v-if="item.type === 'dropdown'">
                    <select
                        class="form-control form-input form-input-bordered form-select block w-full mt-1 text-90"
                        :disabled="disabled"
                        v-model="item.value">
                        <option v-for="(value, key) in item.options" v-bind:key="key" :value="key">{{value}}</option>
                    </select>
                </div>
                <div class="px-2" v-if="item.type === 'number'">
                    <input type="number"
                           class="form-control form-input block w-full mt-1 text-90"
                           v-bind:min="(item.options && item.options.min !== undefined) ? item.options.min : -999999999999999"
                           v-bind:max="(item.options && item.options.max !== undefined) ? item.options.max : 999999999999999"
                           v-bind:step="(item.options && item.options.step !== undefined) ? item.options.step : 0.1"
                           :disabled="disabled"
                           v-model="item.value">
                </div>
                <div class="px-2" v-if="item.type === 'password'">
                    <input v-if="item.type === 'password'"
                           type="password"
                           class="form-control form-input block w-full mt-1 text-90"
                           :disabled="disabled"
                           v-model="item.value">
                </div>
                <div class="px-2" v-if="item.type === 'boolean'">
                    <input type="checkbox" class="checkbox my-4 mx-3"
                           :disabled="disabled"
                           v-model="item.value" @change="setBooleanValue($event)">
                </div>
                <div class="px-2" v-if="item.type === 'text'">
                    <textarea :dusk="`key-value-value-${index}`"
                              v-model="item.value"
                              @focus="handleValueFieldFocus"
                              ref="valueField"
                              type="text"
                              class="font-mono text-sm hover:bg-20 focus:bg-white block min-h-input w-full form-control form-input form-input-row py-4 text-90"
                              :disabled="disabled"
                              :class="{'!bg-white': disabled, 'hover:bg-20 focus:bg-white': !disabled}"
                    />
                </div>
                <div v-if="item.type === 'editor'" class="editor-wrapper py-4">
                    <quill-editor :content="item.value" @change="handleHtmlChange($event)"/>
                </div>
            </div>
        </div>

        <div
            v-if="!disabled"
            class="flex justify-center h-11 w-11 absolute"
            style="right: -50px"
        >
            <button
                v-if="mappedFields.length == 0"
                @click="$emit('remove-row', item.id)"
                type="button"
                tabindex="-1"
                class="flex appearance-none cursor-pointer text-70 hover:text-primary active:outline-none active:shadow-outline focus:outline-none focus:shadow-outline"
                title="Delete"
            >
                <icon/>
            </button>
        </div>
    </div>
</template>

<script>
    import autosize from 'autosize'
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'

    import { quillEditor } from 'vue-quill-editor'

    export default {
        components: {
            quillEditor
        },
        props: {
            index: Number,
            item: Object,
            mappedFields: Array,
            disabled: {
                type: Boolean,
                default: false,
            },
        },

        mounted() {
            autosize(this.$refs.keyField)
            autosize(this.$refs.valueField)

            if (this.editors.length > 0) {
                this.editorWindowSize();
                window.addEventListener('resize', () => {
                    this.editorWindowSize();
                });
            }

            if (!this.item.value && this.item.options && this.item.options.default) {
                this.item.value = this.item.options.default;
            }
        },

        methods: {
            handleKeyFieldFocus() {
                this.$refs.keyField.select()
            },

            handleValueFieldFocus() {
                if (this.$refs.valueField) {
                    this.$refs.valueField.select();
                }
            },
            editorWindowSize() {
                const editor = this.editors[0];
                const parentWidth = editor.parentElement.offsetWidth;

                editor.style.minWidth = `${(parentWidth - 4)}px`;
            },
            setBooleanValue($event) {
                if ($event.target.checked) {
                    this.item.value = 1;
                } else {
                    this.item.value = 0;
                }
            },
            handleHtmlChange($event) {
                this.item.value = $event.html;
            }
        },

        computed: {
            itemKey() {
                return this.item.title ? this.item.title : this.item.key;
            },
            isNotObject() {
                return !(this.item.value instanceof Object)
            },
            editors() {
                return document.getElementsByClassName('editor-wrapper');
            }
        },
    }
</script>
