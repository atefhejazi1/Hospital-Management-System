<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DoctorSlot extends Model
{
    protected $fillable = ['doctor_id', 'day_of_week', 'start_time', 'end_time'];

    /**
     * Canonical week order (Sat-Fri clinic week). Values match Carbon's
     * English ->format('l') day name, stored as-is regardless of UI locale.
     */
    public const DAYS = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Hardcoded master list of bookable slots (08:00-17:00, 30 min each).
     * Admin can only pick from this fixed list, never create new slot times.
     */
    public static function fixedSlotOptions(): array
    {
        $options = [];
        $time = Carbon::createFromTime(8, 0);
        $end = Carbon::createFromTime(17, 0);

        while ($time->lt($end)) {
            $slotEnd = $time->copy()->addMinutes(30);

            $options[] = [
                'start' => $time->format('H:i:s'),
                'end' => $slotEnd->format('H:i:s'),
                'label' => $time->format('h:i A') . ' - ' . $slotEnd->format('h:i A'),
            ];

            $time = $slotEnd;
        }

        return $options;
    }
}
