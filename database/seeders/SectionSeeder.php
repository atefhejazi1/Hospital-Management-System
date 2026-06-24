<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'en' => ['name' => 'Neurology', 'description' => 'Diagnosis and treatment of disorders of the brain, spine, and nervous system.'],
                'ar' => ['name' => 'قسم المخ والاعصاب', 'description' => 'تشخيص وعلاج اضطرابات المخ والعمود الفقري والجهاز العصبي.'],
            ],
            [
                'en' => ['name' => 'General Surgery', 'description' => 'Surgical care covering a broad range of operations for adults and children.'],
                'ar' => ['name' => 'قسم الجراحة', 'description' => 'رعاية جراحية تشمل نطاقاً واسعاً من العمليات للبالغين والأطفال.'],
            ],
            [
                'en' => ['name' => 'Pediatrics', 'description' => 'Comprehensive medical care for infants, children, and adolescents.'],
                'ar' => ['name' => 'قسم الاطفال', 'description' => 'رعاية طبية شاملة للرضع والأطفال والمراهقين.'],
            ],
            [
                'en' => ['name' => 'Obstetrics & Gynecology', 'description' => 'Women\'s health services covering pregnancy, childbirth, and reproductive care.'],
                'ar' => ['name' => 'قسم النساء والتوليد', 'description' => 'خدمات صحة المرأة تشمل الحمل والولادة والرعاية التناسلية.'],
            ],
            [
                'en' => ['name' => 'Ophthalmology', 'description' => 'Diagnosis, treatment, and surgery for conditions affecting the eyes and vision.'],
                'ar' => ['name' => 'قسم العيون', 'description' => 'تشخيص وعلاج وجراحة الحالات التي تؤثر على العين والرؤية.'],
            ],
            [
                'en' => ['name' => 'Internal Medicine', 'description' => 'Prevention, diagnosis, and treatment of adult diseases across all body systems.'],
                'ar' => ['name' => 'قسم الباطنة', 'description' => 'الوقاية والتشخيص وعلاج أمراض البالغين في جميع أجهزة الجسم.'],
            ],
        ];

        foreach ($sections as $section) {
            $model = new Section();
            $model->translateOrNew('en')->name = $section['en']['name'];
            $model->translateOrNew('en')->description = $section['en']['description'];
            $model->translateOrNew('ar')->name = $section['ar']['name'];
            $model->translateOrNew('ar')->description = $section['ar']['description'];
            $model->save();
        }
    }
}
