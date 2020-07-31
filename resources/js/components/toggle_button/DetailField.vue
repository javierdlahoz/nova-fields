<template>
    <panel-item :field="field">
        <template slot="value">
            <div></div>
        </template>
    </panel-item>
</template>

<script>

export default {
    props: ["resource", "resourceName", "resourceId", "field"],

    data: () => ({ theData: [] }),

    created() {

    }
};
</script>
