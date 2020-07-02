<template>
    <sparkline-with-link-panel-item :field="field" />
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field']
}
</script>
