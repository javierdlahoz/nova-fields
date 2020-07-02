<template>
    <default-field :field="field" :errors="errors" :full-width-content="true">
        <template slot="field">
            <jdlabs-html-field :field="field" @html-changed="handleChange($event)"></jdlabs-html-field>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],
    props: ['resourceName', 'resourceId', 'field'],
    methods: {
        fill(formData) {
            formData.append(this.field.attribute, this.value || '')
        },
        handleChange(value) {
            this.value = value.html !== undefined ? value.html : value
        },
    },
}
</script>
