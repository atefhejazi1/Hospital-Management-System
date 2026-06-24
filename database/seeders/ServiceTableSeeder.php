<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['price' => 100, 'name_en' => 'General Consultation', 'name_ar' => 'كشف عام', 'desc_en' => 'Initial consultation with a specialist doctor.', 'desc_ar' => 'كشف أولي مع طبيب اخصائي.'],
            ['price' => 50, 'name_en' => 'Follow-up Consultation', 'name_ar' => 'كشف متابعة', 'desc_en' => 'Follow-up visit for an existing case.', 'desc_ar' => 'زيارة متابعة لحالة قائمة.'],
            ['price' => 80, 'name_en' => 'Blood Test - CBC', 'name_ar' => 'تحليل دم شامل', 'desc_en' => 'Complete blood count laboratory test.', 'desc_ar' => 'فحص مخبري شامل لعينة الدم.'],
            ['price' => 150, 'name_en' => 'X-Ray - Chest', 'name_ar' => 'أشعة سينية - الصدر', 'desc_en' => 'Chest X-ray imaging.', 'desc_ar' => 'تصوير بالأشعة السينية للصدر.'],
            ['price' => 200, 'name_en' => 'Ultrasound - Abdomen', 'name_ar' => 'سونار - البطن', 'desc_en' => 'Abdominal ultrasound scan.', 'desc_ar' => 'فحص سونار لمنطقة البطن.'],
            ['price' => 90, 'name_en' => 'ECG', 'name_ar' => 'تخطيط القلب', 'desc_en' => 'Electrocardiogram heart rhythm test.', 'desc_ar' => 'فحص تخطيط كهربية القلب.'],
            ['price' => 800, 'name_en' => 'MRI - Brain', 'name_ar' => 'رنين مغناطيسي - الدماغ', 'desc_en' => 'Magnetic resonance imaging of the brain.', 'desc_ar' => 'تصوير بالرنين المغناطيسي للدماغ.'],
            ['price' => 600, 'name_en' => 'CT Scan', 'name_ar' => 'تصوير مقطعي', 'desc_en' => 'Computed tomography scan.', 'desc_ar' => 'تصوير طبقي محوري.'],
            ['price' => 120, 'name_en' => 'Physiotherapy Session', 'name_ar' => 'جلسة علاج طبيعي', 'desc_en' => 'One physical therapy session.', 'desc_ar' => 'جلسة واحدة من العلاج الطبيعي.'],
            ['price' => 60, 'name_en' => 'Vaccination', 'name_ar' => 'تطعيم', 'desc_en' => 'Routine vaccination dose.', 'desc_ar' => 'جرعة تطعيم روتينية.'],
            ['price' => 500, 'name_en' => 'Minor Surgery', 'name_ar' => 'جراحة صغرى', 'desc_en' => 'Outpatient minor surgical procedure.', 'desc_ar' => 'إجراء جراحي صغير لمرضى العيادات الخارجية.'],
            ['price' => 70, 'name_en' => 'Dental Cleaning', 'name_ar' => 'تنظيف أسنان', 'desc_en' => 'Professional dental cleaning session.', 'desc_ar' => 'جلسة تنظيف أسنان متخصصة.'],
        ];

        foreach ($services as $service) {
            $model = new Service();
            $model->price = $service['price'];
            $model->description = $service['desc_en'];
            $model->status = 1;
            $model->save();

            $model->translateOrNew('en')->name = $service['name_en'];
            $model->translateOrNew('ar')->name = $service['name_ar'];
            $model->save();
        }
    }
}
