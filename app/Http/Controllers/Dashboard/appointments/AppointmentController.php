<?php

namespace App\Http\Controllers\Dashboard\appointments;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class AppointmentController extends Controller
{
    public function index()
    {

        $appointments = Appointment::where('type', 'غير مؤكد')->get();
        return view('Dashboard.appointments.index', compact('appointments'));
    }

    public function index2()
    {

        $appointments = Appointment::where('type', 'مؤكد')->get();
        return view('Dashboard.appointments.index2', compact('appointments'));
    }

    public function approval(Request $request, $id)
    {
        $appointment = Appointment::findorFail($id);
        $appointment->update([
            'type' => 'مؤكد',
            'appointment' => $request->appointment
        ]);

         // send message mob
         $receiverNumber = $appointment->phone;
         $message = "عزيزي المريض" . " " . $appointment->name . " " . "تم حجز موعدك بتاريخ " . $appointment->appointment;

         $account_sid = getenv("TWILIO_SID");
         $auth_token = getenv("TWILIO_AUTH_TOKEN");
         $twilio_number = getenv("TWILIO_NUMBER");


         $client = new Client($account_sid, $auth_token);
         $client->messages->create($receiverNumber,[
             'from' => $twilio_number,
             'body' => $message
         ]);



        session()->flash('add');
        return back();
    }
}
