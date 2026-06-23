<!-- Deleted insurance -->
<div class="modal fade" id="deleted_laboratorie{{$patient_Laboratorie->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('doctor-dashboard_trans.delete_lab_modal_title') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Laboratories.destroy', $patient_Laboratorie->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="row">
                        <div class="col">
                            <p class="h5 text-danger"> {{ trans('doctor-dashboard_trans.confirm_delete_lab') }} </p>
                            <input type="text" class="form-control" readonly value="{{ $patient_Laboratorie->description }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('insurance.close') }}</button>
                        <button class="btn btn-success">{{ trans('insurance.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
