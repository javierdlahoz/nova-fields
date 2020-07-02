<template>
    <panel-item :field="field">
        <template slot="value">
            <div class="jdlabs-content-html p-6" v-html="field.value" v-if="showContent"></div>
            <div class="p-6" v-else>{{ __('No content') }}</div>
        </template>
    </panel-item>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    computed: {
        showContent () {
            return this.field.value && this.field.value !== '[object Object]'
        }
    }
}
</script>
