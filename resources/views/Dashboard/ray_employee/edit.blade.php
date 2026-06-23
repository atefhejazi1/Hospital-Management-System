<!-- Modal -->
<div class="modal fade" id="edit{{ $ray_employee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('staff-crud_trans.edit_employee_title') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ray_employee.update', $ray_employee->id) }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <label for="exampleInputPassword1">{{ trans('staff-crud_trans.employee_name') }}</label>
                    <input type="text" value="{{$ray_employee->name}}" name="name" class="form-control"><br>

                    <label for="exampleInputPassword1">{{ trans('staff-crud_trans.employee_email') }}</label>
                    <input type="email" value="{{$ray_employee->email}}" name="email" class="form-control"><br>

                    <label for="exampleInputPassword1">{{ trans('staff-crud_trans.employee_password') }}</label>
                    <input type="password" name="password" class="form-control" autocomplete="new-password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('Dashboard/sections_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
