<?php

namespace App\Http\Controllers\Dashboard_Laboratorie_Employee;

use App\Http\Controllers\Controller;
use App\Models\Laboratorie;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $employee = Auth::guard('laboratorie_employee')->user();

        $metrics = [
            'pendingQueue' => Laboratorie::where('case', 0)->count(),
            'completedByMe' => Laboratorie::where('employee_id', $employee->id)->where('case', 1)->count(),
            'completedToday' => Laboratorie::where('employee_id', $employee->id)->where('case', 1)->whereDate('updated_at', today())->count(),
            'totalLabs' => Laboratorie::count(),
        ];

        $rangeStart = today()->subDays(6);
        $dailyCounts = Laboratorie::where('employee_id', $employee->id)
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
            'pending' => Laboratorie::where('case', 0)->count(),
            'completed' => Laboratorie::where('case', 1)->count(),
        ];

        $recentCompleted = Laboratorie::with(['Patient', 'doctor'])
            ->where('employee_id', $employee->id)
            ->where('case', 1)
            ->latest('updated_at')
            ->take(6)
            ->get();

        return view('Dashboard.dashboard_LaboratorieEmployee.dashboard', [
            'employee' => $employee,
            'metrics' => $metrics,
            'completedTrend' => $completedTrend,
            'statusBreakdown' => $statusBreakdown,
            'recentCompleted' => $recentCompleted,
        ]);
    }
}
