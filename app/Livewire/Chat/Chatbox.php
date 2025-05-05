<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Chatbox extends Component
{
    // protected $listeners = ['pushMessage','load_conversationDoctor', 'load_conversationPatient'];
    public $receiver;
    public $selected_conversation;
    public $receviverUser;
    public $messages;
    public $auth_email;
    public $auth_id;
    public $event_name;
    public $chat_page;

    public function mount()
    {
        if (Auth::guard('patient')->check()) {
            $this->auth_email = Auth::guard('patient')->user()->email;
            $this->auth_id = Auth::guard('patient')->user()->id;
        } else {
            $this->auth_email = Auth::guard('doctor')->user()->email;
            $this->auth_id = Auth::guard('doctor')->user()->id;
        }
    }


    public function getListeners()
    {
        if (Auth::guard('patient')->check()) {
            $auth_id = Auth::guard('patient')->user()->id;
            $this->event_name = "MassageSent2";
            $this->chat_page = "chat2";
        } else {
            $auth_id = Auth::guard('doctor')->user()->id;
            $this->event_name = "MassageSent";
            $this->chat_page = "chat";
        }

        return [
            "echo-private:$this->chat_page.{$auth_id},$this->event_name" => 'broadcastMassage',
            'pushMessage',
            'load_conversationPatient',
            'load_conversationDoctor',
        ];
    }

    public function broadcastMassage($event)
    {
        $broadcastMessage = Message::find($event['message']);
        $broadcastMessage->read = 1;
        $this->pushMessage($broadcastMessage->id);
    }


    #[On('pushMessage')]
    public function pushMessage($messageId)
    {

        $newMessage = Message::find($messageId);
        $this->messages->push($newMessage);
    }


    public function load_conversationDoctor(Conversation $conversation, Doctor $receiver)
    {

        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
        $this->messages = Message::where('conversation_id', $this->selected_conversation->id)->get();
    }

    public function load_conversationPatient(Conversation $conversation, Patient $receiver)
    {

        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
        $this->messages = Message::where('conversation_id', $this->selected_conversation->id)->get();
    }



    public function render()
    {
        return view('livewire.chat.chatbox');
    }
}
