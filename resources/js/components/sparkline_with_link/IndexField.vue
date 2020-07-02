<template>
    <sparkline-with-link-item-value :field="field"></sparkline-with-link-item-value>
</template>

<script>
export default {
    props: ['resourceName', 'field']
}
</script>
