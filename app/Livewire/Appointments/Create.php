<?php

namespace App\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Section;
use Illuminate\Database\QueryException;
use Livewire\Component;

class Create extends Component
{
    public $doctors;
    public $sections;
    public $doctor;
    public $section;
    public $name;
    public $email;
    public $phone;
    public $notes;
    public $message = false;

    public $date;
    public $schedule = [];
    public $selectedSlot = null;
    public $slotTaken = false;

    public function mount()
    {
        $this->sections = Section::get();
        // $this->doctors = collect(); // فارغة بالبداية
        $this->doctors = Doctor::get();
        $this->date = now()->toDateString();
    }

    public function render()
    {
        return view('livewire.appointments.create', [
            "sections" => $this->sections,
            "doctors" =>  $this->doctors,
        ]);
    }


    public function updatedSection($section_id)
    {
        $this->doctors = Doctor::where('section_id', $section_id)->get();
        $this->resetSlotSelection();
    }

    public function updatedDoctor($doctor_id)
    {
        $this->loadSchedule($doctor_id);
    }

    public function updatedDate($date)
    {
        $this->loadSchedule($this->doctor);
    }

    public function selectSlot($startTime)
    {
        $this->selectedSlot = $startTime;
    }

    protected function loadSchedule($doctorId)
    {
        $this->resetSlotSelection();

        $doctor = $doctorId ? Doctor::find($doctorId) : null;
        $this->schedule = $doctor ? $doctor->scheduleForDate($this->date) : [];
    }

    protected function resetSlotSelection()
    {
        $this->selectedSlot = null;
        $this->slotTaken = false;
        $this->schedule = [];
    }

    public function store()
    {
        $this->slotTaken = false;

        if (!$this->selectedSlot) {
            return;
        }

        $appointments = new Appointment();
        $appointments->doctor_id = $this->doctor;
        $appointments->section_id = $this->section;
        $appointments->name = $this->name;
        $appointments->email = $this->email;
        $appointments->phone = $this->phone;
        $appointments->notes = $this->notes;
        $appointments->appointment = $this->date . ' ' . $this->selectedSlot;

        try {
            $appointments->save();
            $this->message = true;
            $this->resetSlotSelection();
        } catch (QueryException $e) {
            $this->slotTaken = true;
            $this->loadSchedule($this->doctor);
        }
    }
}
