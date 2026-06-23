@extends('Dashboard.layouts.master')
@section('title')
    {{ trans('invoices_trans.page_title_print_invoices') }}
@stop
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('invoices_trans.breadcrumb_invoices') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('invoices_trans.breadcrumb_print_invoices') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">{{ trans('invoices_trans.single_invoice_title') }}</h1>
                            <div class="billed-from">
                                <h6>{{ trans('invoices_trans.single_invoice_title') }}</h6>
                                <p>{{ trans('invoices_trans.address_line') }}<br>
                                    {{ trans('invoices_trans.tel_label') }}<br>
                                    {{ trans('invoices_trans.email_label') }}</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">

                            <div class="col-md">
                                <label class="tx-gray-600">{{ trans('invoices_trans.invoice_info') }}</label>
                                {{--                                <p class="invoice-info-row"><span>اسم الخدمه</span> <span>{{$single_invoice->Service->name}}</span></p> --}}
                                {{--                                <p class="invoice-info-row"><span>اسم المريض</span> <span>{{$single_invoice->patient->name}}</span></p> --}}
                                <p class="invoice-info-row"><span>{{ trans('invoices_trans.invoice_date') }}</span>
                                    <span>{{ Request::get('invoice_date') }}</span></p>
                                <p class="invoice-info-row"><span>{{ trans('invoices_trans.doctor') }}</span>
                                    <span></span>{{ Request::get('doctor_id') }}</p>
                                <p class="invoice-info-row"><span>{{ trans('invoices_trans.department') }}</span> <span></span>{{ Request::get('section_id') }}
                                </p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">#</th>
                                        <th class="wd-40p">{{ trans('invoices_trans.service_name') }}</th>
                                        <th class="tx-center">{{ trans('invoices_trans.service_price') }}</th>
                                        <th class="tx-right">{{ trans('invoices_trans.invoice_type') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td class="tx-12">{{ Request::get('Service_id') }}</td>
                                        <td class="tx-center">{{ Request::get('price') }}</td>
                                        <td class="tx-right">{{ Request::get('type') == 1 ? trans('invoices_trans.type_cash') : trans('invoices_trans.type_deferred') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="valign-middle" colspan="2" rowspan="4">
                                            <div class="invoice-notes">
                                                <label class="main-content-label tx-13"></label>
                                            </div><!-- invoice-notes -->
                                        </td>
                                        <td class="tx-right">{{ trans('invoices_trans.total') }}</td>
                                        <td class="tx-right" colspan="2"> {{ number_format(Request::get('price'), 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">{{ trans('invoices_trans.discount_value') }}</td>
                                        <td class="tx-right" colspan="2">{{ Request::get('discount_value') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">{{ trans('invoices_trans.tax_rate') }}</td>
                                        <td class="tx-right" colspan="2">% {{ Request::get('tax_rate') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">{{ trans('invoices_trans.total_with_tax_inclusive') }}</td>
                                        <td class="tx-right" colspan="2">
                                            <h4 class="tx-primary tx-bold">
                                                {{ number_format(Request::get('total_with_tax'), 2) }}</h4>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">
                        <a href="#" class="btn btn-danger float-left mt-3 mr-2" id="print_Button"
                            onclick="printDiv()">
                            <i class="mdi mdi-printer ml-1"></i>{{ trans('invoices_trans.print') }}
                        </a>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('Admin/assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection
