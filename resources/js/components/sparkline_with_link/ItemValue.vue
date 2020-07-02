<template>
    <div v-if="Object.keys(field.route).length > 0" @click="clearBreadcrumbStacks()">
        <router-link :to="field.route" class="no-underline dim text-primary font-bold">
            <index-sparkline-field :field="field"></index-sparkline-field>
        </router-link>
    </div>
</template>
<script>
    export default {
        props: ['field'],
        methods: {
            clearBreadcrumbStacks() {
                window.clearBreadcrumbStacks();
                return true;
            }
        }
    }
</script>
