<div class="bottom_wrapper clearfix">
    {!! Form::open(['route' => 'messages.store']) !!}
   
    <!-- Subject Form Input -->
    <input type="hidden" name="innovation_id" value="{{$innovation->id}}">
    <div class="form-group">
        <!--{!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}-->
        <!--{!! Form::hidden('subject', null, ['class' => 'form-control', 'value' => '{{\Auth::user()->fullName()}}']) !!}-->
        <input type="hidden" name="progress" value="{{\Auth::user()->fullName()}}">
        <input type="hidden" name="subject" value="{{\Auth::user()->fullName()}}">
    </div>
    
    <div class="message_input_wrapper">
        {!! Form::label('message', 'Your Message:', ['class' => 'control-label sr-only']) !!}
        {!! Form::textarea('message', 'Type your message here...', ['class' => 'form-control message_input']) !!}
        
        <input type="hidden" name="recipients[]" value="{!!$innovation->user->id!!}">
    </div>
    {!! Form::submit('Send', ['class' => 'form-control send_message']) !!}

    {!! Form::close() !!}
</div>

