<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use Translatable;
    use HasFactory;
    use SoftDeletes;

    public $translatedAttributes = ['name','Address'];
    protected $fillable = ['email','password','Date_Birth','Phone','Gender','Blood_Group'];
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'patient_id');
    }

    public function receiptAccounts()
    {
        return $this->hasMany(ReceiptAccount::class, 'patient_id');
    }

    public function patientAccounts()
    {
        return $this->hasMany(PatientAccount::class, 'patient_id');
    }
}
