<div>
    @if ($message === true)
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert" style="border-radius:8px;">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ trans('landing_trans.booking_success') }}</span>
        </div>
    @endif
    <form wire:submit="store">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">{{ trans('landing_trans.form_full_name') }}</label>
                <input type="text" class="form-control" wire:model="name" placeholder="{{ trans('landing_trans.form_full_name_placeholder') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">{{ trans('landing_trans.form_email') }}</label>
                <input type="email" class="form-control" wire:model="email" placeholder="{{ trans('landing_trans.form_email_placeholder') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">{{ trans('landing_trans.form_department') }}</label>
                <select class="form-select" wire:model.live="section">
                    <option value="">{{ trans('landing_trans.form_department_placeholder') }}</option>
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">{{ trans('landing_trans.form_doctor') }}</label>
                <select class="form-select" wire:model="doctor">
                    <option value="">{{ trans('landing_trans.form_doctor_placeholder') }}</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">{{ trans('landing_trans.form_phone') }}</label>
                <input type="tel" class="form-control" wire:model="phone" placeholder="{{ trans('landing_trans.form_phone_placeholder') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">{{ trans('landing_trans.form_notes') }}</label>
                <input type="text" class="form-control" wire:model="notes" placeholder="{{ trans('landing_trans.form_notes_placeholder') }}">
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn-brand w-100 border-0" style="padding:13px 0; font-size:.95rem;" wire:loading.attr="disabled">
                    <i class="bi bi-calendar2-check-fill me-1"></i> {{ trans('landing_trans.form_submit') }}
                </button>
            </div>
        </div>
    </form>
</div>
