<div>
    @section('css')
        <link rel="stylesheet" href="{{ URL::asset('Dashboard/css/mc-chat.css') }}">
    @endsection
    @section('page-header')
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{ trans('chat_trans.conversations') }}</h4>
                </div>
            </div>
        </div>
    @endsection
    @section('content')
        <div class="row row-sm">
            <div class="col-xl-12">
                @livewire('chat.create-chat')
            </div>
        </div>
    @endsection
</div>
