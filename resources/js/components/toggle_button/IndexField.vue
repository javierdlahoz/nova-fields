<template>
    <template>
        <div class="flex justify-center items-center md:-mx-4">
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
        </div>
    </template>
</template>

<script>
import { FormField, HandlesValidationErrors } from "laravel-nova";
import Submittable from '../../mixins/Submittable'

export default {
    mixins: [HandlesValidationErrors, FormField, Submittable],

    props: ['resourceName', 'field'],

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
            this.submit()
        },
    },

    computed: {
        checked() {
            return Boolean(this.value)
        },

        trueValue() {
            return +this.checked
        },

        resourceId() {
            return this.$parent.resource.id.value;
        }
    },
};
</script>
