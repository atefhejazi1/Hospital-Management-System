<div>

    @if ($InvoiceSaved)
        <div class="alert alert-info">{{ trans('invoices_trans.data_saved_success') }}</div>
    @endif

    @if ($InvoiceUpdated)
        <div class="alert alert-info">{{ trans('invoices_trans.data_updated_success') }}</div>
    @endif

    @if ($show_table)
        @include('livewire.group_invoices.Table')
    @else
        <form wire:submit.prevent="store" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col">
                    <label>{{ trans('invoices_trans.patient_name') }}</label>
                    <select wire:model="patient_id" class="form-control" required>
                        <option value="">{{ trans('invoices_trans.choose_from_list_placeholder') }}</option>
                        @foreach ($Patients as $Patient)
                            <option value="{{ $Patient->id }}">{{ $Patient->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col">
                    <label>{{ trans('invoices_trans.doctor_name') }}</label>
                    <select wire:model="doctor_id" wire:change="get_section" class="form-control"
                        id="exampleFormControlSelect1" required>
                        <option value="">{{ trans('invoices_trans.choose_from_list_placeholder') }}</option>
                        @foreach ($Doctors as $Doctor)
                            <option value="{{ $Doctor->id }}">{{ $Doctor->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col">
                    <label>{{ trans('invoices_trans.department') }}</label>
                    <input wire:model="section_id" type="text" class="form-control" readonly>
                </div>

                <div class="col">
                    <label>{{ trans('invoices_trans.invoice_type') }}</label>
                    <select wire:model="type" class="form-control" {{ $updateMode == true ? 'disabled' : '' }}>
                        <option value="">{{ trans('invoices_trans.choose_from_list_placeholder') }}</option>
                        <option value="1">{{ trans('invoices_trans.type_cash') }}</option>
                        <option value="2">{{ trans('invoices_trans.type_deferred') }}</option>
                    </select>
                </div>


            </div><br>

            <div class="row row-sm">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0"></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mg-b-0 text-md-nowrap" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('invoices_trans.service_name') }}</th>
                                            <th>{{ trans('invoices_trans.service_price') }}</th>
                                            <th>{{ trans('invoices_trans.discount_value') }}</th>
                                            <th>{{ trans('invoices_trans.tax_rate') }}</th>
                                            <th>{{ trans('invoices_trans.tax_value') }}</th>
                                            <th>{{ trans('invoices_trans.total_with_tax') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>
                                                <select wire:model="Group_id" class="form-control"
                                                    wire:change="get_price" id="exampleFormControlSelect1">
                                                    <option value="">{{ trans('invoices_trans.choose_service_placeholder') }}</option>
                                                    @foreach ($Groups as $Group)
                                                        <option value="{{ $Group->id }}">{{ $Group->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input wire:model="price" type="text" class="form-control" readonly>
                                            </td>
                                            <td><input wire:model="discount_value" type="text" class="form-control"
                                                    readonly></td>
                                            <th><input wire:model="tax_rate" type="text" class="form-control"
                                                    readonly></th>
                                            <td><input type="text" class="form-control" value="{{ $tax_value }}"
                                                    readonly></td>
                                            <td><input type="text" class="form-control" readonly
                                                    value="{{ $subtotal + $tax_value }}"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- bd -->
                        </div><!-- bd -->
                    </div><!-- bd -->
                </div>
            </div>
            <input class="btn btn-outline-success" type="submit" value="{{ trans('invoices_trans.confirm_data') }}">
        </form>
    @endif

</div>
