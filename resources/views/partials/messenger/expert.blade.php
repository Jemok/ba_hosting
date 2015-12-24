<div class="col-sm-3">
    <ul class="list-group" id="myTab" role="tablist">
        <button class="list-group-item active" data-toggle="tab" data-target="#innovator" role="tab" aria-controls="innovator">
            Messages
            <span class="label label-success label-pill pull-right"></span>
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
        <h4>No chats available</h4>
        @endif
    </div>
    <div class="tab-pane" id="mother" role="tabpanel">@include('messenger.create_mother')</div>
</div>