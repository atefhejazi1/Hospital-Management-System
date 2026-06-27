<?php

return array (
  // dashboard.blade.php
  'doctor_dashboard_title' => "Doctor's Dashboard",
  'total_invoices' => 'Total Invoices',
  'invoices_in_progress' => 'Invoices In Progress',
  'completed_invoices_count' => 'Completed Invoices',
  'review_invoices_count' => 'Review Invoices',
  'greeting_morning' => 'Good morning',
  'greeting_afternoon' => 'Good afternoon',
  'greeting_evening' => 'Good evening',
  'greeting_subtitle' => "here's your schedule for today.",
  'view_invoices' => 'View Invoices',
  'review_invoices_action' => 'Review Invoices',
  'chat_patients' => 'Chat with Patients',
  'appointments_today' => "Today's Appointments",
  'appointments_this_week' => "This Week's Appointments",
  'today_schedule_title' => "Today's Schedule",
  'today_schedule_sub' => 'Your assigned time slots for today',
  'col_time_slot' => 'Time Slot',
  'slot_available' => 'Available',
  'slot_booked' => 'Booked',
  'no_slots_assigned' => 'No time slots assigned for today. Contact admin to set your weekly schedule.',
  'trend_title' => 'Appointments This Week',
  'trend_sub' => 'Daily appointment volume, last 7 days',
  'status_breakdown_title' => 'Appointment Status',
  'status_breakdown_sub' => 'All-time distribution',
  'status_pending' => 'Pending',
  'status_confirmed' => 'Confirmed',
  'status_completed' => 'Completed',
  'recent_patients_title' => 'Recent Patients',
  'recent_patients_sub' => 'Your most recent appointments',
  'col_patient' => 'Patient',
  'col_contact' => 'Contact',
  'col_datetime' => 'Date & Time',
  'col_status' => 'Status',
  'no_appointments' => 'No appointments recorded yet.',
  'appointments_suffix' => 'appointments',

  // shared invoice table headers
  'col_hash' => '#',
  'col_invoice_date' => 'Invoice Date',
  'col_service_name' => 'Service Name',
  'col_patient_name' => 'Patient Name',
  'col_service_price' => 'Service Price',
  'col_discount_value' => 'Discount Value',
  'col_tax_rate' => 'Tax Rate',
  'col_tax_value' => 'Tax Value',
  'col_total_with_tax' => 'Total With Tax',
  'col_invoice_status' => 'Invoice Status',
  'col_review_date' => 'Review Date',
  'col_processes' => 'Processes',

  // shared status badges
  'status_in_progress' => 'In Progress',
  'status_review' => 'Review',
  'status_completed_badge' => 'Completed',

  // shared dropdown actions (index.blade.php / review_invoices.blade.php)
  'action_add_diagnosis' => 'Add Diagnosis',
  'action_add_review' => 'Add Review',
  'action_convert_to_xray' => 'Convert To Radiology',
  'action_convert_to_lab' => 'Convert To Laboratory',
  'action_delete_data' => 'Delete Data',

  // index.blade.php
  'invoices_page_title' => 'Invoices',
  'breadcrumb_invoices' => 'Invoices',

  // review_invoices.blade.php
  'reviews_page_title' => 'Reviews',

  // completed_invoices.blade.php
  'completed_invoices_page_title' => 'Completed Invoices',

  // add_diagnosis.blade.php
  'add_diagnosis_modal_title' => "Diagnose Patient's Condition",
  'label_diagnosis' => 'Diagnosis',
  'label_medicine' => 'Medicine',
  'close' => 'Close',
  'save_data' => 'Save Data',

  // add_review.blade.php
  'add_review_modal_title' => "Schedule Patient's Review",
  'label_review_date' => 'Review Date',

  // xray_conversion.blade.php / edit_xray_conversion.blade.php
  'convert_to_radiology_modal_title' => 'Convert To Radiology Department',
  'label_request' => 'Request',

  // Laboratorie_conversion.blade.php / edit_laboratorie_conversion.blade.php
  'convert_to_lab_modal_title' => 'Convert To Laboratory Department',

  // deleted.blade.php
  'delete_xray_modal_title' => 'Delete Radiology Details',
  'confirm_delete_xray' => 'Are you sure you want to delete this radiology data?',

  // deleted_laboratorie.blade.php
  'delete_lab_modal_title' => 'Delete Laboratory Details',
  'confirm_delete_lab' => 'Are you sure you want to delete this laboratory data?',

  // patient_details.blade.php
  'patient_information_title' => 'Patient Information',
  'tab_patient_record' => 'Patient Record',
  'tab_radiology' => 'Radiology',
  'tab_laboratory' => 'Laboratory',
  'status_update_posted' => 'Posted a status update',
  'col_service_name_short' => 'Service Name',
  'col_doctor_name' => "Doctor's Name",
  'col_radiology_employee_name' => 'Radiology Employee Name',
  'col_exam_status' => 'Examination Status',
  'status_incomplete' => 'Incomplete',
  'status_complete' => 'Complete',

  // patient_record.blade.php
  'patient_breadcrumb' => 'Patient',
  'patient_record_breadcrumb' => 'Patient Record',

  // view_laboratories.blade.php / view_rays.blade.php
  'lab_images_title' => 'Lab Result Images',
  'xray_images_title' => 'Radiology Images',
  'lab_doctor_notes' => "Laboratory Doctor's Notes",
  'xray_doctor_notes' => "Radiology Doctor's Notes",
);
