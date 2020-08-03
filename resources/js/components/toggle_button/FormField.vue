<template>
    <default-field :field="field" :errors="errors" :full-width-content="true">
        <template slot="field" class="jdlabs-toggle-field">
            <div class="flex items-center md:-mx-4">
                <label class="switch relative inline-block w-16 h-10" style="margin-left: 0">
                    <input type="checkbox"
                           @input="toggle"
                           :id="field.attribute"
                           :name="field.name"
                           :checked="checked"
                           :disabled="isReadonly"
                    >
                    <span class="slider cursor-pointer inset-0 absolute round rounded-full"></span>
                </label>
                <div class="ml-4 text-primary text-bold" v-if="checked && field.checkedText">{{ field.checkedText }}</div>
                <div class="ml-4 text-70" v-if="!checked && field.uncheckedText">{{ field.uncheckedText }}</div>
            </div>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from "laravel-nova";

export default {
    mixins: [HandlesValidationErrors, FormField],

    data: () => ({
        value: false,
    }),

    mounted() {
        this.value = this.field.value || false

        this.field.fill = formData => {
            formData.append(this.field.attribute, this.value ? 1 : 0)
        }
    },

    methods: {
        toggle() {
            this.value = !this.value
        },
    },

    computed: {
        checked() {
            return Boolean(this.value)
        },

        trueValue() {
            return +this.checked
        },
    },
};
</script>
