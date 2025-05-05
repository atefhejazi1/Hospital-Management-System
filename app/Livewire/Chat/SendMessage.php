<?php

namespace App\Livewire\Chat;

use App\Events\MassageSent;
use App\Events\MassageSent2;
use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class SendMessage extends Component
{
    public $body = "";
    public $selected_conversation;
    public $receviverUser;
    public $auth_email;
    public $sender;
    public $createdMessage;
    protected $listeners = ['updateMessage', 'dispatchSentMassage', 'updateMessage2'];

    public function mount()
    {
        if (Auth::guard('patient')->check()) {
            $this->auth_email = Auth::guard('patient')->user()->email;
            $this->sender = Auth::guard('patient')->user();
        } else {
            $this->auth_email = Auth::guard('doctor')->user()->email;
            $this->sender = Auth::guard('doctor')->user();
        }
    }


    public function updateMessage(Conversation $conversation, Doctor $receiver)
    {
        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
    }

    public function updateMessage2(Conversation $conversation, Patient $receiver)
    {
        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
    }

    public function sendMessage()
    {
        if ($this->body == null) {
            return null;
        }

        // تحقق من وجود جميع البيانات المطلوبة قبل إنشاء الرسالة
        if (!$this->selected_conversation || !$this->auth_email || !$this->receviverUser || !$this->body) {
            Log::error("Missing data to create message.");
            return;
        }

        // إنشاء الرسالة
        $createdMessage = Message::create([
            'conversation_id' => $this->selected_conversation->id,
            'sender_email' => $this->auth_email,
            'receiver_email' => $this->receviverUser->email,
            'body' => $this->body,
        ]);

        // إذا كانت الرسالة فارغة أو لم تُنشأ بشكل صحيح
        if (!$createdMessage) {
            Log::error("Failed to create message.");
            return;
        }

        // تخزين الرسالة في خاصية الكلاس
        $this->createdMessage = $createdMessage;

        // تحديث المحادثة
        $this->selected_conversation->last_time_message = $createdMessage->created_at;
        $this->selected_conversation->save();


        $this->dispatch('pushMessage', $this->createdMessage->id)->to('chat.chatbox');
        $this->dispatch('refresh')->to('chat.chatlist');

        // بث الحدث بعد تخزين الرسالة
        $this->dispatch('dispatchSentMassage');

        // $this->body = null;
        $this->reset('body');


    }


    public function dispatchSentMassage()
    {
        if (Auth::guard('patient')->check()) {
            broadcast(new MassageSent(
                $this->sender,
                $this->createdMessage,  // الآن تحتوي على الرسالة الصحيحة
                $this->selected_conversation,
                $this->receviverUser
            ));
        } else {
            broadcast(new MassageSent2(
                $this->sender,
                $this->createdMessage,  // الآن تحتوي على الرسالة الصحيحة
                $this->selected_conversation,
                $this->receviverUser
            ));
        }
    }


    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
