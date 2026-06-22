<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Diagnostic;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Contracts\Auth\Authenticatable;

class DiagnosticPolicy
{
    /**
     * Admins have full access to every diagnostic record.
     */
    public function before(Authenticatable $user, string $ability): ?bool
    {
        return $user instanceof Admin ? true : null;
    }

    /**
     * The patient the record belongs to may view it (read-only). The doctor
     * who authored it may view it. No other doctor or employee guard may.
     */
    public function view(Authenticatable $user, Diagnostic $diagnostic): bool
    {
        if ($user instanceof Patient) {
            return (int) $user->id === (int) $diagnostic->patient_id;
        }

        return $user instanceof Doctor && (int) $user->id === (int) $diagnostic->doctor_id;
    }

    /**
     * Any authenticated doctor may file a new diagnosis; ownership of the
     * specific patient/invoice is enforced separately (see
     * DiagnosisRepository::store(), which derives doctor_id from the
     * authenticated guard rather than trusting request input).
     */
    public function create(Authenticatable $user): bool
    {
        return $user instanceof Doctor;
    }

    public function update(Authenticatable $user, Diagnostic $diagnostic): bool
    {
        return $user instanceof Doctor && (int) $user->id === (int) $diagnostic->doctor_id;
    }

    /**
     * Diagnoses are part of the permanent medical record — only admins may
     * remove one (granted via before()).
     */
    public function delete(Authenticatable $user, Diagnostic $diagnostic): bool
    {
        return false;
    }
}
