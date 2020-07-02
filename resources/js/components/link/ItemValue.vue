<template>
    <div v-if="Object.keys(field.route).length > 0" @click="clearBreadcrumbStacks()">
        <router-link :to="field.route" class="no-underline dim text-primary font-bold">
            <div v-html="field.value || field.html"></div>
        </router-link>
    </div>
    <div v-else @click="clearBreadcrumbStacks()">
        <a v-bind:href="field.url" class="no-underline dim text-primary font-bold">
            <div v-html="field.value || field.html"></div>
        </a>
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
