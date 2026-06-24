<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    private array $doctorLines = [
        'Hello, how are you feeling today?',
        'Please remember to take your medication as prescribed.',
        'Your test results look good, no concerns there.',
        'Let me know if the symptoms continue past this week.',
        'Can you come in for a follow-up next week?',
    ];

    private array $patientLines = [
        'Hello doctor, thank you for the consultation.',
        'I am feeling a bit better since yesterday.',
        'Should I continue the same dosage?',
        'I still have some mild pain, is that normal?',
        'Yes, I can come for a follow-up next week.',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = Doctor::all();
        $patients = Patient::all();

        for ($i = 0; $i < 12; $i++) {
            $doctor = $doctors->random();
            $patient = $patients->random();

            $conversation = Conversation::create([
                'sender_email' => $doctor->email,
                'receiver_email' => $patient->email,
                'last_time_message' => now(),
            ]);

            $messageCount = fake()->numberBetween(3, 6);
            $timestamp = fake()->dateTimeBetween('-10 days', '-1 hours');

            for ($m = 0; $m < $messageCount; $m++) {
                $isDoctorTurn = $m % 2 === 0;
                $timestamp = (clone $timestamp)->modify('+' . fake()->numberBetween(5, 90) . ' minutes');

                $message = Message::create([
                    'conversation_id' => $conversation->id,
                    'sender_email' => $isDoctorTurn ? $doctor->email : $patient->email,
                    'receiver_email' => $isDoctorTurn ? $patient->email : $doctor->email,
                    'read' => $m < $messageCount - 1,
                    'body' => fake()->randomElement($isDoctorTurn ? $this->doctorLines : $this->patientLines),
                ]);

                $message->created_at = $timestamp;
                $message->updated_at = $timestamp;
                $message->save();
            }

            $conversation->last_time_message = $timestamp;
            $conversation->save();
        }
    }
}
