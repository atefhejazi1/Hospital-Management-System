<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Section;

class HomeController extends Controller
{
    public function index()
    {
        $sections = Section::with('translations')
            ->withCount('doctors')
            ->orderBy('id')
            ->take(8)
            ->get();

        $doctors = Doctor::with(['translations', 'section.translations'])
            ->where('status', 1)
            ->orderBy('id')
            ->take(8)
            ->get();

        $stats = [
            'active_staff' => Doctor::where('status', 1)->count(),
            'sections' => Section::count(),
            'patients_served' => Patient::count(),
        ];

        return view('WebSite.index', compact('sections', 'doctors', 'stats'));
    }
}
