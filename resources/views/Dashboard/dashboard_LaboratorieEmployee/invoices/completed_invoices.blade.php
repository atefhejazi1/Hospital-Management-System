@extends('Dashboard.layouts.master')
@section('title')
    {{ trans('staff-dashboard_trans.completed_invoices_title') }}
@stop
@section('css')


    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('staff-dashboard_trans.completed_invoices_title') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('staff-dashboard_trans.lab_checkups_breadcrumb') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row -->
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                            <tr>
                                <th>{{ trans('staff-dashboard_trans.col_hash') }}</th>
                                <th>{{ trans('staff-dashboard_trans.col_invoice_date') }}</th>
                                <th>{{ trans('staff-dashboard_trans.col_patient_name') }}</th>
                                <th>{{ trans('staff-dashboard_trans.col_doctor_name') }}</th>
                                <th>{{ trans('staff-dashboard_trans.col_required') }}</th>
                                <th>{{ trans('staff-dashboard_trans.col_invoice_status') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $invoice->created_at }}</td>
                                    <td><a href="{{route('view_laboratories_laboratorie_employee',$invoice->id)}}">{{ $invoice->Patient->name }}</a></td>
                                    <td>{{ $invoice->doctor->name }}</td>
                                    <td>{{ $invoice->description }}</td>
                                    <td>
                                        @if($invoice->case == 0)
                                            <span class="badge badge-danger">{{ trans('staff-dashboard_trans.status_in_progress') }}</span>
                                        @else
                                            <span class="badge badge-success">{{ trans('staff-dashboard_trans.status_completed') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

        <!-- /row -->
    </div>
    <!-- row closed -->

    <!-- Container closed -->

    <!-- main-content closed -->
@endsection
@section('js')

    <!--Internal  Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>

@endsection
