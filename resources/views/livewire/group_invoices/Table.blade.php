<button class="btn btn-primary pull-right" wire:click="show_form_add" type="button">{{ trans('invoices_trans.add_new_invoice') }} </button><br><br>
<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1" data-page-length="50"style="text-align: center">
        <thead>
            <tr>
                <th>{{ trans('invoices_trans.col_id') }}</th>
                <th>{{ trans('invoices_trans.col_service_name') }}</th>
                <th>{{ trans('invoices_trans.col_patient_name') }}</th>
                <th>{{ trans('invoices_trans.col_invoice_date') }}</th>
                <th>{{ trans('invoices_trans.col_doctor_name') }}</th>
                <th>{{ trans('invoices_trans.col_department') }}</th>
                <th>{{ trans('invoices_trans.col_service_price') }}</th>
                <th>{{ trans('invoices_trans.col_discount_value') }}</th>
                <th>{{ trans('invoices_trans.col_tax_rate') }}</th>
                <th>{{ trans('invoices_trans.col_tax_value') }}</th>
                <th>{{ trans('invoices_trans.col_total_with_tax') }}</th>
                <th>{{ trans('invoices_trans.col_invoice_type') }}</th>
                <th>{{ trans('invoices_trans.col_processes') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($group_invoices as $group_invoice)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $group_invoice->Group->name }}</td>
                    <td>{{ $group_invoice->Patient->name }}</td>
                    <td>{{ $group_invoice->invoice_date }}</td>
                    <td>{{ $group_invoice->Doctor->name }}</td>
                    <td>{{ $group_invoice->Section->name }}</td>
                    <td>{{ number_format($group_invoice->price, 2) }}</td>
                    <td>{{ number_format($group_invoice->discount_value, 2) }}</td>
                    <td>{{ $group_invoice->tax_rate }}%</td>
                    <td>{{ number_format($group_invoice->tax_value, 2) }}</td>
                    <td>{{ number_format($group_invoice->total_with_tax, 2) }}</td>
                    <td>{{ $group_invoice->type == 1 ? trans('invoices_trans.type_cash') : trans('invoices_trans.type_deferred') }}</td>
                    <td>
                        <button wire:click="edit({{ $group_invoice->id }})" class="btn btn-primary btn-sm"><i
                                class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                            data-target="#delete_invoice" wire:click="delete({{ $group_invoice->id }})"><i
                                class="fa fa-trash"></i></button>
                        <a href="#" wire:click="print({{ $group_invoice->id }})" class="btn btn-primary btn-sm"
                            target="_blank" title="{{ trans('invoices_trans.print') }}"><i class="fas fa-print"></i></a>
                        {{-- <button wire:click="print({{ $group_invoice->id }})" class="btn btn-primary btn-sm"><i
                        class="fas fa-print"></i></button> --}}
                    </td>
                </tr>
            @endforeach
    </table>
    @include('livewire.group_invoices.delete')
</div>
