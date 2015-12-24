<div class="col-sm-3">
    <ul class="list-group" id="myTab" role="tablist">
        <button class="list-group-item active" data-toggle="tab" data-target="#innovator" role="tab" aria-controls="innovator">
            Messages
            <span class="label label-success label-pill pull-right">@include('messenger.unread-count')</span>
        </button>
        <button class="list-group-item" data-toggle="tab" data-target="#expert" role="tab" aria-controls="expert">
            Expert <i class="ion-plus-round pull-right"></i>
        </button>
        <button class="list-group-item" data-toggle="tab" data-target="#mother" role="tab" aria-controls="mother">
            Mother <i class="ion-plus-round pull-right"></i>
        </button>
    </ul>
</div>

<div class="tab-content col-sm-9">
    <div class="tab-pane active" id="innovator" role="tabpanel">
        @if($threads_count > 0)
           @include('partials.messenger.loop_threads')
        @else
           @include('partials.messenger.send_form')
        @endif
    </div>
    <div class="tab-pane" id="expert" role="tabpanel">@include('messenger.create_expert')</div>
    <div class="tab-pane" id="mother" role="tabpanel">@include('messenger.create_mother')</div>
</div>
