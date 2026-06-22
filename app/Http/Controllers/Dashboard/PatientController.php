<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PatientController extends Controller
{
    private $Patient;

    public function __construct(PatientRepositoryInterface $Patient)
    {
        $this->Patient = $Patient;
    }

    public function index()
    {
        return $this->Patient->index();
    }


    public function create()
    {
        return$this->Patient->create();
    }


    public function store(StorePatientRequest $request)
    {
        Gate::authorize('create', Patient::class);

        return $this->Patient->store($request);
    }


    public function show($id)
    {
        Gate::authorize('view', Patient::findOrFail($id));

        return $this->Patient->show($id);
    }


    public function edit($id)
    {
        Gate::authorize('update', Patient::findOrFail($id));

        return $this->Patient->edit($id);
    }


    public function update(StorePatientRequest $request)
    {
        Gate::authorize('update', Patient::findOrFail($request->id));

        return $this->Patient->update($request);
    }


    public function destroy(Request $request)
    {
        Gate::authorize('delete', Patient::findOrFail($request->id));

        return $this->Patient->destroy($request);
    }
}
