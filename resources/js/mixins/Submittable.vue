<script>
export default {
    methods: {
        async submit(showToasted = true) {
            let formData = new FormData()

            formData.append(this.field.attribute, this.value ? 1 : 0)
            formData.append('_method', 'PUT')

            return Nova.request().post(`/nova-api/${this.resourceName}/${this.resourceId}`, formData)
                .then(() => {
                    this.$toasted.show(`${this.field.name} Updated`, { type: 'success' })
                }, (response) => {
                    this.$toasted.show(response, { type: 'error' })
                })
        }
    }
}
</script>
