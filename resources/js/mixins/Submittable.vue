<script>
export default {
    methods: {
        async submit(showToasted = true) {
            let formData = new FormData();

            formData.append(this.field.attribute, this.value);
            formData.append('_method', 'PUT');

            return Nova.request().post(`/nova-api/${this.resourceName}/${this.resourceId}`, formData)
                .then(() => {
                    let label = _.find(this.field.options, option => option.value == this.value).label;

                    if (showToasted) {
                        this.$toasted.show(`${this.field.name} updated to "${label}"`, { type: 'success' });
                    }
                }, (response) => {
                    if (showToasted) {
                        this.$toasted.show(response, { type: 'error' });
                    }
                })
        }
    }
}
</script>
