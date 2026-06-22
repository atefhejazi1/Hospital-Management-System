<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Patient;
use Illuminate\Contracts\Auth\Authenticatable;

class PatientPolicy
{
    /**
     * Admins manage the patient roster directly; every ability below is
     * granted to them unconditionally.
     */
    public function before(Authenticatable $user, string $ability): ?bool
    {
        return $user instanceof Admin ? true : null;
    }

    /**
     * A patient may view their own record. A doctor may view a patient's
     * record only if they have actually treated/billed them — derived from
     * an existing invoice between the two, since this app has no explicit
     * "doctor's patient list" table.
     */
    public function view(Authenticatable $user, Patient $patient): bool
    {
        if ($user instanceof Patient) {
            return (int) $user->id === (int) $patient->id;
        }

        return $user instanceof Doctor && $this->doctorTreatsPatient($user, $patient);
    }

    public function update(Authenticatable $user, Patient $patient): bool
    {
        return $user instanceof Doctor && $this->doctorTreatsPatient($user, $patient);
    }

    /**
     * Only admins may delete a patient record (granted via before()).
     */
    public function delete(Authenticatable $user, Patient $patient): bool
    {
        return false;
    }

    private function doctorTreatsPatient(Doctor $doctor, Patient $patient): bool
    {
        return Invoice::where('patient_id', $patient->id)
            ->where('doctor_id', $doctor->id)
            ->exists();
    }
}
