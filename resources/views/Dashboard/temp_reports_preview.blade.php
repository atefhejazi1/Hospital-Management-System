@extends('Dashboard.layouts.master')
@section('css')@endsection
@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto"><div class="d-flex">
        <h4 class="content-title mb-0 my-auto">التقارير والإحصائيات</h4>
        <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ نظرة عامة</span>
    </div></div>
</div>
@endsection
@section('content')
<!-- Summary Cards -->
<div class="row">
    <div class="col-lg-3 col-md-6"><div class="card custom-card text-center p-3">
        <div class="card-body"><i class="fas fa-users fa-2x text-primary mb-2"></i>
        <h3 class="font-weight-bold">1,247</h3><p class="text-muted mb-0">إجمالي المرضى</p>
        <small class="text-success">↑ 12% هذا الشهر</small></div>
    </div></div>
    <div class="col-lg-3 col-md-6"><div class="card custom-card text-center p-3">
        <div class="card-body"><i class="fas fa-user-md fa-2x text-success mb-2"></i>
        <h3 class="font-weight-bold">60</h3><p class="text-muted mb-0">إجمالي الأطباء</p>
        <small class="text-success">↑ 3 أطباء جدد</small></div>
    </div></div>
    <div class="col-lg-3 col-md-6"><div class="card custom-card text-center p-3">
        <div class="card-body"><i class="fas fa-calendar-check fa-2x text-warning mb-2"></i>
        <h3 class="font-weight-bold">317</h3><p class="text-muted mb-0">مواعيد هذا الأسبوع</p>
        <small class="text-warning">↑ 8% عن الأسبوع الماضي</small></div>
    </div></div>
    <div class="col-lg-3 col-md-6"><div class="card custom-card text-center p-3">
        <div class="card-body"><i class="fas fa-file-invoice-dollar fa-2x text-danger mb-2"></i>
        <h3 class="font-weight-bold">$48,320</h3><p class="text-muted mb-0">إيرادات الشهر</p>
        <small class="text-success">↑ 15% عن الشهر الماضي</small></div>
    </div></div>
</div>
<!-- Charts Row -->
<div class="row mt-3">
    <div class="col-lg-8">
        <div class="card custom-card">
            <div class="card-header"><h6 class="card-title mb-0">إحصائيات المرضى الشهرية</h6></div>
            <div class="card-body">
                <canvas id="monthlyChart" height="120"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card custom-card">
            <div class="card-header"><h6 class="card-title mb-0">توزيع الأقسام</h6></div>
            <div class="card-body">
                <canvas id="deptChart" height="210"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Table -->
<div class="row mt-3">
    <div class="col-12">
        <div class="card custom-card">
            <div class="card-header"><h6 class="card-title mb-0">أعلى الأقسام أداءً هذا الشهر</h6></div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="bg-light"><tr>
                        <th>القسم</th><th>عدد المرضى</th><th>الإيرادات</th><th>نسبة الإشغال</th><th>التقييم</th>
                    </tr></thead>
                    <tbody>
                        <tr><td>طوارئ</td><td>342</td><td>$12,400</td><td><div class="progress" style="height:8px"><div class="progress-bar bg-danger" style="width:85%"></div></div></td><td>⭐⭐⭐⭐⭐</td></tr>
                        <tr><td>قلبية</td><td>289</td><td>$18,200</td><td><div class="progress" style="height:8px"><div class="progress-bar bg-primary" style="width:72%"></div></div></td><td>⭐⭐⭐⭐</td></tr>
                        <tr><td>عظام</td><td>215</td><td>$9,600</td><td><div class="progress" style="height:8px"><div class="progress-bar bg-success" style="width:60%"></div></div></td><td>⭐⭐⭐⭐</td></tr>
                        <tr><td>أطفال</td><td>198</td><td>$7,800</td><td><div class="progress" style="height:8px"><div class="progress-bar bg-warning" style="width:55%"></div></div></td><td>⭐⭐⭐⭐⭐</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
new Chart(document.getElementById('monthlyChart'), {
  type: 'bar',
  data: { labels: ['يناير','فبراير','مارس','أبريل','مايو','يونيو','يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر'],
    datasets: [{ label: 'المرضى', data: [320,410,380,450,490,520,560,480,530,570,480,430], backgroundColor: '#6259ca55', borderColor: '#6259ca', borderWidth: 2 }]
  }, options: { responsive: true, plugins: { legend: { display: false } } }
});
new Chart(document.getElementById('deptChart'), {
  type: 'doughnut',
  data: { labels: ['طوارئ','قلبية','عظام','أعصاب','أطفال'],
    datasets: [{ data: [30,24,18,15,13], backgroundColor: ['#dc3545','#6259ca','#f7b731','#20c997','#17a2b8'] }]
  }, options: { responsive: true }
});
</script>
@endsection
