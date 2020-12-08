@extends('layouts.app')
@section('content')

    <div class="bg-white shadow-sm" id="app" v-cloak>

        <invoice-modal @create="loadInvoices(current_page)"></invoice-modal>

        <div class="d-flex" id="logged-data"
             data-token="{{ $user->api_token }}">
            <button class="btn btn-primary" @click="$modal.show('invoiceModal')">Add invoice</button>
            <a class="btn btn-light mr-auto" href="/logout">Logout</a>

            <button class="btn btn-light" @click="loadInvoices(prevPage)" :disabled="! isHasPrevPage">Prev</button>
            <button class="btn btn-light" @click="loadInvoices(nextPage)" :disabled="! isHasNextPage">Next</button>
        </div>

        @verbatim

            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                    <tr class="text-nowrap">
                        <th width="25%">School name</th>
                        <th width="25%">Description</th>
                        <th>Amount</th>
                        <th>Payment status</th>
                        <th>Invoice link</th>
                        <th>Payer name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="invoice in invoices">
                        <td>{{ invoice.school }}</td>
                        <td>{{ invoice.description }}</td>
                        <td>{{ invoice.amount }}</td>
                        <td>{{ invoice.status ? "Payment received" : "New" }}</td>
                        <td><a href="#a" onclick="return false;"
                               class="btn-copy btn btn-link"
                               :data-clipboard-text="invoice.link">Copy</a></td>
                        <td>{{ invoice.payer }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-center p-3">
                Page {{ current_page }} of {{ last_page }}
            </div>

        @endverbatim
    </div>
@endsection

@once
    @push('scripts')
        <script src="{{ mix('/js/app.js')  }}"></script>
    @endpush
@endonce
