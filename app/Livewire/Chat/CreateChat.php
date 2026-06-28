<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateChat extends Component
{
    public $users;
    public $auth_email;
    public $search = '';

    public function mount()
    {
        $this->auth_email = Auth::user()->email;
    }

    public function getInitials($user): string
    {
        return \Illuminate\Support\Str::of((string) $user->name)
            ->explode(' ')
            ->map(fn ($w) => mb_substr($w, 0, 1))
            ->take(2)
            ->implode('');
    }

    public function createConversation($receiver_email)
    {
        $chek_Conversation = Conversation::chekConversation($this->auth_email, $receiver_email)->get();
        if ($chek_Conversation->isEmpty()) {
            DB::beginTransaction();
            try {
                // $createConversation
                $createConversation = Conversation::create([
                    'sender_email' => $this->auth_email,
                    'receiver_email' => $receiver_email,
                    'last_time_message' => null,
                ]);
                // create message
                Message::create([
                    'conversation_id' => $createConversation->id,
                    'sender_email' => $this->auth_email,
                    'receiver_email' => $receiver_email,
                    'body' => 'السلام عليكم',
                ]);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
            }
        }
    }


    public function render()
    {
        $isPatientViewer = Auth::guard('patient')->check();
        $users = $isPatientViewer ? Doctor::all() : Patient::all();

        if ($this->search !== '') {
            $needle = mb_strtolower($this->search);
            $users = $users->filter(fn ($user) => str_contains(mb_strtolower((string) $user->name), $needle))->values();
        }

        $this->users = $users;

        return view('livewire.chat.create-chat', ['isPatientViewer' => $isPatientViewer]);
    }
}
