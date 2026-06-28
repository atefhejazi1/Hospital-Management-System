<div>
    @if ($selected_conversation)
        <div class="main-content-body main-content-body-chat">
            <div class="main-chat-header">
                <span class="mc-chat-avatar">
                    {{ \Illuminate\Support\Str::of((string) $receviverUser->name)->explode(' ')->map(fn ($w) => mb_substr($w, 0, 1))->take(2)->implode('') }}
                </span>
                <div class="main-chat-msg-name">
                    <h6>{{ $receviverUser->name }}</h6>
                    <span class="mc-role-tag">
                        {{ $receviverUser instanceof \App\Models\Doctor ? trans('main-header_trans.role_doctor') : trans('main-header_trans.role_patient') }}
                    </span>
                </div>
            </div><!-- main-chat-header -->
            <div class="main-chat-body" id="ChatBody">
                <div class="content-inner">

                    @foreach ($messages as $message)
                        <div class="media {{ $auth_email == $message->sender_email ? 'flex-row-reverse' : '' }}">
                            <div class="media-body">
                                <div class="main-msg-wrapper">
                                    {{ $message->body }}
                                </div>
                                <div><span>{{ $message->created_at->format('h:i A') }}</span></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="mc-chat-empty-body">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
            <h6>{{ trans('chat_trans.select_conversation_title') }}</h6>
            <p>{{ trans('chat_trans.select_conversation_hint') }}</p>
        </div>
    @endif

</div>
