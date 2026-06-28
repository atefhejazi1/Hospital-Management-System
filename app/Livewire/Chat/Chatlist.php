<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Chatlist extends Component
{
    public $conversations;
    public $auth_email;
    public $receviverUser;
    public $selected_conversation;
    public $search = '';

    public function mount()
    {
        $this->auth_email = Auth::user()->email;
    }

    /**
     * Without this, only the open chat thread (Chatbox) refreshes on an
     * incoming message - the sidebar's last-message preview stays stale
     * until the page is reloaded, since it has no echo-private listener
     * of its own.
     */
    public function getListeners()
    {
        if (Auth::guard('patient')->check()) {
            $auth_id = Auth::guard('patient')->user()->id;
            $channel = "echo-private:chat2.$auth_id,MassageSent2";
        } else {
            $auth_id = Auth::guard('doctor')->user()->id;
            $channel = "echo-private:chat.$auth_id,MassageSent";
        }

        return [
            $channel => '$refresh',
            'chatUserSelected',
            'refresh' => '$refresh',
        ];
    }

    // public function getUsers(Conversation $conversation, $request)
    // {
    //     if ($conversation->sender_email == $this->auth_email) {
    //         $this->receviverUser = Doctor::firstwhere('email', $conversation->receiver_email);
    //     } else {
    //         $this->receviverUser = Patient::firstwhere('email', $conversation->sender_email);
    //     }

    //     if ($this->receviverUser && isset($request)) {
    //         return $this->receviverUser->$request;
    //     }
    // }





    public function getUsers(Conversation $conversation, $request)
    {
        // حدد الإيميل الذي نحتاج نحصل عليه
        $targetEmail = $conversation->sender_email == $this->auth_email
            ? $conversation->receiver_email
            : $conversation->sender_email;

        // جرب تبحث في كلا الجدولين
        $user = Doctor::firstWhere('email', $targetEmail) ?? Patient::firstWhere('email', $targetEmail);

        if ($user && isset($request)) {
            return $user->$request;
        }

        return 'غير معروف';
    }

    public function getInitials(Conversation $conversation): string
    {
        $name = (string) $this->getUsers($conversation, 'name');

        return \Illuminate\Support\Str::of($name)
            ->explode(' ')
            ->map(fn ($w) => mb_substr($w, 0, 1))
            ->take(2)
            ->implode('');
    }

    public function chatUserSelected(Conversation $conversation, $receiver_id)
    {
        // $conversation/$receiver_id arrive from a client-issued Livewire
        // action call, so both are attacker-controllable. Without this check
        // any authenticated doctor/patient could read and post into another
        // user's private conversation just by passing a different id.
        if ($conversation->sender_email !== $this->auth_email && $conversation->receiver_email !== $this->auth_email) {
            abort(403);
        }

        $this->selected_conversation = $conversation;
        if (Auth::guard('patient')->check()) {
            $this->receviverUser = Doctor::find($receiver_id);
            $this->dispatch('load_conversationDoctor', $this->selected_conversation, $this->receviverUser)
                ->to('chat.chatbox');
            $this->dispatch('updateMessage', $this->selected_conversation, $this->receviverUser)
                ->to('chat.send-message');
        } else {
            $this->receviverUser = Patient::find($receiver_id);
            $this->dispatch('load_conversationPatient', $this->selected_conversation, $this->receviverUser)
                ->to('chat.chatbox');
            $this->dispatch('updateMessage2', $this->selected_conversation, $this->receviverUser)
                ->to('chat.send-message');
        }
    }


    public function render()
    {
        $conversations = Conversation::where('sender_email', $this->auth_email)->orwhere('receiver_email', $this->auth_email)
            ->orderBy('created_at', 'DESC')
            ->get();

        if ($this->search !== '') {
            $needle = mb_strtolower($this->search);
            $conversations = $conversations->filter(
                fn (Conversation $conversation) => str_contains(mb_strtolower((string) $this->getUsers($conversation, 'name')), $needle)
            )->values();
        }

        $this->conversations = $conversations;

        return view('livewire.chat.chatlist');
    }
}
