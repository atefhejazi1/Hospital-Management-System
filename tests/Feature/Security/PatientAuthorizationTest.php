<?php

use App\Models\Admin;
use App\Models\Diagnostic;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

/**
 * Exercises the multi-guard Gate resolver (App\Providers\AppServiceProvider)
 * together with PatientPolicy/DiagnosticPolicy against the same code path
 * the controllers use (Gate::authorize() with no explicit user — relying on
 * "whichever guard is currently logged in").
 *
 * Fixtures are inserted directly via the DB query builder rather than
 * factories/Translatable, since none of the authorization rules under test
 * depend on translated name/address fields.
 */
function logoutAllGuards(): void
{
    foreach (['admin', 'doctor', 'patient', 'ray_employee', 'laboratorie_employee'] as $guard) {
        Auth::guard($guard)->logout();
    }
}

function makeSection(): int
{
    return DB::table('sections')->insertGetId(['created_at' => now(), 'updated_at' => now()]);
}

function makeDoctor(int $sectionId, string $email): Doctor
{
    $id = DB::table('doctors')->insertGetId([
        'email' => $email,
        'password' => bcrypt('password'),
        'section_id' => $sectionId,
        'phone' => fake()->unique()->numerify('01#########'),
        'status' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return Doctor::find($id);
}

function makePatient(string $email): Patient
{
    $id = DB::table('patients')->insertGetId([
        'email' => $email,
        'password' => bcrypt('password'),
        'Date_Birth' => '1990-01-01',
        'Phone' => fake()->unique()->numerify('01#########'),
        'Gender' => '1',
        'Blood_Group' => 'O+',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return Patient::find($id);
}

function makeAdmin(): Admin
{
    $id = DB::table('admins')->insertGetId([
        'name' => 'Admin',
        'email' => fake()->unique()->safeEmail(),
        'password' => bcrypt('password'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return Admin::find($id);
}

function makeInvoice(int $patientId, int $doctorId, int $sectionId): int
{
    return DB::table('invoices')->insertGetId([
        'invoice_type' => 1,
        'invoice_date' => now()->toDateString(),
        'patient_id' => $patientId,
        'doctor_id' => $doctorId,
        'section_id' => $sectionId,
        'tax_rate' => '0',
        'tax_value' => '0',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

beforeEach(function () {
    $this->sectionId = makeSection();

    $this->doctorA = makeDoctor($this->sectionId, 'doctor.a@example.test');
    $this->doctorB = makeDoctor($this->sectionId, 'doctor.b@example.test');

    $this->patientA = makePatient('patient.a@example.test');
    $this->patientB = makePatient('patient.b@example.test');

    // Only doctorA has ever billed/treated patientA.
    $this->invoiceA = makeInvoice($this->patientA->id, $this->doctorA->id, $this->sectionId);

    $this->admin = makeAdmin();
});

afterEach(function () {
    logoutAllGuards();
});

it('lets an admin view, update and delete any patient', function () {
    Auth::guard('admin')->login($this->admin);

    expect(Gate::allows('view', $this->patientA))->toBeTrue();
    expect(Gate::allows('view', $this->patientB))->toBeTrue();
    expect(Gate::allows('update', $this->patientB))->toBeTrue();
    expect(Gate::allows('delete', $this->patientA))->toBeTrue();
});

it('lets a doctor view and update only patients they have an invoice with', function () {
    Auth::guard('doctor')->login($this->doctorA);

    expect(Gate::allows('view', $this->patientA))->toBeTrue();
    expect(Gate::allows('update', $this->patientA))->toBeTrue();

    // doctorA has no invoice with patientB.
    expect(Gate::allows('view', $this->patientB))->toBeFalse();
    expect(Gate::allows('update', $this->patientB))->toBeFalse();
});

it("blocks a doctor from viewing a patient they've never treated (the IDOR this policy closes)", function () {
    Auth::guard('doctor')->login($this->doctorB);

    expect(Gate::allows('view', $this->patientA))->toBeFalse();
});

it('lets a patient view only their own record', function () {
    Auth::guard('patient')->login($this->patientA);

    expect(Gate::allows('view', $this->patientA))->toBeTrue();
    expect(Gate::allows('view', $this->patientB))->toBeFalse();

    // Patients are never granted update/delete on their own record via this policy.
    expect(Gate::allows('update', $this->patientA))->toBeFalse();
});

it('denies a patient record to a doctor guard once both guards happen to be authenticated', function () {
    // Regression guard for the original "guards => [all five]" bug: even if
    // a patient session is concurrently active, the admin/doctor checks
    // above must not leak patient-only access, and vice versa.
    Auth::guard('doctor')->login($this->doctorB);
    Auth::guard('patient')->login($this->patientA);

    // Our resolver prefers admin > doctor > patient > ... so the doctor
    // guard wins here — and doctorB still has no relationship to patientA.
    expect(Gate::allows('view', $this->patientA))->toBeFalse();
});

it('lets only the authoring doctor (or admin) view/update a diagnostic, and the owning patient view it', function () {
    $diagnosticId = DB::table('diagnostics')->insertGetId([
        'date' => now()->toDateString(),
        'diagnosis' => 'flu',
        'medicine' => 'rest',
        'invoice_id' => $this->invoiceA,
        'patient_id' => $this->patientA->id,
        'doctor_id' => $this->doctorA->id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    $diagnostic = Diagnostic::find($diagnosticId);

    Auth::guard('doctor')->login($this->doctorA);
    expect(Gate::allows('view', $diagnostic))->toBeTrue();
    expect(Gate::allows('update', $diagnostic))->toBeTrue();
    logoutAllGuards();

    Auth::guard('doctor')->login($this->doctorB);
    expect(Gate::allows('view', $diagnostic))->toBeFalse();
    expect(Gate::allows('update', $diagnostic))->toBeFalse();
    logoutAllGuards();

    Auth::guard('patient')->login($this->patientA);
    expect(Gate::allows('view', $diagnostic))->toBeTrue();
    expect(Gate::allows('update', $diagnostic))->toBeFalse();
    logoutAllGuards();

    Auth::guard('admin')->login($this->admin);
    expect(Gate::allows('view', $diagnostic))->toBeTrue();
    expect(Gate::allows('delete', $diagnostic))->toBeTrue();
});
