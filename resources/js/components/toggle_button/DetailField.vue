<template>
    <panel-item :field="field">
        <template slot="value">
            <div class="flex items-center">
                <label class="switch relative inline-block w-16 h-10" style="margin-left: 0">
                    <input type="checkbox"
                           @input="toggle"
                           :id="field.attribute"
                           :name="field.name"
                           :checked="checked"
                           :disabled="true"
                    >
                    <span class="slider cursor-pointer inset-0 absolute round rounded-full"></span>
                </label>
                <div class="ml-4 text-primary text-bold" v-if="checked && field.checkedText">{{ field.checkedText }}</div>
                <div class="ml-4 text-70" v-if="!checked && field.uncheckedText">{{ field.uncheckedText }}</div>
            </div>
        </template>
    </panel-item>
</template>

<script>
import { FormField, HandlesValidationErrors } from "laravel-nova";

export default {
    mixins: [HandlesValidationErrors, FormField],

    data: () => ({
        value: true,
    }),

    mounted() {
        this.value = this.field.value || true

        this.field.fill = formData => {
            formData.append(this.field.attribute, this.trueValue)
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
