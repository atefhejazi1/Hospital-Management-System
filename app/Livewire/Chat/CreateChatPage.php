<?php

namespace App\Livewire\Chat;

use Livewire\Component;

class CreateChatPage extends Component
{
    public function render()
    {
        return view('livewire.chat.create-chat-page')->extends('Dashboard.layouts.master');
    }
}
