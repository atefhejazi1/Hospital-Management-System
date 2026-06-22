<?php

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return $user instanceof \App\Models\User && (int) $user->id === (int) $id;
});

/*
 * Invoice-created notifications are only ever consumed by the doctor that owns
 * the invoice. Restricting the guard to "doctor" closes the cross-role ID
 * collision where a patient/admin/employee sharing the same numeric id as a
 * doctor could otherwise authorize this channel.
 */
Broadcast::channel(
    'create-invoice.{doctor_id}',
    function (Doctor $user, $doctor_id) {
        return (int) $user->id === (int) $doctor_id;
    },
    ['guards' => ['doctor']]
);

/*
 * "chat.{id}" is the doctor side of the conversation (see
 * App\Livewire\Chat\Chatbox::getListeners(), which maps the doctor guard to
 * the "chat" channel prefix). Only the "doctor" guard may authorize it, and
 * the resolved user is verified to actually be a Doctor instance.
 */
Broadcast::channel(
    'chat.{receiver_id}',
    function (Doctor $user, $receiver_id) {
        return $user instanceof Doctor && (int) $user->id === (int) $receiver_id;
    },
    ['guards' => ['doctor']]
);

/*
 * "chat2.{id}" is the patient side of the conversation (see
 * App\Livewire\Chat\Chatbox::getListeners(), which maps the patient guard to
 * the "chat2" channel prefix). Only the "patient" guard may authorize it.
 */
Broadcast::channel(
    'chat2.{receiver_id}',
    function (Patient $user, $receiver_id) {
        return $user instanceof Patient && (int) $user->id === (int) $receiver_id;
    },
    ['guards' => ['patient']]
);
