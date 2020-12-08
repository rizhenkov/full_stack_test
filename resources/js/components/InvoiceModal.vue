<template>
    <vue-modal name="invoiceModal" :classes="['invoice-modal']"
               height="auto" :adaptive="true"
               :click-to-close="false" :focus-trap="true" :scrollable="true"
               :resizable="true">
        <form @submit.prevent.stop="invoiceFormSubmit" method="post" ref="invoiceForm" class="p-3">
            <div class="form-group">
                <label for="inputSchool">School name</label>
                <input v-model="invoice.school" type="text" class="form-control" id="inputSchool" required>
            </div>
            <div class="form-group">
                <label for="inputDescription">Description</label>
                <textarea v-model="invoice.description" class="form-control" id="inputDescription" rows="3"
                          required></textarea>
            </div>
            <div class="form-group">
                <label for="inputAmount">Amount</label>
                <input v-model="invoice.amount" type="number" class="form-control" id="inputAmount" required>
            </div>
            <hr>
            <div class="form-group">
                <label for="inputEmail">Payer email</label>
                <input v-model="invoice.email" type="email" class="form-control" id="inputEmail" required>
                <small id="passwordHelpBlock" class="form-text text-muted">
                    The invoice will be sent to the provided email with link for payment when clicked on
                    "Create".
                </small>
            </div>
            <div class="d-flex justify-content-between">
                <button class="btn btn-lg btn-primary" :disabled="sendingState" type="submit">Create</button>
                <button class="btn btn-lg btn-secondary" @click="$modal.hide('invoiceModal')" type="button">Cancel
                </button>
            </div>
        </form>
    </vue-modal>
</template>

<script>
export default {
    name: "InvoiceModal",
    data() {
        return {
            sendingState: false,
            invoice: {
                school: "",
                description: "",
                amount: "",
                email: ""
            },
        }
    },
    methods: {
        invoiceFormSubmit(e) {
            const form = this.$refs.invoiceForm;
            form.classList.add('was-validated');
            if (form.checkValidity()) {
                this.storeInvoice();
            }
        },
        storeInvoice() {
            this.sendingState = true;
            axios.post('invoices', this.invoice)
                .then((response) => {
                    this.$modal.hide('invoiceModal');
                    this.invoice = {
                        school: "",
                        description: "",
                        amount: "",
                        email: ""
                    };
                    this.$emit('create');
                })
                .catch((error) => {
                    let message = error?.response?.data?.message;
                    if (!message) {
                        message = 'Unable to store invoice';
                    }
                    Vue.$toast.open({
                        message: message, type: 'error',
                    })
                })
                .finally(() => {
                    this.sendingState = false;
                })
        },
    }
}
</script>

<style scoped>
textarea {
    resize: none;
}
</style>
