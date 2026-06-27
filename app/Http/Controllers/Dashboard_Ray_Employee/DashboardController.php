<?php

namespace App\Http\Controllers\Dashboard_Ray_Employee;

use App\Http\Controllers\Controller;
use App\Models\Ray;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $employee = Auth::guard('ray_employee')->user();

        $metrics = [
            'pendingQueue' => Ray::where('case', 0)->count(),
            'completedByMe' => Ray::where('employee_id', $employee->id)->where('case', 1)->count(),
            'completedToday' => Ray::where('employee_id', $employee->id)->where('case', 1)->whereDate('updated_at', today())->count(),
            'totalRays' => Ray::count(),
        ];

        $rangeStart = today()->subDays(6);
        $dailyCounts = Ray::where('employee_id', $employee->id)
            ->where('case', 1)
            ->whereBetween('updated_at', [$rangeStart->copy()->startOfDay(), today()->endOfDay()])
            ->selectRaw('DATE(updated_at) as d, COUNT(*) as c')
            ->groupBy('d')
            ->pluck('c', 'd');

        $completedTrend = collect(range(6, 0))->map(function ($daysAgo) use ($dailyCounts) {
            $date = today()->subDays($daysAgo);
            return [
                'label' => $date->translatedFormat('D'),
                'count' => (int) ($dailyCounts[$date->format('Y-m-d')] ?? 0),
            ];
        })->values();

        $statusBreakdown = [
            'pending' => Ray::where('case', 0)->count(),
            'completed' => Ray::where('case', 1)->count(),
        ];

        $recentCompleted = Ray::with(['Patient', 'doctor'])
            ->where('employee_id', $employee->id)
            ->where('case', 1)
            ->latest('updated_at')
            ->take(6)
            ->get();

        return view('Dashboard.dashboard_RayEmployee.dashboard', [
            'employee' => $employee,
            'metrics' => $metrics,
            'completedTrend' => $completedTrend,
            'statusBreakdown' => $statusBreakdown,
            'recentCompleted' => $recentCompleted,
        ]);
    }
}
