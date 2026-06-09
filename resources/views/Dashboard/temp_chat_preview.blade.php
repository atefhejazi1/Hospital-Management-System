@extends('Dashboard.layouts.master')
@section('css')
<style>
.main-content-app { height: 600px; }
.chat-body { background: #f4f6fd; }
</style>
@endsection
@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المحادثات</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المحادثات الاخيرة</span>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row row-sm main-content-app mb-4">
    <div class="col-xl-4 col-lg-5">
        <div class="card custom-card card-body" style="height:580px;">
            <div class="main-chat-list">
                <div class="d-flex align-items-center p-3 border-bottom">
                    <div class="main-img-user me-3"><img src="https://via.placeholder.com/40" class="rounded-circle" alt=""></div>
                    <div class="flex-fill">
                        <h6 class="mb-0 font-weight-semibold">Dr. Ahmed Khalid</h6>
                        <small class="text-muted">آخر رسالة منذ 5 دقائق</small>
                    </div>
                    <span class="badge bg-success">2</span>
                </div>
                <div class="d-flex align-items-center p-3 border-bottom bg-light">
                    <div class="main-img-user me-3"><img src="https://via.placeholder.com/40" class="rounded-circle" alt=""></div>
                    <div class="flex-fill">
                        <h6 class="mb-0 font-weight-semibold">Patient: Sara Mohammed</h6>
                        <small class="text-muted">آخر رسالة منذ ساعة</small>
                    </div>
                </div>
                <div class="d-flex align-items-center p-3 border-bottom">
                    <div class="main-img-user me-3"><img src="https://via.placeholder.com/40" class="rounded-circle" alt=""></div>
                    <div class="flex-fill">
                        <h6 class="mb-0 font-weight-semibold">Dr. Fatima Al-Hassan</h6>
                        <small class="text-muted">آخر رسالة منذ 3 ساعات</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-7">
        <div class="card custom-card" style="height:580px;">
            <div class="card-header p-3 border-bottom d-flex align-items-center">
                <div class="main-img-user me-3"><img src="https://via.placeholder.com/40" class="rounded-circle" alt=""></div>
                <div>
                    <h6 class="mb-0">Dr. Ahmed Khalid</h6>
                    <small class="text-success">● متصل الآن</small>
                </div>
            </div>
            <div class="card-body p-4" style="overflow-y:auto; flex:1;">
                <div class="d-flex mb-4">
                    <img src="https://via.placeholder.com/35" class="rounded-circle me-3" style="height:35px;width:35px;">
                    <div class="chat-body p-3 rounded" style="max-width:70%; background:#e8ecf9;">
                        <p class="mb-0">مرحباً، هل يمكنك مراجعة ملف المريض رقم 245؟</p>
                        <small class="text-muted">10:30 ص</small>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-4">
                    <div class="chat-body p-3 rounded text-white" style="max-width:70%; background:#6259ca;">
                        <p class="mb-0">نعم، سأراجعه الآن وأرسل لك التقرير خلال ساعة.</p>
                        <small style="opacity:0.8;">10:35 ص</small>
                    </div>
                </div>
                <div class="d-flex mb-4">
                    <img src="https://via.placeholder.com/35" class="rounded-circle me-3" style="height:35px;width:35px;">
                    <div class="chat-body p-3 rounded" style="max-width:70%; background:#e8ecf9;">
                        <p class="mb-0">شكراً جزيلاً، في انتظارك.</p>
                        <small class="text-muted">10:36 ص</small>
                    </div>
                </div>
            </div>
            <div class="card-footer p-3 border-top">
                <div class="d-flex align-items-center">
                    <input type="text" class="form-control me-2" placeholder="اكتب رسالتك هنا...">
                    <button class="btn btn-primary px-4">إرسال</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
