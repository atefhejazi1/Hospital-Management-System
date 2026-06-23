@extends('Dashboard.layouts.master')
@section('css')
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('billing-ops_trans.ambulance_section') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('billing-ops_trans.ambulance_index_title') }}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
				<!-- row opened -->
				<div class="row row-sm">
					<!--div-->
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
                                    <a href="{{route('Ambulance.create')}}" class="btn btn-primary">{{ trans('billing-ops_trans.ambulance_add_title') }}</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th>#</th>
												<th >{{ trans('billing-ops_trans.ambulance_col_number') }}</th>
												<th >{{ trans('billing-ops_trans.ambulance_col_model') }}</th>
												<th>{{ trans('billing-ops_trans.ambulance_col_year') }}</th>
												<th>{{ trans('billing-ops_trans.ambulance_col_type') }}</th>
												<th >{{ trans('billing-ops_trans.ambulance_col_driver_name') }}</th>
                                                <th >{{ trans('billing-ops_trans.ambulance_col_license') }}</th>
                                                <th >{{ trans('billing-ops_trans.ambulance_col_phone') }}</th>
                                                <th >{{ trans('billing-ops_trans.ambulance_col_status') }}</th>
                                                <th >{{ trans('billing-ops_trans.ambulance_col_notes') }}</th>
                                                <th>{{ trans('billing-ops_trans.ambulance_col_actions') }}</th>
											</tr>
										</thead>
										<tbody>
                                        @foreach($ambulances as $ambulance)
											<tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$ambulance->car_number}}</td>
                                                <td>{{$ambulance->car_model}}</td>
                                                <td>{{$ambulance->car_year_made}}</td>
                                                <td>{{$ambulance->car_type == 1 ? trans('billing-ops_trans.ambulance_car_type_owned') : trans('billing-ops_trans.ambulance_car_type_rented')}}</td>
                                                <td>{{$ambulance->driver_name}}</td>
                                                <td>{{$ambulance->driver_license_number}}</td>
                                                <td>{{$ambulance->driver_phone}}</td>
                                                <td>{{$ambulance->is_available == 1 ? trans('billing-ops_trans.ambulance_status_active') : trans('billing-ops_trans.ambulance_status_inactive')}}</td>
                                                <td>{{$ambulance->notes}}</td>
                                                <td>
                                                    <a href="{{route('Ambulance.edit',$ambulance->id)}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Deleted{{$ambulance->id}}"><i class="fas fa-trash"></i></button>
                                                </td>
											</tr>
                                            @include('Dashboard.Ambulances.Deleted')
                                        @endforeach
										</tbody>
									</table>
								</div>
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
					<!--/div-->
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection
