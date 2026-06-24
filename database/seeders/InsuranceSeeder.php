<?php

namespace Database\Seeders;

use App\Models\Insurance;
use Illuminate\Database\Seeder;

class InsuranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insurances = [
            ['code' => 'INS-001', 'discount' => '10', 'rate' => '90', 'name_en' => 'NextCare Insurance', 'name_ar' => 'نكست كير للتأمين', 'notes_en' => 'Covers outpatient consultations and lab tests.', 'notes_ar' => 'تغطي الكشف الخارجي والتحاليل المخبرية.'],
            ['code' => 'INS-002', 'discount' => '15', 'rate' => '85', 'name_en' => 'Bupa Arabia', 'name_ar' => 'بوبا العربية', 'notes_en' => 'Full coverage including imaging and surgery.', 'notes_ar' => 'تغطية شاملة تشمل الأشعة والجراحة.'],
            ['code' => 'INS-003', 'discount' => '20', 'rate' => '80', 'name_en' => 'MedGulf', 'name_ar' => 'ميدغلف', 'notes_en' => 'Discounted rates for chronic disease follow-up.', 'notes_ar' => 'أسعار مخفضة لمتابعة الأمراض المزمنة.'],
            ['code' => 'INS-004', 'discount' => '12', 'rate' => '88', 'name_en' => 'Tawuniya', 'name_ar' => 'التعاونية', 'notes_en' => 'Covers maternity and pediatric care.', 'notes_ar' => 'تغطي رعاية الحمل والولادة وطب الأطفال.'],
            ['code' => 'INS-005', 'discount' => '8', 'rate' => '92', 'name_en' => 'AXA Gulf', 'name_ar' => 'أكسا الخليج', 'notes_en' => 'Standard plan covering general consultations.', 'notes_ar' => 'خطة أساسية تغطي الكشف العام.'],
            ['code' => 'INS-006', 'discount' => '18', 'rate' => '82', 'name_en' => 'Al Rajhi Takaful', 'name_ar' => 'الراجحي تكافل', 'notes_en' => 'Shariah-compliant plan with dental coverage.', 'notes_ar' => 'خطة متوافقة مع الشريعة تشمل تغطية الأسنان.'],
        ];

        foreach ($insurances as $insurance) {
            $model = new Insurance();
            $model->insurance_code = $insurance['code'];
            $model->discount_percentage = $insurance['discount'];
            $model->Company_rate = $insurance['rate'];
            $model->status = 1;
            $model->save();

            $model->translateOrNew('en')->name = $insurance['name_en'];
            $model->translateOrNew('en')->notes = $insurance['notes_en'];
            $model->translateOrNew('ar')->name = $insurance['name_ar'];
            $model->translateOrNew('ar')->notes = $insurance['notes_ar'];
            $model->save();
        }
    }
}
