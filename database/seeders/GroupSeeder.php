<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Service;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = Service::all()->values();

        $groups = [
            [
                'name_en' => 'Full Checkup Package', 'name_ar' => 'باقة الفحص الشامل',
                'notes_en' => 'Consultation, blood test, and ECG bundled together.', 'notes_ar' => 'كشف وتحليل دم وتخطيط قلب في باقة واحدة.',
                'items' => [0 => 1, 2 => 1, 5 => 1],
            ],
            [
                'name_en' => 'Cardiac Care Package', 'name_ar' => 'باقة فحص القلب',
                'notes_en' => 'Two ECG sessions plus a blood test and consultation.', 'notes_ar' => 'جلستا تخطيط قلب مع تحليل دم وكشف.',
                'items' => [5 => 2, 2 => 1, 0 => 1],
            ],
            [
                'name_en' => 'Maternity Package', 'name_ar' => 'باقة الحمل والولادة',
                'notes_en' => 'Two abdominal ultrasounds with a consultation.', 'notes_ar' => 'فحصا سونار للبطن مع كشف.',
                'items' => [4 => 2, 0 => 1],
            ],
            [
                'name_en' => 'Imaging Package', 'name_ar' => 'باقة الأشعة',
                'notes_en' => 'Chest X-Ray combined with a CT scan.', 'notes_ar' => 'أشعة سينية للصدر مع تصوير مقطعي.',
                'items' => [3 => 1, 7 => 1],
            ],
            [
                'name_en' => 'Physiotherapy Course', 'name_ar' => 'كورس علاج طبيعي',
                'notes_en' => 'Five physiotherapy sessions.', 'notes_ar' => 'خمس جلسات علاج طبيعي.',
                'items' => [8 => 5],
            ],
            [
                'name_en' => 'Dental Care Package', 'name_ar' => 'باقة الأسنان',
                'notes_en' => 'Two dental cleaning sessions with a consultation.', 'notes_ar' => 'جلستا تنظيف أسنان مع كشف.',
                'items' => [11 => 2, 0 => 1],
            ],
        ];

        foreach ($groups as $group) {
            $totalBeforeDiscount = 0;
            foreach ($group['items'] as $serviceIndex => $quantity) {
                $totalBeforeDiscount += $services[$serviceIndex]->price * $quantity;
            }

            $discountValue = round($totalBeforeDiscount * 0.10, 2);
            $totalAfterDiscount = $totalBeforeDiscount - $discountValue;
            $taxRate = '17';
            $totalWithTax = round($totalAfterDiscount * 1.17, 2);

            $model = new Group();
            $model->Total_before_discount = $totalBeforeDiscount;
            $model->discount_value = $discountValue;
            $model->Total_after_discount = $totalAfterDiscount;
            $model->tax_rate = $taxRate;
            $model->Total_with_tax = $totalWithTax;
            $model->save();

            $model->translateOrNew('en')->name = $group['name_en'];
            $model->translateOrNew('en')->notes = $group['notes_en'];
            $model->translateOrNew('ar')->name = $group['name_ar'];
            $model->translateOrNew('ar')->notes = $group['notes_ar'];
            $model->save();

            foreach ($group['items'] as $serviceIndex => $quantity) {
                $model->service_group()->attach($services[$serviceIndex]->id, ['quantity' => $quantity]);
            }
        }
    }
}
