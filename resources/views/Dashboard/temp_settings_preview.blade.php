@extends('Dashboard.layouts.master')
@section('css')@endsection
@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto"><div class="d-flex">
        <h4 class="content-title mb-0 my-auto">الإعدادات</h4>
        <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إعدادات النظام</span>
    </div></div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-xl-3 col-lg-4">
        <div class="card custom-card">
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action active"><i class="fas fa-hospital me-2"></i> معلومات المستشفى</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-envelope me-2"></i> إعدادات البريد</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-bell me-2"></i> الإشعارات</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-shield-alt me-2"></i> الأمان والصلاحيات</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-palette me-2"></i> المظهر والثيم</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-language me-2"></i> اللغة والمنطقة</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-database me-2"></i> النسخ الاحتياطي</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-8">
        <div class="card custom-card">
            <div class="card-header"><h6 class="card-title mb-0"><i class="fas fa-hospital me-2"></i>معلومات المستشفى</h6></div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">اسم المستشفى</label>
                            <input type="text" class="form-control" value="MediCore HMS">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">رقم الترخيص</label>
                            <input type="text" class="form-control" value="LIC-2024-HMS-001">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">رقم الهاتف</label>
                            <input type="text" class="form-control" value="+966 11 234 5678">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" value="info@medicorehms.com">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">العنوان</label>
                            <input type="text" class="form-control" value="شارع الملك فهد، الرياض، المملكة العربية السعودية">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">المدينة</label>
                            <input type="text" class="form-control" value="الرياض">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">الدولة</label>
                            <select class="form-control"><option>المملكة العربية السعودية</option></select>
                        </div>
                    </div>
                    <hr>
                    <h6 class="mb-3">إعدادات البريد الإلكتروني</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SMTP Host</label>
                            <input type="text" class="form-control" value="smtp.gmail.com">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">SMTP Port</label>
                            <input type="text" class="form-control" value="587">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Encryption</label>
                            <select class="form-control"><option>TLS</option><option>SSL</option></select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">بريد المُرسِل</label>
                            <input type="email" class="form-control" value="noreply@medicorehms.com">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">كلمة مرور SMTP</label>
                            <input type="password" class="form-control" value="••••••••••">
                        </div>
                    </div>
                    <div class="text-end mt-2">
                        <button type="button" class="btn btn-secondary me-2">إلغاء</button>
                        <button type="button" class="btn btn-primary">حفظ الإعدادات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
