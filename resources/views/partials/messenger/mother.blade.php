<div class="col-sm-3">
    <ul class="list-group" id="myTab" role="tablist">
        <button class="list-group-item active" data-toggle="tab" data-target="#messages" role="tab" aria-controls="messages">
            Messages
            <span class="label label-success label-pill pull-right"></span>
        </button>
        @if($threads_count > 0)
        <button class="list-group-item" data-toggle="tab" data-target="#expert" role="tab" aria-controls="expert">
            Expert <i class="ion-plus-round pull-right"></i>
        </button>
        <button class="list-group-item" data-toggle="tab" data-target="investor" role="tab" aria-controls="mother">
            Mother <i class="ion-plus-round pull-right"></i>
        </button>
        @endif
    </ul>
</div>

<div class="tab-content col-sm-9">
    <div class="tab-pane active" id="messages" role="tabpanel">
        @if($threads_count > 0)
            @include('partials.messenger.loop_threads')
        @else
            @include('partials.messenger.send_form')
        @endif
    </div>
    @if($threads_count > 0)
    <div class="tab-pane" id="expert" role="tabpanel">@include('messenger.create_expert')</div>
    <div class="tab-pane" id="investor" role="tabpanel">@include('messenger.create_investor')</div>
    @endif
</div>
