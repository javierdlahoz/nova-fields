<template>
    <panel-item :field="field">
        <template slot="value">
            <KeyValueTable v-if="theData.length > 0" :edit-mode="false" class="overflow-hidden">
                <KeyValueHeader :key-label="field.keyLabel" :value-label="field.valueLabel" />

                <div class="bg-white overflow-hidden key-value-items">
                    <KeyValueItem
                        v-for="item in theData"
                        :item="item"
                        :disabled="true"
                        :key="item.key"
                    />
                </div>
            </KeyValueTable>
        </template>
    </panel-item>
</template>

<script>
import KeyValueItem from "./KeyValueField/KeyValueItem";
import KeyValueHeader from "./KeyValueField/KeyValueHeader";
import KeyValueTable from "./KeyValueField/KeyValueTable";

export default {
    props: ["resource", "resourceName", "resourceId", "field"],

    components: { KeyValueTable, KeyValueHeader, KeyValueItem },

    data: () => ({ theData: [] }),

    created() {
        if (this.field.mappedFields.length > 0) {
            let theData = [];
            this.field.mappedFields.forEach(field => {
                if (this.field.value && this.field.value[field.key] !== undefined) {
                    theData.push({
                        key: field.key,
                        value: this.field.value[field.key],
                        title: field.title,
                        type: field.type,
                        options: field.options
                    });
                }
            });
            this.theData = theData;
        } else {
            this.theData = _.map(this.value || {}, (value, key) => ({
                key,
                value
            }));
        }
    }
};
</script>
