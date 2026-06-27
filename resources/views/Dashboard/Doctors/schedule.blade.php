@extends('Dashboard.layouts.master')
@section('title')
    {{trans('doctors.schedule')}}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ $doctor->name }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{trans('doctors.schedule')}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <form method="GET" class="form-inline">
                        <label class="mr-2">{{trans('doctors.date')}}</label>
                        <input type="date" name="date" value="{{ $date }}" class="form-control mr-2" onchange="this.form.submit()">
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th>{{trans('doctors.time_slot')}}</th>
                                <th>{{trans('doctors.Status')}}</th>
                                <th>{{trans('doctors.patient_name')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($schedule as $row)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($row['slot']->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($row['slot']->end_time)->format('h:i A') }}</td>
                                    <td>
                                        @if($row['booked'])
                                            <span class="badge badge-danger">{{trans('doctors.booked')}}</span>
                                        @else
                                            <span class="badge badge-success">{{trans('doctors.available')}}</span>
                                        @endif
                                    </td>
                                    <td>{{ $row['booked'] ? $row['appointment']->name : '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">{{trans('doctors.choose_slots')}}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
