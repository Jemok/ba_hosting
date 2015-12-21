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