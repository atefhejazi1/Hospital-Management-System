<?php

return array (
  // dashboard.blade.php
  'doctor_dashboard_title' => 'لوحة تحكم الدكتور',
  'total_invoices' => 'عدد الفواتير',
  'invoices_in_progress' => 'عدد الفواتير تحت الاجراء',
  'completed_invoices_count' => 'عدد الفواتير المكتملة',
  'review_invoices_count' => 'عدد فواتير المراجعات',
  'greeting_morning' => 'صباح الخير',
  'greeting_afternoon' => 'مساء الخير',
  'greeting_evening' => 'مساء الخير',
  'greeting_subtitle' => 'هذا جدولك لهذا اليوم.',
  'view_invoices' => 'عرض الفواتير',
  'review_invoices_action' => 'مراجعة الفواتير',
  'chat_patients' => 'محادثة المرضى',
  'appointments_today' => 'مواعيد اليوم',
  'appointments_this_week' => 'مواعيد هذا الأسبوع',
  'today_schedule_title' => 'جدول اليوم',
  'today_schedule_sub' => 'الأوقات المحددة لك اليوم',
  'col_time_slot' => 'الوقت',
  'slot_available' => 'متاح',
  'slot_booked' => 'محجوز',
  'no_slots_assigned' => 'لا توجد أوقات محددة لك اليوم. تواصل مع الإدارة لتحديد جدولك الأسبوعي.',
  'trend_title' => 'مواعيد هذا الأسبوع',
  'trend_sub' => 'عدد المواعيد اليومية، آخر 7 أيام',
  'status_breakdown_title' => 'حالة المواعيد',
  'status_breakdown_sub' => 'التوزيع الكلي',
  'status_pending' => 'قيد الانتظار',
  'status_confirmed' => 'مؤكد',
  'status_completed' => 'مكتمل',
  'recent_patients_title' => 'أحدث المرضى',
  'recent_patients_sub' => 'أحدث مواعيدك',
  'col_patient' => 'المريض',
  'col_contact' => 'التواصل',
  'col_datetime' => 'التاريخ والوقت',
  'col_status' => 'الحالة',
  'no_appointments' => 'لا توجد مواعيد مسجلة حتى الآن.',
  'appointments_suffix' => 'موعد',

  // shared invoice table headers
  'col_hash' => '#',
  'col_invoice_date' => 'تاريخ الفاتورة',
  'col_service_name' => 'اسم الخدمة',
  'col_patient_name' => 'اسم المريض',
  'col_service_price' => 'سعر الخدمة',
  'col_discount_value' => 'قيمة الخصم',
  'col_tax_rate' => 'نسبة الضريبة',
  'col_tax_value' => 'قيمة الضريبة',
  'col_total_with_tax' => 'الاجمالي مع الضريبة',
  'col_invoice_status' => 'حالة الفاتورة',
  'col_review_date' => 'تاريخ المراجعة',
  'col_processes' => 'العمليات',

  // shared status badges
  'status_in_progress' => 'تحت الاجراء',
  'status_review' => 'مراجعة',
  'status_completed_badge' => 'مكتملة',

  // shared dropdown actions (index.blade.php / review_invoices.blade.php)
  'action_add_diagnosis' => 'اضافة تشخيص',
  'action_add_review' => 'اضافة مراجعة',
  'action_convert_to_xray' => 'تحويل الي الاشعة',
  'action_convert_to_lab' => 'تحويل الي المختبر',
  'action_delete_data' => 'حذف البيانات',

  // index.blade.php
  'invoices_page_title' => 'الكشوفات',
  'breadcrumb_invoices' => 'الفواتير',

  // review_invoices.blade.php
  'reviews_page_title' => 'المراجعات',

  // completed_invoices.blade.php
  'completed_invoices_page_title' => 'الكشوفات المكتملة',

  // add_diagnosis.blade.php
  'add_diagnosis_modal_title' => 'تشخيص حالة مريض',
  'label_diagnosis' => 'التشخيص',
  'label_medicine' => 'الادوية',
  'close' => 'اغلاق',
  'save_data' => 'حفظ البيانات',

  // add_review.blade.php
  'add_review_modal_title' => 'تحديد مراجعة المريض',
  'label_review_date' => 'تاريخ المراجعة',

  // xray_conversion.blade.php / edit_xray_conversion.blade.php
  'convert_to_radiology_modal_title' => 'تحويل الي قسم الاشعة',
  'label_request' => 'المطلوب',

  // Laboratorie_conversion.blade.php / edit_laboratorie_conversion.blade.php
  'convert_to_lab_modal_title' => 'تحويل الي قسم المختبر',

  // deleted.blade.php
  'delete_xray_modal_title' => 'حذف تفاصيل اشعة',
  'confirm_delete_xray' => 'هل انت متاكد من حذف بيانات الاشعة ؟',

  // deleted_laboratorie.blade.php
  'delete_lab_modal_title' => 'حذف تفاصيل مختبر',
  'confirm_delete_lab' => 'هل انت متاكد من حذف بيانات الاشعة ؟',

  // patient_details.blade.php
  'patient_information_title' => 'معلومات المريض',
  'tab_patient_record' => 'سجل المريض',
  'tab_radiology' => 'الاشعة',
  'tab_laboratory' => 'المختبر',
  'status_update_posted' => 'قام بنشر تحديث للحالة',
  'col_service_name_short' => 'اسم الخدمه',
  'col_doctor_name' => 'اسم الدكتور',
  'col_radiology_employee_name' => 'اسم موظف الاشعة',
  'col_exam_status' => 'حالة الكشف',
  'status_incomplete' => 'غير مكتملة',
  'status_complete' => 'مكتملة',

  // patient_record.blade.php
  'patient_breadcrumb' => 'المريض',
  'patient_record_breadcrumb' => 'سجل المريض',

  // view_laboratories.blade.php / view_rays.blade.php
  'lab_images_title' => 'صور التحاليل',
  'xray_images_title' => 'صور الاشعة',
  'lab_doctor_notes' => 'ملاحظات دكتور المختبر',
  'xray_doctor_notes' => 'ملاحظات دكتور الاشعة',
);
