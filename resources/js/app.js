require('./bootstrap');

window.Vue = require('vue');

import ClipboardJS from 'clipboard';
import VModal from 'vue-js-modal';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

Vue.use(VModal, {componentName: 'VueModal'});
Vue.use(VueToast);

Vue.component('invoice-modal', require('./components/InvoiceModal.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        current_page: 1,
        last_page: 1,
        invoices: [],
        clipper: null,

        activeProcesses: 0,
        alertText: null,
        alertClass: 'info',
        canDeploy: false,
        primaryServer: null
    },
    components: {},
    mounted() {
        this.loadInvoices()
    },
    beforeUpdate() {
        if (this.clipper) {
            this.clipper.destroy();
            this.clipper = null;
        }
    },
    updated() {
        this.clipper = new ClipboardJS('.btn-copy');
        this.clipper.on('success', function (e) {
            Vue.$toast.open('You did it!');

            e.clearSelection();
        });
        this.clipper.on('error', function (e) {
            Vue.$toast.open({
                message: 'Copying failed :(',
                type: 'error',
            });
            e.clearSelection();
        });
    },
    methods: {
        loadInvoices(page = 1) {
            axios.get(`invoices?page=${page}`)
                .then((response) => {
                    this.invoices = response.data?.data;
                    this.current_page = response.data?.meta?.current_page;
                    this.last_page = response.data?.meta?.last_page;
                }).catch((error) => {
                Vue.$toast.open({
                    message: 'Unable to load invoices',
                    type: 'error',
                });
            })
        }
    },
    computed: {
        isHasPrevPage() {
            return (this.current_page > 1);
        },
        isHasNextPage() {
            return (this.current_page < this.last_page);
        },
        nextPage() {
            return this.current_page + 1;
        },
        prevPage() {
            return this.current_page - 1;
        }
    }
});
