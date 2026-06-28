<div>
    <div class="mc-chat-list-head">
        <h6>{{ trans('chat_trans.recent_conversations') }}</h6>
        <div class="mc-chat-search">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="{{ trans('chat_trans.search_placeholder') }}">
        </div>
    </div>

    <div class="main-chat-list" id="ChatList">
        @forelse ($conversations as $conversation)
            <div class="media {{ $selected_conversation && $selected_conversation->id === $conversation->id ? 'selected' : 'new' }}"
                wire:click="chatUserSelected({{ $conversation }},'{{ $this->getUsers($conversation, $name = 'id') }}')">
                <span class="mc-chat-avatar">{{ $this->getInitials($conversation) }}</span>
                <div class="media-body">
                    <div class="media-contact-name">
                        <span>{{ $this->getUsers($conversation, $name = 'name') }}</span>
                        <span>{{ $conversation->messages->last()->created_at->shortAbsoluteDiffForHumans() }}</span>
                    </div>
                    <p>{{ $conversation->messages->last()->body }}</p>
                </div>
            </div>
        @empty
            <div class="mc-chat-empty-list">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                <p>{{ trans('chat_trans.no_conversations_yet') }}</p>
            </div>
        @endforelse
    </div><!-- main-chat-list -->
</div>
