{{-- @extends('Dashboard.layouts.master') --}}
<div>
    @section('css')
        <link rel="stylesheet" href="{{ URL::asset('Dashboard/css/mc-chat.css') }}">
    @endsection
    @section('page-header')
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{ trans('chat_trans.conversations') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                        {{ trans('chat_trans.breadcrumb_recent_conversations') }}</span>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
    @endsection
    @section('content')
        <!-- row -->
        <div class="row row-sm main-content-app mb-4">
            <div class="col-xl-4 col-lg-5">
                <div class="card mc-chat-card">
                    <div class="main-content-left main-content-left-chat">
                        @livewire('chat.chatlist')
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-7">
                <div class="card mc-chat-card">
                    <a class="main-header-arrow" href="" id="ChatBodyHide"><i class="icon ion-md-arrow-back"></i></a>
                    @livewire('chat.chatbox')
                    @livewire('chat.send-message')
                </div>
            </div>
        </div>
        <!-- row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  lightslider js -->
    <script src="{{ URL::asset('Dashboard/plugins/lightslider/js/lightslider.min.js') }}"></script>
    <!--Internal  Chat js -->
    <script src="{{ URL::asset('Dashboard/js/chat.js') }}"></script>
@endsection
</div>
