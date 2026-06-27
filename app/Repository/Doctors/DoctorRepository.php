<?php

namespace App\Repository\Doctors;

use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Doctor;
use App\Models\DoctorSlot;
use App\Models\Image;
use App\Models\Section;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorRepository implements DoctorRepositoryInterface
{
    use UploadTrait;

    public function index()
    {
        // $doctors = Doctor::all();
        $doctors = Doctor::with('appointments')->get();
        return view('Dashboard.Doctors.index', compact('doctors'));
    }

    public function create()
    {
        $sections = Section::all();
        $slotOptions = DoctorSlot::fixedSlotOptions();
        $days = DoctorSlot::DAYS;
        return view('Dashboard.Doctors.add', compact('sections', 'slotOptions', 'days'));
    }


    public function store($request)
    {

        DB::beginTransaction();

        try {

            $doctors = new Doctor();
            $doctors->email = $request->email;
            $doctors->password = Hash::make($request->password);
            $doctors->section_id = $request->section_id;
            $doctors->phone = $request->phone;
            $doctors->status = 1;
            $doctors->save();
            // store trans
            $doctors->name = $request->name;

            $doctors->save();

            $this->syncSlots($doctors, $request->slots ?? []);

            //Upload img
            $this->verifyAndStoreImage($request, 'photo', 'doctors', 'upload_image', $doctors->id, Doctor::class);

            DB::commit();
            session()->flash('add');
            return redirect()->route('Doctors.create');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update($request)
    {
        DB::beginTransaction();

        try {

            $doctor = Doctor::findorfail($request->id);

            $doctor->email = $request->email;
            $doctor->section_id = $request->section_id;
            $doctor->phone = $request->phone;
            $doctor->save();
            // store trans
            $doctor->name = $request->name;
            $doctor->save();

            $this->syncSlots($doctor, $request->slots ?? []);

            // update photo
            if ($request->has('photo')) {
                // Delete old photo
                if ($doctor->image) {
                    $old_img = $doctor->image->filename;
                    $this->Delete_attachment('upload_image', 'doctors/' . $old_img, $request->id);
                }
                //Upload img
                $this->verifyAndStoreImage($request, 'photo', 'doctors', 'upload_image', $request->id, 'App\Models\Doctor');
            }

            DB::commit();
            session()->flash('edit');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy($request)
    {
        if ($request->page_id == 1) {

            if ($request->filename) {

                $this->Delete_attachment('upload_image', 'doctors/' . $request->filename, $request->id, $request->filename);
            }
            Doctor::destroy($request->id);
            session()->flash('delete');

            return redirect()->route('Doctors.index');
        }


        //---------------------------------------------------------------

        else {
            // delete selector doctor
            $delete_select_id = explode(",", $request->delete_select_id);
            foreach ($delete_select_id as $ids_doctors) {
                $doctor = Doctor::findorfail($ids_doctors);
                if ($doctor->image) {
                    $this->Delete_attachment('upload_image', 'doctors/' . $doctor->image->filename, $ids_doctors, $doctor->image->filename);
                }
            }

            Doctor::destroy($delete_select_id);
            session()->flash('delete');
            return redirect()->route('Doctors.index');
        }
    }

    public function edit($id)
    {
        $sections = Section::all();
        $slotOptions = DoctorSlot::fixedSlotOptions();
        $days = DoctorSlot::DAYS;
        $doctor = Doctor::findorfail($id);
        return view('Dashboard.Doctors.edit', compact('sections', 'slotOptions', 'days', 'doctor'));
    }

    public function schedule($id, $date)
    {
        $doctor = Doctor::findorfail($id);
        $date = $date ?: now()->toDateString();
        $schedule = $doctor->scheduleForDate($date);

        return view('Dashboard.Doctors.schedule', compact('doctor', 'schedule', 'date'));
    }

    /**
     * Replace a doctor's assigned weekly slots from the submitted
     * ['Saturday' => ['08:00:00', ...], 'Sunday' => [...]] structure,
     * matched against the fixed master list for each end_time.
     */
    private function syncSlots(Doctor $doctor, array $slotsByDay): void
    {
        $doctor->slots()->delete();

        $options = collect(DoctorSlot::fixedSlotOptions())->keyBy('start');

        foreach ($slotsByDay as $day => $startTimes) {
            if (!in_array($day, DoctorSlot::DAYS, true)) {
                continue;
            }

            foreach ($startTimes as $start) {
                $option = $options->get($start);

                if (!$option) {
                    continue;
                }

                $doctor->slots()->create([
                    'day_of_week' => $day,
                    'start_time' => $option['start'],
                    'end_time' => $option['end'],
                ]);
            }
        }
    }

    public function update_password($request)
    {
        try {
            $doctor = Doctor::findorfail($request->id);
            $doctor->update([
                'password' => Hash::make($request->password)
            ]);

            session()->flash('edit');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update_status($request)
    {
        try {
            $doctor = Doctor::findorfail($request->id);

            $doctor->update([
                'status' => $request->status
            ]);

            session()->flash('edit');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
