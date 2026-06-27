<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Doctor extends Authenticatable
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['name'];
    protected $fillable = ['email', 'email_verified_at', 'password', 'phone', 'status', 'name',  'section_id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the Doctor's image.
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    // One To One get section of Doctor
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function slots()
    {
        return $this->hasMany(DoctorSlot::class);
    }

    /**
     * This doctor's fixed slots for $date's day of week (e.g. every
     * Wednesday), with booked status and the booking appointment (if any)
     * for that exact date. Single source of truth shared by the admin
     * schedule view and the patient booking page.
     */
    public function scheduleForDate(string $date): \Illuminate\Support\Collection
    {
        $dayOfWeek = \Carbon\Carbon::parse($date)->format('l');

        $appointments = $this->appointments()
            ->whereDate('appointment', $date)
            ->get()
            ->keyBy(fn ($appointment) => $appointment->appointment->format('H:i:s'));

        return $this->slots
            ->where('day_of_week', $dayOfWeek)
            ->sortBy('start_time')
            ->map(function (DoctorSlot $slot) use ($appointments) {
                $appointment = $appointments->get($slot->start_time);

                return [
                    'slot' => $slot,
                    'booked' => $appointment !== null,
                    'appointment' => $appointment,
                ];
            })
            ->values();
    }
}
