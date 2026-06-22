<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnostic extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * `diagnosis` and `medicine` hold PHI (clinical findings/prescriptions).
     * The `encrypted` cast transparently encrypts on write and decrypts on
     * read using APP_KEY (AES-256-CBC), so the columns are unreadable in a
     * raw DB dump while remaining ordinary strings to the rest of the app.
     */
    protected function casts(): array
    {
        return [
            'diagnosis' => 'encrypted',
            'medicine' => 'encrypted',
        ];
    }

    public function Doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
