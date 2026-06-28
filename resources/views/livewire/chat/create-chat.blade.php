<div class="card mc-chat-card">
    <div class="mc-chat-list-head">
        <h6>{{ $isPatientViewer ? trans('chat_trans.doctors') : trans('chat_trans.patients') }}</h6>
        <div class="mc-chat-search">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="{{ trans('chat_trans.search_contacts_placeholder') }}">
        </div>
    </div>
    <div class="card-body">
        @forelse ($users as $user)
            <div class="mc-contact-card">
                <span class="mc-chat-avatar">{{ $this->getInitials($user) }}</span>
                <span class="mc-contact-name">{{ $user->name }}</span>
                <button type="button" class="btn-mc-start" wire:click="createConversation('{{ $user->email }}')">
                    {{ trans('chat_trans.start_chat') }}
                </button>
            </div>
        @empty
            <div class="mc-chat-empty-list">
                <p>{{ trans('chat_trans.no_contacts_found') }}</p>
            </div>
        @endforelse
    </div><!-- bd -->
</div>
