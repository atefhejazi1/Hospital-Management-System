<div>
    @if ($message === true)
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert" style="border-radius:8px;">
            <i class="bi bi-check-circle-fill"></i>
            <span>Your appointment request has been received — we'll confirm the date and time by phone and email.</span>
        </div>
    @endif
    <form wire:submit="store">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Full name</label>
                <input type="text" class="form-control" wire:model="name" placeholder="Your full name" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" wire:model="email" placeholder="you@example.com" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Department</label>
                <select class="form-select" wire:model.live="section">
                    <option value="">Select a department first</option>
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Doctor</label>
                <select class="form-select" wire:model="doctor">
                    <option value="">Select a doctor</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Phone number</label>
                <input type="tel" class="form-control" wire:model="phone" placeholder="Your phone number" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Notes (optional)</label>
                <input type="text" class="form-control" wire:model="notes" placeholder="Anything we should know?">
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn-brand w-100 border-0" style="padding:13px 0; font-size:.95rem;" wire:loading.attr="disabled">
                    <i class="bi bi-calendar2-check-fill me-1"></i> Confirm Appointment Request
                </button>
            </div>
        </div>
    </form>
</div>
