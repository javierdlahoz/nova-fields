require("../../node_modules/codemirror/mode/htmlmixed/htmlmixed")

Nova.booting((Vue, router, store) => {
    // HTML EDITOR
    Vue.component('jdlabs-html-field', require('./components/html/HtmlField').default)
    Vue.component('index-jdlabs-html', require('./components/html/IndexField').default)
    Vue.component('detail-jdlabs-html', require('./components/html/DetailField').default)
    Vue.component('form-jdlabs-html', require('./components/html/FormField').default)

    // KEY VALUE
    Vue.component('index-jdlabs-key-value', require('./components/keyvalue/IndexField').default)
    Vue.component('detail-jdlabs-key-value', require('./components/keyvalue/DetailField').default)
    Vue.component('form-jdlabs-key-value', require('./components/keyvalue/FormField.vue').default)

    // LINK
    Vue.component('index-jdlabs-link', require('./components/link/IndexField').default)
    Vue.component('detail-jdlabs-link', require('./components/link/DetailField').default)
    Vue.component('form-jdlabs-link', require('./components/link/FormField').default)
    Vue.component('jdlabs-link-panel-item', require('./components/link/PanelItem').default)
    Vue.component('jdlabs-link-item-value', require('./components/link/ItemValue').default)

    // SPARK LINE WITH LINK
    Vue.component('index-sparkline-with-link', require('./components/sparkline_with_link/IndexField').default)
    Vue.component('detail-sparkline-with-link', require('./components/sparkline_with_link/DetailField').default)
    Vue.component('form-sparkline-with-link', require('./components/sparkline_with_link/FormField').default)
    Vue.component('sparkline-with-link-panel-item', require('./components/sparkline_with_link/PanelItem').default)
    Vue.component('sparkline-with-link-item-value', require('./components/sparkline_with_link/ItemValue').default)

    // TOGGLE
    Vue.component('index-toggle-button', require('./components/toggle_button/IndexField').default)
    Vue.component('detail-toggle-button', require('./components/toggle_button/DetailField').default)
    Vue.component('form-toggle-button', require('./components/toggle_button/FormField').default)
    // Vue.component('toggle-button-panel-item', require('./components/toggle_button/PanelItem').default)
    // Vue.component('toggle-button-item-value', require('./components/toggle_button/ItemValue').default)
})
