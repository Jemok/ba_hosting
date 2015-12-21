@include('partials.messenger.new_chat_selector')

@if($threads_count > 0)
    @include('partials.messenger.loop_threads')
@else
<div class="container">
    <h5>Start a chat with <a href="{{ url('innovator/profile/'.$innovation->user_id) }}">{{ $innovation->user->first_name }} {{ $innovation->user->last_name }}</a> about {{ $innovation->innovationTitle }} </h5>

    {!! Form::open(['route' => 'messages.store']) !!}
    <div class="col-md-6">
        <!-- Subject Form Input -->
        <input type="hidden" name="innovation_id" value="{{$innovation->id}}">
        <div class="form-group">
            <!--{!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}-->
            <!--{!! Form::hidden('subject', null, ['class' => 'form-control', 'value' => '{{\Auth::user()->fullName()}}']) !!}-->
            <input type="hidden" name="subject" value="{{\Auth::user()->fullName()}}">
        </div>

        <!-- Message Form Input -->
        <div class="form-group">
            {!! Form::label('message', 'Your Message:', ['class' => 'control-label']) !!}
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>

        <input type="hidden" name="recipients[]" value="{!!$innovation->user->id!!}">

        <!-- Submit Form Input -->
        <div class="form-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endif
