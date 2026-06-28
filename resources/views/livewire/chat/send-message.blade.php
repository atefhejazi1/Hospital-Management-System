<div>
    @if ($selected_conversation)
        <form wire:submit.prevent="sendMessage">
            <div class="main-chat-footer">
                <input wire:model="body" wire:keydown.enter="sendMessage" placeholder="{{ trans('chat_trans.message_placeholder') }}"
                    type="text" autocomplete="off">
                <button class="main-msg-send" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="17" height="17"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                </button>
            </div>
        </form>
    @endif
</div>
